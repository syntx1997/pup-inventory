<x-main-template :title="$title" :fragment="$fragment" :dashboardLink="$dashboardLink" :js="$js" :totalRequests="$totalRequests">
    @include('partials._page-title')

    <div class="card">
        <div class="card-header">
            <h5><strong>{{ $title }}</strong></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <h5 class="mb-3 text-muted text-end"><strong>INFORMATION</strong></h5>
                    <form id="update-info-form">
                        <div class="mb-3 row">
                            <label class="col-3">Name</label>
                            <div class="col-9">
                                <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3">Designation</label>
                            <div class="col-9">
                                <input type="text" name="designation" class="form-control" value="{{ auth()->user()->designation }}" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3">Office</label>
                            <div class="col-9">
                                <input type="text" name="office" class="form-control" value="{{ auth()->user()->office }}" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3">Email</label>
                            <div class="col-9">
                                <input type="text" name="email" class="form-control" value="{{ auth()->user()->office }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-9">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Update Information</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <h5 class="mb-3 text-muted text-end"><strong>PASSWORD</strong></h5>
                    <form id="update-password-form">
                        <div class="mb-3 row">
                            <label class="col-3">Current Password</label>
                            <div class="col-9">
                                <input type="password" name="current_password" class="form-control" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3">New Password</label>
                            <div class="col-9">
                                <input type="password" name="designation" class="form-control" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3">Confirm New Password</label>
                            <div class="col-9">
                                <input type="text" name="confirm_password" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-9">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-main-template>
