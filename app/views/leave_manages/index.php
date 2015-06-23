<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Leave Manage</h1>
</div>

<div class="wrapper-md" ng-init="index()">
    <div flash-message="5000"></div>
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
