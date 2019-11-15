<?php
/*----------Validacion de datos----------*/
/*Validacion del nombre de usuario*/
$nombreUsuario = "";
if(isset($_POST["nombreUsuario"])){
    $nombreUsuario = filter_input(INPUT_POST, "nombreUsuario");
}

/*Validacion de la contraseña de usuario*/
$contraseña = "";
if(isset($_POST["passwordUsuario"])){
    $contraseña = filter_input(INPUT_POST, "passwordUsuario");
}

if(empty($nombreUsuario) || empty($contraseña)){
    $http = "Location: userLogged.php?";
    $http .="mensaje=".urldecode("Nombre de usuario o contraseña no introducidos");
    
    header($http);
    exit;
}


/*----------Conexion y consulta a base de datos----------*/
//Conexion a la base de datos
$canal = mysqli_connect("127.0.0.1", "tiendaOnline", "tiendaOnline", "tiendaonline");

//Comprobacion si existe la base de datos
if(!$canal){
    echo "Ha ocurrido el error" .mysqli_connect_errno() ." " .mysqli_connect_error() ."<br>";
}

//seleccion de la codifiacion de la base de datos
mysqli_set_charset($canal, "utf8");

/*----------Busqueda Usuario----------*/
$sqlUsuario = "SELECT nombre_usuario, contraseña
               FROM usuarios
               WHERE nombre_usuario = ? AND contraseña = ?" ;

//Prepara la consulta a la base de datos
$consulta = mysqli_prepare($canal, $sqlUsuario);

//Comprueba si la consulta existe
if(!$consulta){
    echo "Ha ocurrido el error " .mysqli_errno($canal) ." " .mysqli_error($canal);
}

//Agrego las variables a la sentencia
mysqli_stmt_bind_param($consulta, "ss", $nombreUsuario, $contraseña);
$nombreUsuario = filter_input(INPUT_POST, "nombreUsuario");
$contraseña = filter_input(INPUT_POST, "passwordUsuario");

//Ejecuta la consulta
mysqli_execute($consulta);

//Agrego los resultado a variables
mysqli_stmt_bind_result($consulta, $nombreUsuario, $contraseña);

//Transfiere un conjunto de resultados desde una sentencia preparada
mysqli_stmt_store_result($consulta);

//Cuenta las lineas que coincidan con la sentencia ejecutada
$resultados = mysqli_stmt_num_rows($consulta);

if($resultados == 0){
    $http = "Location: userLogged.php?";
    $http .="mensaje=".urldecode("No existe usuario con ese nombre");
    
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
            <img src="imagenes/principal1.jpg" width="300" height="200" alt="principal1"/>
            <p>Descripcion 1</p>
            <img src="imagenes/principal2.jpg" width="300" height="200" alt="principal2"/>
            <p>Descripcion 2</p>   
            
            
            <p>Si desea conoces nuestros productos no dude en entrar a nuestra tienda haciendo click en el siguiente boton</p>
            <form action="tienda.php">
                <input type="submit" value="Entrar tienda">
                <input type="hidden" name="nombreUsuario" value=<?=$nombreUsuario?>>
            <form>
        </main>
        <footer>
            
        </footer>
    </body>
</html>

<!--SOBRA-->
<!--<html>
    <head>
        <meta charset="utf-8" />
        <title>Comprobracion Usuario</title>
    </head>
    <body>
        <table>
            <tr>
                <th>Nombre Usuario</th>
                <th>Contraseña</th>
            </tr>
            <?php
                while(mysqli_stmt_fetch($consulta)){
                    echo "<tr>"
                    . "<td> $nombreUsuario </td>"
                    . "<td> $contraseña </td>";
                }
            ?>
        </table>
    </body>
</html>-->
