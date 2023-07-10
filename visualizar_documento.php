<?php
// Conexión a la base de datos
$conexion = mysqli_connect("https://databases.000webhost.com/index.php?route=/&route=%2F", "id20953994_root", "1005966737Emcali&", "id20953994_rol");

// ID del documento que deseas abrir
$idDocumento = $_GET['id'];

// Consulta para obtener el documento de la base de datos
$query = "SELECT nombre, tipo, contenido FROM documentos WHERE id = $idDocumento";
$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $nombreArchivo = $fila['nombre'];
    $tipoContenido = $fila['tipo'];
    $contenido = $fila['contenido'];

    // Cerrar la conexión a la base de datos antes de enviar cualquier salida al navegador
    mysqli_close($conexion);

    // Establecer el encabezado para la visualización del archivo PDF
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=$nombreArchivo");

    // Imprimir el contenido en el navegador
    echo $contenido;
} else {
    // Cerrar la conexión a la base de datos si no se encontró el documento
    mysqli_close($conexion);

    echo "No se encontró el documento.";
}
?>



