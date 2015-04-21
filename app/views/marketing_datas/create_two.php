<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Add Data</h1>
</div>
<div class="wrapper-md" ng-init="resetData()">

    <div flash-message="5000" ></div>
    <div class="alert alert-danger" ng-repeat="(key, value) in errors">{{ key }} = {{ value }}</div>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Add Data</strong>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Owener Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="owner_name" class="form-control" placeholder="" ng-model="data.owner_name" required="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Company Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="company_name" class="form-control" placeholder="" ng-model="data.company_name" required="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Website</label>
                                <div class="col-sm-9">
                                    <input type="text" name="website" class="form-control" placeholder="" ng-model="data.website" required="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" placeholder="" ng-model="data.email" required="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="form-control" placeholder="" ng-model="data.phone" required="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-3 control-label">Categories</label>
                                <div class="col-sm-9">
                                    <select ng-model="data.marketing_categories_id" name="marketing_categories_id" class="form-control" ng-options="selectedItem.marketing_categories_id as selectedItem.marketing_categories_name for selectedItem in data.categories" required>
                                        <option value="">Select Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">States</label>
                                <div class="col-sm-11">
                                    <div class="radio col-sm-2" ng-repeat="state in data.states">
                                        <label class="i-checks">
                                            <input type="radio" name="marketing_states_id" ng-model="data.marketing_states_id" value="{{ state.marketing_states_id }}" >
                                            <i></i>
                                            {{ state.marketing_states_name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <footer class="panel-footer text-right bg-light lter">
                                <button ng-disabled="formValidate.marketing_categories_id.$invalid || formValidate.marketing_states_id.$invalid || formValidate.website.$invalid" type="submit" class="btn btn-success" ng-click="create()">Submit</button>
                            </footer>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>