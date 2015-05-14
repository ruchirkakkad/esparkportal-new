<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Company Details</h1>
</div>
<div class="wrapper-md">
    <div flash-message="5000"></div>
    <div>
        <div class="row" ng-init="indexData()">
            <div class="col-sm-9">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Company Details
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Company Name</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-model="data.company_details.company_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Company Url</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-model="data.company_details.company_url">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Company Address</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-model="data.company_details.company_address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Company Phone</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-model="data.company_details.company_phone">
                                </div>
                            </div>
                        </div>
                        <div class="panel-heading">
                            Contact Person
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">First Name</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-model="data.company_details.cp_first_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Last Name</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-model="data.company_details.cp_last_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-model="data.company_details.cp_email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-model="data.company_details.cp_phone">
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