<x-main-template :title="$title" :fragment="$fragment" :dashboardLink="$dashboardLink">
    @include('partials._page-title')

    <div class="text-end mb-4">
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add-supply-modal">
            <i class="uil-plus"></i> Add Supply Item
        </button>
    </div>

    <div class="table-responsive">
        <table id="supplies-table" class="table bg-white" style="width: 100%">
            <thead class="bg-light">
            <tr>
                <th class="text-center">Category</th>
                <th class="text-center">Supply</th>
                <th class="text-center">Stock</th>
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

</x-main-template>
