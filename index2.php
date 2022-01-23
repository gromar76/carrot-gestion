<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />  
    <title>Carrot</title>

    <LINK REL=StyleSheet HREF="/css/estilos1.css" TYPE="text/css">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
      integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn"
      crossorigin="anonymous"
    />
  </head>
  <body>

    <?php
    // cargo las variables que vienen del logueo
    //isset($_POST["email"]) 
    $email=trim($_POST["email"]);
    $passw=trim($_POST["password"]);
    ?>

  <?php
  //if ($email=="nicogrons@gmail.com" && $passw=="pepe")    
  if ($email=="nicogrons@gmail.com")  
  {
    // cargo el menu el usuario es correcto
    include('inc/barra_de_navegacion.inc.php')
  ?>    
   <button class="btn btn-primary" id="btn-cargar-contenido">Cargar Clientes</button>
    
    <div id="contenido"></div>

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
      integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
      integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2"
      crossorigin="anonymous"
    ></script>

    <script src="/clientes/clientes.js"></script>

<?php 
}
else
{
 echo "NO ES UN USUARIO CORRECTO";
}
?>
  </body>
</html>
