
<?php
require "parte superior.php";
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "rol");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$sql = "SELECT usuarios.id, usuarios.nombre, usuarios.usuario, usuarios.contraseña, usuarios.fecha, cargo.descripcion
        FROM usuarios
        INNER JOIN cargo ON usuarios.id_cargo = cargo.id
        ORDER BY usuarios.id DESC";

$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Usuarios</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        .btn {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
        }
        
        .btn-editar {
            background-color: #4CAF50;
            color: white;
        }
        
        .btn-eliminar {
            background-color: #f44336;
            color: white;
        }
        
        .btn-agregar {
            background-color: #008CBA;
            color: white;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Usuarios</h2>
    <a href="crear usuario.php" class="btn btn-agregar">Agregar Nuevo Usuario</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Fecha</th>
            <th>Cargo</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Imprimir los datos de cada registro
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["usuario"] . "</td>";
                echo "<td>" . $row["contraseña"] . "</td>";
                echo "<td>" . $row["fecha"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
                echo "<td>";
                echo "<a href='editar usuario.php?id=" . $row["id"] . "' class='btn btn-editar'>Editar</a>";
                echo "<a href='eliminar usuario.php?id=" . $row["id"] . "' class='btn btn-eliminar'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No se encontraron registros.</td></tr>";
        }
        ?>
    </table>
</body>
</html
<?php
// Cerrar conexión
$conexion->close();
require "parte inferior.php";
?>


