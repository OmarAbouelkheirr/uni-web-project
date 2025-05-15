<?php 
$pageTitle = 'My Cart';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
if($loggedin){
?>

<section class="container">
  <div class="section-header">
    <h2 class="section-title">My Cart</h2>
  </div>
  <div class="category-grid" style="grid-template-columns: 2fr 1fr; align-items: flex-start;">
    <div>
      <div class="category-card" style="padding: 0;">
        <div class="category-content" style="padding: var(--spacing-lg);">
          <div class="alert alert-info mb-3">
            <strong>Info!</strong> Online payment is currently disabled. Please choose cash on delivery.
          </div>
          <table class="table text-center" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th>No.</th>
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>
                  <form action="partials/_manageCart.php" method="POST">
                    <button name="removeAllItem" class="btn btn-sm btn-outline-danger">Remove All</button>
                    <input type="hidden" name="userId" value="<?php $userId = $_SESSION['userId']; echo $userId ?>">
                  </form>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT * FROM `viewcart` WHERE `userId`= $userId";
                $result = mysqli_query($conn, $sql);
                $counter = 0;
                $totalPrice = 0;
                while($row = mysqli_fetch_assoc($result)){
                  $pizzaId = $row['pizzaId'];
                  $Quantity = $row['itemQuantity'];
                  $mysql = "SELECT * FROM `pizza` WHERE pizzaId = $pizzaId";
                  $myresult = mysqli_query($conn, $mysql);
                  $myrow = mysqli_fetch_assoc($myresult);
                  $pizzaName = $myrow['pizzaName'];
                  $pizzaPrice = $myrow['pizzaPrice'];
                  $total = $pizzaPrice * $Quantity;
                  $counter++;
                  $totalPrice = $totalPrice + $total;
                  echo '<tr>
                          <td>' . $counter . '</td>
                          <td>' . $pizzaName . '</td>
                          <td>' . $pizzaPrice . '</td>
                          <td>
                            <form id="frm' . $pizzaId . '">
                              <input type="hidden" name="pizzaId" value="' . $pizzaId . '">
                              <input type="number" name="quantity" value="' . $Quantity . '" class="text-center" onchange="updateCart(' . $pizzaId . ')" onkeyup="return false" style="width:60px" min=1 oninput="check(this)" onClick="this.select();">
                            </form>
                          </td>
                          <td>' . $total . '</td>
                          <td>
                            <form action="partials/_manageCart.php" method="POST">
                              <button name="removeItem" class="btn btn-sm btn-outline-danger">Remove</button>
                              <input type="hidden" name="itemId" value="'.$pizzaId. '">
                            </form>
                          </td>
                        </tr>';
                }
                if($counter==0) {
                  echo '</tbody></table></div></div>';
                  echo '<div class="category-card"><div class="category-content"><div class="empty-cart-cls text-center"> <img src="img/burger.jpeg" width="130" height="130" class="img-fluid mb-4 mr-3"><h3><strong>Your Cart is Empty</strong></h3><h4>Add something to make me happy :)</h4> <a href="index.php" class="view-all-btn m-3">Continue Shopping</a> </div></div></div>';
                } else {
                  echo '</tbody></table></div></div>';
                }
              ?>
    </div>
    <div>
      <div class="category-card" style="padding: 0;">
        <div class="category-content" style="padding: var(--spacing-lg);">
          <h3 class="category-name" style="margin-bottom: var(--spacing-md);">Order Summary</h3>
          <ul class="list-group list-group-flush" style="margin-bottom: var(--spacing-md);">
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 bg-white">Total Price<span>EGP. <?php echo $totalPrice ?></span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-white">Shipping<span>EGP. 0</span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3 bg-white">
              <div>
                <strong>The total amount of</strong>
                <strong><p class="mb-0">(including Tax & Charge)</p></strong>
              </div>
              <span><strong>EGP. <?php echo $totalPrice ?></strong></span>
            </li>
          </ul>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
            <label class="form-check-label" for="flexRadioDefault1">
              Cash On Delivery 
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault1" disabled>
            <label class="form-check-label" for="flexRadioDefault1">
              Online Payment 
            </label>
          </div><br>
          <button type="button" class="view-all-btn" data-toggle="modal" data-target="#checkoutModal" style="width: 100%;">Go to Checkout <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>
      <div class="category-card" style="margin-top: var(--spacing-lg); padding: 0;">
        <div class="category-content" style="padding: var(--spacing-lg);">
          <a class="dark-grey-text d-flex justify-content-between" style="text-decoration: none; color: #050607;" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Add a discount code (optional)
            <span><i class="fas fa-chevron-down pt-1"></i></span>
          </a>
          <div class="collapse" id="collapseExample">
            <div class="mt-3">
              <div class="md-form md-outline mb-0">
                <input type="text" id="discount-code" class="form-control font-weight-light" placeholder="Enter discount code">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
} else {
  echo '<section class="container" style="min-height : 610px;"><div class="alert alert-info my-3"><font style="font-size:22px"><center>Before checkout you need to <strong><a class="alert-link" data-toggle="modal" data-target="#loginModal">Login</a></strong></center></font></div></section>';
}
?>
<?php require 'partials/_checkoutModal.php'; ?>
<?php require 'partials/_footer.php'; ?>

<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
<script>
    function check(input) {
        if (input.value <= 0) {
            input.value = 1;
        }
    }
    function updateCart(id) {
        $.ajax({
            url: 'partials/_manageCart.php',
            type: 'POST',
            data:$("#frm"+id).serialize(),
            success:function(res) {
                location.reload();
            } 
        })
    }
</script>