'use strict';

/* Controllers */
// signin controller
app.factory('ModuleService', function ModuleService($http) {
    return {
        parentdata: function parentdata() {
            return $http.post('modules/parentdata');
        }
    }
});

app.controller('ModuleCreateFormController', ['$scope', '$http', '$state','ModuleService','Flash',
    function ($scope, $http, $state,ModuleService,Flash) {

        $scope.module_name = '';
        $scope.parent_id = '';
        $scope.module_url = '';
        $scope.is_active = 1;
        $scope.is_inmenu = 1;
        $scope.module_controller = '';

        ModuleService.parentdata().success(function (data) {
            $scope.parent_modules = (data);
        });



        $scope.create = function () {
            if ($scope.parent_id == '') {
                $scope.parent_id = 0;
            }
            $http.post('modules/store', {
                module_name: $scope.module_name,
                parent_id: $scope.parent_id,
                module_url: $scope.module_url,
                is_active: $scope.is_active,
                is_inmenu: $scope.is_inmenu,
                module_controller:$scope.module_controller
            })
                .success(function (data) {

                    var data = (data);

                    if (data.code == '200') {

                        Flash.create('success', 'Created');
                        $state.go('app.modules.index');
                    }
                    if (data.code == '403') {
                        alert(data.msg)
                    }
                }, function (x) {
                    alert('Server Error');
                    //$scope.authError = 'Server Error';
                });
        };
    }]);

app.controller('ModuleEditFormController', ['$scope', '$http', '$state', '$stateParams','ModuleService','Flash',
    function ($scope, $http, $state, $stateParams,ModuleService,Flash) {


        $scope.module_name = '';
        $scope.module_id = '';

        $scope.module_url = '';
        $scope.is_active = 1;
        $scope.is_inmenu = 1;
        $scope.module_controller = '';


        $scope.parent_modules;

        ModuleService.parentdata()
            .success(function (data) {
                $scope.parent_modules = (data);

                $scope.module_id = $stateParams.id;
                $http.post('modules/find/' + $stateParams.id, {module_id: $stateParams.id})
                    .success(function (data) {
                        $scope.module_name = data.module_name;
                        $scope.parent_id = data.parent_id;
                        $scope.module_url = data.module_url;
                        $scope.is_active = data.is_active;
                        $scope.is_inmenu = data.is_inmenu;
                        $scope.module_controller = data.module_controller;

                    });
            });


        $scope.update = function () {

            if ($scope.parent_id == '') {
                $scope.parent_id = 0;
            }
            $http.post('modules/update/' + $scope.module_id, {
                module_name: $scope.module_name,
                parent_id: $scope.parent_id,
                module_url: $scope.module_url,
                is_active: $scope.is_active,
                is_inmenu: $scope.is_inmenu,
                module_controller:$scope.module_controller

            })
                .success(function (data) {

                    var data = (data);
                    console.log(data)
                    if (data.code == '200') {

                        //Flash.add('success', 'Edited', 'custom-class')
                        Flash.create('success', 'Edited');
                        $state.go('app.modules.index');
                    }
                    if (data.code == '403') {
                        alert(data.msg);
                        $state.go('app.modules.index');
                    }
                }, function (x) {
                    alert('Server Error');
                    //$scope.authError = 'Server Error';
                });
        };


    }]);




app.controller('ModulesController', ['$scope', '$http', '$state','ModuleService','Flash',
    function ($scope, $http, $state,ModuleService,Flash) {


    }]);
