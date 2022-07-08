<x-main-template :title="$title" :fragment="$fragment" :dashboardLink="$dashboardLink" :js="$js">
    @include('partials._page-title')

    <div class="card">
        <ul class="nav nav-tabs nav-bordered mb-3">
            <li class="nav-item p-2 pb-0">
                <a href="#supplies-tb" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                    <i class="mdi mdi-cart d-md-none d-block"></i>
                    <span class="d-none d-md-block"> <i class="uil-cart"></i> Supply</span>
                </a>
            </li>
            <li class="nav-item p-2 pb-0">
                <a href="#equipments-tb" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                    <i class="mdi mdi-toolbox d-md-none d-block"></i>
                    <span class="d-none d-md-block"> <i class="uil-print"></i> Equipment</span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane show active table-responsive" id="supplies-tb">
                <div class="card-body">
                    <table id="supply-table" class="table display nowrap" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Stocks</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="equipments-tb">
                <div class="card-body">
                    <table id="equipment-table" class="table display nowrap" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Stocks</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-main-template>
