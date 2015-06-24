<!-- navbar header -->
<div class="navbar-header bg-info">
    <button class="pull-right visible-xs dk" ui-toggle-class="show" data-target=".navbar-collapse">
        <i class="glyphicon glyphicon-cog"></i>
    </button>
    <button class="pull-right visible-xs" ui-toggle-class="off-screen" data-target=".app-aside" ui-scroll-to="app">
        <i class="glyphicon glyphicon-align-justify"></i>
    </button>
    <!-- brand -->
    <a href="#/app/dashboard" class="navbar-brand text-lt">
        <!--        <i class="fa fa-btc"></i>-->
        <span class="hidden-folded m-l-xs"><img src="img/logo.png" alt="." ></span>


    </a>
    <!-- / brand -->
</div>
<!-- / navbar header -->

<!-- navbar collapse -->
<div class="collapse pos-rlt navbar-collapse box-shadow {{app.settings.navbarCollapseColor}}" data-ng-controller="showMenuController">
    <!-- link and dropdown -->
    <ul class="nav navbar-nav hidden-sm">
            <li class="dropdown" dropdown  ng-repeat="module in data.modules">
                <a href class="dropdown-toggle" dropdown-toggle>
                    <i class="fa fa-fw fa-plus visible-xs-inline-block"></i>
                    <span>   {{module.label}}</span> <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu" >
                    <li ng-repeat="submodule in module.children">
                        <a href="{{submodule.url}}">{{submodule.label}}
                        <span class="arrow right" ng-if="submodule.secondMenu!=1"></span></a>
                        <ul class="dropdown-menu subdropdown-menu" ng-if="submodule.secondMenu!=1">

                            <li   ng-repeat="child3 in submodule.children"><a href="{{child3.url}}">{{child3.label}}</a></li>

                        </ul>
                    </li>

                </ul>
            </li>

        </ul>

    <!-- / link and dropdown -->

    <!-- nabar right -->
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a ui-sref="app.notifications.list" class="">
                <i class="icon-bell fa-fw"></i>
                <span class="visible-xs-inline">Notifications</span>
                <span class="badge badge-sm up bg-danger pull-right-xs">{{ data.notification_count }}</span>
            </a>
        </li>
        <li class="dropdown" dropdown>
            <a href class="dropdown-toggle clear" dropdown-toggle>
                <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                    <img src="<?= ImgProxy::link("public/{{ user.profile_image }}", 50, 50,100,0); ?>" alt="...">
                    <i class="on md b-white bottom"></i>
                </span>
                <span class="hidden-sm hidden-md">{{user.first_name}} {{user.last_name}}</span> <b class="caret"></b>
            </a>
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w">
                <li>
                    <a ui-sref="app.user_profiles.index">Profile</a>
                </li>
                <li>
                    <a ui-sref="app.user_profiles.edit">Edit Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a ui-sref="access.logout">Logout</a>
                </li>
            </ul>
            <!-- / dropdown -->
        </li>
    </ul>
    <!-- / navbar right -->

</div>
<!-- / navbar collapse -->
<script>
        app.controller('showMenuController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
        function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

            $scope.data = {
                modules:[]

            };

            $http.get('headerDataView',{}).success(
                function(data){

                    $scope.data.modules =data.modules;
                    $scope.data.notification_count =data.notification_count;

//                    console.log($scope.data.modules);

                }
            );




    }]);


</script>