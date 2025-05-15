<?php
$pageTitle = 'Categories';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>

<section class="container">
  <div class="section-header">
    <h2 class="section-title">All Categories</h2>
  </div>
  <div class="category-grid">
    <?php
    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $sql);
    $animationOrder = 0;
    
    while($row = mysqli_fetch_assoc($result)){
      $id = $row['categorieId'];
      $cat = $row['categorieName'];
      $desc = $row['categorieDesc'];
      $animationOrder++;
      $imgSrc = ($cat === 'BURGER PIZZA') ? 'img/card-7.jpg';
      echo '<div class="category-card" style="--animation-order: ' . $animationOrder . '">
              <div class="category-img-wrapper">
                <img src="img/000.png' . $imgSrc . '" class="category-img" alt="000" . $cat . '" />
                
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

<?php require 'partials/_footer.php'; ?> 