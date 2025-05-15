<?php
require 'partials/_dbconnect.php';
require 'partials/_nav.php';
?>
<link rel="stylesheet" href="css/admin.css">

<div class="admin-container">
	<div class="row">
		<!-- Add Menu Item Form -->
		<div class="col-md-4">
			<div class="admin-card">
				<div class="admin-card-header">
					<h2 class="mb-0">Add New Item</h2>
				</div>
				<div class="admin-card-body">
					<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
						<div class="admin-form-group">
							<label class="admin-form-label">Item Name</label>
							<input type="text" class="admin-form-control" name="name" required>
						</div>
						<div class="admin-form-group">
							<label class="admin-form-label">Description</label>
							<textarea class="admin-form-control" name="description" rows="3" required></textarea>
						</div>
						<div class="admin-form-group">
							<label class="admin-form-label">Price</label>
							<input type="number" class="admin-form-control" name="price" required min="1">
						</div>
						<div class="admin-form-group">
							<label class="admin-form-label">Category</label>
							<select name="categoryId" class="admin-form-control" required>
								<option value="" disabled selected>Select Category</option>
								<?php
									$catsql = "SELECT * FROM `categories`"; 
									$catresult = mysqli_query($conn, $catsql);
									while($row = mysqli_fetch_assoc($catresult)){
										echo '<option value="' . $row['categorieId'] . '">' . $row['categorieName'] . '</option>';
									}
								?>
							</select>
						</div>
						<div class="admin-form-group">
							<label class="admin-form-label">Item Image</label>
							<input type="file" class="admin-form-control" name="image" accept="image/*" required>
						</div>
						<button type="submit" class="admin-btn admin-btn-primary w-100" name="createItem">
							<i class="fas fa-plus"></i> Add Item
						</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Menu Items List -->
		<div class="col-md-8">
			<div class="admin-card">
				<div class="admin-card-header">
					<h2 class="mb-0">Menu Items</h2>
				</div>
				<div class="admin-card-body">
					<div class="table-responsive">
						<table class="admin-table">
							<thead>
								<tr>
									<th>Category</th>
									<th>Image</th>
									<th>Details</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql = "SELECT p.*, c.categorieName 
										   FROM `pizza` p 
										   JOIN `categories` c ON p.pizzaCategorieId = c.categorieId 
										   ORDER BY p.pizzaId DESC";
									$result = mysqli_query($conn, $sql);
									while($row = mysqli_fetch_assoc($result)){
										$pizzaId = $row['pizzaId'];
										$pizzaName = $row['pizzaName'];
										$pizzaPrice = $row['pizzaPrice'];
										$pizzaDesc = $row['pizzaDesc'];
										$categoryName = $row['categorieName'];

										echo '<tr>
												<td>' . htmlspecialchars($categoryName) . '</td>
												<td>
													<img src="/OnlinePizzaDelivery/img/pizza-' . $pizzaId . '.jpg" 
														 alt="' . htmlspecialchars($pizzaName) . '" 
														 class="img-thumbnail" 
														 style="width: 100px; height: 100px; object-fit: cover;">
												</td>
												<td>
													<h5 class="mb-1">' . htmlspecialchars($pizzaName) . '</h5>
													<p class="text-muted mb-1">' . htmlspecialchars($pizzaDesc) . '</p>
													<p class="mb-0"><strong>₹' . $pizzaPrice . '</strong></p>
												</td>
												<td>
													<div class="d-flex gap-2 justify-content-center">
														<button class="admin-btn admin-btn-primary" 
																data-toggle="modal" 
																data-target="#updateItem' . $pizzaId . '">
															<i class="fas fa-edit"></i>
														</button>
														<form action="partials/_menuManage.php" method="POST" class="d-inline">
															<input type="hidden" name="pizzaId" value="' . $pizzaId . '">
															<button type="submit" name="removeItem" class="admin-btn admin-btn-danger">
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

<!-- Update Item Modals -->
<?php
	$sql = "SELECT p.*, c.categorieName 
			FROM `pizza` p 
			JOIN `categories` c ON p.pizzaCategorieId = c.categorieId";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)){
		$pizzaId = $row['pizzaId'];
		$pizzaName = $row['pizzaName'];
		$pizzaPrice = $row['pizzaPrice'];
		$pizzaDesc = $row['pizzaDesc'];
		$pizzaCategorieId = $row['pizzaCategorieId'];
?>
<div class="modal fade" id="updateItem<?php echo $pizzaId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateItemLabel<?php echo $pizzaId; ?>" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="admin-modal-content">
			<div class="admin-modal-header">
				<h5 class="modal-title" id="updateItemLabel<?php echo $pizzaId; ?>">Update Menu Item</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
				<div class="admin-modal-body">
					<div class="admin-form-group">
						<label class="admin-form-label">Item Name</label>
						<input type="text" class="admin-form-control" name="name" value="<?php echo htmlspecialchars($pizzaName); ?>" required>
					</div>
					<div class="admin-form-group">
						<label class="admin-form-label">Description</label>
						<textarea class="admin-form-control" name="desc" rows="3" required><?php echo htmlspecialchars($pizzaDesc); ?></textarea>
					</div>
					<div class="admin-form-group">
						<label class="admin-form-label">Price</label>
						<input type="number" class="admin-form-control" name="price" value="<?php echo $pizzaPrice; ?>" min="1" required>
					</div>
					<div class="admin-form-group">
						<label class="admin-form-label">Category</label>
						<select name="catId" class="admin-form-control" required>
							<?php
								$catsql = "SELECT * FROM `categories`"; 
								$catresult = mysqli_query($conn, $catsql);
								while($catrow = mysqli_fetch_assoc($catresult)){
									$selected = ($catrow['categorieId'] == $pizzaCategorieId) ? 'selected' : '';
									echo '<option value="' . $catrow['categorieId'] . '" ' . $selected . '>' . $catrow['categorieName'] . '</option>';
								}
							?>
						</select>
					</div>
					<div class="admin-form-group">
						<label class="admin-form-label">Item Image</label>
						<input type="file" class="admin-form-control" name="image" accept="image/*">
						<small class="form-text text-muted">Leave empty to keep current image</small>
					</div>
					<input type="hidden" name="pizzaId" value="<?php echo $pizzaId; ?>">
				</div>
				<div class="admin-modal-footer">
					<button type="button" class="admin-btn admin-btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="updateItem" class="admin-btn admin-btn-primary">Update Item</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>