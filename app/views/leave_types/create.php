<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Add Leave Type</h1>
</div>
<div class="wrapper-md" ng-init="resetData()">
    <div flash-message="5000"></div>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Add Leave Type</strong>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="required field"
                                           ng-model="data.leave_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Title</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="required field"
                                           ng-model="data.leave_title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Comment</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="required field"
                                           ng-model="data.leave_comment">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Start After</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-pattern="/^(\d)+$/"
                                           placeholder="required field"
                                           ng-model="data.start_duration">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Total Leaves</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-pattern="/^(\d)+$/"
                                           placeholder="required field"
                                           ng-model="data.total_leaves">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Total Leaves Type</label>

                                <div class="col-sm-9">
                                    <select class="form-control" ng-model="data.total_leaves_type"
                                            ng-options="item.key as item.value for item in [{key:'month',value:'Month'},{key:'year',value:'Year'}]"></select>
                                </div>
                            </div>

                            <footer class="panel-footer text-right bg-light lter">
                                <button type="submit" ng-disabled="!formValidate.$valid" class="btn btn-success"
                                        ng-click="create()">Submit
                                </button>
                            </footer>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>