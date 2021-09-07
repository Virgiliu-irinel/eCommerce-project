<!-- Login Container BEGIN -->
      <div class="row mb-4" id="loginPanel" style="display:none;">
        <div class="col-md-12 col-lg-9 mx-auto">
          <!-- Login Card BEGIN -->
          <div class="card card-body">
            <button type="button" class="close" aria-label="Close">
              <span id="closeLoginPanel" aria-hidden="true" class="closeButton pull-right">&times;</span>
            </button>
            <form action="controller.php" method="post" class="form-signin">
              <h5 class="form-signin-heading">Login</h5>
              <div class="form-group">
              <label for="inputEmail" class="sr-only">Email</label>
              <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus="">
              </div>
              <div class="form-group">
              <label for="inputPassword" class="sr-only">Parola</label>
              <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me"> &nbsp;Pastreaza-ma logat
                </label>
              </div>
              <input type="hidden" name="actiune" value="login">
              <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
          </div><!-- Login Card END -->
        </div>  
      </div>  <!-- Login Container END -->