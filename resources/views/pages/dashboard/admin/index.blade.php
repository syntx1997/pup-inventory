<x-main-template :title="$title" :fragment="$fragment" :dashboardLink="$dashboardLink" :totalRequests="$totalRequests">
    @include('partials._page-title')

    <div class="row">
        <div class="col-xl-5 col-lg-6">

            <div class="row">
                <div class="col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-refresh-circle widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">On Process (Requests)</h5>
                            <h3 class="mt-3 mb-3">{{ count(\App\Models\Transaction::where('status', 'On Process')->get()) }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-thumb-up widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Accepted (Requests)</h5>
                            <h3 class="mt-3 mb-3">{{ count(\App\Models\Transaction::where('status', 'Accepted')->get()) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-thumb-down widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Declined (Requests)</h5>
                            <h3 class="mt-3 mb-3">{{ count(\App\Models\Transaction::where('status', 'Declined')->get()) }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-human widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Growth">Employees</h5>
                            <h3 class="mt-3 mb-3">{{ count(\App\Models\User::where('role', 'Employee')->get()) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-7 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h4 class="header-titl">Request History</h4>
                </div>
                <div class="card-body" style="overflow-y: scroll; height: 200px">
                    <table class="table table-striped">
                        @foreach(\App\Models\Request::all()->sortByDesc('id') as $request)
                            <?php
                                $item = \App\Models\Item::where('id', $request->item_id)->first();
                                $transaction = \App\Models\Transaction::where('id', $request->transaction_id)->first();
                                $user = \App\Models\User::where('id', $transaction->user_id)->first();
                            ?>
                            <tr>
                                <td class="text-center">{{ \Carbon\Carbon::parse($request->created_at)->format('M d, Y') }}</td>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->office }}</td>
                                <td colspan="text-center">{{ $item->name }}</td>
                                <td colspan="text-center">{{ $request->quantity }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>

</x-main-template>
