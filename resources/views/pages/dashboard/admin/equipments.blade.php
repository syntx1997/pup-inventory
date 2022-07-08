<x-main-template :title="$title" :fragment="$fragment" :dashboardLink="$dashboardLink" :js="$js">
    @include('partials._page-title')

    <div class="text-end mb-4">
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add-equipment-modal">
            <i class="uil-plus"></i> Add Equipment Item
        </button>
    </div>

    <div class="table-responsive">
        <table id="equipments-table" class="table bg-white" style="width: 100%">
            <thead class="bg-light">
            <tr>
                <th class="text-center"></th>
                <th class="text-center">Category</th>
                <th class="text-center">Item Name</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Critical Stock</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="6">no data</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div id="add-equipment-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="add-equipment-form" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="uil-plus"></i> Add Equipment Item</h5>
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2 row">
                        <label class="col-3">Category</label>
                        <div class="col-9">
                            <select name="category_id" class="form-select">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-3">Item Name</label>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" placeholder="Enter item name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Description</label>
                        <div class="col-9">
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type" value="equipment">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Add</button>
                </div>
            </form>
        </div>
    </div>

    <div id="edit-equipment-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="edit-equipment-form" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="uil-edit"></i> Edit Equipment Item</h5>
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2 row">
                        <label class="col-3">Category</label>
                        <div class="col-9">
                            <select name="category_id" class="form-select">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-3">Item Name</label>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" placeholder="Enter item name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Description</label>
                        <div class="col-9">
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type" value="equipment">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Edit</button>
                </div>
            </form>
        </div>
    </div>

    @include('partials._restock-modal')

    <div id="critical-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="critical-form" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="uil-edit"></i> Update Critical Stock Value</h5>
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
                        <label class="col-3">Critical Value</label>
                        <div class="col-9">
                            <input type="number" name="critical" class="form-control" placeholder="Enter your desired value">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="item_id">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Update</button>
                </div>
            </form>
        </div>
    </div>

</x-main-template>
