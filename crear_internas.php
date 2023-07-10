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
    <title>Agregar Proyecto</title>
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
        $ConsecutivoNo = $_POST['Consecutivo'];
        $Anio = $_POST['Anio'];
        $PosibilidadServicio = $_POST['PosibilidadServicio'];
        $Sector = $_POST['Sector'];
        $DireccionObra = $_POST['DireccionObra'];
        $ComunaSector = $_POST['ComunaSector'];
        $CiudadMunicipio = $_POST['CiudadMunicipio'];
        $NombreProyecto = $_POST['NombreProyecto'];
        $PropietarioObra = $_POST['PropietarioObra'];
        $FirmaConsultoraProyectista = $_POST['FirmaConsultoraProyectista'];
        $IngenieroAsignado = $_POST['IngenieroAsignado'];
        $No = $_POST['No'];
        $Tipo = $_POST['Tipo'];
        $No2 = $_POST['No2'];
        $Tipo2 = $_POST['Tipo2'];
        $EstadoAvance = $_POST['EstadoAvance'];
        $EstadoAtencion = $_POST['EstadoAtencion'];
        $FechaEstado = $_POST['FechaEstado'];
        $AreaConstruccionFacturada = $_POST['AreaConstruccionFacturada'];
        $CostoFacturadoIVA = $_POST['CostoFacturadoIVA'];
        $FechaLiquidacion = $_POST['FechaLiquidacion'];
        $FechaPago = $_POST['FechaPago'];
        $RadicacionNo = $_POST['RadicacionNo'];
        $FechaAprobacion = $_POST['FechaAprobacion'];
        $OficioAprobacion = $_POST['OficioAprobacion'];
        $CCNITPropietario = $_POST['CCNITPropietario'];
        $DireccionPropietario = $_POST['DireccionPropietario'];
        $TelefonoPropietario = $_POST['TelefonoPropietario'];
        $CorreoElectronicoPropietario = $_POST['CorreoElectronicoPropietario'];
        $DireccionFirmaConsultoraProyectista = $_POST['DireccionFirmaConsultoraProyectista'];
        $TelefonoProyectista = $_POST['TelefonoProyectista'];
        $CorreoElectronicoFirmaConsultoraProyectista = $_POST['CorreoElectronicoFirmaConsultoraProyectista'];
        $Aprob1 = $_POST['Aprob1'];
        $fechaIngreso1= $_POST['FechaIngreso1'];
        $fechaDevolucion1 = $_POST['Devol1'];
        
        


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

$diasRevision1 = calcularDiasHabiles($fechaIngreso1, $fechaDevolucion1);

