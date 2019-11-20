<?php
    /*----------VALIDACION DE DATOS----------*/
    $nombreUsuario = "";
    if(filter_input(INPUT_GET, "nombreUsuario")){
        $nombreUsuario = strip_tags(filter_input(INPUT_GET, "nombreUsuario"));
    }

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
    const iva = 10;
    
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DroneMaster</title>
        <style>
            .txtTblCentro{
                text-align: center;
            }
        </style>
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
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total Producto</th>
                </tr>
            <?php 
                $total = 0;
                while (mysqli_stmt_fetch($consulta)){
                    $cantidad = $_POST["cantidad$idProducto"];
                    //Comprueba si existe la variable "cantidad$idProducto" de tienda.php y si dicha variable es esta entre el stock maximo y 1
                    if(isset($cantidad) && $cantidad > 0 && $cantidad < $stockProducto){
                        echo "<tr>"
                            ."<td>$nombreProducto"
                            ."<td class='txtTblCentro'>$cantidad"
                            ."<td class='txtTblCentro'>$precioProducto €"
                            ."<td class='txtTblCentro'>".$cantidad * $precioProducto ." €";
                             
                        $total += $cantidad * $precioProducto;
                        
                        /*----------Insercion de los productos comprados----------*/
                        //Sentencia SQL
                        /*$sqlInsertar = "INSERT INTO compra(nombre_usuario, id_producto, fecha, precio_unidad, unidades_compradas)
                                        VALUES(?, ?, curdate(), ?, ?)"; */
                    }
                }
            ?>
            </table>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td class='txtTblCentro'> <?=$total?> €</td>
                </tr>
                <tr>
                    <td>IVA(<?=iva?>%)</td>
                    <td class='txtTblCentro'><?=$total*(iva/100)?> €</td>
                </tr>
                <tr>
                     <td>Total</td>
                     <td class='txtTblCentro'><?=$total+($total*(iva/100))?> €</td>
                </tr>
            </table>            
        </main>
    </body>
</html>
