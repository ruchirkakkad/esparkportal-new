<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = true; 
    app.settings.asideDock = false;
">
    <div class="bg-light lter b-b wrapper-md ng-scope">
        <h1 class="m-n font-thin h3">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
            <!-- progressbar -->
            <div ng-controller="ProgressDemoCtrl" class="panel panel-default">
                <div class="panel-heading">
                    Time Tracker
                </div>
                <div class="list-group">
                    <div class="list-group-item">
                        <button class="btn m-b-xs w-xs btn-success">Check In</button>
                    </div>
                </div>
            </div>
            <!-- / progressbar -->
        </div>
    </div>
</div>