<?php 
$pageTitle = 'About Us';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>

<section class="container" style="padding-top: var(--spacing-2xl);">
  <div class="section-header">
    <h2 class="section-title">Our Story</h2>
  </div>
  <div style="display: flex; flex-wrap: wrap; gap: var(--spacing-2xl); align-items: center;">
    <div style="flex: 1 1 350px; min-width: 300px;">
      <p class="section-subtitle">Founded with a passion for authentic flavors, Pizza World brings you the best of Italian tradition and local favorites. Our mission is to deliver happiness, one slice at a time, using only the freshest ingredients and time-honored recipes.</p>
      <p class="section-subtitle">From our humble beginnings to becoming a neighborhood favorite, we believe in quality, community, and a love for great food.</p>
    </div>
    <div style="flex: 1 1 350px; min-width: 300px; text-align: center;">
      <img src="img/pizza.png" alt="About Pizza World" style="width: 50%; border-radius: var(--border-radius); box-shadow: var(--shadow-lg);">
    </div>
  </div>
</section>

<section class="container">
  <div class="section-header">
    <h2 class="section-title">Our Values</h2>
  </div>
  <div class="category-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));">
    <div class="category-card">
      <div class="category-content">
        <h3 class="category-name"><i class="fas fa-seedling"></i> Fresh Ingredients</h3>
        <p class="category-description">We use only the freshest, highest-quality ingredients in every pizza we make.</p>
      </div>
    </div>
    <div class="category-card">
      <div class="category-content">
        <h3 class="category-name"><i class="fas fa-users"></i> Community</h3>
        <p class="category-description">We support our local community and believe in giving back through food and service.</p>
      </div>
    </div>
    <div class="category-card">
      <div class="category-content">
        <h3 class="category-name"><i class="fas fa-heart"></i> Passion</h3>
        <p class="category-description">Our team is passionate about pizza and dedicated to making every meal memorable.</p>
      </div>
    </div>
  </div>
</section>

<section class="container" style="text-align: center; padding-bottom: var(--spacing-2xl);">
  <img src="img/pizza.jpeg" alt="Decorative Pizza Visual" style="max-width: 400px; width: 100%; opacity: 0.15; margin: 0 auto;">
</section>

<?php require 'partials/_footer.php'; ?>
