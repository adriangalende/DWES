<?php
/**
 * Funciones con los métodos de ordenación
 *
 */

/**
 * @param $numeros
 *  Muestra por pantalla la lista de números ya ordenada.
 */
function pintar($numeros){
    $resultado = "";
    foreach ($numeros as $numero){
        $resultado .= " ".$numero;
    }
    echo $resultado."<br>";
}

/**
 * Ordenación por inserción directa
 * @param $numeros
 *
 * Compara el elemento x con sus n anteriores para trasladarse a la posición que le
 * toca.
 *
 */
function directa($numeros){
    $ini =  microtime(true); //microtime(true) nos convierte los ms a s automáticamente.
    echo "Has seleccionado Ordenación Selección directa: <br>";

    $contadorItems = count($numeros);

    //Nos aseguramos que trabajamos solo cuando nos envian más de un número en la matríz
    if($contadorItems > 1) {
        for ($i = 1; $i < $contadorItems; $i++) {
            $j = $i;
            $numeroAuxiliar = $numeros[$i];
            while ($j > 0 && $numeros[$j - 1] > $numeroAuxiliar) {
                $numeros[$j] = $numeros[$j - 1];
                $j--;
            }
            $numeros[$j] = $numeroAuxiliar;
        }
    }
    echo pintar($numeros);

    echo  "Tiempo empleado: ". number_format((microtime(true) - $ini),6,",","") ." s";
}

/**
 * Ordenación por selección directa
 * @param $numero
 * Desde la posición indicada, buscamos el número más pequeño de la matríz y lo insertamos en dicha posición, pasamos al
 * sigüiente número y hacemos lo mismo. Así con todos los números de la matríz.
 */
function seleccion($numeros){
    $ini =  microtime(true); //microtime(true) nos convierte los ms a s automáticamente.
    echo "Has seleccionado Ordenación Selección directa: <br>";

    $contadorItems = count($numeros);

        if($contadorItems > 1){
        for($i=0; $i < $contadorItems-1; $i++){
            $indiceMinimo = $i;
            for($j=$i+1;$j < $contadorItems; $j++){

                if($numeros[$j] < $numeros[$indiceMinimo]){
                    $indiceMinimo = $j;
                }

                if($i != $indiceMinimo){
                    $numeroAuxiliar = $numeros[$i];
                    $numeros[$i] = $numeros[$indiceMinimo];
                    $numeros[$indiceMinimo] = $numeroAuxiliar;
                }

            }
        }
    }
    echo pintar($numeros);

    echo  "Tiempo empleado: ". number_format((microtime(true) - $ini),6,",","") ." s";
}

/**
 * Ordenación por método de la burbuja.
 * @param $numeros
 *
 * Comparamos los elementos por pares, el primer elemento se compara con su elemento inmediato
 * sucesor para ordenar de menor a mayor.
 */
function burbuja ($numeros){
    $ini =  microtime(true);
    echo "Has seleccionado Ordenación por el método \"Bubble sort\": <br>";

    $contadorItems = count($numeros);
    if($contadorItems > 1) {
        for ($i = 0; $i < $contadorItems; $i++) {
            for ($j = 0; $j < $contadorItems - 1; $j++) {
                //Las matrices son mutables, así que me curo en salud y guardo ambos elementos en variables.
                $numInicial = $numeros[$j];
                $numeroAux = $numeros[$j + 1];
                /**Cuando el numero actual es mayor que el auxiliar ( elemento inmediato al actual )
                 * giramos los lementos en la matríz.
                 **/
                if ($numeros[$j] > $numeroAux) {
                    $numeros[$j] = $numeroAux;
                    $numeros[$j + 1] = $numInicial;
                }
            }
        }
    }
    echo pintar($numeros);

    echo  "Tiempo empleado: ". number_format((microtime(true) - $ini),6,",","") ." s";
}

/**
 * Ordenación por método Quick sort
 * @param $numeros
 * Dividimos la matríz en dos partes utilizando un pivote
 * Primero, elegimos el pivote que puede ser cualquier elemento de la matriz.
 * matriz menores = números más pequeños que el pivote
 * matriz mayores = números mayores que el pivote
 *
 * Una vez tenemos los subarrays creados, volvemos a ordenarlos de forma
 * independiente con la misma función -> "Recursividad"
 *
 */
function quicksort($numeros){
    $ini =  microtime(true);
    $contadorItems = count($numeros);
    //Como siempre, programación defensiva: si nos envían solo 1 número les pintaremos el array sin tratarlo.
    if($contadorItems > 1){
        $pivote = $numeros[0]; //elegimos al primer elemento como pivote.
        $menores = array();
        $mayores = array();

        for($i=1; $i < $contadorItems;$i++){
            if($numeros[$i] <= $pivote){
                $menores[] = $numeros[$i];
            } else {
                $mayores[] = $numeros[$i];
            }
        }

        return array_merge(quicksort($menores),array($pivote),quicksort($mayores));
    }
    return $numeros;
}



?>