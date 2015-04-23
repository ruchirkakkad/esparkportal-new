/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('TimezonesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'timezones_name': '',
            'timezones_id': '',
            'timezones': []
        };


        $scope.timezone_view_file = '';
        $scope.index = function () {
            $http.get('timezones/indexdata-view', {}).success(function (data) {
                $scope.data.timezones = data.aaData;
                $scope.timezone_view_file = 'tpl/timezones_view.html';
            });
        }
        $scope.getArray = function () {
            var csv = [];
            angular.forEach($scope.data.timezones, function (value, key) {
                csv[key] = {
                    id: value.timezones_id,
                    name: value.timezones_name
                }
            });
            return csv;
        };

        $scope.resetData = function() {
            $scope.data = {
                'timezones_name': '',
                'timezones_id': ''
            };
        };

        $scope.create = function () {

            $http.post('timezones/store-add', {
                timezones_name: $scope.data.timezones_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.timezones.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('timezones/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.timezones_name = data.timezones_name;
                    $scope.data.timezones_id = data.timezones_id;
                });
        }


        $scope.update = function () {


            $http.post('timezones/update-edit/' + $scope.data.timezones_id, {
                timezones_name: $scope.data.timezones_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.timezones.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
