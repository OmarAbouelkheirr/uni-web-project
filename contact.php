<?php 
$pageTitle = 'Contact Us';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>

<section class="container" style="padding-top: var(--spacing-2xl);">
  <div class="section-header">
    <h2 class="section-title">Contact Us</h2>
  </div>
  <div style="display: flex; flex-wrap: wrap; gap: var(--spacing-2xl); align-items: flex-start;">
    <div style="flex: 1 1 350px; min-width: 300px;">
      <form action="partials/_manageContactUs.php" method="POST" style="background: var(--white); border-radius: var(--border-radius); box-shadow: var(--shadow); padding: var(--spacing-lg);">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" required value="<?php if(isset($_SESSION['userId'])) { echo htmlspecialchars($_SESSION['email'] ?? ''); } ?>">
        </div>
        <div class="form-group">
          <label for="phone">Phone No</label>
          <input type="tel" class="form-control" id="phone" name="phone" required pattern="[0-9]{10}" maxlength="10" value="<?php if(isset($_SESSION['userId'])) { echo htmlspecialchars($_SESSION['phone'] ?? ''); } ?>">
        </div>
        <div class="form-group">
          <label for="orderId">Order Id</label>
          <input type="text" class="form-control" id="orderId" name="orderId" value="0">
          <small class="form-text text-muted">If your problem is not related to an order, leave as 0.</small>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="view-all-btn" style="width: 100%;">Send Message <i class="fas fa-paper-plane"></i></button>
      </form>
    </div>
    <div style="flex: 1 1 350px; min-width: 300px;">
      <div style="background: var(--white); border-radius: var(--border-radius); box-shadow: var(--shadow); padding: var(--spacing-lg); margin-bottom: var(--spacing-lg);">
        <h4 class="category-name"><i class="fas fa-map-marker-alt"></i> Address</h4>
        <p class="category-description">123 Pizza Street, Food City</p>
        <h4 class="category-name"><i class="fas fa-phone"></i> Phone</h4>
        <p class="category-description">+1 234 567 8900</p>
        <h4 class="category-name"><i class="fas fa-envelope"></i> Email</h4>
        <p class="category-description">info@pizzadelivery.com</p>
      </div>
      <div style="border-radius: var(--border-radius); overflow: hidden; box-shadow: var(--shadow);">
        <iframe src="https://www.google.com/maps?q=New+York,+NY,+USA&output=embed" width="100%" height="220" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>
    </div>
  </div>
</section>

<?php require 'partials/_footer.php'; ?>