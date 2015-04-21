'use strict';

/* Controllers */
// signin controller
app.controller('SigninFormController', ['$scope', '$http', '$state',
    function ($scope, $http, $state) {

        $scope.user = {};
        $scope.authError = null;
        $scope.login = function () {
            $scope.authError = null;

            // Try to login
            $http.post('checklogin', {email: $scope.user.email, password: $scope.user.password})
                .success(function (data) {

                    if (data == '0') {
                        $scope.authError = 'Email or Password not right';
                    } else {
                        $state.go('app.dashboard');
                    }
                }, function (x) {
                    $scope.authError = 'Server Error';
                });
        };
    }]);