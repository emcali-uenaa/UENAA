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
        $TipoProyecto= $_POST['TipoProyecto'];
        $actividad = $_POST['Actividad'];
        $servicio = $_POST['Servicio'];
        $consecutivo = $_POST['Consecutivo'];
        $anio = $_POST['Anio'];
        $descripcionProyecto = $_POST['DescripcionProyecto'];
        $direccion = $_POST['Direccion'];
        $propietarioProyecto = $_POST['PropietarioProyecto'];
        $estado = $_POST['Estado'];
        $estadoAtencion = $_POST['EstadoAtencion'];
        $fechaEstado = $_POST['FechaEstado'];
        $direccionPropietario = $_POST['DireccionPropietario'];
        $cedulaNit = $_POST['CedulaNit'];
        $telefonoPropietario = $_POST['TelefonoPropietario'];
        $correoPropietario = $_POST['CorreoPropietario'];
        $consultor = $_POST['Consultor'];
        $telefonoProyectista = $_POST['TelefonoProyectista'];
        $correoElectronicoProyectista = $_POST['CorreoElectronicoProyectista'];
        $recursos = $_POST['Recursos'];
        $comuna = $_POST['Comuna'];
        $ingeniero = $_POST['Ingeniero'];
        $unidad = $_POST['Unidad'];
        $cantidad = $_POST['Cantidad'];
        $mlFacturados = $_POST['MLFacturados'];
        $vrFacturado = $_POST['VrFacturado'];
        $fechaLiquidacion = $_POST['FechaLiquidacion'];
        $fechaPago = $_POST['FechaPago'];
        $noOficio = $_POST['NoOficio'];
        $datoBasico = $_POST['DatoBasico'];
        $fDatoBasico = $_POST['FDatoBasico'];
             
