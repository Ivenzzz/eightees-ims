<!-- Add Downpayment Modal for Each Transaction -->
<div class="modal fade" id="addDownpaymentModal<?= $transaction['project_transaction_id'] ?>" tabindex="-1" aria-labelledby="addDownpaymentLabel<?= $transaction['project_transaction_id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDownpaymentLabel<?= $transaction['project_transaction_id'] ?>">
                    <i class="bi bi-wallet2"></i> Add Downpayment
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../controllers/admin_add_downpayment.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="transaction_id" value="<?= $transaction['project_transaction_id'] ?>">
                    <div class="mb-3">
                        <label for="newDownpayment<?= $transaction['project_transaction_id'] ?>" class="form-label">
                            <i class="bi bi-currency-dollar"></i> Downpayment Amount
                        </label>
                        <input type="number" class="form-control" name="new_downpayment" id="newDownpayment<?= $transaction['project_transaction_id'] ?>" step="0.01" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-cash-stack"></i> Add Downpayment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>