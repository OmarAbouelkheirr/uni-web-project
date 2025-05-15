<?php
require 'partials/_dbconnect.php';

$orderId = isset($_GET['orderid']) ? intval($_GET['orderid']) : 0;
$orderStatus = null;

if ($orderId > 0) {
    $sql = "SELECT orderStatus, orderDate FROM orders WHERE orderId = $orderId";
    $result = mysqli_query($conn, $sql);
    if ($result && $row = mysqli_fetch_assoc($result)) {
        $orderStatus = $row['orderStatus'];
        $orderDate = $row['orderDate'];
    }
}

$statusSteps = [
    'Order Placed',
    'Order Confirmed',
    'Preparing',
    'On the Way',
    'Delivered',
    'Denied',
    'Cancelled'
];

function getStatusIndex($status) {
    $map = [
        '0' => 0, // Placed
        '1' => 1, // Confirmed
        '2' => 2, // Preparing
        '3' => 3, // On the Way
        '4' => 4, // Delivered
        '5' => 5, // Denied
        '6' => 6, // Cancelled
    ];
    return isset($map[$status]) ? $map[$status] : 0;
}
$currentStep = getStatusIndex($orderStatus);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order #<?php echo htmlspecialchars($orderId); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        .stepper {
            display: flex;
            justify-content: space-between;
            margin: 40px 0 30px 0;
        }
        .step {
            flex: 1;
            text-align: center;
            position: relative;
        }
        .step .circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e0e0e0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #888;
            margin-bottom: 8px;
            border: 2px solid #e0e0e0;
            z-index: 1;
        }
        .step.active .circle, .step.completed .circle {
            background: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .step.completed .circle {
            background: #28a745;
            border-color: #28a745;
        }
        .step .label {
            font-size: 0.95rem;
            color: #555;
        }
        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 18px;
            left: 50%;
            width: 100%;
            height: 4px;
            background: #e0e0e0;
            z-index: 0;
        }
        .step.completed:not(:last-child)::after {
            background: #28a745;
        }
        .step.active:not(:last-child)::after {
            background: #007bff;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Track Order #<?php echo htmlspecialchars($orderId); ?></h2>
    <?php if ($orderStatus !== null): ?>
        <div class="stepper">
            <?php foreach ($statusSteps as $i => $label):
                $stepClass = '';
                if ($i < $currentStep) $stepClass = 'completed';
                elseif ($i == $currentStep) $stepClass = 'active';
            ?>
                <div class="step <?php echo $stepClass; ?>">
                    <div class="circle"><?php echo $i+1; ?></div>
                    <div class="label"><?php echo $label; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="card p-3">
            <h5>Status: <span class="badge badge-info"><?php echo $statusSteps[$currentStep]; ?></span></h5>
            <p>Order Date: <?php echo date('M d, Y H:i', strtotime($orderDate)); ?></p>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Order not found.</div>
    <?php endif; ?>
    <a href="viewOrder.php" class="btn btn-secondary mt-4">Back to My Orders</a>
</div>
</body>
</html> 