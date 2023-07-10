                    
<?php
require "parte superior.php";
// Configuración de conexión a MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rol";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión a MySQL: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$NoOficio = $_POST['NoOficio'];
$tipo="application/pdf";
$archivo = $_FILES['archivo'];

// Verificar si se seleccionó un archivo
if ($archivo['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $archivo['tmp_name'];

    // Leer el contenido del archivo
    $contenido = file_get_contents($tmp_name);
    

    // Guardar los metadatos y el contenido en MySQL
    $sql = "INSERT INTO documentos (nombre, NumeroDeOficio, tipo, contenido) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre,$NoOficio, $tipo, $contenido);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo "El archivo se ha subido correctamente a MySQL en ex.";
} else {
    echo "Error al subir el archivo.";
}
require "parte inferior.php"
?>
        
