<?php 
// Always start session and ensure DB connection is available
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($conn)) {
    if (file_exists(__DIR__ . '/_dbconnect.php')) {
        require_once __DIR__ . '/_dbconnect.php';
    } else if (file_exists('partials/_dbconnect.php')) {
        require_once 'partials/_dbconnect.php';
    }
}

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $userId = $_SESSION['userId'];
  $username = $_SESSION['username'];
}
else{
  $loggedin = false;
  $userId = 0;
}

// Site name
$systemName = 'Pizza World'; // fallback
$sql = "SELECT * FROM `sitedetail`";
$result = isset($conn) ? mysqli_query($conn, $sql) : false;
if ($result && $row = mysqli_fetch_assoc($result)) {
$systemName = $row['systemName'];
}

echo '<nav class="navbar navbar-expand-lg">
      <div class="container">
        <div class="navbar-brand">
          <div class="logo">
            <a href="index.php">
              <i class="fas fa-pizza-slice"></i>
              '.$systemName.'
            </a>
          </div>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php"><i class="fas fa-home"></i>Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-pizza-slice"></i>Categories
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
              $sql = "SELECT categorieName, categorieId FROM `categories`"; 
              $result = isset($conn) ? mysqli_query($conn, $sql) : false;
              if ($result) {
              while($row = mysqli_fetch_assoc($result)){
                echo '<a class="dropdown-item" href="viewPizzaList.php?catid=' .$row['categorieId']. '">
                  <i class="fas fa-chevron-right"></i>' .$row['categorieName']. '
                </a>';
                }
              } else {
                echo '<span class="dropdown-item text-danger">No categories found</span>';
              }
              echo '</div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="viewOrder.php"><i class="fas fa-shopping-bag"></i>Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php"><i class="fas fa-info-circle"></i>About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i>Contact</a>
            </li>
          </ul>
          
          <form method="get" action="/OnlinePizzaDelivery/search.php" class="search-form my-2 my-lg-0">
            <div class="input-group">
              <input class="form-control" type="search" name="search" id="search" placeholder="Search pizzas..." aria-label="Search" required>
              <div class="input-group-append">
                <button class="btn" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>';

          $count = 0;
          if ($loggedin && isset($conn)) {
          $countsql = "SELECT SUM(`itemQuantity`) FROM `viewcart` WHERE `userId`=$userId"; 
          $countresult = mysqli_query($conn, $countsql);
            if ($countresult) {
          $countrow = mysqli_fetch_assoc($countresult);      
              $count = $countrow['SUM(`itemQuantity`)'] ?? 0;
            }
          }
          echo '<a href="viewCart.php" class="cart-icon" title="My Cart">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count">' .$count. '</span>
          </a>';

          if($loggedin){
            echo '<div class="dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownUser" role="button" data-toggle="dropdown">
                <img src="img/person-' .$userId. '.jpg" class="rounded-circle" onError="this.src = \'img/profilePic.jpg\'" style="width:32px; height:32px; object-fit: cover;">
                <span>' .$username. '</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownUser">
                <a class="dropdown-item" href="viewProfile.php"><i class="fas fa-user"></i>Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="partials/_logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
              </div>
            </div>';
          }
          else {
            echo '
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
              <i class="fas fa-sign-in-alt"></i>Sign In
            </button>
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#signupModal">
              <i class="fas fa-user-plus"></i>Sign Up
            </button>';
          }
              
    echo '</div>
      </div>
    </nav>';

    include 'partials/_loginModal.php';
    include 'partials/_signupModal.php';

    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true") {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> You can now login.
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
    if(isset($_GET['error']) && $_GET['signupsuccess']=="false") {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Warning!</strong> ' .$_GET['error']. '
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> You are logged in
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Warning!</strong> Invalid Credentials
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
            </div>';
    }
?>

