<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Edit Data</h1>
</div>
<div class="wrapper-md">
    <div flash-message="5000"></div>
    <div>
        <div class="row" ng-init="editData()">
            <div class="col-sm-12">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Edit Data</strong>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Owener Name</label>

                                <div class="col-sm-9">
                                    <input type="text" name="owner_name" class="form-control" placeholder=""
                                           ng-model="data.owner_name" required="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Company Name</label>

                                <div class="col-sm-9">
                                    <input type="text" name="company_name" class="form-control" placeholder=""
                                           ng-model="data.company_name" required="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Website</label>

                                <div class="col-sm-9">
                                    <input type="text" name="website" class="form-control" placeholder=""
                                           ng-model="data.website" required="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" placeholder=""
                                           ng-model="data.email" required="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Phone</label>

                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="form-control" placeholder=""
                                           ng-model="data.phone" required="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Categories</label>

                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="form-control" placeholder=""
                                           ng-model="data.marketing_categories_name" required="" disabled>
                                </div>

                            </div>

                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">States</label>

                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="form-control" placeholder=""
                                           ng-model="data.marketing_states_name" required="" disabled>
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <footer class="panel-footer text-right bg-light lter">
                                <button
                                    ng-disabled="formValidate.website.$invalid"
                                    type="submit" class="btn btn-success" ng-click="update()">Submit
                                </button>
                            </footer>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>