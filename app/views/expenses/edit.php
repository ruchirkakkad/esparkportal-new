<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Edit Designation</h1>
</div>
<div class="wrapper-md">
    <div flash-message="5000"></div>
    <div>
        <div class="row" ng-init="editData()">
            <div class="col-sm-6">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Edit Designation</strong>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Expense Type</label>

                                <div class="col-sm-9">
                                    <select type="text" class="form-control"
                                            ng-model="data.expense_type"
                                            ng-options="selectedItem.id as selectedItem.val for selectedItem in [{id:'credit',val:'Credit'},{id:'debit',val:'Debit'}]"
                                            required>
                                        <option value="">Select Type</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" ng-if="data.expense_type == 'credit'">
                                <label class="col-sm-3 control-label">Payment Type</label>

                                <div class="col-sm-9">
                                    <select type="text" class="form-control"
                                            ng-model="data.amount_type"
                                            ng-options="selectedItem.id as selectedItem.val for selectedItem in [{id:'cash',val:'Cash'},{id:'cheque',val:'Cheque'}]"
                                            required>
                                        <option value="">Select Type</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group"
                                 ng-if="data.amount_type == 'cheque' && data.expense_type == 'credit'">
                                <label class="col-sm-3 control-label">Cheque Number</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="required field"
                                           ng-model="data.cheque_number">
                                </div>
                            </div>

                            <div class="form-group"
                                 ng-if="data.expense_type == 'debit' || data.expense_type == 'credit'">
                                <label class="col-sm-3 control-label">Amount</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" ng-pattern="/^(\d)+$/"  placeholder="required field"
                                           ng-model="data.amount" required>
                                </div>
                            </div>

                            <div class="form-group" ng-if="data.expense_type == 'debit'">
                                <label class="col-sm-3 control-label">Reason for Expense</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="required field"
                                           ng-model="data.reason">
                                </div>
                            </div>

                            <div class="form-group"
                                 ng-if="data.expense_type == 'debit' || data.expense_type == 'credit'">
                                <label class="col-sm-3 control-label">Date</label>

                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <div class="col-sm-9" ng-controller="DatepickerDemoCtrl">
                                            <div class="input-group w-md">
                                                <input type="text" class="form-control" datepicker-popup="yyyy-MM-dd"
                                                       ng-model="data.date"
                                                       is-open="opened" datepicker-options="dateOptions"
                                                       ng-required="true" close-text="Close"/>
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="btn btn-default"
                                                                            ng-click="open($event)"><i
                                                                            class="glyphicon glyphicon-calendar"></i>
                                                                    </button>
                                                                </span>
                                            </div>
                                        </div>
                                    </div>
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