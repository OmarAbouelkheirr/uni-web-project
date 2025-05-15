<?php 
$pageTitle = 'Pizza Menu';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';

$id = $_GET['catid'];
$sql = "SELECT * FROM `categories` WHERE categorieId = $id";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $catname = $row['categorieName'];
    $catdesc = $row['categorieDesc'];
}
?>

<div style="height: 2.5rem;"></div>
<section class="container">
  <div class="section-header">
    <h2 class="section-title"><?php echo $catname; ?></h2>
    <p class="section-subtitle"><?php echo $catdesc; ?></p>
  </div>
  <div class="category-grid">
    <?php
      $sql = "SELECT * FROM `pizza` WHERE pizzaCategorieId = $id";
      $result = mysqli_query($conn, $sql);
      $noResult = true;
      $animationOrder = 0;
      while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $pizzaId = $row['pizzaId'];
        $pizzaName = $row['pizzaName'];
        $pizzaPrice = $row['pizzaPrice'];
        $pizzaDesc = $row['pizzaDesc'];
        $animationOrder++;
        echo '<div class="category-card" style="--animation-order: ' . $animationOrder . '">
                <div class="category-img-wrapper">
                  <img src="img/pizza.png" class="category-img" alt="' . $pizzaName . '">
                </div>
                <div class="category-content">
                  <h3 class="category-name"><i class="fas fa-pizza-slice"></i> ' . $pizzaName . '</h3>
                  <p class="category-description">' . $pizzaDesc . '</p>
                  <h4 style="color: var(--secondary-color); margin-bottom: var(--spacing-sm);">EGP. '.$pizzaPrice.' /-</h4>
                  <div style="display: flex; gap: var(--spacing-sm); flex-wrap: wrap;">
                    ';
        if(isset($loggedin) && $loggedin){
          $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE pizzaId = '$pizzaId' AND `userId`='$userId'";
          $quaresult = mysqli_query($conn, $quaSql);
          $quaExistRows = mysqli_num_rows($quaresult);
          if($quaExistRows == 0) {
            echo '<form action="partials/_manageCart.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="itemId" value="'.$pizzaId. '">
                    <button type="submit" name="addToCart" class="view-all-btn" style="background: var(--primary-color); color: #fff;">Add to Cart <i class="fas fa-cart-plus"></i></button>
                  </form>';
          }else {
            echo '<a href="viewCart.php" class="view-all-btn" style="background: var(--primary-dark); color: #fff;">Go to Cart <i class="fas fa-shopping-cart"></i></a>';
          }
        }
        else{
          echo '<button class="view-all-btn" style="background: var(--primary-color); color: #fff;" data-toggle="modal" data-target="#loginModal">Add to Cart <i class="fas fa-cart-plus"></i></button>';
        }
        echo '<a href="viewPizza.php?pizzaid=' . $pizzaId . '" class="view-all-btn" style="background: var(--secondary-color); color: #fff;">Quick View <i class="fas fa-eye"></i></a>
                  </div>
                </div>
              </div>';
      }
      if($noResult) {
        echo '<div class="category-card"><div class="category-content"><h3 class="category-name"><i class="fas fa-info-circle"></i> No Pizzas Available</h3><p class="category-description">We will update this category soon.</p></div></div>';
      }
    ?>
  </div>
</section>

<?php require 'partials/_footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script> 
        document.getElementById("title").innerHTML = "<?php echo $catname; ?>"; 
        document.getElementById("catTitle").innerHTML = "<?php echo $catname; ?>"; 
    </script> 
</body>
</html>