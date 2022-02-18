
<link rel="stylesheet" type="text/css" href="estilo.css">

<?php
    
    $cadena = str_replace(" ","%20",$_SERVER['PHP_SELF']);

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
    $mesEscrito = '';

    switch ($mes) {
        case "1": $mesEscrito="Enero"; break;
        case "2": $mesEscrito="Febrero"; break;
        case "3": $mesEscrito="Marzo"; break;
        case "4": $mesEscrito="Abril"; break;
        case "5": $mesEscrito="Mayo"; break;
        case "6": $mesEscrito="Junio"; break;
        case "7": $mesEscrito="Julio"; break;
        case "8": $mesEscrito="Agosto";break;
        case "9": $mesEscrito="Septiembre"; break;
        case "10": $mesEscrito="Octubre"; break;
        case "11": $mesEscrito="Noviembre"; break;
        case "12": $mesEscrito="Diciembre"; break;
    }

    $diainicio = jddayofweek(cal_to_jd(CAL_GREGORIAN,$mes,1,$anio));
    $diainicio = ($diainicio==0)?7:$diainicio;

    echo "<p>CALENDARIO</p>";

    echo "<a href=".$cadena."?mes=".($mes-1)."&anio=".$anio.">"."<<"."</a>";
    echo " ".$mesEscrito." de ".$anio." ";
    echo "<a href=".$cadena."?mes=".($mes+1)."&anio=".$anio."&diaPosicionado=1".">".">>"."</a>";

    echo "<table border=1>";
    echo "<tr><th>Lunes</th>";
    echo "<th>Martes</th>";
    echo "<th>Miércoles</th>";
    echo "<th>Jueves</th>";
    echo "<th>Viernes</th>";
    echo "<th>Sábado</th>";
    echo "<th>Domingo</th></tr>";

    
    $pintar = false;
    $diaEmpezarMes = 1;
    
    while ($diaEmpezarMes<=$diasMes){
        echo "<tr>";

        for ($j = 1; $j < 8;$j++){

            /* Si no hemos empezado a pintar días y estamos en el día
            de la semana que coincide con el 1 del mes activa $pintar
            para que empiece a pintarlo */

            if (!$pintar && $j==$diainicio){
                $pintar = true;
            }

            if ($pintar && $diaEmpezarMes>$diasMes){
                $pintar = false;
            }

            if ($pintar) {
                //echo "<td id ='filaDentro'>".$dia++."</td>";
                if ($diaEmpezarMes==$diaPosicionado){
                    echo "<td style='background-color:yellow'><a href=".$cadena."?diaPosicionado=".$diaPosicionado."&mes=".$mes.">".$diaEmpezarMes++."</td>";
                } else {
                    echo "<td id ='filaDentro'><a href=".$cadena."?diaPosicionado=".$diaEmpezarMes."&mes=".$mes.">".$diaEmpezarMes++."</td>";
                }
            } else {
                echo "<td id ='filaFuera'></td>";
            }
        }

        echo "</tr>";
    }

    echo "</table>";

    function leerArchivo($nombre){
        $fp = '';
        if (file_exists($nombre)){
            $fp = file_get_contents($nombre);
        }
        return $fp; 
    }

    function guardarArchivo($nombre,$comentario){
        file_put_contents($nombre,$comentario);
    }

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
