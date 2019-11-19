<?php
    /*----------VALIDACION DE DATOS----------*/

    /*----------CONEXION BASE DATOS-----------*/
    //Conexion a la base de datos
    $canal = mysqli_connect("127.0.0.1", "tiendaOnline", "tiendaOnline", "tiendaonline");
    
    //Comprobacion si existe la base de datos
    if(!$canal){
        echo "Ha ocurrido el error" .mysqli_connect_errno() ." " .mysqli_connect_error();
    }
    
    //seleccion de la codifiacion de la base de datos
    mysqli_set_charset($canal, "utf8");
    
    /*----------Busqueda de los productos----------*/
    $sqlProductos = "SELECT id_producto, nombre, precio, stock
                     FROM productos
                     ORDER BY id_producto;";
    
    //Prepara la consulta a la base de datos
    $consulta = mysqli_prepare($canal, $sqlProductos);
    
    //Comprueba si la consulta existe
    if(!$consulta){
        echo "Ha ocurrido el error " .mysqli_errno($canal) ." " .mysqli_error($canal);
    }
    
    //Ejecuta la consulta
    mysqli_execute($consulta);

    //Agrego los resultado a variables
    mysqli_stmt_bind_result($consulta, $idProducto, $nombreProducto, $precioProducto, $stockProducto);
            
    /*----------OTROS DATOS----------*/           
    
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
            <?php 
                while (mysqli_stmt_fetch($consulta)){
                    //Comprueba si existe la variable "cantidad$idProducto" de tienda.php y si dicha variable es esta entre el stock maximo y 1
                    if(isset($_POST["cantidad$idProducto"]) && $_POST["cantidad$idProducto"] > 0 && $_POST["cantidad$idProducto"] < $stockProducto){
                        echo $nombreProducto .'('.$_POST["cantidad$idProducto"].')';
                    }
                }
            ?>
        </main>
    </body>
</html>
