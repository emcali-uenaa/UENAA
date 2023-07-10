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

    // Obtener el ID del usuario a editar
    $id = $_POST["id"];

    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];
    $id_cargo = $_POST["id_cargo"];

    // Actualizar el registro en la base de datos
    $sql = "UPDATE usuarios SET nombre='$nombre', usuario='$usuario', contraseña='$contraseña', id_cargo='$id_cargo' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // Redireccionar a la página de la tabla de usuarios
        header("Location: crud administrador.php");
        exit();
    } else {
        echo "Error al actualizar el usuario: " . $conn->error;
    }

    // Cerrar conexión
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
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
        .form-label {
        display: inline-block;
        width: 200px;
        text-align: right;
    }

    .form-input {
        display: inline-block;
        width: 300px;
    }
    
    </style>
</head>
<body>
    <?php
    // Obtener el ID del usuario a editar
    $id = $_GET["id"];

    // Crear conexión
    $conn = new mysqli("localhost", "root", "", "rol");

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del usuario a editar
    $sql = "SELECT * FROM usuarios WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row["nombre"];
        $usuario = $row["usuario"];
        $contraseña = $row["contraseña"];
        $id_cargo = $row["id_cargo"];
    } else {
        echo "No se encontró el usuario.";
        exit();
    }

    // Cerrar conexión
    $conn->close();
    ?>

    <h2>Editar Usuario</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
        
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>" required>
        
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" value="<?php echo $contraseña; ?>" required>
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
