/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('SettingsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            fields : []
        };

        $scope.editData = function () {
            $http.post('settings/index-data-view', {})
                .success(function (data) {
                    $scope.data.fields = data;
                    console.log($scope.data.fields)
                });
        };


        $scope.update = function () {


            $http.post('settings/update-view', {
                fields: $scope.data.fields
            }).success(function (data) {

                //var data = (data);
                //
                //if (data.code == '200') {
                //    Flash.create('success', data.msg);
                //    $state.go('app.skills.index');
                //}
                //if (data.code == '403') {
                //    Flash.create('danger', data.msg);
                //}
            }, function (x) {
                //Flash.create('danger', 'Server Error');
            });
        };

    }]);
