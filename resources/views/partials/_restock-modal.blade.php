<div id="restock-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form id="restock-form" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <i class="uil-file-plus"></i> Restock Item</h5>
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2 row">
                    <label class="col-3">Item Name</label>
                    <div class="col-9">
                        <input type="text" name="name" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group mb-2 row">
                    <label class="col-3">Current Stock</label>
                    <div class="col-9">
                        <input type="text" name="stock" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group mb-2 row">
                    <label class="col-3">Quantity</label>
                    <div class="col-9">
                        <input type="number" name="quantity" class="form-control" placeholder="Enter quantity of item">
                    </div>
                </div>
                <div class="form-group mb-2 row">
                    <label class="col-3">Cost</label>
                    <div class="col-9">
                        <input type="number" name="cost" class="form-control" placeholder="0" min="0" value="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$">
                    </div>
                </div>
                <div class="form-group mb-2 row">
                    <label class="col-3">Supplier</label>
                    <div class="col-9">
                        <input type="text" name="supplier" class="form-control" placeholder="Enter supplier name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="item_id">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Stock</button>
            </div>
        </form>
    </div>
</div>
