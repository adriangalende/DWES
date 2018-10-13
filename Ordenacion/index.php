<?php
/**
 * Created by PhpStorm.
 * User: Adri
 * Date: 09/10/2018
 * Time: 16:42
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Algoritmos Ordenación PHP</title>
</head>
<body>
<form id="formularioOrdenacion" method="post">
    <select name="algoritmo" id="selectAlgoritmo">
        <option value="0">Elije una opción</option>
        <option value="1">Selección directa</option>
    </select><br>
    <input type="checkbox" name="random" id="random"> random
    <input type="number" name="entradaRandom" id="entradaRandom"><br>

    <input type="checkbox" name="entrada" id="entrada"> entrada
    <input type="text" name="entradaText" id="entradaText"> *separa cada número con una coma<br>

    <input type="checkbox" name="fichero" id="fichero"> fichero <br>
    <input type="submit" value="enviar">
</form>
<?php

/**
 *  Comprobamos si se ha refrescado la página
 *  y así limpiamos los parámetros que pasaremos.
 */

session_start();

/**
 * "importamos" el archivo metodos.php para poder utilizar las funciones de los métodos
 * de ordenación.
 */
include_once "metodos.php";

//if(session_status() == "2" && isset($_SESSION['loaded']) && $_SESSION['loaded']) {
//
//    if(isset($_POST['entradaText'])){
//        unset($_POST['entradaText']);
//    }
//    if(isset($_POST['random'])){
//        unset($_POST['random']);
//    }
//    if(isset($_POST['entradaRandom'])){
//        unset($_POST['entradaRandom']);
//    }
//
//    //Redirección si refrescamos
//    header('location:index.php');
//}

$_SESSION['loaded'] = true;

/**
 * Partes del formulario
 *
 *  entrada  = entrada -> Si está activa cogerá lo escrito en entradaText
 *  entradaText = textbox
 *
 *  random = checkbox -> Si está activa, cogerá  N números aleatorios
 *  entradaRandom = textbox para determinar N números de forma aleatoria
 *
 *  fichero = SOON;
 *
 */
$entrada = array(4, 10, 3, 20, 1, 0); // entrada por defecto de números
$entradaText = false;
$random = false;
$entradaFichero = false;

 if(isset($_POST['entradaText']) && !empty($_POST['entradaText'])){
     $entradaText = true;
 } else if (isset($_POST['random']) && $_POST['random'] == "on"){
     $random = true;
 }

 if($entradaText){
     //Intentamos filtrar posibles errores que haya insertado el usuario.
     $entrada = str_replace(' ', ',', $_POST['entradaText'] );
     $entrada = explode(",", $entrada);
 } else if ($random){
     /**
      * Generamos tantos números aleatorios como nos pida el usuario en el formulario.
      * usamos la función rand(); de php
      * vamos a ponerle un máximo para que no nos saque números descabellados.
      * De momento no se controla la repetición de números random.
      */
     if(isset($_POST['entradaRandom']) && $_POST['entradaRandom'] > 0){
       $entrada = array();
       for($i=0;$i<$_POST['entradaRandom'];$i++){
           $entrada[$i] = rand(-100, 100);
       }
     } else {
         echo "Dime la cantidad de números rándom que quieres generar.";
     }
 } else {
     echo "Como no has seleccionado ningún método para generar la lista de números, he cogido los números asignados por defecto. <br>";
 }

 if(isset($_POST['algoritmo'])) {
     ordenar($_POST['algoritmo'], $entrada);
 }


/**
 * @param $algoritmo
 * @param $entrada
 */

 function ordenar($algoritmo, $entrada){
     $arrayMetodosOrdenacion = array("","directa");
     if($algoritmo != 0){
         $arrayMetodosOrdenacion[$algoritmo]($entrada);
     } else {
         echo "por favor, selecciona un método de ordenación para poder seguir";
     }
 }



    session_destroy();
?>

</body>
</html>
