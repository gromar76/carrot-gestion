<?php
// debo verificar que el usuario este logueado
// eso como lo hago una variable global? session????? pablo sabra decirme...

  include "config/constantes.php";
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />  
    
    <title>Carrot</title>
    
    <link 
          rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" 
          integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
          crossorigin="anonymous" 
          referrerpolicy="no-referrer" />

    <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn"
          crossorigin="anonymous"
    />
    
    <link rel="stylesheet"
          href="public/vendor/multi-column-dropdown-inputpicker/jquery.inputpicker.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
    
    <link rel=StyleSheet href="public/css/estilos1.css" type="text/css">
 

<body>
    <?php
        
        if (  $data["mostrar_header"] ){
          include('vistas/common/barra_de_navegacion.inc.php');
        }
       
        if ( isset( $data["titulo"] )){
        ?>          
          <h2 id="titulo-modulo" class="mb-3"><?=$data["titulo"]?></h2>        
        <?php 
        }


      ?>

        <div class="container-fluid">
          <?php
            // si existe un mensaje entonces lo muestro y tambien el tipo de mensaje
            if ( isset( $data["mensaje"]  ) ){      
            ?>

            <div id="mensaje" class="alert alert-<?=$data["tipoMensaje"]?> alert-dismissible fade show" role="alert">
              <?= $data["mensaje"] ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
              }
              /* CONTENIDO */          
              include($data["contenido"]);

              if (  $data["mostrar_footer"] ){
                include('vistas/common/footer.inc.php');
              }
          ?>
        </div>

    <script>
      const URL_BASE="<?=$URL_BASE?>";
    </script>


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

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="public/vendor/multi-column-dropdown-inputpicker/jquery.inputpicker.js"></script>

    <script>
      
      setTimeout( cerrarMensaje , 2000);
      
      function cerrarMensaje (){      
        $('#mensaje').alert('close')
      }

      const userId = <?= $data['usuario']['id'] ?>;
      
    </script>

    <?php       
       // si hay un js asociado lo activo para utilizar
       if ( isset($data['js'] ) ){
    ?>    
        <script src="public/js/<?=$data['js'][0]?>"></script>
    <?php } 
    

    ?>

</body>
</html>
