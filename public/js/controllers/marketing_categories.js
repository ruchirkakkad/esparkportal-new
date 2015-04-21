/**
 * Created by ruchir on 4/8/2015.
 */

app.controller('MarketingCategoriesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'marketing_categories_name': '',
            'marketing_categories_id': ''
        };

        $scope.resetData = function() {
            $scope.data = {
                'marketing_categories_name': '',
                'marketing_categories_id': ''
            };
        };

        $scope.create = function () {

            $http.post('marketing_categories/store-add', {
                marketing_categories_name: $scope.data.marketing_categories_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.marketing_categories.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('marketing_categories/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.marketing_categories_name = data.marketing_categories_name;
                    $scope.data.marketing_categories_id = data.marketing_categories_id;
                });
        }


        $scope.update = function () {


            $http.post('marketing_categories/update-edit/' + $scope.data.marketing_categories_id, {
                marketing_categories_name: $scope.data.marketing_categories_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.marketing_categories.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
