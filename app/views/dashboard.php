<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = true; 
    app.settings.asideDock = false;
" ng-controller="StaffingCtrl">
    <div id="dvBlockAccess" style="display: {{ userAccessClass }}"><h1>Your Access Is Blocked... Please Kindly contact Administrator</h1></div>
    <div class="bg-light lter b-b wrapper-md ng-scope">
        <h1 class="m-n font-thin h3">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-6"></div>
        <div class="col-lg-6" >
            <div class="col-lg-10" ng-init="getData()">
                <div data-ng-include="staffing_file" class="fade-in-up-big "></div>
            </div>
        </div>
    </div>
</div>