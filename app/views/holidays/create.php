<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Add Holiday</h1>
</div>
<div class="wrapper-md" ng-init="resetData()">
    <div flash-message="5000"></div>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Add Holiday</strong>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="required field"
                                           ng-model="data.holidays_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date</label>

                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <div class="col-sm-9" ng-controller="DatepickerDemoCtrl">
                                            <div class="input-group w-md">
                                                <input type="text" class="form-control" datepicker-popup="yyyy-MM-dd"
                                                       ng-model="data.holidays_date"
                                                       is-open="opened" datepicker-options="dateOptions"
                                                       ng-required="true" close-text="Close"/>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" ng-click="open($event)"><i
                                                            class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <footer class="panel-footer text-right bg-light lter">
                                <button type="submit" class="btn btn-success" ng-click="create()">Submit</button>
                            </footer>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>