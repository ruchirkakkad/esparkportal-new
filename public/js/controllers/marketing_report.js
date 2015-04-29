/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('MarketingReportController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope', '$interval', '$filter', '$timeout', 'editableOptions', 'editableThemes', '$modal', '$log',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope, $interval, $filter, $timeout, editableOptions, editableThemes, $modal, $log) {

        $scope.data = {
            marketing_users: []
        };

        $scope.marketing_report_chart_view = '';
        $scope.d3 = [
            { label: "iPhone5S", data: 40 },
            { label: "iPad Mini", data: 40 },
            { label: "iPad Mini Retina", data: 40 },
            { label: "iPad Mini Retina1", data: 40 },
            { label: "iPad Mini Retina2", data: 40 },
            { label: "iPad Mini Retina3", data: 40 },
            { label: "iPad Mini Retina4", data: 40 },
            { label: "iPhone4S", data: 12 },
            { label: "iPad Air", data: 18 }
        ];

        $scope.getMarketingUsers = function () {
            $scope.marketing_report_chart_view = '';
            $http.get('marketing_report/index-one-data-view', {})
                .success(function (data) {
                    $scope.data.marketing_users = data.marketing_users;

                }, function (x) {
                    Flash.create('danger', 'Server Error');
                });
        }

        $scope.userWiseChart = function() {
            $http.get('marketing_report/index-two-data-view/'+$stateParams.id, {})
                .success(function (data) {
                    $scope.total = data.total;
                    $scope.marketing_report_chart_view = 'tpl/marketing_report_chart_view.html';
                }, function (x) {
                    Flash.create('danger', 'Server Error');
                });
        }



    }]);