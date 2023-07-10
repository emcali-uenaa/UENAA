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
    <title>Editar Proyecto</title>
</head>
<body>
<?php
    require "parte superior.php";
    ?>
    <?php
    
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "rol");

    // Verificar la conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Verificar si se ha enviado el formulario de edición
    if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $Consecutivo = $_POST['Consecutivo'];
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
    
                 
// Obtener las fechas de revisión y devolución
$fIngreso1 =$_POST['FechaIngreso1'];
$fechaDevolucion1 = $_POST['Devol1'];

// Función para calcular los días hábiles entre dos fechas
function calcularDiasHabiles1($fechaInicio, $fechaFin) {
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
$diasRevision1 = calcularDiasHabiles1($fIngreso1, $fechaDevolucion1);

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
    
$Aprob2 = $_POST['Aprob2'];
        $fechaRevision2 = $_POST['FechaIngreso2'];
        $fechaDevolucion2 = $_POST['Devol2'];


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

$Aprob3 = $_POST['Aprob3'];
        $fechaRevision3 = $_POST['FechaIngreso3'];
        $fechaDevolucion3 = $_POST['Devol3'];
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
        $Aprob4 = $_POST['Aprob4'];
        $fechaRevision4 = $_POST['FechaIngreso4'];
        $fechaDevolucion4 = $_POST['Devol4'];
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
        $Aprob5 = $_POST['Aprob5'];
        $fechaRevision5 = $_POST['FechaIngreso5'];
        $fechaDevolucion5 = $_POST['Devol5'];
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
        $Aprob6 = $_POST['Aprob6'];
        $fechaRevision6 = $_POST['FechaIngreso6'];
        $fechaDevolucion6 = $_POST['Devol6'];
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
        $fechaAprobacion = $_POST['FechaAprobacion'];
        if($diasRevision1>=1){ 
            $TotalRev = 1;
            if($diasRevision2>=1){ 
                $TotalRev = 2;
                
            }if($diasRevision3>=1){ 
                $TotalRev = 3;
                
             }if($diasRevision4>=1){ 
                $TotalRev = 4;
                
                }if($diasRevision5>=1){ 
                $TotalRev = 5;   
           
            
                  }if($diasRevision5>=1){ 
                      $TotalRev = 5;   
                  }
                    
        }else{
            $TotalRev =0;
        }
        

        

        // Actualizar el registro en la base de datos
        $sql = "UPDATE redesinternas SET 
        Consecutivo = '$Consecutivo', 
        Anio = '$Anio', 
        FechaIngreso1 = '$fIngreso1',
        PosibilidadServicio = '$PosibilidadServicio',
        Sector = '$Sector',
        DireccionObra = '$DireccionObra', 
        ComunaSector = '$ComunaSector',
        CiudadMunicipio = '$CiudadMunicipio',
        NombreProyecto = '$NombreProyecto',
        PropietarioObra = '$PropietarioObra', 
        FirmaConsultoraProyectista = '$FirmaConsultoraProyectista',
        IngenieroAsignado = '$IngenieroAsignado',
        No = '$No',
        Tipo = '$Tipo',
        No2 = '$No2', 
        Tipo2 = '$Tipo2', 
        EstadoAvance = '$EstadoAvance',
        EstadoAtencion = '$EstadoAtencion',
        FechaEstado = '$FechaEstado',
        AreaConstruccionFacturada = '$AreaConstruccionFacturada',
        CostoFacturadoIVA = '$CostoFacturadoIVA',
        FechaLiquidacion = '$FechaLiquidacion', 
        FechaPago = '$FechaPago', 
        RadicacionNo = '$RadicacionNo',
        FechaAprobacion = '$FechaAprobacion', 
        OficioAprobacion = '$OficioAprobacion',
        CCNITPropietario = '$CCNITPropietario',
        DireccionPropietario = '$DireccionPropietario',
        TelefonoPropietario = '$TelefonoPropietario', 
        CorreoElectronicoPropietario = '$CorreoElectronicoPropietario',
        DireccionFirmaConsultoraProyectista = '$DireccionFirmaConsultoraProyectista', 
        TelefonoProyectista = '$TelefonoProyectista',
        CorreoElectronicoFirmaConsultoraProyectista = '$CorreoElectronicoFirmaConsultoraProyectista',
        Aprob1 = '$Aprob1', 
        Devol1 = '$fechaDevolucion1', 
        DiasRev1 = '$diasRevision1',
        FechaIngreso2 = '$fechaRevision2',
        Aprob2 = '$Aprob2', 
        Devol2 = '$fechaDevolucion2', 
        DiasRev2 = '$diasRevision2',
        FechaIngreso3 = '$fechaRevision3',
        Aprob3 = '$Aprob3',
        Devol3 = '$fechaDevolucion3', 
        DiasRev3 = '$diasRevision3',
        FechaIngreso4 = '$fechaRevision4', 
        Aprob4 = '$Aprob4',
        Devol4 = '$fechaDevolucion4',
        DiasRev4 = '$diasRevision4',
        FechaIngreso5 = '$fechaRevision5',
        Aprob5 = '$Aprob5', 
        Devol5 = '$fechaDevolucion5',
        DiasRev5 = '$diasRevision5',
        FechaIngreso6 = '$fechaRevision6',
        Aprob6 = '$Aprob6',
        DiasRev6 = '$diasRevision6',
        Devol6 = '$fechaDevolucion6',
        diasEnRevision = '$diasEnRevision',
        TotalRev = '$TotalRev'
        WHERE id = '$id'";

        if (mysqli_query($conexion, $sql)) {
            echo "Registro actualizado correctamente.";
        
        
        } else {
            echo "Error al actualizar el registro: " . mysqli_error($conexion);
        }
       
    }

    // Obtener el ID del proyecto a editar
    $idProyecto = $_GET['id'];

    // Consulta SQL para obtener el proyecto específico
    $sql = "SELECT * FROM redesinternas WHERE id='$idProyecto'";
    $resultado = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    ?>

