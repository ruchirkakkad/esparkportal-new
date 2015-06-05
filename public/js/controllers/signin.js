'use strict';

/* Controllers */
// signin controller
app.controller('SigninFormController', ['$scope', '$http', '$state','$rootScope',
    function ($scope, $http, $state,$rootScope) {

        $scope.user = {};
        $scope.authError = null;
        $scope.login = function () {
            $scope.authError = null;

            // Try to login
            $http.post('checklogin', {email: $scope.user.email, password: $scope.user.password})
                .success(function (data) {
                    $scope.authError = null;
                    $scope.authError = null;
                    if (data == '0') {
                        $scope.authError = 'Email or Password not right';
                    } else {


                        $rootScope.permission=data.permission;
                        $rootScope.user=data.user;

                        $state.go('app.dashboard');
                    }
                }, function (x) {
                    //$scope.authError = 'Server Error';
                });
        };
    }]);