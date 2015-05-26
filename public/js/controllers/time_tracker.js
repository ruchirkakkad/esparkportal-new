/**
 * Created by ruchir on 5/21/2015.
 */
app.controller('TimeTrackerController', ['$scope', '$http', '$state', '$interval','$rootScope','Flash', '$stateParams',
    function ($scope, $http, $state, $interval,$rootScope,Flash, $stateParams) {

        $scope.data = {
            users : {},
            dateRangeSearch : '',
            months : [
                {id:'01',value: 'January'},
                {id:'02',value: 'February'},
                {id:'03',value: 'March'},
                {id:'04',value: 'April'},
                {id:'05',value: 'May'},
                {id:'06',value: 'June'},
                {id:'07',value: 'July'},
                {id:'08',value: 'August'},
                {id:'09',value: 'September'},
                {id:10,value: 'October'},
                {id:11,value: 'November'},
                {id:12,value: 'December'}
            ],
            years : [
                {id:2014,value: 2014},
                {id:2015,value: 2015},
                {id:2016,value: 2016},
                {id:2017,value: 2017},
                {id:2018,value: 2018},
                {id:2019,value: 2019},
                {id:2020,value: 2020}

            ]
        };
        $scope.getUsers = function(){
            $http.post('time_tracker/users-list-view', {})
                .success(function (data) {
                    $scope.data.users= data.users;
                });
        };



        $scope.userWiseReportData = function(){
            $scope.user_wise_report = "";
            $http.post('time_tracker/users-report-view/'+$stateParams.id, {})
                .success(function (data) {
                    $scope.data.user= data.user;
                    $scope.staffings = data.staffings;
                    $scope.user_wise_report = "tpl/user_wise_report.html";
                });
        };

        $scope.userWiseDateRangeSearch = function(){

            alert($scope.data.dateRangeSearch)
            //$scope.user_wise_report = "";
            //$http.post('time_tracker/users-report-view/'+$stateParams.id, {})
            //    .success(function (data) {
            //        $scope.data.user= data.user;
            //        $scope.staffings = data.staffings;
            //        $scope.user_wise_report = "tpl/user_wise_report.html";
            //    });
        };
        $scope.userWiseMonthYearSearch= function(){
            $scope.user_wise_report = "";
            $http.post('time_tracker/users-report-month-year-view/'+$stateParams.id,
                {year : $scope.data.yearSearch,month:$scope.data.monthSearch})
                .success(function (data) {
                    $scope.data.user= data.user;
                    $scope.staffings = data.staffings;
                    $scope.user_wise_report = "tpl/user_wise_report.html";
                });
        };
    }]);
