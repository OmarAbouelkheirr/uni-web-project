<?php
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>
<link rel="stylesheet" href="css/admin.css">

<div class="admin-container">
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="mb-0">User Management</h2>
            <div class="d-flex gap-2">
                <button class="admin-btn admin-btn-primary" onclick="window.location.reload()">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div>
        <div class="admin-card-body">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM users ORDER BY id DESC";
                            $result = mysqli_query($conn, $sql);
                            $count = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                $count++;
                                $userId = $row['id'];
                                $username = $row['username'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                                $role = $row['role'] ?? 'user';
                                $status = $row['status'] ?? 'active';

                                // Role badge class
                                $roleClass = $role == 'admin' ? 'admin-badge-primary' : 'admin-badge-info';
                                
                                // Status badge class
                                $statusClass = $status == 'active' ? 'admin-badge-success' : 'admin-badge-danger';

                                echo '<tr>
                                        <td>#' . $userId . '</td>
                                        <td>' . htmlspecialchars($username) . '</td>
                                        <td>' . htmlspecialchars($email) . '</td>
                                        <td>' . $phone . '</td>
                                        <td><span class="admin-badge ' . $roleClass . '">' . ucfirst($role) . '</span></td>
                                        <td><span class="admin-badge ' . $statusClass . '">' . ucfirst($status) . '</span></td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button class="admin-btn admin-btn-primary" 
                                                        data-toggle="modal" 
                                                        data-target="#editUser' . $userId . '">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="partials/_userManage.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="userId" value="' . $userId . '">
                                                    <button type="submit" name="deleteUser" class="admin-btn admin-btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>';
                            }
                            if($count == 0) {
                                echo '<tr><td colspan="7" class="text-center">No users found</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modals -->
<?php
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $userId = $row['id'];
        $username = $row['username'];
        $email = $row['email'];
        $phone = $row['phone'];
        $role = $row['role'] ?? 'user';
        $status = $row['status'] ?? 'active';
?>
<div class="modal fade" id="editUser<?php echo $userId; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserLabel<?php echo $userId; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h5 class="modal-title" id="editUserLabel<?php echo $userId; ?>">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="partials/_userManage.php" method="post">
                <div class="admin-modal-body">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Username</label>
                        <input type="text" class="admin-form-control" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Email</label>
                        <input type="email" class="admin-form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Phone</label>
                        <input type="tel" class="admin-form-control" name="phone" value="<?php echo $phone; ?>" required>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Role</label>
                        <select name="role" class="admin-form-control" required>
                            <option value="user" <?php echo $role == 'user' ? 'selected' : ''; ?>>User</option>
                            <option value="admin" <?php echo $role == 'admin' ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Status</label>
                        <select name="status" class="admin-form-control" required>
                            <option value="active" <?php echo $status == 'active' ? 'selected' : ''; ?>>Active</option>
                            <option value="inactive" <?php echo $status == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>
                    <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                </div>
                <div class="admin-modal-footer">
                    <button type="button" class="admin-btn admin-btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updateUser" class="admin-btn admin-btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>