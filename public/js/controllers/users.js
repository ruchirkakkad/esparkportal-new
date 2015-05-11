/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('UsersController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope','$filter',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope,$filter) {

        $scope.data = {
            'users_approve': [],
            'userApproveData': [],
            'users': []

        };
        $scope.user_departments = [];
        $scope.users_data = [];
        $scope.user_view_file = '';

        $http.get('js/app/contact/contacts.json').then(function (resp) {
            $scope.items = resp.data.items;
            $scope.item = $filter('orderBy')($scope.items, 'first')[0];
            $scope.item.selected = true;
        });

        $scope.filter = '';
        $scope.groups = [
            {name: 'Coworkers'},
            {name: 'Family'},
            {name: 'Friends'},
            {name: 'Partners'},
            {name: 'Group'}
        ];

        $scope.indexViewUser = function(){
            $http.get('users/userdata-view', {}).success(function (data) {
                $scope.user_departments = data.departments;
                $scope.users_data = data.users;
                $scope.user_view_file = 'tpl/user_view_file.html';
            });
        };
        $scope.selectGroup = function(item){
            angular.forEach($scope.user_departments, function(item) {
                item.selected = false;
            });
            $scope.user_departments = item;
            $scope.user_departments.selected = true;
            $scope.filter = item.departments_id;
        };



        $scope.approveFind = function () {

        }
        $scope.approve_user_view_file = '';
        $scope.index = function () {
            $http.get('users/approve-data-edit', {}).success(function (data) {
                $scope.data.users_approve = data.aaData;
                $scope.approve_user_view_file = 'tpl/approve_user_view_file.html';
            });
        }

        $scope.editChangeApproveData = function () {
            $http.post('users/find-change-approve-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.userApproveData = data;
                });
        }
        $scope.saveApprovedUpdate = function () {
            $http.post('users/update-approve-edit/' + $scope.data.userApproveData.users.user_encrypted_id, {
                department_id: $scope.data.userApproveData.users.department_id,
                designation_id: $scope.data.userApproveData.designation[$scope.data.userApproveData.users.designation_id]['designations_id'],
                job_profile: $scope.data.userApproveData.users.job_profile,
                role_id: $scope.data.userApproveData.users.role_id,
                email: $scope.data.userApproveData.users.email,
                password: $scope.data.userApproveData.users.password,
                employee_id: $scope.data.userApproveData.users.employee_id,
                doj: $scope.data.userApproveData.users.dateJoin
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {
                    $scope.approve_user_view_file = '';
                    Flash.create('success', data.msg);
                    $state.go('app.users.approve');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        }


    }]);
