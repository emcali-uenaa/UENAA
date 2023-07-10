<?php
require "parte superior.php";

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "rol");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si se ha enviado un ID válido para editar
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idDocumento = $_GET['id'];

    // Verificar si se ha enviado el formulario de edición
    if (isset($_POST['submit'])) {
        // Obtener los datos actualizados del formulario
        $nuevoNombre = $_POST['nombre'];
        $nuevoNumeroOficio = $_POST['numero_oficio'];
        $nuevoDocumento = $_FILES['contenido']['name'];

        // Actualizar los datos en la base de datos
        $sql = "UPDATE documentos SET nombre = '$nuevoNombre', NumeroDeOficio = '$nuevoNumeroOficio', contenido = '$nuevoDocumento' WHERE id = '$idDocumento'";

        if (mysqli_query($conexion, $sql)) {
            echo "Documento actualizado correctamente";
        } else {
            echo "Error al actualizar el documento: " . mysqli_error($conexion);
        }
    }

    // Obtener los datos actuales del documento
    $sql = "SELECT * FROM documentos WHERE id = '$idDocumento'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $nombreActual = $fila['nombre'];
        $numeroOficioActual = $fila['NumeroDeOficio'];
        $documentoActual = $fila['contenido'];
?>

    <h1>Editar Documento</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $nombreActual; ?>" required><br>

        <label for="numero_oficio">Número de Oficio:</label>
        <input type="text" name="numero_oficio" value="<?php echo $numeroOficioActual; ?>" required><br>

        <label for="contenido">Documento:</label>
        <input type="file" name="contenido" required><br>

        <input type="submit" name="submit" value="Actualizar">
    </form>

<?php
    } else {
        echo "No se encontró el documento con el ID proporcionado";
    }
} else {
    echo "No se ha proporcionado un ID válido";
}

// Cierre de la conexión
mysqli_close($conexion);

require "parte inferior.php";
?>
