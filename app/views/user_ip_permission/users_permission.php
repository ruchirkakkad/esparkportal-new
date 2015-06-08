<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Edit User Permission Time</h1>
</div>
<div class="wrapper-md">
    <div flash-message="5000"></div>
    <div>
        <div class="row" ng-init="editData()">
            <div class="col-sm-6">
                <form name="formValidate" class="form-horizontal form-validation" novalidate>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>{{ data.name }}</strong>
                        </div>
                        <div class="panel-body">
                            <div class="form-group ">
                                <label class="col-sm-3 control-label">Expiration Time</label>

                                <div class="col-sm-9">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" id="dropdown1" role="button" data-toggle="dropdown"
                                           data-target="#">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       data-ng-model="data.ip_access_expire_time">
                                        <span class="input-group-addon"><i
                                                class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"
                                            style="position: relative !important;">
                                            <datetimepicker data-ng-model="data.ip_access_expire_time"
                                                            data-datetimepicker-config="{ dropdownSelector: '#dropdown1' }"
                                                ></datetimepicker>
                                        </ul>
                                    </div>
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