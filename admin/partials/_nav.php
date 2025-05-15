<?php
// Ensure session is started and admin info is available
if (session_status() === PHP_SESSION_NONE) session_start();
$adminName = isset($_SESSION['adminusername']) ? $_SESSION['adminusername'] : 'Admin';
?>
    <header class="header" id="header">
        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
    </header>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="index.php" class="nav__logo">
                    <i class='bx bx-layer nav__logo-icon'></i>
                    <span class="nav__logo-name">Pizza Delivery</span>
                </a>
            <div class="nav__profile" style="margin-bottom:1.5rem;">
                <div class="nav__profile-name" style="color:#333;font-weight:700;font-size:1.1rem;letter-spacing:0.5px;">
                    <?php echo htmlspecialchars($adminName); ?> (Admin)
                </div>
            </div>
                <div class="nav__list">
                    <a href="index.php" class="nav__link nav-home">
                      <i class='bx bx-grid-alt nav__icon' ></i>
                      <span class="nav__name">Home</span>
                    </a>
                    <a href="index.php?page=orderManage" class="nav-orderManage nav__link ">
                      <i class='bx bx-bar-chart-alt-2 nav__icon' ></i>
                      <span class="nav__name">Orders</span>
                    </a>
                    <a href="index.php?page=categoryManage" class="nav__link nav-categoryManage">
                      <i class='bx bx-folder nav__icon' ></i>
                      <span class="nav__name">Category List</span>
                    </a>
                    <a href="index.php?page=menuManage" class="nav__link nav-menuManage">
                      <i class='bx bx-message-square-detail nav__icon' ></i>
                      <span class="nav__name">Menu</span>
                    </a>
                    <a href="index.php?page=contactManage" class="nav__link nav-contactManage">
                      <i class="fas fa-hands-helping"></i>
                  <span class="nav__name">Contact Info</span>
                    </a>
                    <a href="index.php?page=userManage" class="nav__link nav-userManage">
                      <i class='bx bx-user nav__icon' ></i>
                      <span class="nav__name">Users</span>
                    </a>
                    <a href="index.php?page=siteManage" class="nav__link nav-siteManage">
                      <i class="fas fa-cogs"></i>
                      <span class="nav__name">Site Settings</span>
                    </a>
                </div>
            </div>
        <a href="partials/_logout.php" class="nav__logout nav__link">
              <i class='bx bx-log-out nav__icon' ></i>
              <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>  
    
<!-- jQuery (latest) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    <?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
    $('.nav-<?php echo $page; ?>').addClass('active')
</script>
   