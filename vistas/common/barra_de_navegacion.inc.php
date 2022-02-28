<nav class="navbar navbar-expand-xl navbar-dark bg-dark m-0 p-0">
<img class="logo-chico2" src="<?=$URL_BASE?>/imagenes/logo-chico2.png">  
<a class="navbar-brand bg-dark" href="#"> Sistema de Gestion - CarrotSports </a>  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?=$URL_BASE?>/index.php">Inicio <span class="sr-only">(current)</span></a>
      </li>      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Archivos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?m=clientes">Clientes</a>
          <a class="dropdown-item" href="index.php?m=productos">Productos</a>          
          <a class="dropdown-item" href="index.php?m=categorias">Categorias de Productos</a>          
          <a class="dropdown-item" href="index.php?m=provincias">Provincias/Estados</a>
          <a class="dropdown-item" href="index.php?m=localidades">Localidades</a>
          <a class="dropdown-item" href="index.php?m=depositos">Depositos</a>
          <a class="dropdown-item" href="index.php?m=egresos">Egresos</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Procesos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?m=ventas">Modulo Ventas</a>
          <a class="dropdown-item" href="#">Movimiento entre Depositos de Productos</a>
          <a class="dropdown-item" href="#">Registrar Egreso/Gasto</a>
          <a class="dropdown-item" href="#">Registrar Corte Contable entre fechas</a>                    
          
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Listados Basicos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Clientes</a>
          <a class="dropdown-item" href="#">Productos</a>          
          <a class="dropdown-item" href="#">Localidades</a>
          <a class="dropdown-item" href="#">Categorias de Productos</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Listados Especiales
        </a>    
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Compras de clientes</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Clientes x provincia</a>
          <a class="dropdown-item" href="#">Clientes x localidad</a>          
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Compras por provincia</a>
          <a class="dropdown-item" href="#">Compras x localidad</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Fecha de ultima compra de clientes</a>
          <a class="dropdown-item" href="#">Clientes que mas compran</a> 
          <a class="dropdown-item" href="#">Productos mas vendidos</a>    
          <div class="dropdown-divider"></div>      
          <a class="dropdown-item" href="#">Armado cuadro por articulo vendido</a>   
      </li>       
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
        <?= $data['usuario']['nombre'] ?>
        </a>
        <div class="dropdown-menu" >
          <a class="dropdown-item" href="#">Mi perfil</a>
          <a class="dropdown-item" href="index.php?m=logout">Cerrar sesión</a>          
      </li>  
    </ul> 
 
  </div>
</nav>
