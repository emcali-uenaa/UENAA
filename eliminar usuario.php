<?php
$conexion = mysqli_connect("localhost", "root", "", "rol");

$id = $_GET["id"];

$sql = "DELETE FROM usuarios WHERE id = '$id'";

if ($conexion->query($sql) === TRUE) {
    echo "Registro eliminado exitosamente.";
    header("Location: crud administrador.php");
} else {
    echo "Error al eliminar el registro: " . $conn->error;
}
?>