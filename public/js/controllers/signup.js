'use strict';

// signup controller
app.controller('SignupFormController', ['$scope', '$http', '$state', 'Flash', function ($scope, $http, $state, Flash) {
    $scope.user = {};
    $scope.authError = null;
    $scope.signup = function () {
        $scope.authError = null;
        // Try to create

        $http.post('usersStore', {
            first_name: $scope.user.first_name,
            email: $scope.user.email,
            middle_name: $scope.user.middle_name,
            last_name: $scope.user.last_name
        })
            .success(function (data) {
                if (data.code == '200') {


                    Flash.create('success', data.msg);
                    $state.go('app.access.signin');
                }
                if (data.code == '403') {
                    //$scope.errors = data.result;
                    angular.forEach(data.result,function(value, key)
                    {
                        Flash.create('success', value);
                    });

                }
            }, function (x) {
                $scope.authError = 'Server Error';
            });
    };
}])
;