<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "rol");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si se recibió el ID del proyecto a eliminar
if (isset($_GET['id'])) {
    // Obtener el ID del proyecto
    $idProyecto = $_GET['id'];

    // Consulta SQL para eliminar el proyecto por su ID
    $sql = "DELETE FROM documentos_conc WHERE id = $idProyecto";

    if (mysqli_query($conexion, $sql)) {
        echo "se elimino correctamente el documento.";
    } else {
        echo "Error al eliminar el documento: " . mysqli_error($conexion);
    }
} else {
    echo "ID de proyecto no especificado.";
}

// Cerrar la conexión
mysqli_close($conexion);

// Redireccionar al usuario a la página principal de proyectos
header("Location: visualizar conc.php");
exit;
?>
