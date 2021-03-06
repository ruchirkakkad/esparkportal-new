<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">General Settings</h1>
</div>
<div class="wrapper-md">
<div flash-message="5000" ></div>
  <div>
    <div class="row" ng-init="editData()">
      <div class="col-sm-6">
        <form name="formValidate" class="form-horizontal form-validation" novalidate>
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>General Settings</strong>
            </div>
            <div class="panel-body">                    
              <div class="form-group" ng-repeat="field in data.fields">
                <label class="col-sm-3 control-label">@{{ field.title }}</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="required field" ng-model="field.value">
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