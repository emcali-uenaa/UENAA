<?php

// Configuración de la base de datos
$host = 'localhost';
$dbName = 'rol';
$username = 'root';
$password = '';

// Conexión a la base de datos
$conn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);

// Consulta SQL para obtener los datos
$query = "SELECT * FROM redesinternas";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($query);
$stmt->execute();

// Obtener los resultados de la consulta
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Nombre del archivo CSV para guardar los datos
$nombreArchivo = 'RedesInternas.csv';

// Abrir el archivo CSV en modo escritura
$archivo = fopen($nombreArchivo, 'w');

// Escribir los encabezados en el archivo CSV
$encabezados = array_keys($resultados[0]);
fputcsv($archivo, $encabezados);

// Escribir los datos en el archivo CSV
foreach ($resultados as $fila) {
    fputcsv($archivo, $fila);
}

// Cerrar el archivo CSV
fclose($archivo);

// Mostrar un mensaje de éxito
echo "Datos exportados correctamente a $nombreArchivo";

// Cerrar la conexión a la base de datos
$conn = null;

?>
<?php

if (isset($_POST['descargar'])) {
    // Nombre del archivo CSV generado anteriormente
    $nombreArchivo = 'redesinternas.csv';

    // Verificar si el archivo existe
    if (file_exists($nombreArchivo)) {
        // Descargar el archivo
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
        readfile($nombreArchivo);
    } else {
        // Mostrar un mensaje de error si el archivo no existe
        echo "El archivo no existe.";
    }
}

?>
