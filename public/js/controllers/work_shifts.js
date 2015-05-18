/**
 * Created by ruchir on 5/18/2015.
 */

app.controller('WorkShiftsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'work_shifts_name': '',
            'work_shifts_id': '',
            'staffing': '',
            'office_start_time': '',
            'office_end_time': '',
            'break_start_time': '',
            'break_end_time': '',
            'work_shifts' : []
        };

        $scope.hstep = 1;

        $scope.mstep = 1;

        $scope.ismeridian = false;

        $scope.index = function() {
            $scope.work_shifts_view = '';
            $http.get('work_shifts/indexdata-view', {}).success(function (data) {
                $scope.data.work_shifts = data.aaData;
                $scope.work_shifts_view = 'tpl/work_shifts_view.html';
            });
        };

        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.work_shifts, function(value, key) {
                csv[key] = {
                    id: value.work_shifts_id,
                    name : value.work_shifts_name
                }
            });
            return csv;
        };

        $scope.resetData = function() {
            $scope.data = {
                'work_shifts_name': '',
                'work_shifts_id': ''
            };
        };

        $scope.create = function () {

            $http.post('work_shifts/store-add', {
                work_shifts_name: $scope.data.work_shifts_name,
                staffing: $scope.data.staffing,
                office_start_time: $scope.data.office_start_time,
                office_end_time: $scope.data.office_end_time,
                break_start_time: $scope.data.break_start_time,
                break_end_time: $scope.data.break_end_time
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.work_shifts.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('work_shifts/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.work_shifts_name = data.work_shifts_name;

                    $scope.data.work_shifts_id = data.work_shifts_id;

                    var staff = data.staffing.split(":");

                    var start = data.office_start_time.split(":");
                    var end = data.office_end_time.split(":");

                    var break_start = data.break_start_time.split(":");
                    var break_end = data.break_end_time.split(":");

                    $scope.data.staffing = new Date(1991,11,05,staff[0],staff[1],staff[2]);

                    $scope.data.office_start_time = new Date(1991,11,05,start[0],start[1],start[2]);
                    $scope.data.office_end_time = new Date(1991,11,05,end[0],end[1],end[2]);

                    $scope.data.break_start_time = new Date(1991,11,05,break_start[0],break_start[1],break_start[2]);
                    $scope.data.break_end_time = new Date(1991,11,05,break_end[0],break_end[1],break_end[2]);

                });
        };


        $scope.update = function () {


            $http.post('work_shifts/update-edit/' + $scope.data.work_shifts_id, {
                work_shifts_name: $scope.data.work_shifts_name,
                staffing: $scope.data.staffing,
                office_start_time: $scope.data.office_start_time,
                office_end_time: $scope.data.office_end_time,
                break_start_time: $scope.data.break_start_time,
                break_end_time: $scope.data.break_end_time
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.work_shifts.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
