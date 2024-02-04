<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/userCompare.php';



if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
    case 'asyncUser':
	$conexion = new Conexion();
	
	break;
	case 'registrar':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> registrar_afiliado('',$id_usuarios,$nombre,$apellido,$codigo,$img,$telefono,'');
		echo $resultado;
	
	break;
	case 'buscar':
		$n_afiliado  = new userCompare();
		$resultado = $n_afiliado  -> gerUserCompare();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {

		?>
		<tr>
			<td><?= $key['id']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['correo']; ?></td>
		
		</tr>
		<?php
		}
		
		die();
	break; 
	case 'cambiar_estado':
		$n_afiliado  = new afiliado();
		$resultado = $n_afiliado  -> cambiar_estado_afiliado($id, $estado);
		echo 1;
	break;
	default:
	break;
}

die();


class Conexion extends PDO
{
    private $tipo_de_base1 = 'mysql';
    private $host1 = 'localhost';
    private $nombre_de_base1 = 'u887467577_clubsky';
    private $usuario1 = 'u887467577_clubsky';
    private $contrasena1 = '6jy^O1]tP';

    private $tipo_de_base2 = 'mysql';
    private $host2 = 'localhost';
    private $nombre_de_base2 = 'u887467577_afiliado';
    private $usuario2 = 'u887467577_afiliado';
    private $contrasena2 = 'T1cswi>|';

    public function __construct()
    {
        try {
            // Conexión a la base de datos 1
            $conexion1 = new PDO($this->tipo_de_base1 . ':host=' . $this->host1 . ';dbname=' . $this->nombre_de_base1, $this->usuario1, $this->contrasena1, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

            // Conexión a la base de datos 2
            $conexion2 = new PDO($this->tipo_de_base2 . ':host=' . $this->host2 . ';dbname=' . $this->nombre_de_base2, $this->usuario2, $this->contrasena2, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

            // Consultar la base de datos 1 para obtener correo y nombre de usuario
            $query = "SELECT user_email, user_nicename FROM wp_users";
            $stmt = $conexion1->query($query);

            // Verificar si hay resultados
            if ($stmt->rowCount() > 0) {
                // Iterar a través de los resultados y almacenar en la base de datos 2
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $correo = $fila['user_email'];
                    $nombreUsuario = $fila['user_nicename'];

                    // Verificar si el correo no existe en la base de datos 2 antes de insertar
                    $verificarCorreo = "SELECT correo FROM user_compare WHERE correo = '$correo'";
                    $stmtVerificacion = $conexion2->query($verificarCorreo);

                    if ($stmtVerificacion->rowCount() == 0) {
                        // Insertar en la base de datos 2
                        $insertarQuery = "INSERT INTO user_compare (correo, nombre) VALUES ('$correo', '$nombreUsuario')";
                        $conexion2->query($insertarQuery);
                    }
                }
            } else {
                echo "No hay resultados en la base de datos 1.";
            }

            // Cerrar las conexiones
            $conexion1 = null;
            $conexion2 = null;
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede conectar o realizar la operación. Detalle: ' . $e->getMessage();
            exit;
        }
    }
}

// Crear una instancia de la clase para ejecutar la operación


