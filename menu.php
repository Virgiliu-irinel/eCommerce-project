<div class="header clearfix">
  <!-- BEGIN: menu horizontal -->
  <nav class="navbar-toggler-right"> 
    <ul class="nav nav-pills float-right">
      <li class="nav-item">
        <a class="nav-link <?php echoSelectedClassIfRequestMatches('index.php') ?>" href="index.php">Anunturi <span class="sr-only">(current)</span></a>
      </li>
      <?php if(isset($_SESSION["username"])) {?>
      <!-- Meniu logat -->
      <li class="nav-item">
        <a class="nav-link <?php echoSelectedClassIfRequestMatches('publicareAnunt.php') ?>" href="publicareAnunt.php">Publica <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php echoSelectedClassIfRequestMatches('profil.php') ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Salut, <?php echo $_SESSION["username"]->nume ?></a>
        <div class="dropdown-menu">
          <a id="miPerfil" class="dropdown-item" href="profil.php">My profil</a>
          <a id="cerrarSesion" class="dropdown-item" href="controller.php?actiune=logout">Logout</a>
        </div>
      </li>
      <?php } else { ?>
      <!-- Meniu nelogat -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Conectare</a>
        <div class="dropdown-menu">
          <a id="login" class="dropdown-item" href="#">Login</a>
          <a id="register" class="dropdown-item" href="#">Inscrie-te</a>
        </div>
      </li>
      <?php } ?>
    </ul>
  </nav> <!-- END: menu horizontal -->
  <h3 class="text-muted">Web Anunturi v1.0</h3>
</div>