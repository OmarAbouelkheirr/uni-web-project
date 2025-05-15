<?php 
$pageTitle = 'Home';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>

<!-- Hero Section -->
<section class="hero-section container" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: var(--spacing-2xl); padding-top: var(--spacing-2xl);">
  <div style="flex: 1 1 350px; min-width: 300px;">
    <h1 class="section-title" style="font-size: 2.5rem;">Delicious Pizza Delivered Fast</h1>
    <p class="section-subtitle">Order your favorite pizzas, sides, and drinks with just a few clicks. Fresh, hot, and delivered to your door!</p>
    <a href="category.php" class="view-all-btn" style="max-width: 220px;">Order Now <i class="fas fa-arrow-right"></i></a>
  </div>
  <div style="flex: 1 1 350px; min-width: 300px; text-align: center;">
    <img src="img/000.png" alt="Pizza" style="max-width: 100%; height: auto; border-radius: var(--border-radius); box-shadow: var(--shadow-lg);">
  </div>
</section>

<!-- Featured Categories -->
<section class="container">
  <div class="section-header">
    <h2 class="section-title">Featured Categories</h2>
  </div>
  <div class="category-grid">
    <?php 
      $sql = "SELECT * FROM `categories` LIMIT 3"; 
      $result = mysqli_query($conn, $sql);
      $animationOrder = 0;
      while($row = mysqli_fetch_assoc($result)){
        $id = $row['categorieId'];
        $cat = $row['categorieName'];
        $desc = $row['categorieDesc'];
        $animationOrder++;
        $imgSrc = ($cat === 'BURGER PIZZA') ? 'img/PizzaBurger.jpeg' ;
        echo '<div class="category-card" style="--animation-order: ' . $animationOrder . '">
                <div class="category-img-wrapper">
                  <img src="img/.jpeg' . $imgSrc . '" class="category-img" alt="' . $cat . '">
                  echo '<img src="img/' . $imgSrc . 'PizzaBurger" class="category-img" alt="' . $cat . '">';

                </div>
                <div class="category-content">
                  <h3 class="category-name"><i class="fas fa-pizza-slice"></i>' . $cat . '</h3>
                  <p class="category-description">' . $desc . '</p>
                  <a href="viewPizzaList.php?catid=' . $id . '" class="view-all-btn">
                    View All <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>';
      }
    ?>
  </div>
</section>

<!-- Testimonials -->
<section class="container">
  <div class="section-header">
    <h2 class="section-title">What Our Customers Say</h2>
  </div>
  <div class="category-grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));">
    <div class="category-card">
      <div class="category-content">
        <p class="category-description">"Best pizza in town! Fast delivery and always hot. Highly recommend!"</p>
        <h4 class="category-name"><i class="fas fa-user-circle"></i> Sarah K.</h4>
      </div>
    </div>
    <div class="category-card">
      <div class="category-content">
        <p class="category-description">"Love the variety and the crust options. My family's go-to pizza place!"</p>
        <h4 class="category-name"><i class="fas fa-user-circle"></i> Mike D.</h4>
      </div>
    </div>
    <div class="category-card">
      <div class="category-content">
        <p class="category-description">"Easy to order, great deals, and the pizza is always delicious."</p>
        <h4 class="category-name"><i class="fas fa-user-circle"></i> Priya S.</h4>
      </div>
    </div>
  </div>
</section>

<!-- Final CTA -->
<section class="container" style="text-align: center; padding-bottom: var(--spacing-2xl);">
  <a href="category.php" class="view-all-btn" style="font-size: 1.25rem; padding: 1.25rem 2.5rem;">Start Your Order <i class="fas fa-arrow-right"></i></a>
</section>

<?php require 'partials/_footer.php'; ?> 