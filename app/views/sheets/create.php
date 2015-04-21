<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Add Sheets</h1>
</div>
<div class="wrapper-md" ng-init="resetData()">
<div flash-message="5000" ></div>
  <div>
    <div class="row">
      <div class="col-sm-6">
        <form name="formValidate" class="form-horizontal form-validation" novalidate>
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Add Sheets</strong>
            </div>
            <div class="panel-body">
             <div class="form-group">
               <label class="col-sm-3 control-label">Date</label>
               <div class="col-sm-9" ng-controller="DatepickerDemoCtrl">
                 <div class="input-group w-md">
                   <input type="text" class="form-control" datepicker-popup="{{format}}" ng-model="data.input_date" is-open="opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" />
                   <span class="input-group-btn">
                     <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                   </span>
                 </div>
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
                <div class="line line-dashed b-b line-lg pull-in"></div>
               <div class="form-group">
                 <label class="col-sm-3 control-label">Category</label>
                 <div class="col-sm-9">

                   <select ng-model="data.marketing_categories_id" name="marketing_categories_id" class="form-control m-t" ng-options="selectedItem.marketing_categories_id as selectedItem.marketing_categories_name for selectedItem in data.categories" required>
                        <option value="">Select Category</option>
                    </select>
                 </div>
               </div>

             <footer class="panel-footer text-right bg-light lter">
               <button ng-disabled="formValidate.marketing_categories_id.$invalid || formValidate.marketing_countries_id.$invalid || formValidate.input_date.$invalid" type="submit" class="btn btn-success" ng-click="create()">Submit</button>
             </footer>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>