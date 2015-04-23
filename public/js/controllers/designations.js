/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('DesignationsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'designations_name': '',
            'designations_id': '',
            'designations' : []
        };
        $scope.department_view_file = '';
        $scope.index = function() {
            $http.get('designations/indexdata-view', {}).success(function (data) {
                $scope.data.designations = data.aaData;
                $scope.designation_view_file = 'tpl/designations_view.html';
            });
        }
        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.designations, function(value, key) {
                csv[key] = {
                    id: value.designations_id,
                    name : value.designations_name
                }
            });
            return csv;
        };
        $scope.resetData = function() {
            $scope.data = {
                'designations_name': '',
                'designations_id': ''
            };
        };

        $scope.create = function () {

            $http.post('designations/store-add', {
                designations_name: $scope.data.designations_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    $scope.department_view_file = '';
                    Flash.create('success', data.msg);
                    $state.go('app.designations.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('designations/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.designations_name = data.designations_name;
                    $scope.data.designations_id = data.designations_id;
                });
        }


        $scope.update = function () {


            $http.post('designations/update-edit/' + $scope.data.designations_id, {
                designations_name: $scope.data.designations_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    $scope.department_view_file = '';
                    Flash.create('success', data.msg);
                    $state.go('app.designations.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
