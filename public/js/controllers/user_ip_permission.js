
app.controller('UserIpPermissionController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            users: {},
            ip_access_expire_time: null
        };
        $scope.getUsers = function () {
            $http.post('user_ip_permission/indexdata-view', {})
                .success(function (data) {
                    $scope.data.users = data.users;
                });
        };


        $scope.editData = function () {
            $http.post('user_ip_permission/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.ip_access_expire_time = data.ip_access_expire_time;
                    $scope.data.name = data.first_name+' '+data.last_name;
                });
        }


        $scope.update = function () {


            $http.post('user_ip_permission/update-edit/' + $stateParams.id, {
                ip_access_expire_time: $scope.data.ip_access_expire_time
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.user_ip_permission.index',{},{reload: true});
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
