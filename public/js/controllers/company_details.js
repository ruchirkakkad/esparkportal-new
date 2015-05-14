/**
 * Created by ruchir on 5/14/2015.
 */

app.controller('CompanyDetailsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope', '$interval', '$filter', '$timeout',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope, $interval, $filter, $timeout) {

        $scope.data = {};

        $scope.indexData = function () {

            $http.get('company_details/indexdata-view', {})
                .success(function (data) {

                    $scope.data.company_details = data.company_details;

                }, function (x) {
                    Flash.create('danger', 'Server Error');
                });
        };

        $scope.update = function () {
            $http.post('company_details/update-view', {
                company_name : $scope.data.company_details.company_name,
                company_url : $scope.data.company_details.company_url,
                company_address : $scope.data.company_details.company_address,
                company_phone : $scope.data.company_details.company_phone,
                cp_first_name : $scope.data.company_details.cp_first_name,
                cp_last_name : $scope.data.company_details.cp_last_name,
                cp_email : $scope.data.company_details.cp_email,
                cp_phone : $scope.data.company_details.cp_phone,
            })
                .success(function (data) {

                });
        };

    }]);