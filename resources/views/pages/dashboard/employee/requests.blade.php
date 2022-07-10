<x-main-template :title="$title ?? ''" :fragment="$fragment ?? ''" :dashboardLink="$dashboardLink ?? ''" :js="$js ?? ''">
    @include('partials._page-title')

    <div class="card">
        <div class="card-header">
            <div class="float-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#request-modal">
                    <i class="uil-plus"></i> Request Supply / Equipment
                </button>
            </div>
            <h5><strong>{{ $title }}</strong></h5>
        </div>
        <div class="card-body table-responsive">
            <table id="requests-table" class="table table-striped" style="width: 100%">
                <thead>
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center">Transaction ID</th>
                    <th class="text-center">Requestor</th>
                    <th class="text-center">Office</th>
                    <th class="text-center">Status</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div id="request-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form id="request-form" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="uil-plus"></i> Request Supply / Equipment</h5>
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pb-3">
                    <div class="row mb-3">
                        <label class="col-3">Choose Item Type</label>
                        <div class="col-9">
                            <select name="type" class="form-select">
                                <option value="supply?">Supply</option>
                                <option value=equipment?">Equipment</option>
                            </select>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        <i class="uil-info-circle"></i> Click the row to select the item(s) you want to request.
                    </div>
                    <div class="table-responsive">
                        <table id="items-table" class="table border" style="width: 100%">
                           <thead>
                           <tr>
                               <th class="text-center">Category</th>
                               <th class="text-center">Item Name</th>
                               <th class="text-center">Description</th>
                               <th class="text-center">Stock</th>
                           </tr>
                           </thead>
                        </table>
                    </div>
                    <div class="float-end text-end mt-2"></div>
                    <button type="button" class="btn btn-outline-dark" id="move-requests-btn"> <i class="uil-arrow-down"></i> Move to the Request Table</button>
                    <button type="button" class="btn btn-outline-danger" id="reset-btn"> <i class="uil-refresh"></i> Reset</button>
                </div>
                <div class="card-body border-top">
                    <h5>Review Item(s)</h5>
                </div>
                <div class="table-responsive">
                    <table id="toRequest-table" class="table border-top" style="width: 100%">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">Type</th>
                            <th class="text-center">Item Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Request</button>
                </div>
            </form>
        </div>
    </div>

</x-main-template>
