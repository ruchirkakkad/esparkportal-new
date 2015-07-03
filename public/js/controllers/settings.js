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
                });
        }


        $scope.update = function () {


            $http.post('skills/update-edit/' + $scope.data.skills_id, {
                skills_name: $scope.data.skills_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.skills.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
