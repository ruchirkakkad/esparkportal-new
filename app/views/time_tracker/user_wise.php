<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">
        User Wise Report
        <label style="float: right">Search: <input ng-model="searchText.first_name"></label>
    </h1>

</div>
<div class="wrapper-md" ng-init="getUsers()">
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="row row-sm text-center">
                    <div class="col-xs-2" ng-repeat="user in data.users | filter:searchText | orderBy:'first_name'">
                        <a href="/#/app/user_wise_time_sheet/user-wise-report-view/{{ user.user_encryt_id }} "
                           class="block panel padder-v bg-info item">
                            <span class="text-muted h1 "><i class=" icon-user"></i></span>
                            <span class="text-white font-thin h2 block">{{ user.first_name }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>