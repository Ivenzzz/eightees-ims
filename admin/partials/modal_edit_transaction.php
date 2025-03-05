<!-- Edit Transaction Modal -->
<div class="modal fade" id="editTransactionModal<?= $transaction['project_transaction_id'] ?>" tabindex="-1" aria-labelledby="editTransactionLabel<?= $transaction['project_transaction_id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTransactionLabel<?= $transaction['project_transaction_id'] ?>">
                    <i class="bi bi-pencil-square"></i> Edit Transaction
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../controllers/admin_update_transaction.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="transaction_id" value="<?= $transaction['project_transaction_id'] ?>">

                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-people"></i> Team Name</label>
                        <input type="text" class="form-control" name="team_name" value="<?= htmlspecialchars($transaction['team_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-tag"></i> Category</label>
                        <select class="form-select" name="category_id" required>
                            <?php
                            $categories = getTransactionCategories($conn);
                            foreach ($categories as $category) :
                            ?>
                                <option value="<?= $category['category_id'] ?>" <?= $category['category_id'] == $transaction['category_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['category_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-file-earmark-text"></i> Description</label>
                        <textarea class="form-control" name="description"><?= htmlspecialchars($transaction['description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-file-image"></i> Design File</label>
                        <input type="file" class="form-control" name="design_file">
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-hash"></i> Quantity</label>
                        <input type="number" class="form-control" name="quantity" value="<?= $transaction['quantity'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-cash"></i> Amount</label>
                        <input type="number" class="form-control" name="amount" value="<?= $transaction['amount'] ?>" step="0.01" required>
                    </div>

                    <!-- Downpayment Field -->
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-wallet2"></i> Downpayment</label>
                        <input type="number" class="form-control" name="downpayment" value="<?= $transaction['downpayment'] ?>" step="0.01" min="0" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
