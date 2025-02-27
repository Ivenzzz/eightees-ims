<!-- Add Material Modal -->
<div class="modal fade" id="addMaterialModal" tabindex="-1" aria-labelledby="addMaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content text-sm">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addMaterialModalLabel">
                    <i class="bi bi-plus-circle"></i> Add New Material
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMaterialForm" action="../controllers/admin_add_material.php" method="POST">
                    <div class="mb-4">
                        <label for="materialName" class="form-label">
                            <i class="bi bi-tag"></i> Material Name
                        </label>
                        <input type="text" class="form-control" id="materialName" name="name" required>
                    </div>
                    <div class="mb-4">
                        <label for="category" class="form-label">
                            <i class="bi bi-list-ul"></i> Category
                        </label>
                        <select class="form-select" id="category" name="category_id" required>
                            <option value="" selected disabled>Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category['category_id']) ?>">
                                    <?= htmlspecialchars($category['category_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">
                            <i class="bi bi-file-text"></i> Description
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="form-label">
                            <i class="bi bi-currency-dollar"></i> Amount (₱)
                        </label>
                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                    </div>
                    <div class="mb-4">
                        <label for="quantity" class="form-label">
                            <i class="bi bi-box"></i> Quantity
                        </label>
                        <input type="number" class="form-control" id="quantity" name="quantity" step="0.01" required>
                    </div>
                    <div class="mb-4">
                        <label for="supplier" class="form-label">
                            <i class="bi bi-truck"></i> Supplier
                        </label>
                        <input type="text" class="form-control" id="supplier" name="supplier" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Add Material
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>