// Verificar si las fechas están dentro de un fin de semana y ajustar los días hábiles
$inicioSemana = (int)$fechaIngreso1;
$finSemana = (int)$fechaDevolucion1;
if ($inicioSemana <= 5 && $finSemana >= 6) {
    $diasRevision1 -= 2; // Restar 2 días si la revisión y devolución abarcan un fin de semana completo
} elseif ($inicioSemana == 6) {
    $diasRevision1 -= 1; // Restar 1 día si la revisión comienza en sábado
} elseif ($finSemana == 7) {
    $diasRevision1 -= 1; // Restar 1 día si la devolución es domingo
}

        $fechaRevision2 = $_POST['FechaIngreso2'];
        $fechaDevolucion2 = $_POST['Devol2'];
        $Aprob2 = $_POST['Aprob2'];

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
        $fechaDevolucion3 = $_POST['Devol3'];
        $Aprob3 = $_POST['Aprob3'];
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
        $fechaDevolucion4 = $_POST['Devol4'];
        $Aprob4 = $_POST['Aprob4'];
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
        $fechaRevision5 = $_POST['FechaIngreso5'];
        $fechaDevolucion5 = $_POST['Devol5'];
        $Aprob5 = $_POST['Aprob5'];
        function calcularDiasHabiles5($fechaInicio, $fechaFin) {
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
        function esFestivo5($fecha) {
            $festivos = obtenerFestivos5($fecha->format('Y'));
            return in_array($fecha->format('Y-m-d'), $festivos);
        }
        
        // Función para obtener los días festivos en Colombia para un año específico
        function obtenerFestivos5($anio) {
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
        $diasRevision5 = calcularDiasHabiles5($fechaRevision5, $fechaDevolucion5);
        
        // Verificar si las fechas están dentro de un fin de semana y ajustar los días hábiles
        $inicioSemana = (int)$fechaRevision5;
        $finSemana = (int)$fechaDevolucion5;
        if ($inicioSemana <= 5 && $finSemana >= 6) {
            $diasRevision5 -= 2; // Restar 2 días si la revisión y devolución abarcan un fin de semana completo
        } elseif ($inicioSemana == 6) {
            $diasRevision5 -= 1; // Restar 1 día si la revisión comienza en sábado
        } elseif ($finSemana == 7) {
            $diasRevision5 -= 1; // Restar 1 día si la devolución es domingo
        }
        $fechaRevision6 = $_POST['FechaIngreso6'];
        $fechaDevolucion6 = $_POST['Devol6'];
        $Aprob6 = $_POST['Aprob6'];
        function calcularDiasHabiles6($fechaInicio, $fechaFin) {
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
        function esFestivo6($fecha) {
            $festivos = obtenerFestivos6($fecha->format('Y'));
            return in_array($fecha->format('Y-m-d'), $festivos);
        }
        
        // Función para obtener los días festivos en Colombia para un año específico
        function obtenerFestivos6($anio) {
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
        $diasRevision6 = calcularDiasHabiles6($fechaRevision6, $fechaDevolucion6);
        
        // Verificar si las fechas están dentro de un fin de semana y ajustar los días hábiles
        $inicioSemana = (int)$fechaRevision6;
        $finSemana = (int)$fechaDevolucion6;
        if ($inicioSemana <= 5 && $finSemana >= 6) {
            $diasRevision6 -= 2; // Restar 2 días si la revisión y devolución abarcan un fin de semana completo
        } elseif ($inicioSemana == 6) {
            $diasRevision6 -= 1; // Restar 1 día si la revisión comienza en sábado
        } elseif ($finSemana == 7) {
            $diasRevision6 -= 1; // Restar 1 día si la devolución es domingo
        }
        $diasEnRevision = $diasRevision1+$diasRevision2+$diasRevision3+$diasRevision4+$diasRevision5;
        if ($diasRevision1>1){
            $TotalRev= 1;
            if($diasRevision2>1){
                $TotalRev = 2;
            }
            if($diasRevision3>1){
                $TotalRev = 3;
            }
            if($diasRevision4>1){
                $TotalRev = 4;
            }
            if($diasRevision5>1){
                $TotalRev = 5;
            }
            if($diasRevision6>1){
                $TotalRev = 6;
            }
        }else {
           $TotalRev=0;
        }
        

        // Insertar los valores en la base de datos
        $sql = "INSERT INTO redesinternas (
            Consecutivo, Anio, FechaIngreso1, PosibilidadServicio, Sector, DireccionObra, ComunaSector, CiudadMunicipio,
            NombreProyecto, PropietarioObra, FirmaConsultoraProyectista, IngenieroAsignado, No, Tipo, No2, Tipo2,
            EstadoAvance, EstadoAtencion, FechaEstado, AreaConstruccionFacturada, CostoFacturadoIVA, FechaLiquidacion,
            FechaPago, RadicacionNo, FechaAprobacion, OficioAprobacion, CCNITPropietario, DireccionPropietario,
            TelefonoPropietario, CorreoElectronicoPropietario, DireccionFirmaConsultoraProyectista, TelefonoProyectista,
            CorreoElectronicoFirmaConsultoraProyectista, Aprob1, Devol1, DiasRev1, FechaIngreso2, Aprob2, Devol2,
            DiasRev2, FechaIngreso3, Aprob3, Devol3, DiasRev3, FechaIngreso4, Aprob4, Devol4, DiasRev4, FechaIngreso5,
            Aprob5, Devol5, DiasRev5, FechaIngreso6, Aprob6, Devol6, DiasRev6, DiasEnRevision, TotalRev
        )
        VALUES ('$ConsecutivoNo', '$Anio', '$fechaIngreso1', 
        '$PosibilidadServicio', '$Sector', '$DireccionObra', 
        '$ComunaSector', '$CiudadMunicipio', '$NombreProyecto', 
        '$PropietarioObra', '$FirmaConsultoraProyectista', '$IngenieroAsignado', 
        '$No', '$Tipo', '$No2', '$Tipo2', '$EstadoAvance', '$EstadoAtencion', 
        '$FechaEstado', '$AreaConstruccionFacturada', '$CostoFacturadoIVA', 
        '$FechaLiquidacion', '$FechaPago', '$RadicacionNo', '$FechaAprobacion', 
        '$OficioAprobacion', '$CCNITPropietario', '$DireccionPropietario', 
        '$TelefonoPropietario', '$CorreoElectronicoPropietario', 
        '$DireccionFirmaConsultoraProyectista', '$TelefonoProyectista', 
        '$CorreoElectronicoFirmaConsultoraProyectista', '$Aprob1', 
        '$fechaDevolucion1', '$diasRevision1', '$fechaRevision2', '$Aprob2', 
        '$fechaDevolucion2', '$diasRevision2', '$fechaRevision3', '$Aprob3', 
        '$fechaDevolucion3', '$diasRevision3', '$fechaRevision4', '$Aprob4', 
        '$fechaDevolucion4', '$diasRevision4', 
        '$fechaRevision5', '$Aprob5', '$fechaDevolucion5', '$diasRevision5',
         '$fechaRevision6', '$Aprob6',  
        '$fechaDevolucion6', '$diasRevision6','$diasEnRevision', '$TotalRev')";

// Ejecutar la consulta
             if (mysqli_query($conexion, $sql)) {
            echo "El proyecto ha sido agregado correctamente.";
            
        } else {
            echo "Error al agregar el proyecto: " . mysqli_error($conexion);
        }

        // Cerrar la conexión
        mysqli_close($conexion);
        
    }
  
    ?>


<h2>Agregar Proyecto Internas</h2>

<form action="" method="POST">
    <label class="form-label" for="Consecutivo">Consecutivo No:</label>
    <input class="form-input" type="text" name="Consecutivo" id="Consecutivo" required><br>

    <label class="form-label" for="Anio">Año:</label>
    <input class="form-input" type="text" name="Anio" id="Anio" required><br>

    <label class="form-label" for="FechaIngreso1">Fecha de Ingreso 1:</label>
    <input class="form-input" type="date" name="FechaIngreso1" id="FechaIngreso1" required><br>

    <label class="form-label" for="PosibilidadServicio">Posibilidad de Servicio:</label>
    <input class="form-input" type="text" name="PosibilidadServicio" id="PosibilidadServicio" required><br>

    <label class="form-label" for="Sector">Sector:</label>
    <input class="form-input" type="text" name="Sector" id="Sector" required><br>

    <label class="form-label" for="DireccionObra">Dirección de la Obra:</label>
    <input class="form-input" type="text" name="DireccionObra" id="DireccionObra" required><br>

    <label class="form-label" for="ComunaSector">Comuna/Sector:</label>
    <input class="form-input" type="text" name="ComunaSector" id="ComunaSector" required><br>

    <label class="form-label" for="CiudadMunicipio">Ciudad/Municipio:</label>
    <input class="form-input" type="text" name="CiudadMunicipio" id="CiudadMunicipio" required><br>

    <label class="form-label" for="NombreProyecto">Nombre del Proyecto:</label>
    <input class="form-input" type="text" name="NombreProyecto" id="NombreProyecto" required><br>

    <label class="form-label" for="PropietarioObra">Propietario de la Obra:</label>
    <input class="form-input" type="text" name="PropietarioObra" id="PropietarioObra" required><br>

    <label class="form-label" for="FirmaConsultoraProyectista">Firma Consultora Proyectista:</label>
    <input class="form-input" type="text" name="FirmaConsultoraProyectista" id="FirmaConsultoraProyectista" required><br>

    <label class="form-label" for="IngenieroAsignado">Ingeniero Asignado:</label>
    <input class="form-input" type="text" name="IngenieroAsignado" id="IngenieroAsignado" required><br>

    <label class="form-label" for="No">No:</label>
    <input class="form-input" type="text" name="No" id="No" required><br>

    <label class="form-label" for="Tipo">Tipo:</label>
    <input class="form-input" type="text" name="Tipo" id="Tipo" required><br>

    <label class="form-label" for="No2">No2:</label>
    <input class="form-input" type="text" name="No2" id="No2" required><br>

    <label class="form-label" for="Tipo2">Tipo2:</label>
    <input class="form-input" type="text" name="Tipo2" id="Tipo2" required><br>

    <label class="form-label" for="EstadoAvance">Estado de Avance:</label>
    <input class="form-input" type="text" name="EstadoAvance" id="EstadoAvance" required><br>

    <label class="form-label" for="EstadoAtencion">Estado de Atención:</label>
    <input class="form-input" type="text" name="EstadoAtencion" id="EstadoAtencion" required><br>

    <label class="form-label" for="FechaEstado">Fecha de Estado:</label>
    <input class="form-input" type="date" name="FechaEstado" id="FechaEstado" required><br>

    <label class="form-label" for="AreaConstruccionFacturada">Área de Construcción Facturada:</label>
    <input class="form-input" type="text" name="AreaConstruccionFacturada" id="AreaConstruccionFacturada" required><br>

    <label class="form-label" for="CostoFacturadoIVA">Costo Facturado + IVA:</label>
    <input class="form-input" type="text" name="CostoFacturadoIVA" id="CostoFacturadoIVA" required><br>

    <label class="form-label" for="FechaLiquidacion">Fecha de Liquidación:</label>
    <input class="form-input" type="date" name="FechaLiquidacion" id="FechaLiquidacion" required><br>

    <label class="form-label" for="FechaPago">Fecha de Pago:</label>
    <input class="form-input" type="date" name="FechaPago" id="FechaPago" required><br>

    <label class="form-label" for="RadicacionNo">Radicación No:</label>
    <input class="form-input" type="text" name="RadicacionNo" id="RadicacionNo" required><br>

    <label class="form-label" for="FechaAprobacion">Fecha de Aprobación:</label>
    <input class="form-input" type="date" name="FechaAprobacion" id="FechaAprobacion" required><br>

    <label class="form-label" for="OficioAprobacion">Oficio de Aprobación:</label>
    <input class="form-input" type="text" name="OficioAprobacion" id="OficioAprobacion" required><br>

    <label class="form-label" for="CCNITPropietario">CC/NIT Propietario:</label>
    <input class="form-input" type="text" name="CCNITPropietario" id="CCNITPropietario" required><br>

    <label class="form-label" for="DireccionPropietario">Dirección Propietario:</label>
    <input class="form-input" type="text" name="DireccionPropietario" id="DireccionPropietario" required><br>

    <label class="form-label" for="TelefonoPropietario">Teléfono Propietario:</label>
    <input class="form-input" type="text" name="TelefonoPropietario" id="TelefonoPropietario" required><br>

    <label class="form-label" for="CorreoElectronicoPropietario">Correo Electrónico Propietario:</label>
    <input class="form-input" type="text" name="CorreoElectronicoPropietario" id="CorreoElectronicoPropietario" required><br>

    <label class="form-label" for="DireccionFirmaConsultoraProyectista">Dirección Firma Consultora Proyectista:</label>
    <input class="form-input" type="text" name="DireccionFirmaConsultoraProyectista" id="DireccionFirmaConsultoraProyectista" required><br>

    <label class="form-label" for="TelefonoProyectista">Teléfono Proyectista:</label>
    <input class="form-input" type="text" name="TelefonoProyectista" id="TelefonoProyectista" required><br>

    <label class="form-label" for="CorreoElectronicoFirmaConsultoraProyectista">Correo Electrónico Firma Consultora Proyectista:</label>
    <input class="form-input" type="text" name="CorreoElectronicoFirmaConsultoraProyectista" id="CorreoElectronicoFirmaConsultoraProyectista" required><br>

    <label class="form-label" for="Aprob1">Aprobación 1:</label>
    <input class="form-input" type="date" name="Aprob1" id="Aprob1" ><br>

    <label class="form-label" for="Devol1">Devolución 1:</label>
    <input class="form-input" type="date" name="Devol1" id="Devol1" ><br>

    <label class="form-label" for="FechaIngreso2">Fecha de Ingreso 2:</label>
    <input class="form-input" type="date" name="FechaIngreso2" id="FechaIngreso2" ><br>

    <label class="form-label" for="Aprob2">Aprobación 2:</label>
    <input class="form-input" type="date" name="Aprob2" id="Aprob2" ><br>

    <label class="form-label" for="Devol2">Devolución 2:</label>
    <input class="form-input" type="date" name="Devol2" id="Devol2" ><br>

    <label class="form-label" for="FechaIngreso3">Fecha de Ingreso 3:</label>
    <input class="form-input" type="date" name="FechaIngreso3" id="FechaIngreso3" ><br>

    <label class="form-label" for="Aprob3">Aprobación 3:</label>
    <input class="form-input" type="date" name="Aprob3" id="Aprob3" ><br>

    <label class="form-label" for="Devol3">Devolución 3:</label>
    <input class="form-input" type="date" name="Devol3" id="Devol3" ><br>

    <label class="form-label" for="FechaIngreso4">Fecha de Ingreso 4:</label>
    <input class="form-input" type="date" name="FechaIngreso4" id="FechaIngreso4" ><br>

    <label class="form-label" for="Aprob4">Aprobación 4:</label>
    <input class="form-input" type="date" name="Aprob4" id="Aprob4" ><br>

    <label class="form-label" for="Devol4">Devolución 4:</label>
    <input class="form-input" type="date" name="Devol4" id="Devol4" ><br>

    <label class="form-label" for="FechaIngreso5">Fecha de Ingreso 5:</label>
    <input class="form-input" type="date" name="FechaIngreso5" id="FechaIngreso5" ><br>

    <label class="form-label" for="Aprob5">Aprobación 5:</label>
    <input class="form-input" type="date" name="Aprob5" id="Aprob5" ><br>

    <label class="form-label" for="Devol5">Devolución 5:</label>
    <input class="form-input" type="date" name="Devol5" id="Devol5" ><br>

    <label class="form-label" for="FechaIngreso6">Fecha de Ingreso 6:</label>
    <input class="form-input" type="date" name="FechaIngreso6" id="FechaIngreso6" ><br>

    <label class="form-label" for="Aprob6">Aprobación 6:</label>
    <input class="form-input" type="date" name="Aprob6" id="Aprob6" ><br>

    <label class="form-label" for="Devol6">Devolución 6:</label>
    <input class="form-input" type="date" name="Devol6" id="Devol6" ><br>

    <input class="form-input" type="submit" name="agregar" value="Agregar Proyecto">
</form>

    </form>
    
    <?php require_once "parte inferior.php" ?>
</body>

</html>