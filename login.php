<?php 
$pageTitle = 'Login';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>

<section class="container" style="min-height: 70vh; display: flex; align-items: center; justify-content: center;">
  <div style="max-width: 400px; width: 100%; margin: 0 auto; background: var(--white); border-radius: var(--border-radius); box-shadow: var(--shadow-lg); padding: var(--spacing-2xl);">
    <h2 class="section-title" style="font-size: 2rem; text-align: center; margin-bottom: var(--spacing-lg);">Sign In</h2>
    <form action="partials/_handleLogin.php" method="POST">
      <div class="form-group">
        <label for="loginusername">Username</label>
        <input type="text" class="form-control" id="loginusername" name="loginusername" required>
      </div>
      <div class="form-group">
        <label for="loginpassword">Password</label>
        <input type="password" class="form-control" id="loginpassword" name="loginpassword" required>
      </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Remember me</label>
      </div>
      <button type="submit" class="view-all-btn" style="width: 100%;">Sign In <i class="fas fa-sign-in-alt"></i></button>
    </form>
    <p style="text-align: center; margin-top: var(--spacing-md);">Don't have an account? <a href="signup.php">Sign up</a></p>
  </div>
</section>

<?php 
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
                <strong>Warning!</strong> Invalid Credentials
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
              </div>';
    }
?>

<?php require 'partials/_footer.php'; ?> 