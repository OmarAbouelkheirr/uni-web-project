  <!-- Sign up Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="signupModal">Create Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="partials/_handleSignup.php" method="post">
              <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" id="username" name="username" placeholder="Choose a unique username" type="text" required minlength="3" maxlength="11">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="firstName">First Name</label>
                  <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="lastName">Last Name</label>
                  <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" required>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">+20</span>
                  </div>
                  <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required pattern="[0-9]{10}" maxlength="10">
                </div>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" id="password" name="password" placeholder="Create a password" type="password" required data-toggle="password" minlength="4" maxlength="21">
              </div>
              <div class="form-group">
                <label for="password1">Confirm Password</label>
                <input class="form-control" id="cpassword" name="cpassword" placeholder="Confirm your password" type="password" required data-toggle="password" minlength="4" maxlength="21">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Create Account</button>
            </form>
            <div class="text-center mt-3">
              <p class="mb-0">Already have an account? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Sign in</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
