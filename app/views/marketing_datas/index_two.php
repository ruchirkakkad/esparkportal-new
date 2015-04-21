<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Select Timezone</h1>
</div>
<div class="wrapper-md" ng-init="gettimezonesview()">
    <div>
        <div class="row">

            <div class="col-md-12">
                <div class="row row-sm text-center">
                    <div class="col-xs-12">
                        <a href class="block panel padder-v bg-primary item">
                            <span class="text-white font-thin h1 block">India Time</span>
                            <span class="text-muted h1 ">{{ date | date:'dd.MM.yyyy h:mm:ss a'  }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row row-sm text-center">
                    <div class="col-xs-3" ng-repeat="timezone in data.timezones | orderBy: 'timezones_time' : true ">
                        <a href="/#/app/marketing_datas/index-three-view/{{ timezone.timezones_id }} " class="block panel padder-v bg-info item">
                            <span class="text-white font-thin h1 block">{{ timezone.timezones_name }}</span>
                            <span class="text-muted h1 ">{{ timezone.timezones_time1  | date:'dd.MM.yyyy h:mm:ss a'  }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>