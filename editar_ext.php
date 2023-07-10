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
        $TipoProyecto = $_POST['TipoProyecto'];
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
        $diasRevision5 = calcularDiasHabiles5($fechaRevision4, $fechaDevolucion4);
        
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
                $TotalRev = 4;
            }
        }else{
            $TotalRev =0;
        }
        $oficioAprobacionNo = $_POST['OficioAprobacionNo'];
        
        // Actualizar el registro en la base de datos
        $sql = "UPDATE proyectos SET
         Actividad='$actividad',
        Servicio='$servicio',
        Consecutivo='$consecutivo',
        Anio='$anio',
        FIngreso1='$fIngreso1',
        DescripcionProyecto='$descripcionProyecto',
        Direccion='$direccion',
        PropietarioProyecto='$propietarioProyecto',
        Estado='$estado',
        EstadoAtencion='$estadoAtencion',
        FechaEstado='$fechaEstado',
        DireccionPropietario='$direccionPropietario',
        CedulaNit='$cedulaNit',
        TelefonoPropietario='$telefonoPropietario',
        CorreoPropietario='$correoPropietario',
        Consultor='$consultor',
        TelefonoProyectista='$telefonoProyectista',
        CorreoElectronicoProyectista='$correoElectronicoProyectista',
        Recursos='$recursos',
        Comuna='$comuna',
        Ingeniero='$ingeniero',
        Unidad='$unidad',
        Cantidad='$cantidad',
        MLFacturados='$mlFacturados',
        VrFacturado='$vrFacturado',
        FechaLiquidacion='$fechaLiquidacion',
        FechaPago='$fechaPago',
        NoOficio='$noOficio',
        DatoBasico='$datoBasico',
        FDatoBasico='$fDatoBasico',
        FechaDevolucion1='$fechaDevolucion1',
        DiasRev1='$diasRevision1',
        FechaRevision2='$fechaRevision2',
        FechaDevolucion2='$fechaDevolucion2',
        DiasRev2='$diasRevision2',
        DiasEnRevision='$diasEnRevision',
        FechaRevision3='$fechaRevision3',
        FechaDevolucion3='$fechaDevolucion3',
        DiasRev3='$diasRevision3',
        FechaRevision4='$fechaRevision4',
        FechaDevolucion4='$fechaDevolucion4',
        DiasRev4='$diasRevision4',
        FechaRevision5='$fechaRevision5',
        FechaDevolucion5='$fechaDevolucion5',
        DiasRev5='$diasRevision5',
        FechaAprobacion='$fechaAprobacion',
        TotalRev='$TotalRev',
        OficioAprobacionNo='$oficioAprobacionNo'
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
    $sql = "SELECT * FROM proyectos WHERE id='$idProyecto'";
    $resultado = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    ?>

    <h1>Editar Proyecto</h1>

    <form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

<label class="form-label">TipoProyecto:</label>
<input type="text" name="TipoProyecto" value="<?php echo $fila['TipoProyecto']; ?>" class="form-input"><br>

<label class="form-label">Actividad:</label>
<input type="text" name="Actividad" value="<?php echo $fila['Actividad']; ?>" class="form-input"><br>

<label class="form-label">Servicio:</label>
<input type="text" name="Servicio" value="<?php echo $fila['Servicio']; ?>" class="form-input"><br>

<label class="form-label">Consecutivo:</label>
<input type="text" name="Consecutivo" value="<?php echo $fila['Consecutivo']; ?>" class="form-input"><br>

<label class="form-label">Año:</label>
<input type="text" name="Anio" value="<?php echo $fila['Anio']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Ingreso 1:</label>
<input type="date" name="FIngreso1" value="<?php echo $fila['FIngreso1']; ?>" class="form-input"><br>

<label class="form-label">Descripción del Proyecto:</label>
<input type="text" name="DescripcionProyecto" value="<?php echo $fila['DescripcionProyecto']; ?>" class="form-input"><br>

<label class="form-label">Dirección:</label>
<input type="text" name="Direccion" value="<?php echo $fila['Direccion']; ?>"><br>

<label class="form-label">Propietario del Proyecto:</label>
<input type="text" name="PropietarioProyecto" value="<?php echo $fila['PropietarioProyecto']; ?>" class="form-input"><br>

<label class="form-label">Estado:</label>
<input type="text" name="Estado" value="<?php echo $fila['Estado']; ?>" class="form-input"><br>

<label class="form-label">Estado de Atención:</label>
<input type="text" name="EstadoAtencion" value="<?php echo $fila['EstadoAtencion']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Estado:</label>
<input type="date" name="FechaEstado" value="<?php echo $fila['FechaEstado']; ?>" class="form-input"><br>

