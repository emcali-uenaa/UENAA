<?php
require "parte superior.php";
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "rol");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta SQL para obtener los proyectos
$sql = "SELECT * FROM conceptostecnicos";
$resultado = mysqli_query($conexion, $sql);


// Obtener el término de búsqueda enviado desde el formulario
$terminoBusqueda = isset($_GET['termino_busqueda']) ? $_GET['termino_busqueda'] : '';

// Consulta SQL para buscar proyectos que coincidan con el término de búsqueda
$sql = "SELECT * FROM conceptostecnicos WHERE id LIKE '%$terminoBusqueda%' OR
  Numero LIKE '%$terminoBusqueda%' OR
  Sector LIKE '%$terminoBusqueda%' OR
  `Comuna / Localidad` LIKE '%$terminoBusqueda%' OR
  `Ciudad ó Municipio` LIKE '%$terminoBusqueda%' OR
  `Nombre del Concepto` LIKE '%$terminoBusqueda%' OR
  ESTADO LIKE '%$terminoBusqueda%' OR
  `FECHA ESTADO` LIKE '%$terminoBusqueda%' OR
  `INGENIERO ASIGNADO` LIKE '%$terminoBusqueda%' OR
  `Fecha Ingreso 1` LIKE '%$terminoBusqueda%' OR
  `MES INGRESO` LIKE '%$terminoBusqueda%' OR
  `Radicacion No.` LIKE '%$terminoBusqueda%' OR
  `Fecha Ultima Modificacion` LIKE '%$terminoBusqueda%' OR
  `Direccion de la Obra` LIKE '%$terminoBusqueda%' OR
  `Propietario de la Obra` LIKE '%$terminoBusqueda%' OR
  `CC ó NIT Propietario` LIKE '%$terminoBusqueda%' OR
  `Direccion Propietario` LIKE '%$terminoBusqueda%' OR
  `Telefono Propietario` LIKE '%$terminoBusqueda%' OR
  `Correo Electronico Propietario` LIKE '%$terminoBusqueda%' OR
  `Firma Consultora ó Proyectista` LIKE '%$terminoBusqueda%' OR
  `Direccion Firma Consultora ó Proyectista` LIKE '%$terminoBusqueda%' OR
  `Telefono del Proyectista` LIKE '%$terminoBusqueda%' OR
  `Correo Electronico Firma Consultora ó Proyectista` LIKE '%$terminoBusqueda%' OR
  `Fecha Aprobación 1` LIKE '%$terminoBusqueda%' OR
  `FechaDevolución 1` LIKE '%$terminoBusqueda%' OR
  `Tiempo Rev. 1` LIKE '%$terminoBusqueda%' OR
  `Fecha Ingreso 2` LIKE '%$terminoBusqueda%' OR
  `Fecha Aprobación 2` LIKE '%$terminoBusqueda%' OR
  `Fecha Devolución 2` LIKE '%$terminoBusqueda%' OR
  `Tiempo Rev. 2` LIKE '%$terminoBusqueda%' OR
  `Fecha Ingreso 3` LIKE '%$terminoBusqueda%' OR
  `Fecha Aprobación 3` LIKE '%$terminoBusqueda%' OR
  `Fecha Devolución 3` LIKE '%$terminoBusqueda%' OR
  `Tiempo Rev. 3` LIKE '%$terminoBusqueda%' OR
  `Fecha Ingreso 4` LIKE '%$terminoBusqueda%' OR
  `Fecha Aprobación 4` LIKE '%$terminoBusqueda%' OR
  `Fecha Devolución 4` LIKE '%$terminoBusqueda%' OR
  `Tiempo Rev. 4` LIKE '%$terminoBusqueda%' OR
  `DiasEnRevision` LIKE '%$terminoBusqueda%' OR
  `TotalRev` LIKE '%$terminoBusqueda%'
";

$resultado = mysqli_query($conexion, $sql);

