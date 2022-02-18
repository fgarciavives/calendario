<?php


function devolverMesLetra($mes){
    $mesEscrito= '';
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
    return $mesEscrito;
}

function pintarCalendario($diaEmpezarMes, $diaPosicionado, $diasMes, $diainicio, $mes){
    $pintar = false;
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
                    echo "<td style='background-color:yellow'><a href=".$GLOBALS['cadena']."?diaPosicionado=".$diaPosicionado."&mes=".$mes.">".$diaEmpezarMes++."</td>";
                } else {
                    echo "<td id ='filaDentro'><a href=".$GLOBALS['cadena']."?diaPosicionado=".$diaEmpezarMes."&mes=".$mes.">".$diaEmpezarMes++."</td>";
                }
            } else {
                echo "<td id ='filaFuera'></td>";
            }
        }

        echo "</tr>";
    }

    echo "</table>";
}

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

    function mostrarMenu ($mes,$anio,$diaPosicionado,$mesEscrito){
        echo "<p>CALENDARIO</p>";

        echo "<a href=".$GLOBALS['cadena']."?mes=".($mes-1)."&anio=".$anio.">"."<<"."</a>";
        echo " ".$mesEscrito." de ".$anio." ";
        echo "<a href=".$GLOBALS['cadena']."?mes=".($mes+1)."&anio=".$anio."&diaPosicionado=1".">".">>"."</a>";
        
        echo "<table border=1>";
        echo "<tr><th>Lunes</th>";
        echo "<th>Martes</th>";
        echo "<th>Miércoles</th>";
        echo "<th>Jueves</th>";
        echo "<th>Viernes</th>";
        echo "<th>Sábado</th>";
        echo "<th>Domingo</th></tr>";
    }

?>