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
        <span class="hidden-folded m-l-xs"><img src="img/logo3.png" alt="." width="110px" height="100px"></span>


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

        <!--    <li class="dropdown" dropdown>-->
        <!--        <a href class="dropdown-toggle" dropdown-toggle>-->
        <!--            <i class="fa fa-fw fa-plus visible-xs-inline-block"></i>-->
        <!--            <span>Organization</span> <span class="caret"></span>-->
        <!--        </a>-->
        <!--        <ul class="dropdown-menu" role="menu">-->
        <!--            <li><a ui-sref=".user">Company Details</a></li>-->
        <!--            <li><a href="#">Department Management</a></li>-->
        <!--            <li><a href="#">Branch Management</a></li>-->
        <!--            <li><a href="#">General Settings</a></li>-->
        <!--            <li><a href="#">Work Shifts</a></li>-->
        <!--            <li><a href="#">Policy Management</a></li>-->
        <!--            <li><a href="#">Roles Management</a></li>-->
        <!--        </ul>-->
        <!--    </li>-->
        <!--    <li class="dropdown" dropdown>-->
        <!--        <a href class="dropdown-toggle" dropdown-toggle>-->
        <!--            <i class="fa fa-fw fa-plus visible-xs-inline-block"></i>-->
        <!--            <span>HRMS</span> <span class="caret"></span>-->
        <!--        </a>-->
        <!--        <ul class="dropdown-menu" role="menu">-->
        <!--            <li><a href="#"></a></li>-->
        <!--            <li><a href="#">Time Tracker <span class="arrow right"></span></a>-->
        <!--                <ul class="dropdown-menu subdropdown-menu">-->
        <!--                    <li><a href="#">Time log</a></li>-->
        <!--                    <li><a href="#">Time-sheet</a></li>-->
        <!--                    <li><a href="#">User wise Time-sheet</a></li>-->
        <!--                    <li><a href="#">Date wise Time-sheet</a></li>-->
        <!--                    <li><a href="#">Attendance Chart</a></li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--            <li><a href="#">Employee Management <span class="arrow right"></span></a>-->
        <!--                <ul class="dropdown-menu subdropdown-menu">-->
        <!--                    <li><a href="#">View User</a></li>-->
        <!--                    <li><a href="#">Add User</a></li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--            <li><a href="#">Qualification<span class="arrow right"></span></a>-->
        <!--                <ul class="dropdown-menu subdropdown-menu">-->
        <!--                    <li><a href="#">Skills </a></li>-->
        <!--                    <li><a href="#">Education</a></li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--            <li><a href="#">Leave Management <span class="arrow right"></span></a>-->
        <!--                <ul class="dropdown-menu subdropdown-menu">-->
        <!--                    <li><a href="#">View Leave</a></li>-->
        <!--                    <li><a href="#">Leave Request</a></li>-->
        <!--                    <li><a href="#">Leave Report</a></li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--            <li><a href="#">Payroll<span class="arrow right"></span></a>-->
        <!--                <ul class="dropdown-menu subdropdown-menu">-->
        <!--                    <li><a href="#">View Salary </a></li>-->
        <!--                    <li><a href="#">Add Salary </a></li>-->
        <!--                    <li><a href="#">Salary Slip</a></li>-->
        <!--                    <li><a href="#">Salary Slip Generation</a></li>-->
        <!--                    <li><a href="#">Salary Report</a></li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--            <li><a href="#">Designation Management</a></li>-->
        <!--            <li><a href="#">Expense Management</a></li>-->
        <!--            <li><a href="#">Holiday Management <span class="arrow right"></span></a>-->
        <!--                <ul class="dropdown-menu subdropdown-menu">-->
        <!--                    <li><a href="#">View Holiday</a></li>-->
        <!--                    <li><a href="#">Add Holiday</a></li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--            <li><a href="#">General Announcement</a></li>-->
        <!--        </ul>-->
        <!--    </li>-->
        <!--    <li class="dropdown" dropdown>-->
        <!--        <a href class="dropdown-toggle" dropdown-toggle>-->
        <!--            <i class="fa fa-fw fa-plus visible-xs-inline-block"></i>-->
        <!--            <span>Recruitment</span> <span class="caret"></span>-->
        <!--        </a>-->
        <!--        <ul class="dropdown-menu" role="menu">-->
        <!--            <li><a href="#">Add Job Vacancy</a></li>-->
        <!--            <li><a href="#">Add Candidate</a></li>-->
        <!--            <li><a href="#">View Candidate</a></li>-->
        <!--            <li><a href="#">Recruitment Process</a></li>-->
        <!--        </ul>-->
        <!--    </li>-->
        <!--    <li class="dropdown" dropdown>-->
        <!--        <a href class="dropdown-toggle" dropdown-toggle>-->
        <!--            <i class="fa fa-fw fa-plus visible-xs-inline-block"></i>-->
        <!--            <span>Marketing</span> <span class="caret"></span>-->
        <!--        </a>-->
        <!--        <ul class="dropdown-menu" role="menu">-->
        <!--            <li><a href="#"></a></li>-->
        <!--            <li><a href="#">Sheet Management</a></li>-->
        <!--            <li><a href="#">Leads</a></li>-->
        <!--            <li><a href="#">Leads Status Management</a></li>-->
        <!--            <li><a href="#">Follow Up</a></li>-->
        <!--            <li><a href="#">Other Leads<span class="arrow right"></span></a>-->
        <!--                <ul class="dropdown-menu subdropdown-menu">-->
        <!--                    <li><a href="#">Add Other Lead</a></li>-->
        <!--                    <li><a href="#">View Other Lead</a></li>-->
        <!--                    <li><a href="#">Follow Up Other Lead</a></li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--            <li><a href="#">Country Management<span class="arrow right"></span></a>-->
        <!--                <ul class="dropdown-menu subdropdown-menu">-->
        <!--                    <li><a href="#">Country</a></li>-->
        <!--                    <li><a href="#">State</a></li>-->
        <!--                    <li><a href="#">Time Zone</a></li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--            <li><a href="#">Category Management<span class="arrow right"></span></a>-->
        <!--                <ul class="dropdown-menu subdropdown-menu">-->
        <!--                    <li><a href="#">Add Category</a></li>-->
        <!--                    <li><a href="#">View Category</a></li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--            <li><a href="#">Sheet Assignment</a></li>-->
        <!---->
        <!--            <li><a href="#">Email Marketing<span class="arrow right"></span></a>-->
        <!--                <ul class="dropdown-menu subdropdown-menu">-->
        <!--                    <li><a href="#">Group Management</a></li>-->
        <!--                    <li><a href="#">Category</a></li>-->
        <!--                    <li><a href="#">Upload Data Sheet</a></li>-->
        <!--                    <li><a href="#">View Data Sheet</a></li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--        </ul>-->
        <!--    </li>-->
        <!--    <li class="dropdown" dropdown>-->
        <!--        <a href class="dropdown-toggle" dropdown-toggle>-->
        <!--            <i class="fa fa-fw fa-plus visible-xs-inline-block"></i>-->
        <!--            <span>PMS</span> <span class="caret"></span>-->
        <!--        </a>-->
        <!--        <ul class="dropdown-menu" role="menu">-->
        <!--            <li><a href="#">PMS</a></li>-->
        <!--        </ul>-->
        <!--    </li>-->
        <!--    <li class="dropdown" dropdown>-->
        <!--        <a href class="dropdown-toggle" dropdown-toggle>-->
        <!--            <i class="fa fa-fw fa-plus visible-xs-inline-block"></i>-->
        <!--            <span>Support</span> <span class="caret"></span>-->
        <!--        </a>-->
        <!--        <ul class="dropdown-menu" role="menu">-->
        <!--            <li><a href="#">Support</a></li>-->
        <!--        </ul>-->
        <!--    </li>-->
        <!--    <li class="dropdown" dropdown>-->
        <!--        <a href class="dropdown-toggle" dropdown-toggle>-->
        <!--            <i class="fa fa-fw fa-plus visible-xs-inline-block"></i>-->
        <!--            <span>Modules</span> <span class="caret"></span>-->
        <!--        </a>-->
        <!--        <ul class="dropdown-menu" role="menu">-->
        <!--            <li><a href="#/app/modules/index">Modules</a></li>-->
        <!--            <li><a href="#">General Modules</a></li>-->
        <!--        </ul>-->
        <!--    </li>-->

    <!-- / link and dropdown -->

    <!-- nabar right -->
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown" dropdown>
            <a href class="dropdown-toggle" dropdown-toggle>
                <i class="icon-bell fa-fw"></i>
                <span class="visible-xs-inline">Notifications</span>
                <span class="badge badge-sm up bg-danger pull-right-xs">2</span>
            </a>
            <!-- dropdown -->
            <div class="dropdown-menu w-xl animated fadeInUp">
                <div class="panel bg-white">
                    <div class="panel-heading b-light bg-light">
                        <strong>You have <span>2</span> notifications</strong>
                    </div>
                    <div class="list-group">
                        <a href class="media list-group-item">
                            <span class="pull-left thumb-sm">
                                <img src="img/a0.jpg" alt="..." class="img-circle">
                            </span>
                            <span class="media-body block m-b-none">
                                Use awesome animate.css<br>
                                <small class="text-muted">10 minutes ago</small>
                            </span>
                        </a>
                        <a href class="media list-group-item">
                            <span class="media-body block m-b-none">
                                1.0 initial released<br>
                                <small class="text-muted">1 hour ago</small>
                            </span>
                        </a>
                    </div>
                    <div class="panel-footer text-sm">
                        <a href class="pull-right"><i class="fa fa-cog"></i></a>
                        <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
                    </div>
                </div>
            </div>
            <!-- / dropdown -->
        </li>
        <li class="dropdown" dropdown>
            <a href class="dropdown-toggle clear" dropdown-toggle>
                <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                    <img src="img/a0.jpg" alt="...">
                    <i class="on md b-white bottom"></i>
                </span>
                <span class="hidden-sm hidden-md">{{user.first_name}} {{user.last_name}}</span> <b class="caret"></b>
            </a>
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w">
                <li>
                    <a href>
                        <span class="badge bg-danger pull-right">30%</span>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a ui-sref="app.page.profile">Profile</a>
                </li>
                <li>
                    <a ui-sref="app.docs">
                        <span class="label bg-info pull-right">new</span>
                        Help
                    </a>
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

//                    console.log($scope.data.modules);

                }
            );




    }]);


</script>