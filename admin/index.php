<?php 
    session_start();
    if(isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin']==true){
        $adminloggedin = true;
        $userId = $_SESSION['adminuserId'];
    }
    else{
        header("location: /OnlinePizzaDelivery/admin/login.php");
        exit;
    }
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <title>Admin Dashboard - Pizza Delivery</title>
    <link rel="icon" href="/OnlinePizzaDelivery/img/logo.jpg" type="image/x-icon">
    
    <!-- Sidebar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assetsForSideBar/css/styles.css">

    <style>
        .main-content {
            padding: 20px;
            transition: all 0.3s;
        }
        .dashboard-card {
            transition: transform 0.3s;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .stats-card {
            background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
            color: white;
        }
        .menu-card {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            color: white;
        }
        .orders-card {
            background: linear-gradient(45deg, #43e97b, #38f9d7);
            color: white;
        }
        .users-card {
            background: linear-gradient(45deg, #fa709a, #fee140);
            color: white;
        }
        .welcome-banner {
            background: linear-gradient(45deg, #2193b0, #6dd5ed);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body id="body-pd">
    <?php require 'partials/_nav.php'; ?>
     
    <div class="main-content" id="main-content">
    <?php
        require 'partials/_dbconnect.php';

        if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> You are logged in
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
                  </div>';
        }
    ?>

        <?php 
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            if($page == 'home') {
        ?>
            <div class="welcome-banner">
                <h2>Welcome, <?php echo htmlspecialchars($_SESSION['adminusername']); ?>!</h2>
                <p class="mb-0">Here's your admin dashboard overview</p>
            </div>

            <div class="row">
                <!-- Statistics Overview -->
                <div class="col-md-3">
                    <div class="card dashboard-card stats-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-line card-icon"></i>
                            <h5 class="card-title">Total Orders</h5>
                            <?php
                                $sql = "SELECT COUNT(*) as total FROM orders";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                            ?>
                            <h2 class="mb-0"><?php echo $row['total']; ?></h2>
                        </div>
                    </div>
                </div>

                <!-- Menu Management -->
                <div class="col-md-3">
                    <div class="card dashboard-card menu-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-pizza-slice card-icon"></i>
                            <h5 class="card-title">Menu Items</h5>
                            <?php
                                $sql = "SELECT COUNT(*) as total FROM pizza";
                                $result = mysqli_query($conn, $sql);
                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo '<h2 class="mb-0">' . $row['total'] . '</h2>';
                                } else {
                                    echo "<span style='color:yellow;'>Error: " . mysqli_error($conn) . "</span>";
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Total Categories -->
                <div class="col-md-3">
                    <div class="card dashboard-card users-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-list card-icon"></i>
                            <h5 class="card-title">Total Categories</h5>
                            <?php
                                $sql = "SELECT COUNT(*) as total FROM categories";
                                $result = mysqli_query($conn, $sql);
                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo '<h2 class="mb-0">' . $row['total'] . '</h2>';
                                } else {
                                    echo "<span style='color:yellow;'>Error: " . mysqli_error($conn) . "</span>";
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="col-md-3">
                    <div class="card dashboard-card stats-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-dollar-sign card-icon"></i>
                            <h5 class="card-title">Total Revenue</h5>
                            <?php
                                $sql = "SELECT SUM(amount) as revenue FROM orders";
                                $result = mysqli_query($conn, $sql);
                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo '<h2 class="mb-0">' . ($row['revenue'] ? 'EGP ' . number_format($row['revenue'], 2) : 'EGP 0.00') . '</h2>';
                                } else {
                                    echo "<span style='color:yellow;'>Error: " . mysqli_error($conn) . "</span>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Management -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Recent Orders</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT o.*, u.username FROM orders o 
                                                    JOIN users u ON o.userId = u.id 
                                                    ORDER BY o.orderDate DESC LIMIT 5";
                                            $result = mysqli_query($conn, $sql);
                                            if ($result) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>
                                                            <td>#".$row['orderId']."</td>
                                                            <td>".htmlspecialchars($row['username'])."</td>
                                                            <td>EGP ".number_format($row['amount'], 2)."</td>
                                                            <td><span class='badge badge-".($row['orderStatus'] == '0' ? 'warning' : 'success')."'>".$row['orderStatus']."</span></td>
                                                            <td>".date('M d, Y', strtotime($row['orderDate']))."</td>
                                                            <td>
                                                                <a href='index.php?page=orderManage&id=".$row['orderId']."' class='btn btn-sm btn-primary'>View</a>
                                                            </td>
                                                          </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6' class='text-danger'>No recent orders found or query error: ".htmlspecialchars(mysqli_error($conn))."</td></tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <?php include $page.'.php'; ?>
        <?php } ?>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="assetsForSideBar/js/main.js"></script>
    <script>
        // Toggle main content margin when sidebar is toggled
        document.getElementById('header-toggle').addEventListener('click', function() {
            document.getElementById('main-content').classList.toggle('expanded');
        });
    </script>
</body>
</html>