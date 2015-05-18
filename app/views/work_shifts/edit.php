<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Edit Language</h1>
</div>
<div class="wrapper-md">
    <div flash-message="5000"></div>
    <div>
        <div class="row" ng-init="editData()">
            <div class="col-sm-6">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Edit Language</strong>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-model="data.work_shifts_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Staffing</label>

                                <div class="col-sm-9">
                                    <timepicker ng-model="data.staffing" hour-step="hstep" minute-step="mstep"
                                                show-meridian="ismeridian"></timepicker>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Office Time</label>

                                <label class="col-sm-1 control-label">Start</label>
                                <div class="col-sm-3">
                                    <timepicker ng-model="data.office_start_time"  hour-step="hstep" minute-step="mstep" show-meridian="ismeridian"></timepicker>
                                </div>
                                <label class="col-sm-1 control-label">End</label>
                                <div class="col-sm-3">
                                    <timepicker ng-model="data.office_end_time"  hour-step="hstep" minute-step="mstep" show-meridian="ismeridian"></timepicker>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Break Time</label>

                                <label class="col-sm-1 control-label">Start</label>
                                <div class="col-sm-3">
                                    <timepicker ng-model="data.break_start_time"  hour-step="hstep" minute-step="mstep" show-meridian="ismeridian"></timepicker>
                                </div>
                                <label class="col-sm-1 control-label">End</label>
                                <div class="col-sm-3">
                                    <timepicker ng-model="data.break_end_time"  hour-step="hstep" minute-step="mstep" show-meridian="ismeridian"></timepicker>
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