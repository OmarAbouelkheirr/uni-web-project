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