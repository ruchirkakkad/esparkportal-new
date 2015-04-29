<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Report</h1>
</div>
<div class="wrapper-md" ng-init="getMarketingUsers()">
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="row row-sm text-center">
                    <div class="col-xs-3" ng-repeat="marketing_user in data.marketing_users">
                        <a href="/#/app/marketing_report/index-two-view/{{ marketing_user.user_encryt_id }} "
                           class="block panel padder-v bg-info item">
                            <span class="text-muted h1 "><i class=" icon-user"></i></span>
                            <span class="text-white font-thin h2 block">{{ marketing_user.first_name }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>