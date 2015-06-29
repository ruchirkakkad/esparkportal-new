app.controller('LeaveTypesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'leave_types_name': '',
            'leave_types_id': '',
            'leave_types' : []
        };
        $scope.index = function() {
            $scope.leave_types_view_file = '';
            $scope.department_view_file = '';
            $http.get('leave_types/indexdata-view', {}).success(function (data) {
                $scope.data.leave_types = data.aaData;
                $scope.leave_types_view_file = 'tpl/leave_types_view_file.html';
            });
        }
        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.leave_types, function(value, key) {
                csv[key] = {
                    id: value.leave_types_id,
                    leave_name : value.leave_name,
                    leave_title : value.leave_title,
                    leave_comment : value.leave_comment,
                    start_duration : value.start_duration,
                    total_leaves : value.total_leaves+'/'+value.total_leaves_type
                }
            });
            return csv;
        };
        $scope.resetData = function() {
            $scope.data = {
                'leave_types_name': '',
                'leave_types_id': ''
            };
        };

        $scope.create = function () {

            $http.post('leave_types/store-add', {
                leave_name: $scope.data.leave_name,
                leave_title: $scope.data.leave_title,
                leave_comment: $scope.data.leave_comment,
                start_duration: $scope.data.start_duration,
                total_leaves: $scope.data.total_leaves,
                total_leaves_type: $scope.data.total_leaves_type
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.leave_types.index-view',{},{reload: true});
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('leave_types/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data = data;
                });
        }


        $scope.update = function () {


            $http.post('leave_types/update-edit/' + $scope.data.leave_types_id, {
                leave_name: $scope.data.leave_name,
                leave_title: $scope.data.leave_title,
                leave_comment: $scope.data.leave_comment,
                start_duration: $scope.data.start_duration,
                total_leaves: $scope.data.total_leaves,
                total_leaves_type: $scope.data.total_leaves_type
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.leave_types.index-view',{},{reload: true});
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
