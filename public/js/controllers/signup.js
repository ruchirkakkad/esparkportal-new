'use strict';

// signup controller
app.controller('SignupFormController', ['$scope', '$http', '$state','Flash', function ($scope, $http, $state,Flash) {
        $scope.user = {};
        $scope.authError = null;
        $scope.signup = function () {
            $scope.authError = null;
            // Try to create

            $http.post('usersStore', {first_name: $scope.user.first_name, email: $scope.user.email, middle_name: $scope.user.middle_name, last_name: $scope.user.last_name})
                    .success(function (data) {
                        if (data == 1)
                        {
//                            $scope.authError='HR will contact you soon..!';
                            Flash.create('success','HR will contact you soon..!');
                        }
                        else
                        {
//                            $scope.authError='Something went wrong..!';
                            Flash.create('error','Something went wrong..!');
                        }
                    }, function (x) {
                        $scope.authError = 'Server Error';
                    });
        };
    }])
        ;