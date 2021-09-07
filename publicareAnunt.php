<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
include 'functions.php';
$_SESSION["currentPage"] = 'publicareAnunt.php';
?>

<?php include 'header.php';?>	

<div class="row mb-4">
        <div class="col-md-12 col-lg-9 mx-auto">
          <div class="card card-body">
            <h3 class="text-center mb-4">Publicare anunt</h3>
            <p>Completati urmatoarele informatii si publicati anuntul imediat!</p>
            <form action="controller.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group has-error">
                        <input class="form-control input-lg" placeholder="Titlu" name="titlu" type="text">
                    </div>
                    <div class="form-group has-error">
                        <textarea class="form-control input-lg" placeholder="Descriere (max. 140 caractere)" name="descriere"></textarea>
                    </div>
                    <div class="form-group has-error">
                        <input class="form-control input-lg" placeholder="Imagine" type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                    <div class="form-group has-error">
                        <input class="form-control input-lg" placeholder="Pret" name="pret" type="text">
                    </div>
                    <div class="form-group has-error">
                        <input class="form-control input-lg" placeholder="Data expirare" name="dataexpirare" type="text">
                    </div>
                    <input type="hidden" name="actiune" value="publicare">
                    <div class="checkbox">
                        <label class="small">
                            <input name="terms" type="checkbox">&nbsp;Termenii <a href="#">si conditiile de utilizare</a>
                        </label>
                    </div>
                    <input class="btn btn-lg btn-primary btn-block" value="Publica" type="submit">
                </fieldset>
            </form>
          </div>
        </div>
      </div>

<?php include 'footer.php';?>