<?php
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>
<link rel="stylesheet" href="css/admin.css">

<div class="admin-container">
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="mb-0">Order Management</h2>
            <div class="d-flex gap-2">
                <button class="admin-btn admin-btn-primary" onclick="window.location.reload()">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
                <button class="admin-btn admin-btn-info" onclick="window.print()">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>
        <div class="admin-card-body">
            <div class="table-responsive">
                <table class="admin-table" id="orderTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>Address</th>
                            <th>Phone No</th>
                            <th>Amount</th>
                            <th>Payment Mode</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM `orders` ORDER BY orderDate DESC";
                            $result = mysqli_query($conn, $sql);
                            $counter = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                $Id = $row['userId'];
                                $orderId = $row['orderId'];
                                $address = $row['address'];
                                $zipCode = $row['zipCode'];
                                $phoneNo = $row['phoneNo'];
                                $amount = $row['amount'];
                                $orderDate = $row['orderDate'];
                                $paymentMode = $row['paymentMode'] == 0 ? "Cash on Delivery" : "Online";
                                $orderStatus = $row['orderStatus'];
                                $counter++;
                                
                                // Status badge class
                                $statusClass = '';
                                switch($orderStatus) {
                                    case 'Order Placed':
                                        $statusClass = 'admin-badge-warning';
                                        break;
                                    case 'Order Confirmed':
                                        $statusClass = 'admin-badge-info';
                                        break;
                                    case 'Preparing':
                                        $statusClass = 'admin-badge-primary';
                                        break;
                                    case 'On the way':
                                        $statusClass = 'admin-badge-info';
                                        break;
                                    case 'Delivered':
                                        $statusClass = 'admin-badge-success';
                                        break;
                                    case 'Cancelled':
                                        $statusClass = 'admin-badge-danger';
                                        break;
                                    default:
                                        $statusClass = 'admin-badge-warning';
                                }
                                
                                echo '<tr>
                                        <td>#' . $orderId . '</td>
                                        <td>' . $Id . '</td>
                                        <td data-toggle="tooltip" title="' . htmlspecialchars($address) . '">' . substr($address, 0, 20) . '...</td>
                                        <td>' . $phoneNo . '</td>
                                        <td>₹' . $amount . '</td>
                                        <td>' . $paymentMode . '</td>
                                        <td>' . date('M d, Y', strtotime($orderDate)) . '</td>
                                        <td><span class="admin-badge ' . $statusClass . '">' . $orderStatus . '</span></td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button class="admin-btn admin-btn-primary" data-toggle="modal" data-target="#orderStatus' . $orderId . '">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="admin-btn admin-btn-info" data-toggle="modal" data-target="#orderItem' . $orderId . '">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>';
                            }
                            if($counter == 0) {
                                echo '<tr><td colspan="9" class="text-center">No orders found</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
    include 'partials/_orderItemModal.php';
    include 'partials/_orderStatusModal.php';
?>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>