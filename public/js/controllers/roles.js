/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('RolesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'name': '',
            'id': ''
        };

        $scope.resetData = function() {
            $scope.data = {
                'name': '',
                'id': ''
            };
        };

        $scope.create = function () {

            $http.post('roles/store-add', {
                name: $scope.data.name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.roles.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('roles/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.name = data.name;
                    $scope.data.id = data.id;
                });
        }


        $scope.update = function () {


            $http.post('roles/update-edit/' + $scope.data.id, {
                name: $scope.data.name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.roles.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