<h1>Editar Proyecto</h1>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

    <label class="form-label">Consecutivo:</label>
    <input type="text" name="Consecutivo" value="<?php echo $fila['Consecutivo']; ?>" class="form-input"><br>

    <label class="form-label">Año:</label>
    <input type="text" name="Anio" value="<?php echo $fila['Anio']; ?>" class="form-input"><br>

    <label class="form-label">Fecha de Ingreso 1:</label>
    <input type="date" name="FechaIngreso1" value="<?php echo $fila['FechaIngreso1']; ?>" class="form-input"><br>

    <label class="form-label">Posibilidad de Servicio:</label>
    <input type="text" name="PosibilidadServicio" value="<?php echo $fila['PosibilidadServicio']; ?>" class="form-input"><br>

    <label class="form-label">Sector:</label>
    <input type="text" name="Sector" value="<?php echo $fila['Sector']; ?>" class="form-input"><br>

    <label class="form-label">Dirección de la Obra:</label>
    <input type="text" name="DireccionObra" value="<?php echo $fila['DireccionObra']; ?>" class="form-input"><br>

    <label class="form-label">Comuna o Sector:</label>
    <input type="text" name="ComunaSector" value="<?php echo $fila['ComunaSector']; ?>" class="form-input"><br>

    <label class="form-label">Ciudad o Municipio:</label>
    <input type="text" name="CiudadMunicipio" value="<?php echo $fila['CiudadMunicipio']; ?>" class="form-input"><br>

    <label class="form-label" >Nombre del Proyecto:</label>
    <input type="text" name="NombreProyecto" value="<?php echo $fila['NombreProyecto']; ?>" class="form-input"><br>

    <label class="form-label">Propietario de la Obra:</label>
    <input type="text" name="PropietarioObra" value="<?php echo $fila['PropietarioObra']; ?>" class="form-input"><br>

    <label class="form-label">Firma Consultora o Proyectista:</label>
    <input type="text" name="FirmaConsultoraProyectista" value="<?php echo $fila['FirmaConsultoraProyectista']; ?>" class="form-input"><br>

    <label class="form-label">Ingeniero Asignado:</label>
    <input type="text" name="IngenieroAsignado" value="<?php echo $fila['IngenieroAsignado']; ?>" class="form-input"><br>

    <label class="form-label">No:</label>
    <input type="text" name="No" value="<?php echo $fila['No']; ?>" class="form-input"><br>

    <label class="form-label">Tipo:</label>
    <input type="text" name="Tipo" value="<?php echo $fila['Tipo']; ?>" class="form-input"><br>

    <label class="form-label">No2:</label>
    <input type="text" name="No2" value="<?php echo $fila['No2']; ?>" class="form-input"><br>

    <label class="form-label">Tipo2:</label>
    <input type="text" name="Tipo2" value="<?php echo $fila['Tipo2']; ?>" class="form-input"><br>

    <label class="form-label">Estado de Avance:</label>
    <input type="text" name="EstadoAvance" value="<?php echo $fila['EstadoAvance']; ?>" class="form-input"><br>

    <label class="form-label">Estado de Atención:</label>
    <input type="text" name="EstadoAtencion" value="<?php echo $fila['EstadoAtencion']; ?>" class="form-input"><br>

    <label class="form-label">Fecha de Estado:</label>
    <input type="date" name="FechaEstado" value="<?php echo $fila['FechaEstado']; ?>" class="form-input"><br>

    <label class="form-label">Área de Construcción Facturada:</label>
    <input type="text" name="AreaConstruccionFacturada" value="<?php echo $fila['AreaConstruccionFacturada']; ?>" class="form-input"><br>

    <label class="form-label">Costo Facturado (IVA):</label>
    <input type="text" name="CostoFacturadoIVA" value="<?php echo $fila['CostoFacturadoIVA']; ?>" class="form-input"><br>

    <label class="form-label">Fecha de Liquidación:</label>
    <input type="date" name="FechaLiquidacion" value="<?php echo $fila['FechaLiquidacion']; ?>" class="form-input"><br>

    <label class="form-label">Fecha de Pago:</label>
    <input type="date" name="FechaPago" value="<?php echo $fila['FechaPago']; ?>" class="form-input"><br>

    <label class="form-label">Número de Radicación:</label>
    <input type="text" name="RadicacionNo" value="<?php echo $fila['RadicacionNo']; ?>" class="form-input"><br>

    <label class="form-label">Fecha de Aprobación:</label>
    <input type="date" name="FechaAprobacion" value="<?php echo $fila['FechaAprobacion']; ?>" class="form-input"><br>

    <label class="form-label">Oficio de Aprobación:</label>
    <input type="text" name="OficioAprobacion" value="<?php echo $fila['OficioAprobacion']; ?>" class="form-input"><br>

    <label class="form-label">CC/NIT del Propietario:</label>
    <input type="text" name="CCNITPropietario" value="<?php echo $fila['CCNITPropietario']; ?>" class="form-input"><br>

    <label class="form-label">Dirección del Propietario:</label>
    <input type="text" name="DireccionPropietario" value="<?php echo $fila['DireccionPropietario']; ?>" class="form-input"><br>

    <label class="form-label">Teléfono del Propietario:</label>
    <input type="text" name="TelefonoPropietario" value="<?php echo $fila['TelefonoPropietario']; ?>" class="form-input"><br>

    <label class="form-label">Correo Electrónico del Propietario:</label>
    <input type="text" name="CorreoElectronicoPropietario" value="<?php echo $fila['CorreoElectronicoPropietario']; ?>" class="form-input"><br>

    <label class="form-label">Dirección de la Firma Consultora o Proyectista:</label>
    <input type="text" name="DireccionFirmaConsultoraProyectista" value="<?php echo $fila['DireccionFirmaConsultoraProyectista']; ?>" class="form-input"><br>

    <label class="form-label">Teléfono del Proyectista:</label>
    <input type="text" name="TelefonoProyectista" value="<?php echo $fila['TelefonoProyectista']; ?>" class="form-input"><br>

    <label class="form-label">Correo Electrónico de la Firma Consultora o Proyectista:</label>
    <input type="text" name="CorreoElectronicoFirmaConsultoraProyectista" value="<?php echo $fila['CorreoElectronicoFirmaConsultoraProyectista']; ?>" class="form-input"><br>

    <label class="form-label">Aprob1:</label>
    <input type="date" name="Aprob1" value="<?php echo $fila['Aprob1']; ?>" class="form-input"><br>

    <label class="form-label">Devol1:</label>
    <input type="date" name="Devol1" value="<?php echo $fila['Devol1']; ?>" class="form-input"><br>

    <label class="form-label">Fecha de Ingreso 2:</label>
    <input type="date" name="FechaIngreso2" value="<?php echo $fila['FechaIngreso2']; ?>" class="form-input"><br>

    <label class="form-label">Aprob2:</label>
