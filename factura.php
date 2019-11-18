<?php
    /*----------VALIDACION DE DATOS----------*/
    $udProd1 = "";
    if(isset($_POST["udProd1"])){
        $udProd1 = filter_input(INPUT_POST, "udProd1");
    }
    if(empty($udProd1)){
       $udProd1 = 0;
    }
    
    $udProd2 = "";
    if(isset($_POST["udProd2"])){
        $udProd2 = filter_input(INPUT_POST, "udProd2");
    }
    if(empty($udProd2)){
       $udProd2 = 0;
   }
    
    $udProd3 = "";
    if(isset($_POST["udProd3"])){
        $udProd3 = filter_input(INPUT_POST, "udProd3");
    }
    if(empty($udProd3)){
       $udProd3 = 0;
   }
   
    $udProd4 = "";
    if(isset($_POST["udProd4"])){
        $udProd4 = filter_input(INPUT_POST, "udProd4");
    }
    if(empty($udProd4)){
       $udProd4 = 0;
    }
    
    $udProd5 = "";
    if(isset($_POST["udProd5"])){
        $udProd5 = filter_input(INPUT_POST, "udProd5");
    }
    if(empty($udProd5)){
       $udProd5 = 0;
    }
    
    $nomProd1 = "";
     if(isset($_POST["nomProd1"])){
        $nomProd1 = filter_input(INPUT_POST, "nomProd1");
    }
    
    $nomProd2 = "";
     if(isset($_POST["nomProd2"])){
        $nomProd2 = filter_input(INPUT_POST, "nomProd2");
    }
    
    $nomProd3 = "";
     if(isset($_POST["nomProd3"])){
        $nomProd3 = filter_input(INPUT_POST, "nomProd3");
    }
    
    $nomProd4 = "";
     if(isset($_POST["nomProd4"])){
        $nomProd4 = filter_input(INPUT_POST, "nomProd4");
    }
    
    $nomProd5 = "";
     if(isset($_POST["nomProd5"])){
        $nomProd5 = filter_input(INPUT_POST, "nomProd5");
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DroneMaster</title>
    </head>
    <body>
        <header>
            <a href="userLogged.php"><img src="imagenes/logoDroneMaster.png"></img></a>
            <div>
            </div>
        </header>
        <nav>
          
        </nav>
        <main>
            <label>Nombre Producto 1: <?=$nomProd1?></label>
            <label>Unidades producto 1: <?=$udProd1?></label><br>
            <label>Nombre Producto 2: <?=$nomProd2?></label>
            <label>Unidades producto 2: <?=$udProd2?></label><br>
            <label>Nombre Producto 3: <?=$nomProd3?></label>
            <label>Unidades producto 3: <?=$udProd3?></label><br>
            <label>Nombre Producto 4: <?=$nomProd4?></label>
            <label>Unidades producto 4: <?=$udProd4?></label><br>
            <label>Nombre Producto 5: <?=$nomProd5?></label>
            <label>Unidades producto 5: <?=$udProd5?></label><br>
            
            </table>
        </main>
    </body>
</html>
