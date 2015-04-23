/**
 * Created by ruchir on 4/7/2015.
 */


app.controller('MarketingCountriesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {
        console.log($rootScope.permission);
        $scope.country = {
            'marketing_countries_name': '',
            'marketing_countries_id': ''

        };
        $scope.data = {
            'marketing_countries': []
        };

        $scope.country_view_file = '';
        $scope.index = function () {
            $http.get('marketing_countries/indexdata-view', {}).success(function (data) {
                $scope.data.marketing_countries = data.aaData;
                $scope.country_view_file = 'tpl/marketing_countries_view.html';
            });
        }
        $scope.getArray = function () {
            var csv = [];
            angular.forEach($scope.data.marketing_countries, function (value, key) {
                csv[key] = {
                    id: value.marketing_countries_id,
                    name: value.marketing_countries_name
                }
            });
            return csv;
        };

        $scope.create = function () {

            $http.post('marketing_countries/store-add', {
                marketing_countries_name: $scope.country.marketing_countries_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.marketing_countries.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('marketing_countries/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.country.marketing_countries_name = data.marketing_countries_name;
                    $scope.country.marketing_countries_id = data.marketing_countries_id;
                });
        }


        $scope.update = function () {


            $http.post('marketing_countries/update-edit/' + $scope.country.marketing_countries_id, {
                marketing_countries_name: $scope.country.marketing_countries_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.marketing_countries.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.importantforcallingeverytimeduringrouting = function () {
            $rootScope.$on('$stateChangeStart',
                function (event, toState, toParams, fromState, fromParams) {
                    alert('in')
                });
        };

    }]);