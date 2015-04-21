/**
 * Created by ruchir on 4/7/2015.
 */


app.controller('MarketingCountriesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.country = {
            'marketing_countries_name': '',
            'marketing_countries_id': ''
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