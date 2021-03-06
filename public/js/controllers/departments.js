/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('DepartmentsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'departments_name': '',
            'departments_id': '',
            'departments' : []
        };
        $scope.department_view_file = '';
        $scope.index = function() {
            $http.get('departments/indexdata-view', {}).success(function (data) {
                $scope.data.departments = data.aaData;
                $scope.department_view_file = 'tpl/departments_view.html';
            });
        }
        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.departments, function(value, key) {
                csv[key] = {
                    id: value.departments_id,
                    name : value.departments_name
                }
            });
            return csv;
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
                    $scope.department_view_file = '';
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
                    $scope.data.departments_name = data.departments_name;
                    $scope.data.departments_id = data.departments_id;
                });
        }


        $scope.update = function () {


            $http.post('departments/update-edit/' + $scope.data.departments_id, {
                departments_name: $scope.data.departments_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    $scope.department_view_file = '';
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

    }]);
