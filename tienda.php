<!DOCTYPE html>
<!--
Se visualizará una tabla con todos los productos disponibles en la tienda 
junto con un/unos botones de comprar
-->
<?php
    /*----------VALIDACION DE DATOS----------*/
    /*Validacion del nombre de usuario conectado*/
    $nombreUsuario = "";
    if(filter_input(INPUT_GET, "nombreUsuario")){
        $nombreUsuario = strip_tags(filter_input(INPUT_GET, "nombreUsuario"));
    }
    
    /*----------Conexion y consulta a base de datos----------*/
    //Conexion a la base de datos
    $canal = mysqli_connect("127.0.0.1", "tiendaOnline", "tiendaOnline", "tiendaonline");
    
    //Comprobacion si existe la base de datos
    if(!$canal){
        echo "Ha ocurrido el error" .mysqli_connect_errno() ." " .mysqli_connect_error();
    }
    
    //seleccion de la codifiacion de la base de datos
    mysqli_set_charset($canal, "utf8");
    
    /*----------Busqueda de los productos----------*/
    $sqlProductos = "SELECT nombre, precio, descripcion, imagen
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
    mysqli_stmt_bind_result($consulta, $nombreProducto, $precioProducto, $descripcionProducto, $imagenProducto);
    
    //Transfiere un conjunto de resultados desde una sentencia preparada
    mysqli_stmt_store_result($consulta);

//Cuenta las lineas que coincidan con la sentencia ejecutada
$resultados = mysqli_stmt_num_rows($consulta);

if($resultados == 0){
    $http = "Location: userLogged.php?";
    $http .="mensaje=".urldecode("No existen productos");
    
    header($http);
    exit;
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
                <label>Usuario conectado: <?=$nombreUsuario?></label>
            </div>
        </header>
        <nav>
          
        </nav>
        <main>
            <table>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Unidades a comprar</th>
                </tr>
                <?php
                while (mysqli_stmt_fetch($consulta)){
                    echo "<tr>"
                    . "<td> <img src = './imagenes/$imagenProducto'/> </td>"
                    . "<td> $nombreProducto </td>"
                    . "<td> $descripcionProducto </td>"
                    . "<td> $precioProducto </td>"
                    . "<td> <form> <input type='number'/></form></td>";
                }
                ?>
            </table>
        </main>
        <footer>
            
        </footer>
    </body>
</html>
