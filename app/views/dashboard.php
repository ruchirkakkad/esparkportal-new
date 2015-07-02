<div class="bg-light lter b-b wrapper-md ng-scope">
    <h1 class="m-n font-thin h3">Dashboard</h1>
</div>
<div class="hbox hbox-auto-xs hbox-auto-sm wrapper-md" ng-init="
    app.settings.asideFolded = true; 
    app.settings.asideDock = false;
" ng-controller="StaffingCtrl">
    <div id="dvBlockAccess" style="display: {{ userAccessClass }}"><h1>Your Access Is Blocked... Please Kindly contact
            Administrator</h1></div>

    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="row row-sm text-center">
                        <div class="col-xs-12">
                            <a ui-sref="app.dashboard_calendar.index-view" class="block panel padder-v bg-info item">
                                <span class="text-muted h1"><i class="icon-calendar"></i></span>
                                <span class="text-white font-thin h2 block">Calendar</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div ng-if="permission.users.view==1" class="col-md-6">
                    <div class="row row-sm text-center" ng-init="getUserCount()">
                        <div class="col-xs-12">
                            <a href="/#/users/list" class="block panel padder-v bg-info item">
                                <span class="text-muted h1 ">{{ userCount }}</span>
                                <span class="text-white font-thin h2 block">Users</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="col-lg-10" ng-init="getData()">
                <div data-ng-include="staffing_file" class="fade-in-right-big "></div>
            </div>
        </div>
    </div>
    <div ng-if="permission.leave_manages.view==1">
        <div class="row" ng-controller="LeaveManagementDashborad">
            <hr>
            <div class="col-md-12">
                <h2>Leaves</h2>

                <div ng-controller="TabsDemoCtrl" ng-init="leave_request()">
                    <tabset justified="true" class="tab-container">
                        <tab heading="Leave Requset" ng-click="leave_request()" id="#leave_request">
                            <div data-ng-include="leaves_on_dashboard_view" class="fade-right-up-big "></div>
                        </tab>
                        <tab heading="Report" ng-click="report(); $event.stopPropagation();" id="#report">
                            <div data-ng-include="leaves_on_dashboard_view" class="fade-right-up-big "></div>
                        </tab>
                        <tab heading="Today Leave" ng-click="today_leave()" id="#today_leave">
                            <div data-ng-include="leaves_on_dashboard_view" class="fade-right-up-big "></div>
                        </tab>
                    </tabset>
                </div>
            </div>
        </div>
    </div>
</div>