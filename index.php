<?php 
$pageTitle = 'Home';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>

<!-- Category container starts here -->
<div class="container my-3 mb-5">
  <div class="section-header">
    <h2 class="section-title">Menu</h2>
  </div>
  <div class="category-grid">
    <!-- Fetch all the categories and use a loop to iterate through categories -->
    <?php 
      $sql = "SELECT * FROM `categories`"; 
      $result = mysqli_query($conn, $sql);
      $animationOrder = 0;
      while($row = mysqli_fetch_assoc($result)){
        $id = $row['categorieId'];
        $cat = $row['categorieName'];
        $desc = $row['categorieDesc'];
        $animationOrder++;
        $imgSrc = ($cat === 'BURGER PIZZA') ? 'img/card-7.jpg' : 'img/card-'.$id.'.jpg';
        echo '<div class="category-card" style="--animation-order: ' . $animationOrder . '">
                <div class="category-img-wrapper">
                  <img src="' . $imgSrc . '" class="category-img" alt="' . $cat . '">
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
</div>

<?php require 'partials/_footer.php'; ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>