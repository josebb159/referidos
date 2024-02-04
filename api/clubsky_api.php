<?php
include '../model/api.php';


// Decodifica los datos JSON
$jsonData = json_decode(file_get_contents('php://input'), true);

   

if ($jsonData === null) {
    die('Error al decodificar los datos JSON.');
}

// Registra los datos en la tabla logs_api
function logPostData($postData) {
   $connection = new mysqli("localhost", "u887467577_afiliado", "T1cswi>|", "u887467577_afiliado");

   // Verifica la conexión
   if ($connection->connect_error) {
       die("Conexión fallida: " . $connection->connect_error);
   }

   // Escapa los valores para prevenir inyección de SQL
   $postData = $connection->real_escape_string(json_encode($postData));
   $currentDate = date('Y-m-d H:i:s');

   // Inserta los datos en la tabla logs_api
   $query = "INSERT INTO logs_api (post_data, fecha_registro) VALUES ('$postData', '$currentDate')";
   $result = $connection->query($query);

   // Cierra la conexión
   $connection->close();

   // Retorna el resultado de la inserción
   return $result;
}

switch ($jsonData['data']) {
    case 'register_afiliado':
        $n_api = new api();

        // Accede a los datos decodificados
        $postDataArray = array(
            'user'   => $jsonData['user'],
            'email'  => $jsonData['email'],
            'name'   => $jsonData['name'],
            'code'   => $jsonData['codigo'],
            'number' => $jsonData['number'],
            'password' => $jsonData['password']
        );
        
        if (isset($jsonData['codigo']) && !empty($jsonData['codigo'])) {
            // La clave 'codigo' existe y no está vacía
  
            $resultado = $n_api->register_afiliato($jsonData['user'], $jsonData['email'], $jsonData['name'], $jsonData['codigo'], $jsonData['number'], $jsonData['password']);
        } else {
            // La clave 'codigo' no existe o está vacía
            echo "La clave 'codigo' no existe o está vacía.";
             $resultado =register_afiliato_no_referido($jsonData['user'], $jsonData['email'], $jsonData['name'], $jsonData['codigo'], $jsonData['number'], $jsonData['password']);
        }

        // Registra los datos en la tabla logs_api
        $resultado = $n_api->register_afiliato($jsonData['user'], $jsonData['email'], $jsonData['name'], $jsonData['codigo'], $jsonData['number'], $jsonData['password']);
        

        
        echo $resultado;
        logPostData($postDataArray);
        break;


 case 'get_code':
        $n_api = new api();

        // Accede a los datos decodificados
        $postDataArray = array(
            'user_email'   => $jsonData['user_email'],
            'data'=> $jsonData['data']
        );

        // Registra los datos en la tabla logs_api
        $resultado = $n_api->get_code( $jsonData['user_email']);
         header('Content-Type: application/json');
    echo json_encode(['codigo' => $resultado], JSON_UNESCAPED_UNICODE);

        logPostData($postDataArray);
        break;
        
    case 'payafiliato':
        $n_api = new api();

     
    $postDataArray = array(
            'user_email'   => $jsonData['user_email'],
            'data'=> $jsonData['data']
        );

        logPostData($postDataArray);
        break;
    default:
        // Manejo del caso por defecto
        break;
}
?>