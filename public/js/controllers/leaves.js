

app.controller('LeavesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'leave_name': '',
            'leaves_id': '',
            'subject': '',
            'leave_types_id': '',
            'leave_date': '',
            'description': '',
            'leaves' : [],
            'leave_types' : []
        };
        $scope.leaves_view_file = '';
        $scope.index = function() {
            $scope.leaves_view_file = '';
            $http.get('leaves/indexdata-view', {}).success(function (data) {
                $scope.data.leaves = data.aaData;
                $scope.leaves_view_file = 'tpl/leaves_view_file.html';
            });
        }
        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.leaves, function(value, key) {
                csv[key] = {
                    id: value.leaves_id,
                    name : value.leaves_name
                }
            });
            return csv;
        };
        $scope.resetData = function() {
            $http.get('leaves/leave-types-add', {})
                .success(function (data) {
                    $scope.data.leave_types= data;
                });
            $scope.data = {
                'leaves_name': '',
                'leaves_id': ''
            };
        };

        $scope.create = function () {

            $http.post('leaves/store-add', {
                subject: $scope.data.subject,
                leave_types_id: $scope.data.leave_types_id,
                leave_date: $scope.data.leave_date,
                description: $scope.data.description
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.leaves.index',{},{reload: true});
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('leaves/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.leaves_name = data.leaves_name;
                    $scope.data.leaves_id = data.leaves_id;
                });
        }


        $scope.update = function () {


            $http.post('leaves/update-edit/' + $scope.data.leaves_id, {
                leaves_name: $scope.data.leaves_name
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.leaves.index',{},{reload: true});
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
