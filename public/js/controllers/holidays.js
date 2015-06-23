/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('HolidaysController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'holidays_name': '',
            'holidays_id': '',
            'holidays' : []
        };

        $scope.index = function() {
            $scope.holidays_view = '';
            $http.get('holidays/indexdata-view', {}).success(function (data) {
                $scope.data.holidays = data.aaData;
                $scope.holidays_view = 'tpl/holidays_view.html';
            });
        };
        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.holidays, function(value, key) {
                csv[key] = {
                    id: value.holidays_id,
                    name : value.holidays_name,
                    date : value.holidays_date
                }
            });
            return csv;
        };
        $scope.resetData = function() {
            $scope.data = {
                'holidays_date': '',
                'holidays_name': '',
                'holidays_id': ''
            };
        };

        $scope.create = function () {

            $http.post('holidays/store-add', {
                holidays_name: $scope.data.holidays_name,
                holidays_date: $scope.data.holidays_date
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.holidays.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('holidays/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.holidays_name = data.holidays_name;
                    $scope.data.holidays_date = data.holidays_date;
                    $scope.data.holidays_id = data.holidays_id;
                });
        }


        $scope.update = function () {


            $http.post('holidays/update-edit/' + $scope.data.holidays_id, {
                holidays_name: $scope.data.holidays_name,
                holidays_date: $scope.data.holidays_date
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.holidays.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
