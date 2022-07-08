<x-main-template :title="$title" :fragment="$fragment" :dashboardLink="$dashboardLink" :js="$js">
    @include('partials._page-title')

    <div class="card">
        <div class="card-header">
            <div class="float-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-category-modal">
                    <i class="uil-plus"></i> Add Category
                </button>
            </div>
            <h5><strong>{{ $title }}</strong></h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="categories-table" class="table" style="width: 100%">
                    <thead class="bg-light">
                    <tr>
                        <th class="text-center">ID#</th>
                        <th class="text-center">Category Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center" colspan="3">no data</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="add-category-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="add-category-form" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="uil-plus"></i> Add Category</h5>
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3">Name</label>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" placeholder="Enter category name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>

    <div id="edit-category-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="edit-category-form" class="modal-content">
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="uil-edit"></i> Edit Category</h5>
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="notification"></div>
                    <div class="form-group row">
                        <label class="col-3">Name</label>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>

</x-main-template>
