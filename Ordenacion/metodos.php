<?php
/**
 * Funciones con los métodos de ordenación
 *
 */

function pintar($numeros){
    $resultado = "";
    foreach ($numeros as $numero){
        $resultado .= " ".$numero;
    }
    echo $resultado."<br>";
}

/**
 * Ordenación directa
 * @param $numeros
 *
 * Compara el elemento x con sus n anteriores para trasladarse a la posición que le
 * toca.
 *
 */
function directa($numeros){
    $ini =  microtime(true);
    echo "Has seleccionado Ordenación directa: <br>";

    $contadorItems = count($numeros);
    for($i=1; $i < $contadorItems;$i++){
        $j = $i;
        $numeroAuxiliar = $numeros[$i];
        while($j > 0 && $numeros[$j - 1] > $numeroAuxiliar){
            $numeros[$j] = $numeros[$j - 1];
            $j--;
        }
        $numeros[$j] = $numeroAuxiliar;
    }

    echo pintar($numeros);

    echo  "Tiempo empleado: ". microtime(true); - $ini ." ms";
}




?>