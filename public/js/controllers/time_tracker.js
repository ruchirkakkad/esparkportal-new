/**
 * Created by ruchir on 5/21/2015.
 */
app.controller('TimeTrackerController', ['$scope', '$http', '$state', '$interval','$rootScope',
    function ($scope, $http, $state, $interval,$rootScope) {

        $scope.data = {
            users : {}
        };
        $scope.getUsers = function(){
            $http.get('time_tracker/users-list-view', {})
                .success(function (data) {
                    $scope.data.users= data.users;
                });
        };
    }]);
