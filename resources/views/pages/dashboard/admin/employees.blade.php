<x-main-template :title="$title" :fragment="$fragment" :dashboardLink="$dashboardLink" :js="$js" :totalRequests="$totalRequests">
    @include('partials._page-title')

   <div class="card">
       <div class="card-header">
           <div class="float-end">
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-employee-modal">
                   <i class="uil-plus"></i> Add New Employee
               </button>
           </div>
           <h5><strong>{{ $title }}</strong></h5>
       </div>
       <div class="card-body">
           <div class="table-responsive">
               <table id="employees-table" class="table bg-white" style="width: 100%">
                   <thead class="bg-light">
                   <tr>
                       <th class="text-center">Name</th>
                       <th class="text-center">Email</th>
                       <th class="text-center">Designation</th>
                       <th class="text-center">Office</th>
                       <th class="text-center">Actions</th>
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

    <div id="add-employee-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="add-employee-form" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="uil-plus"></i> Add Employee</h5>
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-end">Information</h6>
                    <div class="form-group mb-2 row">
                        <label class="col-3">Name</label>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" placeholder="Enter the employee name">
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-3">Designation</label>
                        <div class="col-9">
                            <input type="text" name="designation" class="form-control" placeholder="Enter the employee designation">
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-3">Office</label>
                        <div class="col-9">
                            <input type="text" name="office" class="form-control" placeholder="Enter the employee's office">
                        </div>
                    </div>
                    <h6 class="text-end">Account</h6>
                    <div class="form-group mb-2 row">
                        <label class="col-3">Email</label>
                        <div class="col-9">
                            <input type="email" name="email" class="form-control" placeholder="Enter the employee's email">
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-3">Password</label>
                        <div class="col-9">
                            <input type="password" name="password" class="form-control" placeholder="Enter the employee's password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="role" value="Employee">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>

    <div id="edit-employee-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="edit-employee-form" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="uil-edit"></i> Edit Employee</h5>
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-end">Information</h6>
                    <div class="form-group mb-2 row">
                        <label class="col-3">Name</label>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" placeholder="Enter the employee name">
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-3">Designation</label>
                        <div class="col-9">
                            <input type="text" name="designation" class="form-control" placeholder="Enter the employee designation">
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-3">Office</label>
                        <div class="col-9">
                            <input type="text" name="office" class="form-control" placeholder="Enter the employee's office">
                        </div>
                    </div>
                    <h6 class="text-end">Account</h6>
                    <div class="form-group mb-2 row">
                        <label class="col-3">Email</label>
                        <div class="col-9">
                            <input type="email" name="email" class="form-control" placeholder="Enter the employee's email">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id">
                    <input type="hidden" name="role" value="Employee">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>

</x-main-template>
