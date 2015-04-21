/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('PermissionsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
          'roles': [],
          'modules': [],
          'isSelected': null,
          'role_id' : '',
          'role_name' : '',
          'showRoles' : false
        };


        $scope.tree_view = "";
        $scope.my_data_tree = [];
        $scope.viewPermission = function() {
            $http.post('permissions/indexdata-view',{}).success(
                function(data){
                    $scope.data.roles = data.roles;
                    //$scope.data.modules = data.modules;

                    console.log($scope.data);

                }
            );
        };
        $scope.selectRole = function(id,role_name) {
            $scope.data.role_id = id;
            $scope.data.role_name = role_name;
            console.log($scope.data.role_id);
            $scope.data.showRoles =true;
            $scope.tree_view = "";
            $http.post('permissions/select-role-view',{role_id:id}).success(
                function(data){

                    $scope.my_data_tree =data.modules;
                    $scope.tree_view = "tpl/tree_view.html";
                    console.log($scope.isSelected);

                }
            );
        };
        var self = this;
        $scope.awesomeCallback = function() {
            console.log($scope.my_data);

        };
        var selectedNodes = [];

        $scope.save=function(){
            $http.post('permissions/save-permission-view',
                {data:$scope.my_data_tree, role_id: $scope.data.role_id}).success(
                function(data){
                    if (data.code == '200') {

                        Flash.create('success', data.msg);

                    }

                    //console.log(data);

                }
            );
        }

    }]);
