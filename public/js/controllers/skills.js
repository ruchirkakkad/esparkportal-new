/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('SkillsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'skills_name': '',
            'skills_id': '',
            'skills' : []
        };

        $scope.index = function() {
            $scope.skills_view = '';
            $http.get('skills/indexdata-view', {}).success(function (data) {
                $scope.data.skills = data.aaData;
                $scope.skills_view = 'tpl/skills_view.html';
            });
        }
        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.skills, function(value, key) {
                csv[key] = {
                    id: value.skills_id,
                    name : value.skills_name
                }
            });
            return csv;
        };
        $scope.resetData = function() {
            $scope.data = {
                'skills_name': '',
                'skills_id': ''
            };
        };

        $scope.create = function () {

            $http.post('skills/store-add', {
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


        $scope.editData = function () {
            $http.post('skills/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.skills_name = data.skills_name;
                    $scope.data.skills_id = data.skills_id;
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
