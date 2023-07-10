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
    <title>Agregar Proyecto conceptos tecnicos</title>
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

    // Verificar si se ha enviado el formulario de agregar
    if (isset($_POST['agregar'])) {
        // Obtener los valores del formulario
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
        $CorreoElectronicoPropietario = $_POST['CorreoPropietario'];
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
        
        // Insertar los valores en la base de datos
        $sql = "INSERT INTO conceptostecnicos (
            Numero,	
            Sector,
            `Comuna / Localidad`,
            `Ciudad ó Municipio`,	
            `Nombre del Concepto`,
            ESTADO,	
            `FECHA ESTADO`,	
            `INGENIERO ASIGNADO`,
            `Fecha Ingreso 1`,
            `MES INGRESO`,	
            `Radicacion No.`,	
            `Fecha Ultima Modificacion`,
            `Direccion de la Obra`,	
            `Propietario de la Obra`,	
            `CC ó NIT Propietario`,	
            `Direccion Propietario`,	
            `Telefono Propietario`,
            `Correo Electronico Propietario`,	
            `Firma Consultora ó Proyectista`,	
            `Direccion Firma Consultora ó Proyectista`,	
            `Telefono del Proyectista`,	
            `Correo Electronico Firma Consultora ó Proyectista`,	
            `Fecha Aprobación 1`,	
            `FechaDevolución 1`,	
            `Tiempo Rev. 1`,	
            `Fecha Ingreso 2`,	
            `Fecha Aprobación 2`,	
            `Fecha Devolución 2`,	
            `Tiempo Rev. 2`,	
            `Fecha Ingreso 3`,	
            `Fecha Aprobación 3`,	
            `Fecha Devolución 3`,	
            `Tiempo Rev. 3`,	
            `Fecha Ingreso 4`,	
            `Fecha Aprobación 4`,	
            `Fecha Devolución 4`,	
            `Tiempo Rev. 4`,	
            DiasEnRevision,	
            TotalRev	
        ) VALUES (
            '$Numero', 
            '$Sector', 
            '$ComunaLocalidad', 
            '$CiudadMunicipio', 
            '$NombreConcepto', 
            '$ESTADO', 
            '$FECHAESTADO', 
            '$INGENIEROASIGNADO', 
            '$fIngreso1',
            '$MESINGRESO', 
            '$RadicacionNo', 
            '$FechaUltimaModificacion', 
            '$DireccionObra', 
            '$PropietarioObra', 
            '$CCNITPropietario',
            '$DireccionPropietario', 
            '$TelefonoPropietario',
            '$CorreoElectronicoPropietario',
            '$FirmaConsultoraProyectista', 
            '$DireccionFirmaConsultoraProyectista', 
            '$TelefonoProyectista', 
            '$CorreoElectronicoFirmaConsultoraProyectista', 
            '$FechaAprobacion1', 
            '$fechaDevolucion1',
            '$diasRevision1',
            '$fechaRevision2',
            '$FechaAprobacion2', 
            '$fechaDevolucion2',
            '$diasRevision2',
            '$fechaRevision3',
            '$FechaAprobacion3',
            '$fechaDevolucion3',
            '$diasRevision3',
            '$fechaRevision4',
            '$FechaAprobacion4',
            '$fechaDevolucion4',
            '$diasRevision4',
            '$diasEnRevision',
            '$TotalRev'
        )";
        
        if (mysqli_query($conexion, $sql)) {
            echo "El proyecto ha sido agregado correctamente.";
        } else {
            echo "Error al agregar el proyecto: " . mysqli_error($conexion);
        }
        

        // Cerrar la conexión
        mysqli_close($conexion);
    }
    ?>

    <h2>Agregar Proyecto conceptos</h2>
    <form action="" method="POST">
    <label class="form-label" for="Numero">Número:</label>
    <input class="form-input" type="text" name="Numero" id="Numero" required><br>

    <label class="form-label" for="Sector">Sector:</label>
    <input class="form-input" type="text" name="Sector" id="Sector" required><br>

    <label class="form-label" for="ComunaLocalidad">Comuna / Localidad:</label>
    <input class="form-input" type="text" name="ComunaLocalidad" id="ComunaLocalidad" required><br>

    <label class="form-label" for="CiudadMunicipio">Ciudad o Municipio:</label>
    <input class="form-input" type="text" name="CiudadMunicipio" id="CiudadMunicipio" required><br>

    <label class="form-label" for="NombreConcepto">Nombre del Concepto:</label>
    <input class="form-input" type="text" name="NombreConcepto" id="NombreConcepto" required><br>

    <label class="form-label" for="Estado">Estado:</label>
    <input class="form-input" type="text" name="Estado" id="Estado" required><br>

    <label class="form-label" for="FechaEstado">Fecha de Estado:</label>
    <input class="form-input" type="date" name="FechaEstado" id="FechaEstado" required><br>

    <label class="form-label" for="IngenieroAsignado">Ingeniero Asignado:</label>
    <input class="form-input" type="text" name="IngenieroAsignado" id="IngenieroAsignado" required><br>

    <label class="form-label" for="FechaIngreso1">Fecha de Ingreso 1:</label>
    <input class="form-input" type="date" name="FechaIngreso1" id="FechaIngreso1" required><br>

    <label class="form-label" for="MesIngreso">Mes de Ingreso:</label>
    <input class="form-input" type="text" name="MesIngreso" id="MesIngreso" required><br>

    <label class="form-label" for="RadicacionNo">Radicación No.:</label>
    <input class="form-input" type="text" name="RadicacionNo" id="RadicacionNo" required><br>

    <label class="form-label" for="FechaUltimaModificacion">Fecha Última Modificación:</label>
    <input class="form-input" type="date" name="FechaUltimaModificacion" id="FechaUltimaModificacion" required><br>

    <label class="form-label" for="DireccionObra">Dirección de la Obra:</label>
    <input class="form-input" type="text" name="DireccionObra" id="DireccionObra" required><br>

    <label class="form-label" for="PropietarioObra">Propietario de la Obra:</label>
    <input class="form-input" type="text" name="PropietarioObra" id="PropietarioObra" required><br>

    <label class="form-label" for="CCNITPropietario">CC o NIT del Propietario:</label>
    <input class="form-input" type="text" name="CCNITPropietario" id="CCNITPropietario" required><br>

    <label class="form-label" for="DireccionPropietario">Dirección del Propietario:</label>
    <input class="form-input" type="text" name="DireccionPropietario" id="DireccionPropietario" required><br>

    <label class="form-label" for="TelefonoPropietario">Teléfono del Propietario:</label>
    <input class="form-input" type="text" name="TelefonoPropietario" id="TelefonoPropietario" required><br>

    <label class="form-label" for="CorreoPropietario">Correo Electrónico del Propietario:</label>
    <input class="form-input" type="email" name="CorreoPropietario" id="CorreoPropietario" required><br>

    <label class="form-label" for="FirmaConsultoraProyectista">Correo Electronico Firma Consultora Proyectista:</label>
    <input class="form-input" type="text" name="FirmaConsultoraProyectista" id="FirmaConsultoraProyectista" required><br>

    <label class="form-label" for="DireccionFirmaConsultoraProyectista">Dirección de la Firma Consultora o Proyectista:</label>
    <input class="form-input" type="text" name="DireccionFirmaConsultoraProyectista" id="DireccionFirmaConsultoraProyectista" required><br>

    <label class="form-label" for="TelefonoProyectista">Teléfono del Proyectista:</label>
    <input type="text" name="TelefonoProyectista" id="TelefonoProyectista" required><br>

    <label class="form-label" for="CorreoProyectista">Correo Electrónico de la Firma Consultora o Proyectista:</label>
    <input class="form-input" type="email" name="CorreoProyectista" id="CorreoProyectista" required><br>

    <label class="form-label" for="FechaAprobacion1">Fecha de Aprobación 1:</label>
    <input type="date" name="FechaAprobacion1" id="FechaAprobacion1" ><br>

    <label class="form-label" for="FechaDevolucion1">Fecha de Devolución 1:</label>
    <input class="form-input" type="date" name="FechaDevolucion1" id="FechaDevolucion1" ><br>

    <label class="form-label" for="FechaIngreso2">Fecha de Ingreso 2:</label>
    <input class="form-input" type="date" name="FechaIngreso2" id="FechaIngreso2" ><br>

    <label class="form-label" for="FechaAprobacion2">Fecha de Aprobación 2:</label>
    <input type="date" name="FechaAprobacion2" id="FechaAprobacion2" ><br>

    <label class="form-label" for="FechaDevolucion2">Fecha de Devolución 2:</label>
    <input class="form-input" type="date" name="FechaDevolucion2" id="FechaDevolucion2" ><br>

    <label class="form-label" for="FechaIngreso3">Fecha de Ingreso 3:</label>
    <input class="form-input" type="date" name="FechaIngreso3" id="FechaIngreso3" ><br>

    <label class="form-label" for="FechaAprobacion3">Fecha de Aprobación 3:</label>
    <input class="form-input" type="date" name="FechaAprobacion3" id="FechaAprobacion3" ><br>

    <label class="form-label" for="FechaDevolucion3">Fecha de Devolución 3:</label>
    <input class="form-input" type="date" name="FechaDevolucion3" id="FechaDevolucion3" ><br>

    <label class="form-label" for="FechaIngreso4">Fecha de Ingreso 4:</label>
    <input class="form-input" type="date" name="FechaIngreso4" id="FechaIngreso4" ><br>

    <label class="form-label" for="FechaAprobacion4">Fecha de Aprobación 4:</label>
    <input class="form-input" type="date" name="FechaAprobacion4" id="FechaAprobacion4" ><br>

    <label class="form-label" for="FechaDevolucion4">Fecha de Devolución 4:</label>
    <input class="form-input" type="date" name="FechaDevolucion4" id="FechaDevolucion4" ><br>

        <input class="form-input" type="submit" name="agregar" value="Agregar Proyecto">
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
