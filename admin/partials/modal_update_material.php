<!-- Edit Material Modal -->
<div class="modal fade" id="editModal<?= $material['material_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $material['material_id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editModalLabel<?= $material['material_id'] ?>">Edit Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../controllers/admin_update_material.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="material_id" value="<?= $material['material_id'] ?>">

                    <div class="mb-3">
                        <label for="name<?= $material['material_id'] ?>" class="form-label">Material Name</label>
                        <input type="text" class="form-control" id="name<?= $material['material_id'] ?>" name="name" value="<?= htmlspecialchars($material['name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="category<?= $material['material_id'] ?>" class="form-label">Category</label>
                        <select class="form-select" id="category<?= $material['material_id'] ?>" name="category_id" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['category_id'] ?>" <?= ($category['category_id'] == $material['category_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['category_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description<?= $material['material_id'] ?>" class="form-label">Description</label>
                        <textarea class="form-control" id="description<?= $material['material_id'] ?>" name="description" required><?= htmlspecialchars($material['description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="amount<?= $material['material_id'] ?>" class="form-label">Amount (₱)</label>
                        <input type="number" class="form-control" id="amount<?= $material['material_id'] ?>" name="amount" value="<?= $material['amount'] ?>" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="quantity<?= $material['material_id'] ?>" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity<?= $material['material_id'] ?>" name="quantity" value="<?= $material['quantity'] ?>" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="supplier<?= $material['material_id'] ?>" class="form-label">Supplier</label>
                        <input type="text" class="form-control" id="supplier<?= $material['material_id'] ?>" name="supplier" value="<?= htmlspecialchars($material['supplier']) ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>