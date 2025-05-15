<?php
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>
<link rel="stylesheet" href="css/admin.css">

<div class="admin-container">
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="mb-0">Contact Messages</h2>
        </div>
        <div class="admin-card-body">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Order ID</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM contact ORDER BY time DESC"; 
                            $result = mysqli_query($conn, $sql);
                            $count = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                $count++;
                                $contactId = $row['contactId'];
                                $userId = $row['userId'];
                                $email = $row['email'];
                                $phoneNo = $row['phoneNo'];
                                $orderId = $row['orderId'];
                                $message = $row['message'];
                                $time = $row['time'];

                                echo '<tr>
                                        <td>#' . $contactId . '</td>
                                        <td>' . $userId . '</td>
                                        <td>' . htmlspecialchars($email) . '</td>
                                        <td>' . $phoneNo . '</td>
                                        <td>' . ($orderId == 0 ? 'N/A' : '#' . $orderId) . '</td>
                                        <td>
                                            <button class="admin-btn admin-btn-info" 
                                                    data-toggle="modal" 
                                                    data-target="#viewMessage' . $contactId . '">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </td>
                                        <td>' . date('M d, Y H:i', strtotime($time)) . '</td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button class="admin-btn admin-btn-primary" 
                                                        data-toggle="modal" 
                                                        data-target="#replyMessage' . $contactId . '">
                                                    <i class="fas fa-reply"></i>
                                                </button>
                                                <form action="partials/_contactManage.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="contactId" value="' . $contactId . '">
                                                    <button type="submit" name="deleteMessage" class="admin-btn admin-btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>';
                            }
                            if($count == 0) {
                                echo '<tr><td colspan="8" class="text-center">No contact messages found</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- View Message Modals -->
<?php
    $sql = "SELECT * FROM contact";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $contactId = $row['contactId'];
        $message = $row['message'];
?>
<div class="modal fade" id="viewMessage<?php echo $contactId; ?>" tabindex="-1" role="dialog" aria-labelledby="viewMessageLabel<?php echo $contactId; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h5 class="modal-title" id="viewMessageLabel<?php echo $contactId; ?>">Message Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="admin-modal-body">
                <div class="admin-form-group">
                    <label class="admin-form-label">Message</label>
                    <div class="admin-form-control" style="min-height: 150px; white-space: pre-wrap;">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn admin-btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Reply Message Modals -->
<div class="modal fade" id="replyMessage<?php echo $contactId; ?>" tabindex="-1" role="dialog" aria-labelledby="replyMessageLabel<?php echo $contactId; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h5 class="modal-title" id="replyMessageLabel<?php echo $contactId; ?>">Reply to Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="partials/_contactManage.php" method="post">
                <div class="admin-modal-body">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Reply Message</label>
                        <textarea class="admin-form-control" name="replyMessage" rows="5" required></textarea>
                    </div>
                    <input type="hidden" name="contactId" value="<?php echo $contactId; ?>">
                </div>
                <div class="admin-modal-footer">
                    <button type="button" class="admin-btn admin-btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="sendReply" class="admin-btn admin-btn-primary">Send Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>