<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">
        Users
        <label style="float: right">Search: <input ng-model="searchText.first_name"></label>
    </h1>

</div>
<div class="wrapper-md" ng-init="getUsers()">
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="row row-sm text-center">
                    <div class="col-xs-2" ng-repeat="user in data.users | filter:searchText | orderBy:'first_name'">
                        <a href="/#/app/user_ip_permission/user-expiration-view/{{ user.user_encryt_id }} "
                           class="block panel padder-v {{user.is_expired == '1'?'bg-danger' : 'bg-info'}} item">
                            <span class="text-muted h1 ">
                                <img src="{{ user.profile_image }}" width="50px" height="50px" style="border-radius: 100%">
                            </span>
                            <span class="text-white font-thin h2 block">{{ user.first_name }}</span>
                            <span ng-if="user.is_expired == 1" class="text-white font-thin block">{{ user.ip_access_expire_time }}</span>
                            <span ng-if="user.is_expired == 0" class="text-white font-thin block">&nbsp;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>