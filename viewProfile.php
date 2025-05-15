<?php 
$pageTitle = 'My Profile';
require 'partials/_header.php';
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
if($loggedin) {
  $sql = "SELECT * FROM users WHERE id='$userId'"; 
  $result = mysqli_query($conn, $sql);
  $row=mysqli_fetch_assoc($result);
  $username = $row['username'];
  $firstName = $row['firstName'];
  $lastName = $row['lastName'];
  $email = $row['email'];
  $phone = $row['phone'];
  $userType = $row['userType'];
  if($userType == 0) {
      $userType = "User";
  } else {
      $userType = "Admin";
  }
?>

<section class="container" style="min-height: 70vh; display: flex; align-items: flex-start; justify-content: center; gap: var(--spacing-2xl); flex-wrap: wrap;">
  <div class="category-card" style="max-width: 340px; width: 100%; text-align: center;">
    <div class="category-content">
      <img class="rounded-circle mb-3 bg-dark" src="https://via.placeholder.com/160?text=User" style="width:160px;height:160px;padding:1px;object-fit:cover;">
      <form action="partials/_manageProfile.php" method="POST" style="margin-bottom: 0.5rem;">
        <small>Remove Image: </small><button type="submit" class="btn btn-sm btn-outline-danger" name="removeProfilePic">remove</button>
      </form>
      <form action="partials/_manageProfile.php" method="POST" enctype="multipart/form-data" style="margin-bottom: 1rem;">
        <div class="upload-btn-wrapper">
          <small>Change Image:</small>
          <label for="image" class="btn btn-sm btn-outline-primary upload" style="cursor:pointer; margin-bottom:0;">Choose</label>
          <input type="file" name="image" id="image" accept="image/*" style="display:none;">
        </div>
        <button type="submit" name="updateProfilePic" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">Update</button>
      </form>
      <ul class="meta list list-unstyled" style="text-align:center;">
        <li class="username my-2"><a href="viewProfile.php">@<?php echo $username ?></a></li>
        <li class="name"><?php echo $firstName." ".$lastName; ?> <span class="badge badge-info"><?php echo $userType ?></span></li>
        <li class="email"><?php echo $email ?></li>
        <li class="my-2"><a href="partials/_logout.php"><button class="btn btn-outline-secondary btn-sm">Logout</button></a></li>
      </ul>
    </div>
  </div>
  <div class="category-card" style="flex: 1 1 340px; max-width: 500px; width: 100%;">
    <div class="category-content">
      <h2 class="section-title" style="font-size: 1.5rem; text-align: center; margin-bottom: var(--spacing-lg);">Profile Details <span class="badge badge-warning"><?php echo $userType ?></span></h2>
      <form action="partials/_manageProfile.php" method="post">
        <div class="form-group">
          <label for="username"><b>Username:</b></label>
          <input class="form-control" id="username" name="username" type="text" disabled value="<?php echo $username ?>">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="firstName"><b>First Name:</b></label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required value="<?php echo $firstName ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="lastName"><b>Last Name:</b></label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" required value="<?php echo $lastName ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="email"><b>Email:</b></label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required value="<?php echo $email ?>">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="phone"><b>Phone No:</b></label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon">+20</span>
              </div>
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number" required pattern="[0-9]{10}" maxlength="10" value="<?php echo $phone ?>">
            </div>
          </div>
          <div class="form-group col-md-6">
            <label for="password"><b>Password:</b></label>
            <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required minlength="4" maxlength="21" data-toggle="password">
          </div>
        </div>
        <button type="submit" name="updateProfileDetail" class="view-all-btn" style="width: 100%;">Update</button>
      </form>
    </div>
  </div>
</section>

<?php
} else {
  echo '<section class="container" style="min-height: 70vh;"><div class="category-card"><div class="category-content text-center"><h2>404 - Page not found</h2><a href="index.php" class="view-all-btn mt-3">Go To Homepage</a></div></div></section>';
}
?>
<?php require 'partials/_footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
<script>
// Removed JS for button text update as it's not needed with label
</script>
