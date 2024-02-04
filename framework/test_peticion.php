<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario POST con Bootstrap</title>

    <!-- Agrega los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
        <form action="api/clubsky_api.php" method="post">

            <div class="form-group">
                <label for="user">Usuario:</label>
                <input type="text" class="form-control" id="user" name="user" required>
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="code">Código:</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>

            <div class="form-group">
                <label for="number">Número:</label>
                <input type="text" class="form-control" id="number" name="number" required>
            </div>

            <input type="hidden" name="data" value="register_afiliado">
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>
    </div>

    <!-- Agrega los scripts de Bootstrap (opcional, pero algunas funciones requieren esto) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>