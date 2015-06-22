/**
 * Created by ruchir on 5/18/2015.
 */
'use strict';

/* Controllers */
app.controller('StaffingCtrl', ['$scope', '$http', '$state', '$interval', '$rootScope',
    function ($scope, $http, $state, $interval, $rootScope) {

        $scope.totalStaffing = {
            time: "00:00"
        };

        $scope.userAccessClass = "none";
        $scope.buttons = [];
        $scope.error = "";
        $scope.entries = "";
        $scope.success = [];
        $interval(function () {
            jQuery.ajax({
                url: "staffing/staffing-calculation?callback=?",
                dataType: "jsonp",
                cache: false,
                success: function (data) {
                    $scope.totalStaffing = data;
                    if (data.accessStyle == 'none') {
                        $scope.userAccessClass = "none";
                    }
                    else {
                        $scope.userAccessClass = "block";
                    }
                },
                error: function (response) {
                    console.log("failed");
                }
            });
            //$http.jsonp('staffing/staffing-calculation?callback=JSON_CALLBACK', {})
            //    .success(function (data) {
            //        $scope.totalStaffing = data;
            //        if (data.accessStyle == 'none') {
            //            $scope.userAccessClass = "none";
            //        }
            //        else {
            //            $scope.userAccessClass = "block";
            //        }
            //    });
        }, 60000);
        $scope.getData = function () {

            $scope.staffing_file = "";
            $http.post('staffing/dashboard-data', {})
                .success(function (data) {
                    $scope.buttons = data.buttons;
                    $scope.error = data.error;
                    $scope.success = data.success;
                    console.log($scope.success);
                    $scope.entries = data.entries;
                    $http.post('staffing/staffing-calculation', {})
                        .success(function (data) {
                            $scope.totalStaffing = data;
                            if (data.accessStyle == 'none') {
                                $scope.userAccessClass = "none";
                            }
                            else {
                                $scope.userAccessClass = "block";
                            }
                        });
                    $scope.staffing_file = "tpl/staffing_file.html";
                });
        };
        $scope.check_in = function () {
            $http.post('staffing/check-in', {})
                .success(function (data) {
                    $state.go($state.current, {}, {reload: true});
                });
        };
        $scope.check_out = function () {
            $http.post('staffing/check-out', {})
                .success(function (data) {
                    $state.go($state.current, {}, {reload: true});
                });
        };
        $scope.break_in = function () {
            $http.post('staffing/break-in', {})
                .success(function (data) {
                    $state.go($state.current, {}, {reload: true});
                });
        };
        $scope.break_out = function () {
            $http.post('staffing/break-out', {})
                .success(function (data) {
                    $state.go($state.current, {}, {reload: true});
                });
        };
    }]);

app.controller('LeaveManagementDashborad', ['$scope', '$http', '$state', '$interval', '$rootScope',
    function ($scope, $http, $state, $interval, $rootScope) {

        $scope.itemsByPage = 5;
        $scope.data = {
            'leave_name': '',
            'leaves_id': '',
            'subject': '',
            'leave_types_id': '',
            'leave_date': '',
            'description': '',
            'leaves': [],
            'leave_types': []
        };
        $scope.selected = '';
        $scope.leaves_on_dashboard_view = '';
        $scope.today_leave = function () {
            $scope.selected = 'today_leave';
            $scope.leaves_on_dashboard_view = '';
            $http.post('leave_manages/today-leave-view', {})
                .success(function (data) {
                    $scope.data.leaves = data.aaData;
                    $scope.leaves_on_dashboard_view = 'tpl/leave_manage_file.html';
                });
        };
        $scope.report = function () {
            $scope.selected = 'report';
            $scope.leaves_on_dashboard_view = '';
            $http.post('leave_manages/leave-report-view', {})
                .success(function (data) {
                    $scope.data.leaves = data.aaData;
                    $scope.leaves_on_dashboard_view = 'tpl/leave_manage_file.html';
                });
        };
        $scope.leave_request = function () {
            $scope.selected = 'leave_request';
            $scope.leaves_on_dashboard_view = '';
            $http.post('leave_manages/leave-request-view', {})
                .success(function (data) {
                    $scope.data.leaves = data.aaData;
                    $scope.leaves_on_dashboard_view = 'tpl/leave_manage_file.html';
                });
        };

        $scope.leave_status_true = function (id, selected) {

            $http.post('leave_manages/leave-change-status',
                {
                    id: id,
                    status_type: selected,
                    status : true
                })
                .success(function (data) {
                    if(selected == 'leave_request')
                    {
                        $scope.leave_request();
                    }
                    if(selected == 'report')
                    {
                        $scope.report();
                    }
                    if(selected == 'today_leave')
                    {
                        $scope.today_leave();
                    }
                });
        };

        $scope.leave_status_false = function (id, selected) {
            $http.post('leave_manages/leave-change-status',
                {
                    id: id,
                    status_type: selected,
                    status : false
                })
                .success(function (data) {
                    if(selected == 'leave_request')
                    {
                        $scope.leave_request();
                    }
                    if(selected == 'report')
                    {
                        $scope.report();
                    }
                    if(selected == 'today_leave')
                    {
                        $scope.today_leave();
                    }
                });
        };

    }]);
//angular.element('#btn2').triggerHandler('click');

app.directive('loading',   ['$http' ,function ($http)
    {
        return {
            restrict: 'A',
            link: function (scope, elm, attrs)
            {
                scope.isLoading = function () {
                    return $http.pendingRequests.length > 0;
                };

                scope.$watch(scope.isLoading, function (v)
                {
                    if(v){
                        elm.show();
                    }else{
                        elm.hide();
                    }
                });
            }
        };

    }]);