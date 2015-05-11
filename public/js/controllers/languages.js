/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('LanguagesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'languages_name': '',
            'languages_id': '',
            'languages' : []
        };

        $scope.index = function() {
            $scope.languages_view = '';
            $http.get('languages/indexdata-view', {}).success(function (data) {
                $scope.data.languages = data.aaData;
                $scope.languages_view = 'tpl/languages_view.html';
            });
        }
        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.languages, function(value, key) {
                csv[key] = {
                    id: value.languages_id,
                    name : value.languages_name
                }
            });
            return csv;
        };
        $scope.resetData = function() {
            $scope.data = {
                'languages_name': '',
                'languages_id': ''
            };
        };

        $scope.create = function () {

            $http.post('languages/store-add', {
                languages_name: $scope.data.languages_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.languages.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('languages/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.languages_name = data.languages_name;
                    $scope.data.languages_id = data.languages_id;
                });
        }


        $scope.update = function () {


            $http.post('languages/update-edit/' + $scope.data.languages_id, {
                languages_name: $scope.data.languages_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.languages.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
