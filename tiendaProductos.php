<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    $mensaje = "";
        
    if(filter_input(INPUT_GET, "mensaje")){
        $mensaje = strip_tags(filter_input(INPUT_GET, "mensaje"));
    }
    
    $usuarioConectado = "";
    if(filter_input(INPUT_GET, "usuarioConectado")){
        $usuarioConectado = strip_tags(filter_input(INPUT_GET, "usuarioConectado"));
    }
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>DroneMaster</title>
    </head>
    <body>
        <header>
            <a href="index.php"><img src="imagenes/logoDroneMaster.png"></img></a>
            <p><?=$mensaje?></p>
            <div>
                <label><?=$usuarioConectado?></label>
            </div>
        </header>
        <nav>
          
        </nav>
        <main>
            <img src="imagenes/principal1.jpg" width="300" height="200" alt="principal1"/>
            <p>Descripcion 1</p>
            <img src="imagenes/principal2.jpg" width="300" height="200" alt="principal2"/>
            <p>Descripcion 2</p>         
        </main>
        <footer>
            
        </footer>
    </body>
</html>
