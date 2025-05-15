<?php
    session_start();
    if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true){
        header("location: /OnlinePizzaDelivery/admin/login.php");
        exit;
    }
    require 'partials/_dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pizza Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .dashboard-card {
            transition: transform 0.3s;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body class="bg-light">
    <?php require 'partials/_nav.php'; ?>

    <div class="container-fluid py-4">
        <h2 class="mb-4">Admin Dashboard</h2>
        
        <div class="row g-4">
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
                            $sql = "SELECT COUNT(*) as total FROM menu";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <h2 class="mb-0"><?php echo $row['total']; ?></h2>
                    </div>
                </div>
            </div>

            <!-- Orders Management -->
            <div class="col-md-3">
                <div class="card dashboard-card orders-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-shopping-cart card-icon"></i>
                        <h5 class="card-title">Pending Orders</h5>
                        <?php
                            $sql = "SELECT COUNT(*) as total FROM orders WHERE status='pending'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <h2 class="mb-0"><?php echo $row['total']; ?></h2>
                    </div>
                </div>
            </div>

            <!-- Users Management -->
            <div class="col-md-3">
                <div class="card dashboard-card users-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-users card-icon"></i>
                        <h5 class="card-title">Total Users</h5>
                        <?php
                            $sql = "SELECT COUNT(*) as total FROM users";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <h2 class="mb-0"><?php echo $row['total']; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Quick Actions</h4>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <a href="menuManage.php" class="btn btn-primary w-100">
                                    <i class="fas fa-utensils me-2"></i>Manage Menu
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="orderManage.php" class="btn btn-success w-100">
                                    <i class="fas fa-shopping-bag me-2"></i>Manage Orders
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="userManage.php" class="btn btn-info w-100">
                                    <i class="fas fa-user-cog me-2"></i>Manage Users
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="categoryManage.php" class="btn btn-warning w-100">
                                    <i class="fas fa-tags me-2"></i>Manage Categories
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
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
                                                JOIN users u ON o.user_id = u.id 
                                                ORDER BY o.order_date DESC LIMIT 5";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                    <td>#".$row['id']."</td>
                                                    <td>".$row['username']."</td>
                                                    <td>$".$row['total_amount']."</td>
                                                    <td><span class='badge bg-".($row['status'] == 'pending' ? 'warning' : 'success')."'>".$row['status']."</span></td>
                                                    <td>".date('M d, Y', strtotime($row['order_date']))."</td>
                                                    <td>
                                                        <a href='orderManage.php?id=".$row['id']."' class='btn btn-sm btn-primary'>View</a>
                                                    </td>
                                                  </tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 