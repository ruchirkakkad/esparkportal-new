<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Edit Department</h1>
</div>
<div class="wrapper-md">
<div flash-message="5000" ></div>
  <div>
    <div class="row" ng-init="editData()">
      <div class="col-sm-6">
        <form name="formValidate" class="form-horizontal form-validation" novalidate>
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Edit Department</strong>
            </div>
            <div class="panel-body">                    
              <div class="form-group">
                <label class="col-sm-3 control-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" ng-pattern="/^(\D)+$/"  class="form-control" placeholder="required field" ng-model="data.departments_name">
                </div>
              </div>

            <footer class="panel-footer text-right bg-light lter">
              <button type="submit" ng-disabled="!formValidate.$valid" class="btn btn-success" ng-click="update()">Submit</button>
            </footer>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>