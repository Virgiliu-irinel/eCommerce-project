<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
include_once 'functions.php';
include_once 'helpers.php';
$_SESSION["currentPage"] = 'profil.php';
?>
<?php include_once 'header.php';?>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#datos" role="tab">Date personale</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#anunturi" role="tab">Anunturile mele</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#favoritos" role="tab">Anunturi favorite</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <!-- BEGIN: Panel de anunturi -->
  <div class="tab-pane" id="anunturi" role="tabpanel">
    <section>
      <div class="container py-3">
        <?php
        //Cargar la libreria de funciones
        require_once('functions.php');
        //Cargar los anunturi e iterar para crearlos.
        $anunturi = getAnunturiByUser($_SESSION["username"]->id);
        foreach ($anunturi as $key => $anunt) {
          $stergeAnunt = "controller.php?actiune=sters&id=".$anunt["id"];
          $setVandut = "controller.php?actiune=vandut&id=".$anunt["id"];
        ?>
        <!-- BEGIN: anunt card -->
        <div class="card mb-3">
          <div class="row card-body">
            <div class="col-md-4">
              <img src="<?php echo getImageUrl($anunt['img']) ?>" class="w-100">
            </div>
            <div class="col-md-8 px-3">
              <div class="card-block px-3">
                <h4 class="card-title"><?php echo $anunt["titlu"] ?></h4>
                <p class="card-text"><?php echo $anunt["descriere"] ?></p>
                <a href="<?php echo $stergeAnunt ?>" class="btn btn-danger">Sterge anunt</a>
                <?php if($anunt["vandut"]) { ?>
                  <a href="<?php echo $setVandut ?>" class="btn btn-outline-warning disabled"><span class="oi oi-check"></span>&nbsp;Vandut</a>
                <?php } else { ?>
                  <a href="<?php echo $setVandut ?>" class="btn btn-outline-warning">Vandut</a>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div> <!-- END: anunt card -->

        <?php
        } //Cierra el bucle recorriendo los anunturi
        ?>

      </div> 
    </section>
  </div> <!-- END: Panel de anunturi -->

  <!-- BEGIN: Panel datos personales -->
  <div class="tab-pane active" id="datos" role="tabpanel">
    <div id="actualisationOK" class="alert alert-success mt-4" role="alert" style="display:none;">
      <strong>Foarte bine!</strong> Datele dvs. au fost actualizate corect.
    </div>
    <form id="updateUser" class="card-body">
      <div class="form-group row">
        <label class="col-2 col-form-label">Username</label>
        <div class="col-10">
          <input class="form-control" type="text" name="username" value="<?php echo $_SESSION['username']->username ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-2 col-form-label">Nume</label>
        <div class="col-10">
          <input class="form-control" type="search" name="nume" value="<?php echo $_SESSION['username']->nume ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-2 col-form-label">Email</label>
        <div class="col-10">
          <input class="form-control" type="email" name="email" value="<?php echo $_SESSION['username']->email ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-2 col-form-label">Telefon</label>
        <div class="col-10">
          <input class="form-control" type="text" name="telefon" value="<?php echo $_SESSION['username']->telefon ?>">
        </div>
      </div>
      <input type="hidden" name="id" value="<?php echo $_SESSION['username']->id ?>">
      <input type="hidden" name="actiune" value="actualizareUser">
      <div class="text-center">
        <button id="updateUserSubmit" type="submit" class="btn btn-primary">Salveaza</button>
        <!--<button type="submit" class="btn btn-outline-primary disabled">Schimba parola</button>-->
      </div>
    </form>
  </div> <!-- END: Panel date personale -->

  <!-- BEGIN: Panel favorite -->
  <div class="tab-pane" id="favoritos" role="tabpanel">
    <section>
      <div class="container py-3">
        <?php
        require_once('functions.php');
        $anunturi = getAnunturiFavorite($_SESSION["username"]->id);
        foreach ($anunturi as $key => $anunt) {
        ?>

        <!-- BEGIN: anunt card -->
        <div class="card mb-3">
          <div class="row card-body">
            <div class="col-md-4">
              <img src="<?php echo getImageUrl($anunt['img']) ?>" class="w-100">
            </div>
            <div class="col-md-8 px-3">
              <div class="card-block px-3">
                <h4 class="card-title"><?php echo $anunt["titlu"] ?></h4>
                <p class="card-text"><?php echo $anunt["descriere"] ?></p>
              </div>
            </div>
          </div>
        </div> <!-- END: anunt card -->
        <?php
        } 
        ?>
      </div> 
    </section>
  </div>
</div>
<?php include 'footer.php';?>