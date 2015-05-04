<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Edit User</h1>
</div>
<div class="wrapper-md">
    <div flash-message="5000" ></div>
    <div>
        <div class="row" ng-init="editChangeApproveData()">
            <div class="col-sm-6">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <!--                        <div class="panel-heading">
                                                    <strong>Edit User</strong>
                                                </div>-->
                        <div class="panel-body">                    
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name :</label>
                                <div class="col-sm-9">
                                    <input class="form-control" disabled value="{{data.userApproveData.users.first_name}} {{data.userApproveData.users.last_name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Employee ID</label>
                                <div class="col-sm-9">
                                    <input  class="form-control" placeholder="required field" ng-model="data.userApproveData.users.employee_id" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date Of Joining</label>
                                <div class="col-sm-9" ng-controller="DatepickerDemoCtrl" ng-init="data.userApproveData.users.doj = ''">
                                    <div class="input-group w-md">
                                        <input type="text" class="form-control" datepicker-popup="yyyy-MM-dd" ng-model="data.userApproveData.users.dateJoin" is-open="opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Company Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" placeholder="required field" ng-model="data.userApproveData.users.email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" placeholder="required field" ng-model="data.userApproveData.users.password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Department</label>
                                <div class="col-sm-9">
                                    <select type="text" class="form-control" placeholder="required field" ng-model="data.userApproveData.users.department_id" ng-options="selectedItem.departments_id as selectedItem.departments_name for selectedItem in data.userApproveData.department" required>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Designation</label>
                                <div class="col-sm-9">
                                    <select type="text" class="form-control" placeholder="required field" ng-model="data.userApproveData.users.designation_id" ng-options="data.userApproveData.designation.indexOf(selectedItem) as selectedItem.designations_name for selectedItem in data.userApproveData.designation" required></select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Job Profile</label>
                                <div class="col-sm-9">
                                    <select type="text" class="form-control" placeholder="required field" ng-model="data.userApproveData.users.job_profile" ng-options="selectedItem.job_profiles_id as selectedItem.job_profiles_name for selectedItem in data.userApproveData.designation[data.userApproveData.users.designation_id].job_profiles" required></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Role</label>
                                <div class="col-sm-9">
                                    <select type="text" class="form-control" placeholder="required field" ng-model="data.userApproveData.users.role_id" ng-options="selectedItem.id as selectedItem.name for selectedItem in data.userApproveData.role" required></select>
                                </div></div>
                        </div>

                        <footer class="panel-footer text-right bg-light lter">
                            <button type="submit" class="btn btn-success" ng-click="saveApprovedUpdate()">Submit</button>
                        </footer>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>