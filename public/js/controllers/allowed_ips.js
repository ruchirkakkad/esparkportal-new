/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('AllowedIpsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'allowed_ips_name': '',
            'allowed_ips_id': '',
            'allowed_ips' : []
        };
        $scope.allowed_ips_view_file = '';
        $scope.index = function() {
            $scope.allowed_ips_view_file = '';
            $http.get('allowed_ips/indexdata-view', {}).success(function (data) {
                $scope.data.allowed_ips = data.aaData;
                $scope.allowed_ips_view_file = 'tpl/allowed_ips_view_file.html';
            });
        }
        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.allowed_ips, function(value, key) {
                csv[key] = {
                    id: value.allowed_ips_id,
                    name : value.allowed_ips_name
                }
            });
            return csv;
        };
        $scope.resetData = function() {
            $scope.data = {
                'allowed_ips_name': '',
                'allowed_ips_id': ''
            };
        };

        $scope.create = function () {

            $http.post('allowed_ips/store-add', {
                allowed_ips_name: $scope.data.allowed_ips_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.allowed_ips.index',{},{reload: true});
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('allowed_ips/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.allowed_ips_name = data.allowed_ips_name;
                    $scope.data.allowed_ips_id = data.allowed_ips_id;
                });
        }


        $scope.update = function () {


            $http.post('allowed_ips/update-edit/' + $scope.data.allowed_ips_id, {
                allowed_ips_name: $scope.data.allowed_ips_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.allowed_ips.index',{},{reload: true});
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
