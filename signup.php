<?php 
$pageTitle = 'Sign Up';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>

<section class="container" style="min-height: 70vh; display: flex; align-items: center; justify-content: center;">
  <div style="max-width: 400px; width: 100%; margin: 0 auto; background: var(--white); border-radius: var(--border-radius); box-shadow: var(--shadow-lg); padding: var(--spacing-2xl);">
    <h2 class="section-title" style="font-size: 2rem; text-align: center; margin-bottom: var(--spacing-lg);">Sign Up</h2>
    <form action="partials/_handleSignup.php" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
      </div>
      <button type="submit" class="view-all-btn" style="width: 100%;">Sign Up <i class="fas fa-user-plus"></i></button>
    </form>
    <p style="text-align: center; margin-top: var(--spacing-md);">Already have an account? <a href="login.php">Sign in</a></p>
  </div>
</section>

<?php require 'partials/_footer.php'; ?> 