// Verificar si se encontraron registros
if (mysqli_num_rows($resultado) > 0) {

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>CONCEPTOS TECNICOS</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }.button-container {
                text-align: right;
            }tr:hover {
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
            background-color: #f44336;
            color: white;
            margin-bottom: 10px;
        }
        </style>
    </head>
    <body>
    <div class="button-container">
            <form action="descargarconc.php" method="post">
                <input type="submit" name="descargar" value="Descargar Datos">
            </form>
        </div>
        <h2>CONCEPTOS TECNICOS</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <button onclick="window.location.href = 'crear_conc.php';" class="btn btn-agregar">crear nuevo proyecto</button>
        <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#dataTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
       <table>
    <tr>
        <th>Número</th>
        <th>Sector</th>
        <th>Comuna / Localidad</th>
        <th>Ciudad ó Municipio</th>
        <th>Nombre del Concepto</th>
        <th>ESTADO</th>
        <th>FECHA ESTADO</th>
        <th>INGENIERO ASIGNADO</th>
        <th>Fecha Ingreso 1</th>
        <th>MES INGRESO</th>
        <th>Radicacion No.</th>
        <th>Fecha Ultima Modificacion</th>
        <th>Direccion de la Obra</th>
        <th>Propietario de la Obra</th>
        <th>CC ó NIT Propietario</th>
        <th>Direccion Propietario</th>
        <th>Telefono Propietario</th>
        <th>Correo Electronico Propietario</th>
        <th>Firma Consultora ó Proyectista</th>
        <th>Direccion Firma Consultora ó Proyectista</th>
        <th>Telefono del Proyectista</th>
        <th>Correo Electronico Firma Consultora ó Proyectista</th>
        <th>Fecha Aprobación 1</th>
        <th>FechaDevolución 1</th>
        <th>Tiempo Rev. 1</th>
        <th>Fecha Ingreso 2</th>
        <th>Fecha Aprobación 2</th>
        <th>Fecha Devolución 2</th>
        <th>Tiempo Rev. 2</th>
        <th>Fecha Ingreso 3</th>
        <th>Fecha Aprobación 3</th>
        <th>Fecha Devolución 3</th>
        <th>Tiempo Rev. 3</th>
        <th>Fecha Ingreso 4</th>
        <th>Fecha Aprobación 4</th>
        <th>Fecha Devolución 4</th>
        <th>Tiempo Rev. 4</th>
        <th>Dias En Revision</th>
        <th># de Revisiones</th>
        <th>acciones</th>
    </tr>
           <?php

            // Iterar sobre los resultados y mostrar los datos en la tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
    <td><?php echo $fila['Numero']; ?></td>
    <td><?php echo $fila['Sector']; ?></td>
    <td><?php echo $fila['Comuna / Localidad']; ?></td>
    <td><?php echo $fila['Ciudad ó Municipio']; ?></td>
    <td><?php echo $fila['Nombre del Concepto']; ?></td>
    <td><?php echo $fila['ESTADO']; ?></td>
    <td><?php echo $fila['FECHA ESTADO']; ?></td>
    <td><?php echo $fila['INGENIERO ASIGNADO']; ?></td>
    <td><?php echo $fila['Fecha Ingreso 1']; ?></td>
    <td><?php echo $fila['MES INGRESO']; ?></td>
    <td><?php echo $fila['Radicacion No.']; ?></td>
    <td><?php echo $fila['Fecha Ultima Modificacion']; ?></td>
    <td><?php echo $fila['Direccion de la Obra']; ?></td>
    <td><?php echo $fila['Propietario de la Obra']; ?></td>
    <td><?php echo $fila['CC ó NIT Propietario']; ?></td>
    <td><?php echo $fila['Direccion Propietario']; ?></td>
    <td><?php echo $fila['Telefono Propietario']; ?></td>
    <td><?php echo $fila['Correo Electronico Propietario']; ?></td>
    <td><?php echo $fila['Firma Consultora ó Proyectista']; ?></td>
    <td><?php echo $fila['Direccion Firma Consultora ó Proyectista']; ?></td>
    <td><?php echo $fila['Telefono del Proyectista']; ?></td>
    <td><?php echo $fila['Correo Electronico Firma Consultora ó Proyectista']; ?></td>
    <td><?php echo $fila['Fecha Aprobación 1']; ?></td>
    <td><?php echo $fila['FechaDevolución 1']; ?></td>
    <td><?php echo $fila['Tiempo Rev. 1']; ?></td>
    <td><?php echo $fila['Fecha Ingreso 2']; ?></td>
    <td><?php echo $fila['Fecha Aprobación 2']; ?></td>
    <td><?php echo $fila['Fecha Devolución 2']; ?></td>
    <td><?php echo $fila['Tiempo Rev. 2']; ?></td>
    <td><?php echo $fila['Fecha Ingreso 3']; ?></td>
    <td><?php echo $fila['Fecha Aprobación 3']; ?></td>
    <td><?php echo $fila['Fecha Devolución 3']; ?></td>
    <td><?php echo $fila['Tiempo Rev. 3']; ?></td>
    <td><?php echo $fila['Fecha Ingreso 4']; ?></td>
    <td><?php echo $fila['Fecha Aprobación 4']; ?></td>
    <td><?php echo $fila['Fecha Devolución 4']; ?></td>
    <td><?php echo $fila['Tiempo Rev. 4']; ?></td>
    <td><?php echo $fila['DiasEnRevision']; ?></td>
    <td><?php echo $fila['TotalRev']; ?></td>


                    <td>
                        <a href="editar_conc.php?id=<?php echo $fila['id']; ?>" class="btn btn-editar">Editar</a>
                        <a href="eliminar_conc.php?id=<?php echo $fila['id']; ?>" class="btn btn-eliminar">Eliminar</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
