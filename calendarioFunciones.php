<link rel="stylesheet" type="text/css" href="estilo.css">

<?php


include "funciones.php";

$GLOBALS['cadena'] = str_replace(" ","%20",$_SERVER['PHP_SELF']);

    if (isset($_REQUEST['anio'])) {
        $anio = $_REQUEST['anio'];
    } else {
        $anio = date('Y');
    }

    if (isset($_REQUEST['mes'])) {     
        if ($_REQUEST['mes'] == 13){
            $anio +=1;
            $mes = 1;
        } else if ($_REQUEST['mes'] == 0){
            $anio -=1;
            $mes=12;
        } else {
            $mes = $_REQUEST['mes'];
        }
    } else {
        $mes = date('n');
    }
    
    if (isset($_REQUEST['diaPosicionado'])){
        $diaPosicionado = $_REQUEST['diaPosicionado'];
    } else {
        $diaPosicionado = 1;
    }
    
    $nombre = "fichero-".$diaPosicionado.$mes.$anio.".txt";

    if (isset($_REQUEST['comentario'])){
        $comentario = $_REQUEST['comentario'];
        guardarArchivo($nombre,$comentario);
    } else {
        $comentario = '';
    }

    $diasMes = date('t');
    $mesEscrito = devolverMesLetra($mes); //función externa

    $diainicio = jddayofweek(cal_to_jd(CAL_GREGORIAN,$mes,1,$anio));
    $diainicio = ($diainicio==0)?7:$diainicio;

    mostrarMenu ($mes,$anio,$diaPosicionado,$mesEscrito); //función externa
    
    $diaEmpezarMes=1;
    pintarCalendario($diaEmpezarMes,$diaPosicionado, $diasMes, $diainicio, $mes); //función externa

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario PHP</title>
</head>
<body>
    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>">

        <br><h4 style='color:orange'>Citas del día</h4>
        
        <input type="hidden" name="diaPosicionado" value="<?php echo $diaPosicionado ?>">
        <input type="hidden" name="mes" value="<?php echo $mes ?>">
        <input type="hidden" name="anio" value="<?php echo $anio ?>">
        <input type="txt" id="cita" name="comentario" placeholder="Introduce la cita del día"
        value="<?php echo leerArchivo($nombre) ?>"/>
        <input type="submit" value="Enviar">

    </form>
        
</body>
</html>
