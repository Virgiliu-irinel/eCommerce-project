<!-- Register Container BEGIN -->
      <div class="row mb-4" id="registerPanel" style="display:none;">
        <div class="col-md-12 col-lg-9 mx-auto">
          <!-- Register Card BEGIN -->
          <div class="card card-body">
              <!-- BEGIN: Botón de cierre -->
              <button type="button" class="close" aria-label="Close">
                <span id="closeRegisterPanel" aria-hidden="true" class="closeButton pull-right">&times;</span>
              </button> <!-- END: menu horizontal -->

              <h3 class="text-center mb-4">Cont nou</h3>
              <p>Doar utilizatorii inregistrati pot publica anunturi</p>
              <!-- BEGIN: formulario de registro -->
              <form action="controller.php" method="post">
                <fieldset>
                  <div class="form-group">
                      <input class="form-control input-lg" placeholder="Username" name="username" type="text" required>
                  </div>
                  <div class="form-group">
                      <input class="form-control input-lg" placeholder="Numele" name="nume" type="text" required>
                  </div>
                  <div class="form-group">
                      <input class="form-control input-lg" placeholder="Telefon" name="telefon" type="text" required>
                  </div>
                  <div class="form-group">
                      <input class="form-control input-lg" placeholder="E-mail" name="email" type="email" required>
                  </div>
                  <div class="form-group">
                      <input class="form-control input-lg" placeholder="Parola" name="password" value="" type="password" required>
                  </div>
                  <div class="form-group">
                      <input class="form-control input-lg" placeholder="Confirma parola" name="password2" value="" type="password" required>
                  </div>
                  <div class="checkbox">
                      <label class="small">
                          <input name="terms" type="checkbox"  required >&nbsp;Termenii <a href="#">si conditiile de utilizare</a>
                      </label>
                  </div>
                  <input type="hidden" name="actiune" value="register">
                  <input class="btn btn-lg btn-primary btn-block" value="Trimite" type="submit">
                </fieldset>
              </form> <!-- END: menu horizontal -->
          </div> <!-- Register Card END -->
        </div>
      </div><!-- Register Container END -->