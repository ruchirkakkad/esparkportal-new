/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('DepartmentsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'departments_name': '',
            'departments_id': ''
        };

        $scope.resetData = function() {
            $scope.data = {
                'departments_name': '',
                'departments_id': ''
            };
        };

        $scope.create = function () {

            $http.post('departments/store-add', {
                departments_name: $scope.data.departments_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.departments.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('departments/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.departments_name = data.timezones_name;
                    $scope.data.departments_id = data.timezones_id;
                });
        }


        $scope.update = function () {


            $http.post('timezones/update-edit/' + $scope.data.timezones_id, {
                timezones_name: $scope.data.timezones_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.timezones.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
