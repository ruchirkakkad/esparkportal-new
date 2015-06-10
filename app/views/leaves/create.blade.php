<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Add Leave</h1>
</div>
<div class="wrapper-md" ng-init="resetData()">
    <div flash-message="5000"></div>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Add Leave</strong>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Subject</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="required field"
                                           ng-model="data.subject">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Leave Type</label>
                                <div class="col-sm-9">
                                    <select ng-model="data.leave_types_id" name="leave_types_id" class="form-control" ng-options="selectedItem.leave_types_id as selectedItem.leave_title for selectedItem in data.leave_types" required>
                                        <option value="">Select Leave Type</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date</label>
                                <div class="col-sm-9">
                                    <input type="daterange" ng-model="data.leave_date" class="form-control">
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label class="col-sm-3 control-label">Date</label>--}}
                                {{--<div class="col-sm-9" ng-controller="DatepickerDemoCtrl">--}}
                                    {{--<div class="input-group w-md">--}}
                                        {{--<input type="text" class="form-control" datepicker-popup="yyyy-MM-dd" ng-model="data.leave_date"--}}
                                               {{--is-open="opened" datepicker-options="dateOptions" ng-required="true" close-text="Close"  ng-click="open($event)"/>--}}
                                    {{--<span class="input-group-btn">--}}
                                        {{--<button type="button" class="btn btn-default" ng-click="open($event)"><i--}}
                                                {{--class="glyphicon glyphicon-calendar"></i></button>--}}
                                    {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description</label>

                                <div class="col-sm-9">
                                    <textarea placeholder="Type your message" rows="3" ng-model="data.description" class="form-control"></textarea>
                                </div>
                            </div>
                            <footer class="panel-footer text-right bg-light lter">
                                <button type="submit" class="btn btn-success" ng-click="create()">Submit</button>
                            </footer>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>