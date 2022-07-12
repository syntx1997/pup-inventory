<div id="delete-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form id="delete-form" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <i class="uil-trash"></i> Delete</h5>
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-3">Enter Password</label>
                    <div class="col-9">
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="id">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </div>
        </form>
    </div>
</div>
