<?php
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>
<link rel="stylesheet" href="css/admin.css">

<div class="admin-container">
    <div class="row">
        <!-- Add Category Form -->
        <div class="col-md-4">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2 class="mb-0">Add New Category</h2>
                </div>
                <div class="admin-card-body">
                    <form action="partials/_categoryManage.php" method="post" enctype="multipart/form-data">
                        <div class="admin-form-group">
                            <label class="admin-form-label">Category Name</label>
                            <input type="text" class="admin-form-control" name="catName" required>
                        </div>
                        <div class="admin-form-group">
                            <label class="admin-form-label">Description</label>
                            <textarea class="admin-form-control" name="catDesc" rows="3" required></textarea>
                        </div>
                        <div class="admin-form-group">
                            <label class="admin-form-label">Category Image</label>
                            <input type="file" class="admin-form-control" name="catImage" accept="image/*" required>
                        </div>
                        <button type="submit" class="admin-btn admin-btn-primary w-100" name="addCategory">
                            <i class="fas fa-plus"></i> Add Category
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Categories List -->
        <div class="col-md-8">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2 class="mb-0">Categories List</h2>
                </div>
                <div class="admin-card-body">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Details</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM `categories` ORDER BY categorieId DESC";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                        $catId = $row['categorieId'];
                                        $catName = $row['categorieName'];
                                        $catDesc = $row['categorieDesc'];

                                        $imgSrc = ($catName === 'BURGER PIZZA') ? '/OnlinePizzaDelivery/img/PizzaBurger.jpeg' : '/OnlinePizzaDelivery/img/card-' . $catId . '.jpg';

                                        echo '<tr>
                                                <td class="text-center">' . $catId . '</td>
                                                <td>
                                                    <img src="' . $imgSrc . '" 
                                                         alt="' . htmlspecialchars($catName) . '" 
                                                         class="img-thumbnail" 
                                                         style="width: 100px; height: 100px; object-fit: cover;">
                                                </td>
                                                <td>
                                                    <h5 class="mb-1">' . htmlspecialchars($catName) . '</h5>
                                                    <p class="text-muted mb-0">' . htmlspecialchars($catDesc) . '</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <button class="admin-btn admin-btn-primary" 
                                                                data-toggle="modal" 
                                                                data-target="#updateCat' . $catId . '">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="partials/_categoryManage.php" method="POST" class="d-inline">
                                                            <input type="hidden" name="catId" value="' . $catId . '">
                                                            <button type="submit" name="removeCategory" class="admin-btn admin-btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>';
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

<!-- Update Category Modals -->
<?php
    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catId = $row['categorieId'];
        $catName = $row['categorieName'];
        $catDesc = $row['categorieDesc'];
?>
<div class="modal fade" id="updateCat<?php echo $catId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateCatLabel<?php echo $catId; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h5 class="modal-title" id="updateCatLabel<?php echo $catId; ?>">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="partials/_categoryManage.php" method="post" enctype="multipart/form-data">
                <div class="admin-modal-body">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Category Name</label>
                        <input type="text" class="admin-form-control" name="catName" value="<?php echo htmlspecialchars($catName); ?>" required>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Description</label>
                        <textarea class="admin-form-control" name="catDesc" rows="3" required><?php echo htmlspecialchars($catDesc); ?></textarea>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Category Image</label>
                        <input type="file" class="admin-form-control" name="catImage" accept="image/*">
                        <small class="form-text text-muted">Leave empty to keep current image</small>
                    </div>
                    <input type="hidden" name="catId" value="<?php echo $catId; ?>">
                </div>
                <div class="admin-modal-footer">
                    <button type="button" class="admin-btn admin-btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updateCategory" class="admin-btn admin-btn-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>