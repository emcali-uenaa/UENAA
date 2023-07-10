<!DOCTYPE html>
<html>
<head>
<style>.form-label {
        display: inline-block;
        width: 200px;
        text-align: right;
    }

    .form-input {
        display: inline-block;
        width: 300px;
    }
    </style>
    <title>Editar Conceptos Tecnicos</title>
</head>
<body>
    <?php
    require "parte superior.php";
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "rol");

    // Verificar la conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Verificar si se ha enviado el formulario de edición
    if (isset($_POST['editar'])) {
        // Obtener los valores del formulario
        $id = $_POST['id'];
        $Numero = $_POST['Numero'];
        $Sector = $_POST['Sector'];
        $ComunaLocalidad = $_POST['ComunaLocalidad'];
        $CiudadMunicipio = $_POST['CiudadMunicipio'];
        $NombreConcepto = $_POST['NombreConcepto'];
        $ESTADO = $_POST['Estado'];
        $FECHAESTADO = $_POST['FechaEstado'];
        $INGENIEROASIGNADO = $_POST['IngenieroAsignado'];
        $MESINGRESO = $_POST['MesIngreso'];
        $RadicacionNo = $_POST['RadicacionNo'];
        $FechaUltimaModificacion = $_POST['FechaUltimaModificacion'];
        $DireccionObra = $_POST['DireccionObra'];
        $PropietarioObra = $_POST['PropietarioObra'];
        $CCNITPropietario = $_POST['CCNITPropietario'];
        $DireccionPropietario = $_POST['DireccionPropietario'];
        $TelefonoPropietario = $_POST['TelefonoPropietario'];
        $CorreoElectronicoPropietario = $_POST['CorreoElectronicoPropietario'];
        $FirmaConsultoraProyectista = $_POST['FirmaConsultoraProyectista'];
        $DireccionFirmaConsultoraProyectista = $_POST['DireccionFirmaConsultoraProyectista'];
        $TelefonoProyectista = $_POST['TelefonoProyectista'];
        $CorreoElectronicoFirmaConsultoraProyectista = $_POST['FirmaConsultoraProyectista'];
        $FechaAprobacion1 = $_POST['FechaAprobacion1'];
        $FechaAprobacion2 = $_POST['FechaAprobacion2'];
        $FechaAprobacion3 = $_POST['FechaAprobacion3'];
        $FechaAprobacion4 = $_POST['FechaAprobacion4'];
        

             
// Obtener las fechas de revisión y devolución
$fIngreso1 =$_POST['FechaIngreso1'];
$fechaDevolucion1 = $_POST['FechaDevolucion1'];

// Función para calcular los días hábiles entre dos fechas
function calcularDiasHabiles($fechaInicio, $fechaFin) {
    // Convertir las fechas a objetos DateTime
    $fechaInicio = new DateTime($fechaInicio);
    $fechaFin = new DateTime($fechaFin);

    // Contador para los días hábiles
    $contadorDiasHabiles = 0;

    // Bucle para contar los días hábiles
    $intervalo = new DateInterval('P1D'); // Intervalo de un día
    $periodo = new DatePeriod($fechaInicio, $intervalo, $fechaFin);
    foreach ($periodo as $fecha) {
        $diaSemana = $fecha->format('N'); // Obtener el día de la semana
        if ($diaSemana <= 5 && !esFestivo($fecha)) {
            $contadorDiasHabiles++;
        }
    }

    return $contadorDiasHabiles;
}

// Función para verificar si una fecha es festiva
function esFestivo($fecha) {
    $festivos = obtenerFestivos($fecha->format('Y'));
    return in_array($fecha->format('Y-m-d'), $festivos);
}

// Función para obtener los días festivos en Colombia para un año específico
function obtenerFestivos($anio) {
    // Array con las fechas de los días festivos en Colombia para un año específico
    $festivos = array(
        $anio . '-01-01', // Año Nuevo
        $anio . '-01-06', // Día de Reyes
        $anio . '-03-19', // Día de San José
        $anio . '-04-09', // Jueves Santo
        $anio . '-04-10', // Viernes Santo
        $anio . '-05-01', // Día del Trabajo
        $anio . '-05-17', // Día de la Ascensión
        $anio . '-06-07', // Día de la Corpus Christi
        $anio . '-06-14', // Día del Sagrado Corazón
        $anio . '-07-20', // Día de la Independencia
        $anio . '-08-07', // Batalla de Boyacá
        $anio . '-08-15', // Asunción de la Virgen
        $anio . '-10-12', // Día de la Raza
        $anio . '-11-01', // Día de Todos los Santos
        $anio . '-11-11', // Independencia de Cartagena
        $anio . '-12-08', // Día de la Inmaculada Concepción
        $anio . '-12-25', // Navidad
        $anio . '-12-31'  // Fin de Año
    );

    return $festivos;
}

// Calcular los días hábiles
$diasRevision1 = calcularDiasHabiles($fIngreso1, $fechaDevolucion1);

// Verificar si las fechas están dentro de un fin de semana y ajustar los días hábiles
$inicioSemana = (int)$fIngreso1;
$finSemana = (int)$fechaDevolucion1;
if ($inicioSemana <= 5 && $finSemana >= 6) {
    $diasRevision1 -= 2; // Restar 2 días si la revisión y devolución abarcan un fin de semana completo
} elseif ($inicioSemana == 6) {
    $diasRevision1 -= 1; // Restar 1 día si la revisión comienza en sábado
} elseif ($finSemana == 7) {
    $diasRevision1 -= 1; // Restar 1 día si la devolución es domingo
}

        $fechaRevision2 = $_POST['FechaIngreso2'];
        $fechaDevolucion2 = $_POST['FechaDevolucion2'];


function calcularDiasHabiles2($fechaInicio, $fechaFin) {
    // Convertir las fechas a objetos DateTime
    $fechaInicio = new DateTime($fechaInicio);
    $fechaFin = new DateTime($fechaFin);

    // Contador para los días hábiles
    $contadorDiasHabiles = 0;

    // Bucle para contar los días hábiles
    $intervalo = new DateInterval('P1D'); // Intervalo de un día
    $periodo = new DatePeriod($fechaInicio, $intervalo, $fechaFin);
    foreach ($periodo as $fecha) {
        $diaSemana = $fecha->format('N'); // Obtener el día de la semana
        if ($diaSemana <= 5 && !esFestivo($fecha)) {
            $contadorDiasHabiles++;
        }
    }

    return $contadorDiasHabiles;
}

// Función para verificar si una fecha es festiva
function esFestivo2($fecha) {
    $festivos = obtenerFestivos2($fecha->format('Y'));
    return in_array($fecha->format('Y-m-d'), $festivos);
}

// Función para obtener los días festivos en Colombia para un año específico
function obtenerFestivos2($anio) {
    // Array con las fechas de los días festivos en Colombia para un año específico
    $festivos = array(
        $anio . '-01-01', // Año Nuevo
        $anio . '-01-06', // Día de Reyes
        $anio . '-03-19', // Día de San José
        $anio . '-04-09', // Jueves Santo
        $anio . '-04-10', // Viernes Santo
        $anio . '-05-01', // Día del Trabajo
        $anio . '-05-17', // Día de la Ascensión
        $anio . '-06-07', // Día de la Corpus Christi
        $anio . '-06-14', // Día del Sagrado Corazón
        $anio . '-07-20', // Día de la Independencia
        $anio . '-08-07', // Batalla de Boyacá
        $anio . '-08-15', // Asunción de la Virgen
        $anio . '-10-12', // Día de la Raza
        $anio . '-11-01', // Día de Todos los Santos
        $anio . '-11-11', // Independencia de Cartagena
        $anio . '-12-08', // Día de la Inmaculada Concepción
        $anio . '-12-25', // Navidad
        $anio . '-12-31'  // Fin de Año
    );

    return $festivos;
}

// Calcular los días hábiles
$diasRevision2 = calcularDiasHabiles2($fechaRevision2, $fechaDevolucion2);

// Verificar si las fechas están dentro de un fin de semana y ajustar los días hábiles
$inicioSemana = (int)$fechaRevision2;
$finSemana = (int)$fechaDevolucion2;
if ($inicioSemana <= 5 && $finSemana >= 6) {
    $diasRevision2 -= 2; // Restar 2 días si la revisión y devolución abarcan un fin de semana completo
} elseif ($inicioSemana == 6) {
    $diasRevision2 -= 1; // Restar 1 día si la revisión comienza en sábado
} elseif ($finSemana == 7) {
    $diasRevision2 -= 1; // Restar 1 día si la devolución es domingo
}

        
        $fechaRevision3 = $_POST['FechaIngreso3'];
        $fechaDevolucion3 = $_POST['FechaDevolucion3'];
        function calcularDiasHabiles3($fechaInicio, $fechaFin) {
            // Convertir las fechas a objetos DateTime
            $fechaInicio = new DateTime($fechaInicio);
            $fechaFin = new DateTime($fechaFin);
        
            // Contador para los días hábiles
            $contadorDiasHabiles = 0;
        
            // Bucle para contar los días hábiles
            $intervalo = new DateInterval('P1D'); // Intervalo de un día
            $periodo = new DatePeriod($fechaInicio, $intervalo, $fechaFin);
            foreach ($periodo as $fecha) {
                $diaSemana = $fecha->format('N'); // Obtener el día de la semana
                if ($diaSemana <= 5 && !esFestivo($fecha)) {
                    $contadorDiasHabiles++;
                }
            }
        
            return $contadorDiasHabiles;
        }
        
        // Función para verificar si una fecha es festiva
        function esFestivo3($fecha) {
            $festivos = obtenerFestivos3($fecha->format('Y'));
            return in_array($fecha->format('Y-m-d'), $festivos);
        }
        
        // Función para obtener los días festivos en Colombia para un año específico
        function obtenerFestivos3($anio) {
            // Array con las fechas de los días festivos en Colombia para un año específico
            $festivos = array(
                $anio . '-01-01', // Año Nuevo
                $anio . '-01-06', // Día de Reyes
                $anio . '-03-19', // Día de San José
                $anio . '-04-09', // Jueves Santo
                $anio . '-04-10', // Viernes Santo
                $anio . '-05-01', // Día del Trabajo
                $anio . '-05-17', // Día de la Ascensión
                $anio . '-06-07', // Día de la Corpus Christi
                $anio . '-06-14', // Día del Sagrado Corazón
                $anio . '-07-20', // Día de la Independencia
                $anio . '-08-07', // Batalla de Boyacá
                $anio . '-08-15', // Asunción de la Virgen
                $anio . '-10-12', // Día de la Raza
                $anio . '-11-01', // Día de Todos los Santos
                $anio . '-11-11', // Independencia de Cartagena
                $anio . '-12-08', // Día de la Inmaculada Concepción
                $anio . '-12-25', // Navidad
                $anio . '-12-31'  // Fin de Año
            );
        
            return $festivos;
        }
        
        // Calcular los días hábiles
        $diasRevision3 = calcularDiasHabiles3($fechaRevision3, $fechaDevolucion3);
        
        // Verificar si las fechas están dentro de un fin de semana y ajustar los días hábiles
        $inicioSemana = (int)$fechaRevision3;
        $finSemana = (int)$fechaDevolucion3;
        if ($inicioSemana <= 5 && $finSemana >= 6) {
            $diasRevision3 -= 2; // Restar 2 días si la revisión y devolución abarcan un fin de semana completo
        } elseif ($inicioSemana == 6) {
            $diasRevision3 -= 1; // Restar 1 día si la revisión comienza en sábado
        } elseif ($finSemana == 7) {
            $diasRevision3 -= 1; // Restar 1 día si la devolución es domingo
        }
        $fechaRevision4 = $_POST['FechaIngreso4'];
        $fechaDevolucion4 = $_POST['FechaDevolucion4'];
        function calcularDiasHabiles4($fechaInicio, $fechaFin) {
            // Convertir las fechas a objetos DateTime
            $fechaInicio = new DateTime($fechaInicio);
            $fechaFin = new DateTime($fechaFin);
        
            // Contador para los días hábiles
            $contadorDiasHabiles = 0;
        
            // Bucle para contar los días hábiles
            $intervalo = new DateInterval('P1D'); // Intervalo de un día
            $periodo = new DatePeriod($fechaInicio, $intervalo, $fechaFin);
            foreach ($periodo as $fecha) {
                $diaSemana = $fecha->format('N'); // Obtener el día de la semana
                if ($diaSemana <= 5 && !esFestivo($fecha)) {
                    $contadorDiasHabiles++;
                }
            }
        
            return $contadorDiasHabiles;
        }
        
        // Función para verificar si una fecha es festiva
        function esFestivo4($fecha) {
            $festivos = obtenerFestivos4($fecha->format('Y'));
            return in_array($fecha->format('Y-m-d'), $festivos);
        }
        
        // Función para obtener los días festivos en Colombia para un año específico
        function obtenerFestivos4($anio) {
            // Array con las fechas de los días festivos en Colombia para un año específico
            $festivos = array(
                $anio . '-01-01', // Año Nuevo
                $anio . '-01-06', // Día de Reyes
                $anio . '-03-19', // Día de San José
                $anio . '-04-09', // Jueves Santo
                $anio . '-04-10', // Viernes Santo
                $anio . '-05-01', // Día del Trabajo
                $anio . '-05-17', // Día de la Ascensión
                $anio . '-06-07', // Día de la Corpus Christi
                $anio . '-06-14', // Día del Sagrado Corazón
                $anio . '-07-20', // Día de la Independencia
                $anio . '-08-07', // Batalla de Boyacá
                $anio . '-08-15', // Asunción de la Virgen
                $anio . '-10-12', // Día de la Raza
                $anio . '-11-01', // Día de Todos los Santos
                $anio . '-11-11', // Independencia de Cartagena
                $anio . '-12-08', // Día de la Inmaculada Concepción
                $anio . '-12-25', // Navidad
                $anio . '-12-31'  // Fin de Año
            );
        
            return $festivos;
        }
        
        // Calcular los días hábiles
        $diasRevision4 = calcularDiasHabiles4($fechaRevision4, $fechaDevolucion4);
        
        // Verificar si las fechas están dentro de un fin de semana y ajustar los días hábiles
        $inicioSemana = (int)$fechaRevision4;
        $finSemana = (int)$fechaDevolucion4;
        if ($inicioSemana <= 5 && $finSemana >= 6) {
            $diasRevision4 -= 2; // Restar 2 días si la revisión y devolución abarcan un fin de semana completo
        } elseif ($inicioSemana == 6) {
            $diasRevision4 -= 1; // Restar 1 día si la revisión comienza en sábado
        } elseif ($finSemana == 7) {
            $diasRevision4 -= 1; // Restar 1 día si la devolución es domingo
        }
        
        $diasEnRevision = $diasRevision1+$diasRevision2+$diasRevision3+$diasRevision4;
       
        if($diasRevision1>=1){ 
            $TotalRev = 1;
            if($diasRevision2>=1){ 
                $TotalRev = 2;
                
            }if($diasRevision3>=1){ 
                $TotalRev = 3;
                
            }if($diasRevision4>=1){ 
                $TotalRev = 4;
            }
        }else{
            $TotalRev =0;
        }
        
        // Actualizar el registro en la base de datos
        $sql = "UPDATE conceptostecnicos SET 
                    Numero = '$Numero',
    Sector = '$Sector',
    `Comuna / Localidad` = '$ComunaLocalidad',
    `Ciudad ó Municipio` = '$CiudadMunicipio',
    `Nombre del Concepto` = '$NombreConcepto',
    ESTADO = '$ESTADO',
    `FECHA ESTADO` = '$FECHAESTADO',
    `INGENIERO ASIGNADO` = '$INGENIEROASIGNADO',
    `Fecha Ingreso 1` = '$fIngreso1',
    `MES INGRESO` = '$MESINGRESO',
    `Radicacion No.` = '$RadicacionNo',
    `Fecha Ultima Modificacion` = '$FechaUltimaModificacion',
    `Direccion de la Obra` = '$DireccionObra',
    `Propietario de la Obra` = '$PropietarioObra',
    `CC ó NIT Propietario` = '$CCNITPropietario',
    `Direccion Propietario` = '$DireccionPropietario',
    `Telefono Propietario` = '$TelefonoPropietario',
    `Correo Electronico Propietario` = '$CorreoElectronicoPropietario',
    `Firma Consultora ó Proyectista` = '$FirmaConsultoraProyectista',
    `Direccion Firma Consultora ó Proyectista` = '$DireccionFirmaConsultoraProyectista',
    `Telefono del Proyectista` = '$TelefonoProyectista',
    `Correo Electronico Firma Consultora ó Proyectista` = '$CorreoElectronicoFirmaConsultoraProyectista',
    `Fecha Aprobación 1` = '$FechaAprobacion1',
    `FechaDevolución 1` = '$fechaDevolucion1',
    `Tiempo Rev. 1` = '$diasRevision1',
    `Fecha Ingreso 2` = '$fechaRevision2',
    `Fecha Aprobación 2` = '$FechaAprobacion2',
    `Fecha Devolución 2` = '$fechaDevolucion2',
    `Tiempo Rev. 2` = '$diasRevision2',
    `Fecha Ingreso 3` = '$fechaRevision3',
    `Fecha Aprobación 3` = '$FechaAprobacion3',
    `Fecha Devolución 3` = '$fechaDevolucion3',
    `Tiempo Rev. 3` = '$diasRevision3',
    `Fecha Ingreso 4` = '$fechaRevision4',
    `Fecha Aprobación 4` = '$FechaAprobacion4',
    `Fecha Devolución 4` = '$fechaDevolucion4',
    `Tiempo Rev. 4` = '$diasRevision4',
    `DiasEnRevision` = '$diasEnRevision',
    `TotalRev` = '$TotalRev'
                WHERE id='$id'";

        if (mysqli_query($conexion, $sql)) {
            echo "Registro actualizado correctamente.";
       
        } else {
            echo "Error al actualizar el registro: " . mysqli_error($conexion);
        }
    }

    // Obtener el ID del proyecto a editar
    $idProyecto = $_GET['id'];

    // Consulta SQL para obtener el proyecto específico
    $sql = "SELECT * FROM conceptostecnicos WHERE id='$idProyecto'";
    $resultado = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    ?>

    <h1>Editar Conceptos Tecnicos</h1>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
       
        <label class="form-label" >Numero:</label>
    <input type="text" name="Numero" value=" <?php echo $fila['Numero']; ?>"class="form-input"><br>

    <label class="form-label">Sector:</label>
    <input type="text" name="Sector" value="<?php echo $fila['Sector']; ?>" class="form-input"><br>

    <label class="form-label">Comuna / Localidad:</label>
    <input type="text" name="ComunaLocalidad" value="<?php echo $fila['Comuna / Localidad']; ?>" class="form-input"><br>

    <label class="form-label">Ciudad ó Municipio:</label>
    <input type="text" name="CiudadMunicipio" value="<?php echo $fila['Ciudad ó Municipio']; ?>" class="form-input"><br>

    <label class="form-label">Nombre del Concepto:</label>
    <input type="text" name="NombreConcepto" value="<?php echo $fila['Nombre del Concepto']; ?>" class="form-input"><br>

    <label class="form-label">ESTADO:</label>
    <input type="text" name="Estado" value="<?php echo $fila['ESTADO']; ?>" class="form-input"><br>

    <label class="form-label">FECHA ESTADO:</label>
    <input type="date" name="FechaEstado" value="<?php echo $fila['FECHA ESTADO']; ?>" class="form-input"><br>

    <label class="form-label">INGENIERO ASIGNADO:</label>
    <input type="text" name="IngenieroAsignado" value="<?php echo $fila['INGENIERO ASIGNADO']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Ingreso 1:</label>
    <input type="date" name="FechaIngreso1" value="<?php echo $fila['Fecha Ingreso 1']; ?>" class="form-input"><br>

    <label class="form-label">MES INGRESO:</label>
    <input type="text" name="MesIngreso" value="<?php echo $fila['MES INGRESO']; ?>" class="form-input"><br>

    <label class="form-label">Radicacion No.:</label>
    <input type="text" name="RadicacionNo" value="<?php echo $fila['Radicacion No.']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Ultima Modificacion:</label>
    <input type="date" name="FechaUltimaModificacion" value="<?php echo $fila['Fecha Ultima Modificacion']; ?>" class="form-input"><br>

    <label class="form-label">Direccion de la Obra:</label>
    <input type="text" name="DireccionObra" value="<?php echo $fila['Direccion de la Obra']; ?>" class="form-input"><br>

    <label class="form-label">Propietario de la Obra:</label>
    <input type="text" name="PropietarioObra" value="<?php echo $fila['Propietario de la Obra']; ?>" class="form-input"><br>

    <label class="form-label">CC ó NIT Propietario:</label>
    <input type="text" name="CCNITPropietario" value="<?php echo $fila['CC ó NIT Propietario']; ?>" class="form-input"><br>

    <label class="form-label">Direccion Propietario:</label>
    <input type="text" name="DireccionPropietario" value="<?php echo $fila['Direccion Propietario']; ?>" class="form-input"><br>

    <label class="form-label">Telefono Propietario:</label>
    <input type="text" name="TelefonoPropietario" value="<?php echo $fila['Telefono Propietario']; ?>" class="form-input"><br>

    <label class="form-label">Correo Electronico Propietario:</label>
    <input type="text" name="CorreoElectronicoPropietario" value="<?php echo $fila['Correo Electronico Propietario']; ?>" class="form-input"><br>

    <label class="form-label">Firma Consultora ó Proyectista:</label>
    <input type="text" name="FirmaConsultoraProyectista" value="<?php echo $fila['Firma Consultora ó Proyectista']; ?>" class="form-input"><br>

    <label class="form-label">Direccion Firma Consultora ó Proyectista:</label>
    <input type="text" name="DireccionFirmaConsultoraProyectista" value="<?php echo $fila['Direccion Firma Consultora ó Proyectista']; ?>" class="form-input"><br>

    <label class="form-label">Telefono del Proyectista:</label>
    <input type="text" name="TelefonoProyectista" value="<?php echo $fila['Telefono del Proyectista']; ?>" class="form-input"><br>

    <label class="form-label">Correo Electronico Firma Consultora ó Proyectista:</label>
    <input type="text" name="CorreoElectronicoFirmaConsultoraProyectista" value="<?php echo $fila['Correo Electronico Firma Consultora ó Proyectista']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Aprobación 1:</label>
    <input type="date" name="FechaAprobacion1" value="<?php echo $fila['Fecha Aprobación 1']; ?>" class="form-input"><br>

    <label class="form-label">FechaDevolución 1:</label>
    <input type="date" name="FechaDevolucion1" value="<?php echo $fila['FechaDevolución 1']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Ingreso 2:</label>
    <input type="date" name="FechaIngreso2" value="<?php echo $fila['Fecha Ingreso 2']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Aprobación 2:</label>
    <input type="date" name="FechaAprobacion2" value="<?php echo $fila['Fecha Aprobación 2']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Devolución 2:</label>
    <input type="date" name="FechaDevolucion2" value="<?php echo $fila['Fecha Devolución 2']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Ingreso 3:</label>
    <input type="date" name="FechaIngreso3" value="<?php echo $fila['Fecha Ingreso 3']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Aprobación 3:</label>
    <input type="date" name="FechaAprobacion3" value="<?php echo $fila['Fecha Aprobación 3']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Devolución 3:</label>
    <input type="date" name="FechaDevolucion3" value="<?php echo $fila['Fecha Devolución 3']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Ingreso 4:</label>
    <input type="date" name="FechaIngreso4" value="<?php echo $fila['Fecha Ingreso 4']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Aprobación 4:</label>
    <input type="date" name="FechaAprobacion4" value="<?php echo $fila['Fecha Aprobación 4']; ?>" class="form-input"><br>

    <label class="form-label">Fecha Devolución 4:</label>
    <input type="date" name="FechaDevolucion4" value="<?php echo $fila['Fecha Devolución 4']; ?>" class="form-input"><br>

        <input class="form-input" type="submit" name="editar" value="Actualizar">
        
    </form>
    
    </div>
                </main>
               
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="js/scripts.js"></script>
        <script>
          $(document).ready(function() {
         $('#sidebarToggle').on('click', function() {
            $('body').toggleClass('sb-sidenav-toggled');
         });
         });
        </script>
    </body>
</html>
  