/**
 * Created by ruchir on 5/21/2015.
 */
app.controller('TimeTrackerController', ['$scope', '$http', '$state', '$interval', '$rootScope', 'Flash', '$stateParams',
    function ($scope, $http, $state, $interval, $rootScope, Flash, $stateParams) {

        $scope.data = {
            users: {},
            dateRangeSearch: '',
            months: [
                {id: '01', value: 'January'},
                {id: '02', value: 'February'},
                {id: '03', value: 'March'},
                {id: '04', value: 'April'},
                {id: '05', value: 'May'},
                {id: '06', value: 'June'},
                {id: '07', value: 'July'},
                {id: '08', value: 'August'},
                {id: '09', value: 'September'},
                {id: 10, value: 'October'},
                {id: 11, value: 'November'},
                {id: 12, value: 'December'}
            ],
            years: [
                {id: 2014, value: 2014},
                {id: 2015, value: 2015},
                {id: 2016, value: 2016},
                {id: 2017, value: 2017},
                {id: 2018, value: 2018},
                {id: 2019, value: 2019},
                {id: 2020, value: 2020}

            ]
        };
        $scope.getUsers = function () {
            $http.post('time_tracker/users-list-view', {})
                .success(function (data) {
                    $scope.data.users = data.users;
                });
        };
        $scope.itemsByPage = 31;


        $scope.userWiseReportData = function () {
            $scope.user_wise_report = "";
            $http.post('time_tracker/users-report-view/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.user_wise_report = "tpl/user_wise_report.html";
                });
        };

        $scope.userWiseDateRangeSearch = function () {
            $scope.user_wise_report = "";
            $http.post('time_tracker/users-report-date-range-view/' + $stateParams.id, {dateRangeSearch: $scope.data.dateRangeSearch})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.user_wise_report = "tpl/user_wise_report.html";
                });
        };
        $scope.userWiseMonthYearSearch = function () {
            $scope.user_wise_report = "";
            $http.post('time_tracker/users-report-month-year-view/' + $stateParams.id,
                {year: $scope.data.yearSearch, month: $scope.data.monthSearch})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.user_wise_report = "tpl/user_wise_report.html";
                });
        };

        $scope.dateWiseReportData = function () {
            $scope.date_wise_report = "";
            var d = new Date();
            var month = d.getMonth() + 1;
            var day = d.getDate();
            var today = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;

            $http.post('time_tracker/date-wise-report-view', {date: today})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.date_wise_report = "tpl/date_wise_report.html";
                });
        };

        $scope.dateWiseDateSearch = function () {
            $scope.date_wise_report = "";
            $http.post('time_tracker/date-wise-report-view', {date: $scope.data.dateWiseSearchVariable})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.date_wise_report = "tpl/date_wise_report.html";
                });
        };


        $scope.attendanceChartReportData = function () {
            $scope.attendance_chart_report = "";
            var d = new Date();
            var month = d.getMonth() + 1;

            $http.post('time_tracker/attendance-chart-report-view', {
                month: (month < 10 ? '0' : '') + month,
                year: d.getFullYear()
            })
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.total_present_count_date_wise = data.total_present_count_date_wise;
                    $scope.attendance_chart_report = "tpl/attendance_chart_report.html";
                });
        };
        $scope.attendanceChartMonthYearSearch = function () {
            $scope.attendance_chart_report = "";
            $http.post('time_tracker/attendance-chart-report-view', {
                year: $scope.data.yearSearch,
                month: $scope.data.monthSearch
            })
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.total_present_count_date_wise = data.total_present_count_date_wise;
                    $scope.attendance_chart_report = "tpl/attendance_chart_report.html";
                });
        };
        $scope.user_breaks = [];
        $scope.user_staffing = null;
        $scope.getUserStaffing = function () {
            $scope.edit_user_staffing = '';
            $http.post('time_tracker/user-staffing-edit/' + $stateParams.id, {})
                .success(function (data) {
                    //$scope.data.user= data.user;
                    $scope.user_staffing = data.user_staffing;
                    $scope.user_breaks = data.user_breaks;

                    var t = $scope.user_staffing.check_in.split(/[- :]/);
                    var checkin_datetime = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
                    var month = checkin_datetime.getUTCMonth() + 1; //months from 1-12
                    var day = checkin_datetime.getUTCDate();
                    var year = checkin_datetime.getUTCFullYear();
                    $scope.staffing_date = year + '-' + month + '-' + day;
                    $scope.edit_user_staffing = 'tpl/edit_user_staffing.html';
                });
        };

        $scope.add_break = function () {
            $scope.user_breaks.push({
                break_in: '',
                break_out: ''
            });
        };
        $scope.remove_break = function (index) {
            $scope.user_breaks.splice(index, 1);

        };

        $scope.updateStaffing = function () {

            var check_in = $scope.user_staffing.check_in;
            var check_out = $scope.user_staffing.check_out;

            if (check_in == '' || check_in == '0000-00-00 00:00:00') {
                alert('please enter check in date time..');
                return false;
            }

            $http.post('time_tracker/update-staffing-edit/' + $stateParams.id, {
                staffings: $scope.user_staffing,
                breaks: $scope.user_breaks
            }).success(function (data) {
                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    alert(data.alert_msg);
                    $state.go($state.current,{},{reload:true});
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                    $('body,html').scrollTop(0);
                }
            });
        };

        //$scope.beforeRender = function ($dates) {
        //    //var index = Math.floor(Math.random() * $dates.length);
        //    //console.log(index);
        //    //$dates[index].selectable = false;
        //    var checkin_datetime = $scope.user_staffing.check_in;
        //    console.log(checkin_datetime);
        //    var month = checkin_datetime.getUTCMonth() + 1; //months from 1-12
        //    var day = checkin_datetime.getUTCDate();
        //    var year = checkin_datetime.getUTCFullYear();
        //    //console.log(checkin_datetime);
        //    var today = new Date(year,month,day,'00','00','00').getTime();
        //    console.log(today);
        //    //var today = $scope.user_staffing.check_in.getTime();
        //    var tom = today + (86400*1000) + 19750000;
        //    //console.log(today);
        //    //console.log(tom);
        //
        //    angular.forEach($dates, function(key, value) {
        //        //console.log($dates[value].utcDateValue);
        //        if(today > $dates[value].utcDateValue || tom < $dates[value].utcDateValue)
        //        {
        //            $dates[value].selectable = false;
        //        }
        //
        //    });
        //};

    }]);