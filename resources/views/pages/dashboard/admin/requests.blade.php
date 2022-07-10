<x-main-template :title="$title" :fragment="$fragment" :dashboardLink="$dashboardLink" :totalRequests="$totalRequests" :js="$js">
    @include('partials._page-title')

    <div class="card">
        <div class="card-body table-responsive">
            <table id="requests-table" class="table table-striped">
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

</x-main-template>
