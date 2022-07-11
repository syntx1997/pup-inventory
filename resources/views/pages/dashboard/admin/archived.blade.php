<x-main-template :title="$title" :fragment="$fragment" :dashboardLink="$dashboardLink" :js="$js" :totalRequests="$totalRequests">
    @include('partials._page-title')

    <div class="card">
        <div class="card-header">
            <h5><strong>{{ $title }}</strong></h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="archived-table" class="table bg-white" style="width: 100%">
                    <thead class="bg-light">
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Designation</th>
                        <th class="text-center">Office</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center" colspan="6">no data</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-main-template>
