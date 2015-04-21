/**
 * Created by ruchir on 4/10/2015.
 */

app.controller('LeadStatusesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'leads_statuses_name': '',
            'leads_statuses_id': ''
        };

        $scope.resetData = function() {
            $scope.data = {
                'leads_statuses_name': '',
                'leads_statuses_id': ''
            };
        };

        $scope.create = function () {

            $http.post('leads_statuses/store-add', {
                leads_statuses_name: $scope.data.leads_statuses_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.leads_statuses.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('leads_statuses/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.leads_statuses_name = data.leads_statuses_name;
                    $scope.data.leads_statuses_id = data.leads_statuses_id;
                });
        }


        $scope.update = function () {


            $http.post('leads_statuses/update-edit/' + $scope.data.leads_statuses_id, {
                leads_statuses_name: $scope.data.leads_statuses_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.leads_statuses.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
