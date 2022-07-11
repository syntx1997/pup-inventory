<x-main-template :title="$title" :fragment="$fragment" :dashboardLink="$dashboardLink" :totalRequests="$totalRequests" :js="$js">
    @include('partials._page-title')

    <div class="card">
        <div class="card-body table-responsive">
            <table id="requests-table" class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center">Request Date</th>
                    <th class="text-center">Transaction ID</th>
                    <th class="text-center">Requestor</th>
                    <th class="text-center">Office</th>
                    <th class="text-center">Status</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div id="accept-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="accept-form" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="uil-thumbs-up"></i> Accept Request</h5>
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-3">Transaction ID</label>
                        <div class="col-9">
                            <strong><span id="transaction-id-text"></span></strong>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-3">Requestor</label>
                        <div class="col-9">
                            <strong><span id="requestor-text"></span></strong>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-3">Message <span class="text-muted">(Optional)</span></label>
                        <div class="col-9">
                            <textarea name="message" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Accept</button>
                </div>
            </form>
        </div>
    </div>

    <div id="decline-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="decline-form" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="uil-thumbs-down"></i> Decline Request</h5>
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-3">Transaction ID</label>
                        <div class="col-9">
                            <strong><span id="transaction-id-text"></span></strong>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-3">Requestor</label>
                        <div class="col-9">
                            <strong><span id="requestor-text"></span></strong>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-3">Reason <span class="text-muted">(Required)</span></label>
                        <div class="col-9">
                            <textarea name="message" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-danger">Decline</button>
                </div>
            </form>
        </div>
    </div>

</x-main-template>
