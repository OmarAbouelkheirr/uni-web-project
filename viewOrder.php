<?php 
$pageTitle = 'Your Orders';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>

<style>
body {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
.main-orders-section {
  flex: 1 0 auto;
  min-height: 60vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  background: var(--background-light);
  padding-bottom: 0;
}
.orders-content-wrapper {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.category-grid {
  justify-content: center;
  margin-bottom: 0;
}
</style>

<div style="height: 2.5rem;"></div> <!-- Extra spacing between navbar and header -->
<section class="main-orders-section">
  <div class="orders-content-wrapper">
    <div class="section-header" style="margin-bottom: var(--spacing-lg); padding-bottom: 0.5rem;">
      <h2 class="section-title" style="margin-bottom: 0; font-size: 2.5rem; letter-spacing: 1px;">Your Recent Orders</h2>
    </div>
    <div class="category-grid">
      <?php 
        $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : 0;
        $sql = "SELECT * FROM `orders` WHERE `userId` = $userId ORDER BY `orderId` DESC LIMIT 6";
        $result = mysqli_query($conn, $sql);
        $animationOrder = 0;
        if(mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)){
            $orderId = $row['orderId'];
            $orderStatus = $row['orderStatus'];
            $orderDate = $row['orderDate'];
            $orderTotal = $row['amount'];
            $animationOrder++;
            echo '<div class="category-card" style="--animation-order: ' . $animationOrder . '; min-width: 320px; max-width: 370px; margin: 1.5rem auto;">
                    <div class="category-content">
                      <h3 class="category-name"><i class="fas fa-receipt"></i> Order #' . $orderId . '</h3>
                      <p class="category-description">Placed on: ' . date('M d, Y', strtotime($orderDate)) . '</p>
                      <p class="category-description">Total: <strong>₹' . $orderTotal . '</strong></p>
                      <div style="margin-bottom: var(--spacing-sm);">
                        <span class="badge" style="background: var(--primary-color); color: #fff; padding: 0.5em 1em; border-radius: 1em;">' . ucfirst($orderStatus) . '</span>
                      </div>
                      <a href="orderTracking.php?orderid=' . $orderId . '" class="view-all-btn" style="margin-bottom: var(--spacing-xs);">Track Order <i class="fas fa-map-marker-alt"></i></a>
                    </div>
                  </div>';
          }
        } else {
          echo '<div class="category-card"><div class="category-content"><h3 class="category-name"><i class="fas fa-info-circle"></i> No Orders Yet</h3><p class="category-description">You have not placed any orders yet. Start your pizza journey now!</p><a href="category.php" class="view-all-btn">Order Now <i class="fas fa-arrow-right"></i></a></div></div>';
        }
      ?>
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