<label class="form-label">Dirección del Propietario:</label>
<input type="text" name="DireccionPropietario" value="<?php echo $fila['DireccionPropietario']; ?>" class="form-input"><br>

<label class="form-label">Cédula/NIT:</label>
<input type="text" name="CedulaNit" value="<?php echo $fila['CedulaNit']; ?>" class="form-input"><br>

<label class="form-label">Teléfono del Propietario:</label>
<input type="text" name="TelefonoPropietario" value="<?php echo $fila['TelefonoPropietario']; ?>" class="form-input"><br>

<label class="form-label">Correo Electrónico del Propietario:</label>
<input type="text" name="CorreoPropietario" value="<?php echo $fila['CorreoPropietario']; ?>" class="form-input"><br>

<label class="form-label">Consultor:</label>
<input type="text" name="Consultor" value="<?php echo $fila['Consultor']; ?>" class="form-input"><br>

<label class="form-label">Teléfono del Proyectista:</label>
<input type="text" name="TelefonoProyectista" value="<?php echo $fila['TelefonoProyectista']; ?>" class="form-input"><br>

<label class="form-label">Correo Electrónico del Proyectista:</label>
<input type="text" name="CorreoElectronicoProyectista" value="<?php echo $fila['CorreoElectronicoProyectista']; ?>" class="form-input"><br>

<label class="form-label">Recursos:</label>
<input type="text" name="Recursos" value="<?php echo $fila['Recursos']; ?>" class="form-input"><br>

<label class="form-label">Comuna:</label>
<input type="text" name="Comuna" value="<?php echo $fila['Comuna']; ?>" class="form-input"><br>

<label class="form-label">Ingeniero:</label>
<input type="text" name="Ingeniero" value="<?php echo $fila['Ingeniero']; ?>" class="form-input"><br>

<label class="form-label">Unidad:</label>
<input type="text" name="Unidad" value="<?php echo $fila['Unidad']; ?>" class="form-input"><br>

<label class="form-label">Cantidad:</label>
<input type="text" name="Cantidad" value="<?php echo $fila['Cantidad']; ?>" class="form-input"><br>

<label class="form-label">ML Facturados:</label>
<input type="text" name="MLFacturados" value="<?php echo $fila['MLFacturados']; ?>" class="form-input"><br>

<label class="form-label">VR Facturado:</label>
<input type="text" name="VrFacturado" value="<?php echo $fila['VrFacturado']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Liquidación:</label>
<input type="date" name="FechaLiquidacion" value="<?php echo $fila['FechaLiquidacion']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Pago:</label>
<input type="date" name="FechaPago" value="<?php echo $fila['FechaPago']; ?>" class="form-input"><br>

<label class="form-label">No. de Oficio:</label>
<input type="text" name="NoOficio" value="<?php echo $fila['NoOficio']; ?>" class="form-input"><br>

<label class="form-label">Dato Básico:</label>
<input type="text" name="DatoBasico" value="<?php echo $fila['DatoBasico']; ?>" class="form-input"><br>

<label class="form-label">F. Dato Básico:</label>
<input type="date" name="FDatoBasico" value="<?php echo $fila['FDatoBasico']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Devolución 1:</label>
<input type="date" name="FechaDevolucion1" value="<?php echo $fila['FechaDevolucion1']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Revisión 2:</label>
<input type="date" name="FechaRevision2" value="<?php echo $fila['FechaRevision2']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Devolución 2:</label>
<input type="date" name="FechaDevolucion2" value="<?php echo $fila['FechaDevolucion2']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Revisión 3:</label>
<input type="date" name="FechaRevision3" value="<?php echo $fila['FechaRevision3']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Devolución 3:</label>
<input type="date" name="FechaDevolucion3" value="<?php echo $fila['FechaDevolucion3']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Revisión 4:</label>
<input type="date" name="FechaRevision4" value="<?php echo $fila['FechaRevision4']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Devolución 4:</label>
<input type="date" name="FechaDevolucion4" value="<?php echo $fila['FechaDevolucion4']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Revisión 5:</label>
<input type="date" name="FechaRevision5" value="<?php echo $fila['FechaRevision5']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Devolución 5:</label>
<input type="date" name="FechaDevolucion5" value="<?php echo $fila['FechaDevolucion5']; ?>" class="form-input"><br>

<label class="form-label">Fecha de Aprobación:</label>
<input type="date" name="FechaAprobacion" value="<?php echo $fila['FechaAprobacion']; ?>" class="form-input"><br>

<label class="form-label">No. de Oficio de Aprobación:</label>
<input type="text" name="OficioAprobacionNo" value="<?php echo $fila['OficioAprobacionNo']; ?>" class="form-input"><br>

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
  