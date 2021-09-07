<!-- Grid de anunturi (cards) BEGIN-->
      <div class="card-columns" id="cardGrid">
        <?php
        require_once('functions.php');
        require_once('helpers.php');
        $anunturi = getAnunturi();
        if(isset($_SESSION["username"])){
            $favorit = getIDAnuntFavorit($_SESSION["username"]->id);
        }
        foreach ($anunturi as $key => $value):?>
        <!-- Card Anunt BEGIN-->
        <div class="card">
          <img class="card-img-top" src="<?php echo getImageUrl($value["img"]) ?>">
          <!-- Card Body BEGIN-->
          <div class="card-body">
            <h4 class="card-title"><?php echo $value["titlu"] ?></h4>
            <div class="d-flex justify-content-end">
              <div class="mr-auto mb-2"><span><b><?php echo $value["pret"] ?>€</b></span></div>
              <div class="mb-2 text-muted date"><small><?php echo getFormattedDate($value["timestamp"]) ?></small></div>
            </div>         
            <p class="card-text"><?php echo $value["descriere"] ?></p>
            <div>
              <a class="btn btn-primary btn-block"  data-toggle="collapse" href="<?php echo '#collapse'.$key ?>" aria-expanded="false" aria-controls="<?php echo '#collapse'.$key ?>">Contact vanzator</a>
              <?php
              if(isset($_SESSION["username"])) {
               
                if(isset($favorit) && addFavoritIcon($value["id"], $favorit))
                { 
                ?>
                
                    <a href="#" data-id="<?php echo $value["id"] ?>" data-favorit="1" class="btn btn-outline-primary btn-block is-favorit"><span class='oi oi-check'></span>&nbsp;Anunt favorit</a>
                <?php
                } else {
                ?>
                
                    <a href="#" data-id="<?php echo $value["id"] ?>" data-favorit="0" class="btn btn-outline-primary btn-block is-favorit">Adauga la favorite</a>
              <?php
                }
              }
              
              ?> 
              <div class="collapse ml-2 mt-4" id="<?php echo 'collapse'.$key ?>">
                <p>
                  <span class="oi oi-phone"></span>
                  <a href="tel:+0740000000"><?php echo $value["telefon"] ?></a>
                </p>
                <p>
                  <span class="oi oi-envelope-closed"></span>
                  <a href="mailto:test@gmail.com"><?php echo $value["email"] ?></a>
                </p>
              </div>
              
            </div>
          </div> <!-- Card Body END -->
          <div class="card-footer">
            <small class="text-muted"><span class="oi oi-person"></span>&nbsp;&nbsp;<?php echo $value["nume"] ?></small>
          </div>
        </div> <!-- Card Anunt END-->
        <?php endforeach; ?>
      </div> <!-- Grid de Anunt (cards) END-->