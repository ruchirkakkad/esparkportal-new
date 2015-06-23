/**
 * Created by ruchir on 5/21/2015.
 */
app.controller('TimeTrackerController', ['$scope', '$http', '$state', '$interval', '$rootScope', 'Flash', '$stateParams','$window',
    function ($scope, $http, $state, $interval, $rootScope, Flash, $stateParams,$window) {

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
            $http.post('user_wise_time_sheet/users-list-view', {})
                .success(function (data) {
                    $scope.data.users = data.users;
                });
        };
        $scope.itemsByPage = 31;


        $scope.userWiseReportData = function () {
            $scope.user_wise_report = "";
            $http.post('user_wise_time_sheet/users-report-view/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.user_wise_report = "tpl/user_wise_report.html";
                });
        };
        $scope.userWiseReportDataSelf = function () {
            $scope.user_wise_report = "";
            $http.post('time_sheet/users-report-view/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.user_wise_report = "tpl/user_wise_report_self.html";
                });
        };

        $scope.userWiseDateRangeSearch = function () {
            $scope.user_wise_report = "";
            $http.post('user_wise_time_sheet/users-report-date-range-view/' + $stateParams.id, {dateRangeSearch: $scope.data.dateRangeSearch})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.user_wise_report = "tpl/user_wise_report.html";
                });
        };
        $scope.userWiseDateRangeSearchSelf = function () {
            $scope.user_wise_report = "";
            $http.post('time_sheet/users-report-date-range-view/' + $stateParams.id, {dateRangeSearch: $scope.data.dateRangeSearch})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.user_wise_report = "tpl/user_wise_report_self.html";
                });
        };
        $scope.userWiseMonthYearSearch = function () {
            $scope.user_wise_report = "";
            $http.post('user_wise_time_sheet/users-report-month-year-view/' + $stateParams.id,
                {year: $scope.data.yearSearch, month: $scope.data.monthSearch})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.user_wise_report = "tpl/user_wise_report.html";
                });
        };
        $scope.userWiseMonthYearSearchSelf = function () {
            $scope.user_wise_report = "";
            $http.post('time_sheet/users-report-month-year-view/' + $stateParams.id,
                {year: $scope.data.yearSearch, month: $scope.data.monthSearch})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.user_wise_report = "tpl/user_wise_report_self.html";
                });
        };

        $scope.dateWiseReportData = function () {
            $scope.date_wise_report = "";
            var d = new Date();
            var month = d.getMonth() + 1;
            var day = d.getDate();
            var today = d.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;

            $http.post('date_wise_time_sheet/date-wise-report-view', {date: today})
                .success(function (data) {
                    $scope.data.user = data.user;
                    $scope.staffings = data.staffings;
                    $scope.date_wise_report = "tpl/date_wise_report.html";
                });
        };

        $scope.dateWiseDateSearch = function () {
            $scope.date_wise_report = "";
            $http.post('date_wise_time_sheet/date-wise-report-view', {date: $scope.data.dateWiseSearchVariable})
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

            $http.post('attendance_chart/attendance-chart-report-view', {
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
            $http.post('attendance_chart/attendance-chart-report-view', {
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
        $scope.user_staffing = [];
        $scope.getUserStaffing = function () {
            $scope.edit_user_staffing = '';
            $http.post('user_wise_time_sheet/user-staffing-edit/' + $stateParams.id, {})
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


        $scope.getUserData = function () {
            $scope.add_user_staffing = '';
            $http.post('user_wise_time_sheet/user-data-edit/' + $stateParams.user_id, {})
                .success(function (data) {
                    $scope.user_staffing = {
                        "check_in": "",
                        "check_out": "",
                        "user_id": data.user_id,
                        "first_name": data.first_name,
                        "middle_name": data.middle_name,
                        "last_name": data.last_name,
                        "email": data.email,
                        "personal_email": data.personal_email,
                        "password": data.password,
                        "profile_image": data.profile_image,
                        "gender": data.gender,
                        "doj": data.doj,
                        "employee_id": data.employee_id,
                        "department_id": data.department_id,
                        "designation_id": data.designation_id,
                        "job_profile": data.job_profile,
                        "role_id": data.role_id,
                        "user_status": data.user_status,
                        "deleted_at": data.deleted_at,
                        "remember_token": data.remember_token,
                        "work_shifts_id": data.work_shifts_id
                    };
                    $scope.user_breaks = [];

                    $scope.staffing_date = $stateParams.date;
                    $scope.add_user_staffing = 'tpl/add_user_staffing.html';
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

            $http.post('user_wise_time_sheet/update-staffing-edit/' + $stateParams.id+'/'+$scope.staffing_date, {
                staffings: $scope.user_staffing,
                breaks: $scope.user_breaks
            }).success(function (data) {
                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $rootScope.PreviousState.goToLastState();
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                    $('body,html').scrollTop(0);
                }
            });
        };

        $scope.addStaffing = function () {

            var check_in = $scope.user_staffing.check_in;
            var check_out = $scope.user_staffing.check_out;

            if (check_in == '' || check_in == '0000-00-00 00:00:00') {
                alert('please enter check in date time..');
                return false;
            }

            $http.post('user_wise_time_sheet/add-staffing-edit/' + $stateParams.date+'/'+$stateParams.user_id, {
                staffings: $scope.user_staffing,
                breaks: $scope.user_breaks
            }).success(function (data) {
                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    alert(data.alert_msg);
                    $rootScope.PreviousState.goToLastState();
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                    $('body,html').scrollTop(0);
                }
            });
        };







        $scope.getUserStaffingDateWise = function () {
            $scope.edit_user_staffing = '';
            $http.post('date_wise_time_sheet/user-staffing-edit/' + $stateParams.id, {})
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
                    $scope.edit_user_staffing = 'tpl/edit_user_staffing_date_wise.html';
                });
        };


        $scope.getUserDataDateWise = function () {
            $scope.add_user_staffing = '';
            $http.post('date_wise_time_sheet/user-data-edit/' + $stateParams.user_id, {})
                .success(function (data) {
                    $scope.user_staffing = {
                        "check_in": "",
                        "check_out": "",
                        "user_id": data.user_id,
                        "first_name": data.first_name,
                        "middle_name": data.middle_name,
                        "last_name": data.last_name,
                        "email": data.email,
                        "personal_email": data.personal_email,
                        "password": data.password,
                        "profile_image": data.profile_image,
                        "gender": data.gender,
                        "doj": data.doj,
                        "employee_id": data.employee_id,
                        "department_id": data.department_id,
                        "designation_id": data.designation_id,
                        "job_profile": data.job_profile,
                        "role_id": data.role_id,
                        "user_status": data.user_status,
                        "deleted_at": data.deleted_at,
                        "remember_token": data.remember_token,
                        "work_shifts_id": data.work_shifts_id
                    };
                    $scope.user_breaks = [];

                    $scope.staffing_date = $stateParams.date;
                    $scope.add_user_staffing = 'tpl/add_user_staffing_date_wise.html';
                });
        };

        $scope.updateStaffingDateWise = function () {

            var check_in = $scope.user_staffing.check_in;
            var check_out = $scope.user_staffing.check_out;

            if (check_in == '' || check_in == '0000-00-00 00:00:00') {
                alert('please enter check in date time..');
                return false;
            }

            $http.post('date_wise_time_sheet/update-staffing-edit/' + $stateParams.id+'/'+$scope.staffing_date, {
                staffings: $scope.user_staffing,
                breaks: $scope.user_breaks
            }).success(function (data) {
                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $rootScope.PreviousState.goToLastState();
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                    $('body,html').scrollTop(0);
                }
            });
        };

        $scope.addStaffingDateWise = function () {

            var check_in = $scope.user_staffing.check_in;
            var check_out = $scope.user_staffing.check_out;

            if (check_in == '' || check_in == '0000-00-00 00:00:00') {
                alert('please enter check in date time..');
                return false;
            }

            $http.post('date_wise_time_sheet/add-staffing-edit/' + $stateParams.date+'/'+$stateParams.user_id, {
                staffings: $scope.user_staffing,
                breaks: $scope.user_breaks
            }).success(function (data) {
                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    alert(data.alert_msg);
                    $rootScope.PreviousState.goToLastState();
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                    $('body,html').scrollTop(0);
                }
            });
        };

    }]);