// Obtener las fechas de revisión y devolución
$fIngreso1 =$_POST['FIngreso1'];
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

        $fechaRevision2 = $_POST['FechaRevision2'];
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

        
        $fechaRevision3 = $_POST['FechaRevision3'];
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
        $fechaRevision4 = $_POST['FechaRevision4'];
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
        $fechaRevision5 = $_POST['FechaRevision5'];
        $fechaDevolucion5 = $_POST['FechaDevolucion5'];
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
            }if($diasRevision6>=1){ 
                $TotalRev = 6;
            }
        }else{
            $TotalRev =0;
        }
        
        $oficioAprobacionNo = $_POST['OficioAprobacionNo'];

        // Insertar los valores en la base de datos
        $sql = "INSERT INTO proyectos (
            TipoProyecto,
            Actividad,
            Servicio,
            Consecutivo,
            Anio,
            DescripcionProyecto,
            Direccion,
            PropietarioProyecto,
            Estado,
            EstadoAtencion,
            FechaEstado,
            DireccionPropietario,
            CedulaNit,
            TelefonoPropietario,
            CorreoPropietario,
            Consultor,
            TelefonoProyectista,
            CorreoElectronicoProyectista,
            Recursos,
            Comuna,
            Ingeniero,
            Unidad,
            Cantidad,
            MLFacturados,
            VrFacturado,
            FechaLiquidacion,
            FechaPago,
            NoOficio,
            DatoBasico,
            FDatoBasico,
            FIngreso1,
            FechaDevolucion1,
            DiasRev1,
            FechaRevision2,
            FechaDevolucion2,
            DiasRev2,
            FechaRevision3,
            FechaDevolucion3,
            DiasRev3,
            FechaRevision4,
            FechaDevolucion4,
            DiasRev4,
            FechaRevision5,
            FechaDevolucion5,
            DiasRev5,
            DiasEnRevision,
            FechaAprobacion,
            OficioAprobacionNo
            ) VALUES (
            '$TipoProyecto',
            '$actividad',
            '$servicio',
            '$consecutivo',
            '$anio',
            '$descripcionProyecto',
            '$direccion',
            '$propietarioProyecto',
            '$estado',
            '$estadoAtencion',
            '$fechaEstado',
            '$direccionPropietario',
            '$cedulaNit',
            '$telefonoPropietario',
            '$correoPropietario',
            '$consultor',
            '$telefonoProyectista',
            '$correoElectronicoProyectista',
            '$recursos',
            '$comuna',
            '$ingeniero',
            '$unidad',
            '$cantidad',
            '$mlFacturados',
            '$vrFacturado',
            '$fechaLiquidacion',
            '$fechaPago',
            '$noOficio',
            '$datoBasico',
            '$fDatoBasico',
            '$fIngreso1',
            '$fechaDevolucion1',
            '$diasRevision1',
            '$fechaRevision2',
            '$fechaDevolucion2',
            '$diasRevision2',
            '$fechaRevision3',
            '$fechaDevolucion3',
            '$diasRevision3',
            '$fechaRevision4',
            '$fechaDevolucion4',
            '$diasRevision4',
            '$fechaRevision5',
            '$fechaDevolucion5',
            '$diasRevision5',
            '$diasEnRevision',
            '$fechaAprobacion',
            '$TotalRev',
            '$oficioAprobacionNo'
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

    <h2>Agregar Proyecto Externas</h2>
    <form action="" method="POST" style="text-align: left;">
    <label class="form-label" for="TipoProyecto">Tipo de Proyecto:</label>
    <input class="form-input" type="text" name="TipoProyecto" id="TipoProyecto" required><br>

    <label  class="form-label" for="Actividad">Actividad:</label>
    <input class="form-input"type="text" name="Actividad" id="Actividad" required><br>

    <label class="form-label" for="Servicio">Servicio:</label>
    <input class="form-input" type="text" name="Servicio" id="Servicio" required><br>

    <label class="form-label" for="Consecutivo">Consecutivo:</label>
    <input class="form-input" type="text" name="Consecutivo" id="Consecutivo" required><br>

    <label class="form-label" for="Anio">Año:</label>
    <input class="form-input" type="text" name="Anio" id="Anio" required><br>

    <label class="form-label"for="DescripcionProyecto">Descripción del Proyecto:</label>
    <textarea class="form-input" name="DescripcionProyecto" id="DescripcionProyecto" required></textarea><br>

    <label class="form-label" for="Direccion">Dirección:</label>
    <input class="form-input" type="text" name="Direccion" id="Direccion" required><br>

    <label class="form-label" for="PropietarioProyecto">Propietario del Proyecto:</label>
    <input class="form-input" type="text" name="PropietarioProyecto" id="PropietarioProyecto" required><br>

    <label class="form-label" for="Estado">Estado:</label>
    <input class="form-input" type="text" name="Estado" id="Estado" required><br>

    <label class="form-label" for="EstadoAtencion">Estado de Atención:</label>
    <input class="form-input" type="date" name="EstadoAtencion" id="EstadoAtencion" required><br>

    <label class="form-label" for="FechaEstado">Fecha de Estado:</label>
    <input class="form-input" type="date" name="FechaEstado" id="FechaEstado" required><br>

    <label class="form-label" for="DireccionPropietario">Dirección del Propietario:</label>
    <input class="form-imput" type="text" name="DireccionPropietario" id="DireccionPropietario" required><br>

    <label class="form-label" for="CedulaNit">Cédula/NIT:</label>
    <input class="form-input" type="text" name="CedulaNit" id="CedulaNit" required><br>

    <label class="form-label" for="TelefonoPropietario">Teléfono del Propietario:</label>
    <input class="form-input" type="text" name="TelefonoPropietario" id="TelefonoPropietario" required><br>

    <label class="form-label" for="CorreoPropietario">Correo Electrónico del Propietario:</label>
    <input class="form-input" type="email" name="CorreoPropietario" id="CorreoPropietario" required><br>

    <label class="form-label" for="Consultor">Consultor:</label>
    <input class="form-input" type="text" name="Consultor" id="Consultor" required><br>

    <label class="form-label" for="TelefonoProyectista">Teléfono del Proyectista:</label>
    <input class="form-input" type="text" name="TelefonoProyectista" id="TelefonoProyectista" required><br>

    <label class="form-label" for="CorreoElectronicoProyectista">Correo Electrónico del Proyectista:</label>
    <input class="form-input" type="email" name="CorreoElectronicoProyectista" id="CorreoElectronicoProyectista" required><br>

    <label class="form-label" for="Recursos">Recursos:</label>
    <input class="form-input" type="text" name="Recursos" id="Recursos" required><br>

    <label class="form-label" for="Comuna">Comuna:</label>
    <input class="form-input" type="text" name="Comuna" id="Comuna" required><br>

    <label class="form-label" for="Ingeniero">Ingeniero:</label>
    <input class="form-input" type="text" name="Ingeniero" id="Ingeniero" required><br>

    <label class="form-label" for="Unidad">Unidad:</label>
    <input class="form-input" type="text" name="Unidad" id="Unidad" required><br>

    <label class="form-label" for="Cantidad">Cantidad:</label>
    <input class="form-input" type="text" name="Cantidad" id="Cantidad" required><br>

    <label class="form-label" for="MLFacturados">ML Facturados:</label>
    <input class="form-input" type="text" name="MLFacturados" id="MLFacturados" required><br>

    <label class="form-label" for="VrFacturado">Valor Facturado:</label>
    <input class="form-input" type="text" name="VrFacturado" id="VrFacturado" required><br>

    <label class="form-label" for="FechaLiquidacion">Fecha de Liquidación:</label>
    <input class="form-input" type="date" name="FechaLiquidacion" id="FechaLiquidacion" required><br>

    <label class="form-label" for="FechaPago">Fecha de Pago:</label>
    <input class="form-input" type="date" name="FechaPago" id="FechaPago" required><br>

    <label class="form-label" for="NoOficio">Número de Oficio:</label>
    <input class="form-input" type="text" name="NoOficio" id="NoOficio" required><br>

    <label class="form-label" for="DatoBasico">Dato Básico:</label>
    <input class="form-input" type="text" name="DatoBasico" id="DatoBasico" required><br>

    <label class="form-label" for="FDatoBasico">Fecha Dato Básico:</label>
    <input class="form-input" type="date" name="FDatoBasico" id="FDatoBasico" required><br>

    <label class="form-label" for="FIngreso1">Fecha de Revisión 1:</label>
    <input class="form-input" type="date" name="FIngreso1" id="FIngreso1" required><br>

    <label class="form-label" for="FechaDevolucion1">Fecha de Devolución 1:</label>
    <input class="form-input" type="date" name="FechaDevolucion1" id="FechaDevolucion1" ><br>

    <label class="form-label" for="FechaRevision2">Fecha de Revisión 2:</label>
    <input class="form-input" type="date" name="FechaRevision2" id="FechaRevision2" ><br>

    <label class="form-label" for="FechaDevolucion2">Fecha de Devolución 2:</label>
    <input class="form-input" type="date" name="FechaDevolucion2" id="FechaDevolucion2" ><br>

    <label class="form-label" for="FechaRevision3">Fecha de Revisión 3:</label>
    <input class="form-input" type="date" name="FechaRevision3" id="FechaRevision3" ><br>

    <label class="form-label" for="FechaDevolucion3">Fecha de Devolución 3:</label>
    <input class="form-input" type="date" name="FechaDevolucion3" id="FechaDevolucion3" ><br>

    <label class="form-label" for="FechaRevision4">Fecha de Revisión 4:</label>
    <input class="form-input" type="date" name="FechaRevision4" id="FechaRevision4" ><br>

    <label class="form-label" for="FechaDevolucion4">Fecha de Devolución 4:</label>
    <input class="form-input" type="date" name="FechaDevolucion4" id="FechaDevolucion4" ><br>

    <label class="form-label" for="FechaRevision5">Fecha de Revisión 5:</label>
    <input class="form-input" type="date" name="FechaRevision5" id="FechaRevision5" ><br>

    <label class="form-label" for="FechaDevolucion5">Fecha de Devolución 5:</label>
    <input class="form-input" type="date" name="FechaDevolucion5" id="FechaDevolucion5" ><br>

    <label class="form-label" for="FechaAprobacion">Fecha de aprobacion:</label>
    <input class="form-input" type="date" name="FechaAprobacion" id="FechaAprobacion" ><br>

    <label class="form-label" for="OficioAprobacionNo">Oficio de Aprobacion No :</label>
    <input class="form-input" type="text" name="OficioAprobacionNo" id="OficioAprobacionNo" ><br>


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