<input type="date" name="Aprob2" value="<?php echo isset($fila['Aprob2']) ? $fila['Aprob2'] : ''; ?>" class="form-input"><br>

<label class="form-label">Devol2:</label>
<input type="date" name="Devol2" value="<?php echo isset($fila['Devol2']) ? $fila['Devol2'] : ''; ?>" class="form-input"><br>

<label class="form-label">Fecha de Ingreso 3:</label>
<input type="date" name="FechaIngreso3" value="<?php echo isset($fila['FechaIngreso3']) ? $fila['FechaIngreso3'] : ''; ?>" class="form-input"><br>

<label class="form-label">Aprob3:</label>
<input type="date" name="Aprob3" value="<?php echo isset($fila['Aprob3']) ? $fila['Aprob3'] : ''; ?>" class="form-input"><br>

<label class="form-label">Devol3:</label>
<input type="date" name="Devol3" value="<?php echo isset($fila['Devol3']) ? $fila['Devol3'] : ''; ?>" class="form-input"><br>

<label class="form-label">Fecha de Ingreso 4:</label>
<input type="date" name="FechaIngreso4" value="<?php echo isset($fila['FechaIngreso4']) ? $fila['FechaIngreso4'] : ''; ?>" class="form-input"><br>

<label class="form-label">Aprob4:</label>
<input type="date" name="Aprob4" value="<?php echo isset($fila['Aprob4']) ? $fila['Aprob4'] : ''; ?>" class="form-input"><br>

