<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModal">Welcome Back!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/_handleLogin.php" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" id="loginusername" name="loginusername" placeholder="Enter your username" type="text" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" id="loginpassword" name="loginpassword" placeholder="Enter your password" type="password" required data-toggle="password">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </form>
        <div class="text-center mt-3">
          <p class="mb-0">Don't have an account? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#signupModal">Sign up now</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

