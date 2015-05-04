<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Edit Designation</h1>
</div>
<div class="wrapper-md">
    <div flash-message="5000"></div>
    <div>
        <div class="row" ng-init="editData()">
            <div class="col-sm-6">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Add Job Profile</strong>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="required field"
                                           ng-model="data.job_profiles_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Designations</label>

                                <div class="col-sm-9">
                                    <select ng-model="data.designations_id" name="designations_id"
                                            class="form-control"
                                            ng-options="selectedItem.designations_id as selectedItem.designations_name for selectedItem in data.designations"
                                            required>
                                        <option value="">Select Designation</option>
                                    </select>
                                </div>
                            </div>
                            <footer class="panel-footer text-right bg-light lter">
                                <button type="submit" class="btn btn-success" ng-click="update()">Submit</button>
                            </footer>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>