<label class="form-label">Devol4:</label>
<input type="date" name="Devol4" value="<?php echo isset($fila['Devol4']) ? $fila['Devol4'] : ''; ?>" class="form-input"><br>

<label class="form-label">Fecha de Ingreso 5:</label>
<input type="date" name="FechaIngreso5" value="<?php echo isset($fila['FechaIngreso5']) ? $fila['FechaIngreso5'] : ''; ?>" class="form-input"><br>

<label class="form-label">Aprob5:</label>
<input type="date" name="Aprob5" value="<?php echo isset($fila['Aprob5']) ? $fila['Aprob5'] : ''; ?>" class="form-input"><br>

<label class="form-label">Devol5:</label>
<input type="date" name="Devol5" value="<?php echo isset($fila['Devol5']) ? $fila['Devol5'] : ''; ?>" class="form-input"><br>

<label class="form-label">Fecha de Ingreso 6:</label>
<input type="date" name="FechaIngreso6" value="<?php echo isset($fila['FechaIngreso6']) ? $fila['FechaIngreso6'] : ''; ?>" class="form-input"><br>

<label class="form-label">Aprob6:</label>
<input type="date" name="Aprob6" value="<?php echo isset($fila['Aprob6']) ? $fila['Aprob6'] : ''; ?>" class="form-input"><br>

<label class="form-label">Devol6:</label>
<input type="date" name="Devol6" value="<?php echo isset($fila['Devol6']) ? $fila['Devol6'] : ''; ?>" class="form-input" class="form-input"><br>

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
  