<?php
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>CONCEPTOS TECNICOS</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }.button-container {
                text-align: right;
            }tr:hover {
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
            background-color: #f44336;
            color: white;
            margin-bottom: 10px;
        }
        </style>
    </head>
    <body>
    <div class="button-container">
            <form action="descargarconc.php" method="post">
                <input type="submit" name="descargar" value="Descargar Datos">
            </form>
        </div>
        <h2>CONCEPTOS TECNICOS</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <button onclick="window.location.href = 'crear_conc.php';" class="btn btn-agregar">crear nuevo proyecto</button>
        <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#dataTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
          <table>
    <tr>
        <th>Número</th>
        <th>Sector</th>
        <th>Comuna / Localidad</th>
        <th>Ciudad ó Municipio</th>
        <th>Nombre del Concepto</th>
        <th>ESTADO</th>
        <th>FECHA ESTADO</th>
        <th>INGENIERO ASIGNADO</th>
        <th>Fecha Ingreso 1</th>
        <th>MES INGRESO</th>
        <th>Radicacion No.</th>
        <th>Fecha Ultima Modificacion</th>
        <th>Direccion de la Obra</th>
        <th>Propietario de la Obra</th>
        <th>CC ó NIT Propietario</th>
        <th>Direccion Propietario</th>
        <th>Telefono Propietario</th>
        <th>Correo Electronico Propietario</th>
        <th>Firma Consultora ó Proyectista</th>
        <th>Direccion Firma Consultora ó Proyectista</th>
        <th>Telefono del Proyectista</th>
        <th>Correo Electronico Firma Consultora ó Proyectista</th>
        <th>Fecha Aprobación 1</th>
        <th>FechaDevolución 1</th>
        <th>Tiempo Rev. 1</th>
        <th>Fecha Ingreso 2</th>
        <th>Fecha Aprobación 2</th>
        <th>Fecha Devolución 2</th>
        <th>Tiempo Rev. 2</th>
        <th>Fecha Ingreso 3</th>
        <th>Fecha Aprobación 3</th>
        <th>Fecha Devolución 3</th>
        <th>Tiempo Rev. 3</th>
        <th>Fecha Ingreso 4</th>
        <th>Fecha Aprobación 4</th>
        <th>Fecha Devolución 4</th>
        <th>Tiempo Rev. 4</th>
        <th>Dias En Revision</th>
        <th># de Revisiones</th>
        <th>acciones</th>
    </tr>
            <?php

    echo "No se encontraron registros.";
}

// Cerrar la conexión
mysqli_close($conexion);
require "parte inferior.php";
?>
