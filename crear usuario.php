<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rol";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];
    $id_cargo = $_POST["id_cargo"];

    // Insertar el nuevo registro en la base de datos
    $sql = "INSERT INTO usuarios (nombre, usuario, contraseña, id_cargo)
            VALUES ('$nombre', '$usuario', '$contraseña', '$id_cargo')";

    if ($conn->query($sql) === TRUE) {
        // Redireccionar a la página de la tabla de usuarios
        header("Location: crud administrador.php");
        exit();
    } else {
        echo "Error al crear el usuario: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Nuevo Usuario</title>
    <style>
        label {
            display: block;
            margin-bottom: 10px;
        }
        
        input[type="text"], input[type="password"] {
            width: 300px;
            padding: 6px 12px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        
        .btn {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            background-color: #008CBA;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Agregar Nuevo Usuario</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>
        
        <label for="id_cargo">Cargo:</label>
        <select id="id_cargo" name="id_cargo" required>
            <option value="">Seleccionar cargo</option>
            <option value="1">Administrador</option>
            <option value="2">Usuario</option>
        </select>
        
        <input type="submit" value="Guardar" class="btn">
    </form>
</body>
</html>
