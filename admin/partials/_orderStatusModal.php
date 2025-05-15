<?php 
    $itemModalSql = "SELECT * FROM `orders`";
    $itemModalResult = mysqli_query($conn, $itemModalSql);
    while($itemModalRow = mysqli_fetch_assoc($itemModalResult)){
        $orderid = $itemModalRow['orderId'];
        $userid = $itemModalRow['userId'];
        $orderStatus = $itemModalRow['orderStatus'];
?>

<!-- Modal -->
<div class="modal fade order-status-modal" id="orderStatus<?php echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="orderStatus<?php echo $orderid; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.12); border: none;">
      <div class="modal-header" style="background: var(--primary-color); color: #fff; border-radius: 16px 16px 0 0; border-bottom: none;">
        <h5 class="modal-title" id="orderStatus<?php echo $orderid; ?>">Order Status and Delivery Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff; opacity: 1; font-size: 1.5rem;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background: var(--background); border-radius: 0 0 16px 16px;">
        <form action="partials/_orderManage.php" method="post" class="mb-4 pb-3" style="border-bottom: 1px solid var(--border-color);">
            <div class="mb-3">    
                <label for="status" class="form-label" style="font-weight: 600; color: var(--text-color);">Order Status</label>
                <div class="d-flex align-items-center gap-2">
                  <input class="form-control" style="max-width: 80px;" id="status" name="status" value="<?php echo $orderStatus; ?>" type="number" min="0" max="6" required>
                  <button type="button" class="btn btn-light ml-2" data-container="body" data-toggle="popover" title="Order Status Codes" data-placement="bottom" data-html="true" data-content="0=Order Placed.<br> 1=Order Confirmed.<br> 2=Preparing your Order.<br> 3=Your order is on the way!<br> 4=Order Delivered.<br> 5=Order Denied.<br> 6=Order Cancelled.">
                      <i class="fas fa-info"></i>
                  </button>
                </div>
            </div>
            <input type="hidden" id="orderId" name="orderId" value="<?php echo $orderid; ?>">
            <button type="submit" class="btn btn-primary" name="updateStatus">Update</button>
        </form>
        <?php 
            $deliveryDetailSql = "SELECT * FROM `deliverydetails` WHERE `orderId`= $orderid";
            $deliveryDetailResult = mysqli_query($conn, $deliveryDetailSql);
            $deliveryDetailRow = mysqli_fetch_assoc($deliveryDetailResult);
            if ($deliveryDetailRow) {
                $trackId = $deliveryDetailRow['id'];
                $deliveryBoyName = $deliveryDetailRow['deliveryBoyName'];
                $deliveryBoyPhoneNo = $deliveryDetailRow['deliveryBoyPhoneNo'];
                $deliveryTime = $deliveryDetailRow['deliveryTime'];
            } else {
                $trackId = '';
                $deliveryBoyName = '';
                $deliveryBoyPhoneNo = '';
                $deliveryTime = '';
            }
            if($orderStatus>0 && $orderStatus<5) { 
        ?>
            <form action="partials/_orderManage.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label" style="font-weight: 600; color: var(--text-color);">Delivery Boy Name</label>
                    <input class="form-control" id="name" name="name" value="<?php echo $deliveryBoyName; ?>" type="text" required>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone" class="form-label" style="font-weight: 600; color: var(--text-color);">Phone No</label>
                        <input class="form-control" id="phone" name="phone" value="<?php echo $deliveryBoyPhoneNo; ?>" type="tel">
                    </div>
                    <div class="col-md-6">
                        <label for="time" class="form-label" style="font-weight: 600; color: var(--text-color);">Estimate Time (minute)</label>
                        <input class="form-control" id="time" name="time" value="<?php echo $deliveryTime; ?>" type="number" min="1" max="120" required>
                    </div>
                </div>
                <input type="hidden" id="trackId" name="trackId" value="<?php echo $trackId; ?>">
                <input type="hidden" id="orderId" name="orderId" value="<?php echo $orderid; ?>">
                <button type="submit" class="btn btn-primary" name="updateDeliveryDetails">Update</button>
            </form>
        <?php } else if ($orderStatus>0 && $orderStatus<5 && !$deliveryDetailRow) { ?>
            <div class="alert alert-info mt-3">No delivery details available for this order yet.</div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<?php
    }
?>

<style>
    .popover {
        top: -77px !important;
    }
</style>

<script>
    $(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>