<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        table,th, td{
            border:1px solid #000;
        }

        table{
            width: 800px;
        }

        .true{
            background-color: #00974c;
            color: #fff;
        }
        
        .false{
            background-color: darkred;
            color: #fff;
        }
    </style>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Contenido de $var</th>
                <th>isset($var)</th>
                <th>empty($var)</th>
                <th>isnull($var)</th>
                <th>(bool)$var</th>
            </tr>
        </thead>
        <tbody>
            <?php
                function stringfy($var){
                    $type = gettype($var);
                    switch ($type) {
                        case "string":
                            return $var;
                        case "boolean":
                            return $var == 1?"true":"false";
                        case "integer":
                            return $var;
                        case "NULL":
                            return 'null';
                        case "array":
                            return "array()";
                    }
                }

                $varArray = array( null, 0,true,false,"\"0\"","\"\"","foo",array(),"unset(&dollar;var)");


                $resultString ="";

                for ($i=0; $i < count($varArray);$i++) {
                    $varString = stringfy($varArray[$i]);

                    ## Casos especial unset($var)
                    ## (unset) - forzado a NULL
                    if($i == 8){
                        unset($v);
                    } else {
                        $v = $varArray[$i];
                    }

                    $isset = isset($v)?"true":"false";
                    $empty = empty($v)?"true":"false";
                    $isNull = is_null($v)?"true":"false";
                    $isBool = (boolean) $v?"true":"false";


                    ## Creamos la tabla dinámicamente
                    $resultString .= "<tr>";
                    $resultString .= "<td>". ($i+1) . "</td>";
                    $resultString .= "<td>&dollar;var = ". $varString . "</td>";
                    $resultString .= "<td class='".$isset."'>". $isset . "</td>";
                    $resultString .= "<td class='".$empty."'>". $empty . "</td>";
                    $resultString .= "<td class='".$isNull."'>". $isNull . "</td>";
                    $resultString .= "<td class='".$isBool."'>". $isBool . "</td>";
                    $resultString .= "</tr>";
                }

                echo $resultString;
            ?>
        </tbody>
    </table>
</body>
</html>
