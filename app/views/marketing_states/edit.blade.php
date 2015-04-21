<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Edit States</h1>
</div>
<div class="wrapper-md">
<div flash-message="5000" ></div>
  <div>
    <div class="row" ng-init="editData()">
      <div class="col-sm-6">
        <form name="formValidate" class="form-horizontal form-validation" novalidate>
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Edit States</strong>
            </div>
            <div class="panel-body">                    
              <div class="form-group">
                  <label class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-9">
                    <input type="text" name="marketing_states_name" class="form-control" placeholder="required field" ng-model="data.marketing_states_name" required="">
                  </div>
                </div>
                <div class="line line-dashed b-b line-lg pull-in"></div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Country</label>
                    <div class="col-sm-9">
                      <select ng-model="data.marketing_countries_id" name="marketing_countries_id" class="form-control m-t" ng-options="selectedItem.marketing_countries_id as selectedItem.marketing_countries_name for selectedItem in data.countries" required>
                           <option value="">Select Country</option>
                       </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Timezones</label>
                    <div class="col-sm-9">

                      <select ng-model="data.timezones_id" name="timezones_id" class="form-control m-t" ng-options="selectedItem.timezones_id as selectedItem.timezones_name for selectedItem in data.timezones" required>
                           <option value="">Select Timezones</option>
                       </select>
                    </div>
                  </div>

            <footer class="panel-footer text-right bg-light lter">
              <button ng-disabled="formValidate.timezones_id.$invalid || formValidate.timezones_id.$invalid || formValidate.marketing_states_name.$invalid" type="submit" class="btn btn-success" ng-click="update()">Submit</button>
            </footer>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>