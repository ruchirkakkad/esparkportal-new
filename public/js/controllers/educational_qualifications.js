/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('EducationalQualificationsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'educational_qualifications_name': '',
            'educational_qualifications_id': '',
            'educational_qualifications' : []
        };

        $scope.index = function() {
            $scope.educational_qualifications_view = '';
            $http.get('educational_qualifications/indexdata-view', {}).success(function (data) {
                $scope.data.educational_qualifications = data.aaData;
                $scope.educational_qualifications_view = 'tpl/educational_qualifications_view.html';
            });
        }
        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.educational_qualifications, function(value, key) {
                csv[key] = {
                    id: value.educational_qualifications_id,
                    name : value.educational_qualifications_name
                }
            });
            return csv;
        };
        $scope.resetData = function() {
            $scope.data = {
                'educational_qualifications_name': '',
                'educational_qualifications_id': ''
            };
        };

        $scope.create = function () {

            $http.post('educational_qualifications/store-add', {
                educational_qualifications_name: $scope.data.educational_qualifications_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.educational_qualifications.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('educational_qualifications/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.educational_qualifications_name = data.educational_qualifications_name;
                    $scope.data.educational_qualifications_id = data.educational_qualifications_id;
                });
        }


        $scope.update = function () {


            $http.post('educational_qualifications/update-edit/' + $scope.data.educational_qualifications_id, {
                educational_qualifications_name: $scope.data.educational_qualifications_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.educational_qualifications.index');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
