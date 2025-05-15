<?php 
$pageTitle = 'Pizza Details';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';

$pizzaId = $_GET['pizzaid'];
$sql = "SELECT * FROM `pizza` WHERE pizzaId = $pizzaId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$pizzaName = $row['pizzaName'];
$pizzaPrice = $row['pizzaPrice'];
$pizzaDesc = $row['pizzaDesc'];
$pizzaCategorieId = $row['pizzaCategorieId'];
?>

<section class="container" style="min-height: 70vh; display: flex; align-items: center; justify-content: center;">
  <div class="category-card" style="max-width: 700px; width: 100%; margin: 0 auto; display: flex; flex-wrap: wrap; align-items: center; gap: var(--spacing-lg);">
    <div class="category-img-wrapper" style="flex: 1 1 280px; min-width: 220px; max-width: 320px;">
      <img src="img/pizza-25.jpg" class="category-img" alt="<?php echo $pizzaName; ?>" style="width: 100%; height: auto; border-radius: var(--border-radius); box-shadow: var(--shadow-lg);">
    </div>
    <div class="category-content" style="flex: 2 1 320px; min-width: 220px;">
      <h2 class="category-name" style="font-size: 2rem;"><i class="fas fa-pizza-slice"></i> <?php echo $pizzaName; ?></h2>
      <h4 style="color: var(--secondary-color); margin-bottom: var(--spacing-sm);">EGP. <?php echo $pizzaPrice; ?> /-</h4>
      <p class="category-description" style="margin-bottom: var(--spacing-md);"><?php echo $pizzaDesc; ?></p>
      <div style="display: flex; gap: var(--spacing-sm); flex-wrap: wrap; margin-bottom: var(--spacing-md);">
        <?php
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
        ?>
      </div>
      <div style="display: flex; gap: var(--spacing-sm); flex-wrap: wrap;">
        <a href="viewPizzaList.php?catid=<?php echo $pizzaCategorieId; ?>" class="view-all-btn" style="background: var(--secondary-color); color: #fff;"><i class="fas fa-qrcode"></i> All Pizza in Category</a>
        <a href="category.php" class="view-all-btn" style="background: var(--primary-dark); color: #fff;"><i class="fas fa-qrcode"></i> All Categories</a>
      </div>
    </div>
  </div>
</section>

<?php require 'partials/_footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>