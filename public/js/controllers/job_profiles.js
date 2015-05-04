/**
 * Created by ruchir on 5/1/2015.
 */

app.controller('JobProfilesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'job_profiles_name': '',
            'designations_id': '',
            'job_profiles_id': '',
            'job_profiles' : [],
            'designations' : []
        };
        $scope.job_profiles_view_file = '';
        $scope.index = function() {
            $scope.job_profiles_view_file = '';
            $http.get('job_profiles/indexdata-view', {}).success(function (data) {
                $scope.data.job_profiles = data.aaData;
                $scope.job_profiles_view_file = 'tpl/job_profiles_view_file.html';
            });
        }
        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.job_profiles, function(value, key) {
                csv[key] = {
                    id: value.job_profiles_id,
                    name : value.job_profiles_name,
                    designations : value.designations_name
                }
            });
            return csv;
        };
        $scope.resetData = function() {
            $scope.data.job_profiles_name = '';
            $scope.data.job_profiles_id = '';
            $http.post('job_profiles/designations-add', {}).success(function (data) {
                $scope.data.designations = data.designations;
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

        $scope.create = function () {
            console.log($scope.data);
            $http.post('job_profiles/store-add', {
                job_profiles_name: $scope.data.job_profiles_name,
                designations_id: $scope.data.designations_id
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.job_profiles.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('job_profiles/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.job_profiles_name = data.job_profiles.job_profiles_name;
                    $scope.data.job_profiles_id = data.job_profiles.job_profiles_id;
                    $scope.data.designations_id = data.job_profiles.designations_id;
                    $scope.data.designations = data.designations;
                });
        }


        $scope.update = function () {

            $http.post('job_profiles/update-edit/' + $scope.data.job_profiles_id, {
                job_profiles_name: $scope.data.job_profiles_name,
                designations_id: $scope.data.designations_id
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.job_profiles.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
