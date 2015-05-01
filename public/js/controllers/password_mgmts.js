/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('PasswordMgmtsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.itemsByPage = 100;

        $scope.data = {
            'password_mgmts_id': '',
            'password_mgmts': [],
            'users_data': [],

            'project_name' : "",
            'user_ids' : null,
            'live_f_url' : "",
            'live_b_url' : "",
            'live_b_username1' : "",
            'live_b_password1' : "",
            'live_b_username2' : "",
            'live_b_password2' : "",
            'live_b_username3' : "",
            'live_b_password3' : "",
            'live_c_url' : "",
            'live_c_username' : "",
            'live_c_password' : "",
            'live_ftp_host' : "",
            'live_ftp_port' : "",
            'live_ftp_username' : "",
            'live_ftp_password' : "",
            'stagging_f_url' : "",
            'stagging_b_url' : "",
            'stagging_b_username1' : "",
            'stagging_b_password1' : "",
            'stagging_b_username2' : "",
            'stagging_b_password2' : "",
            'stagging_b_username3' : "",
            'stagging_b_password3' : "",
            'stagging_c_url' : "",
            'stagging_c_username' : "",
            'stagging_c_password' : "",
            'stagging_ftp_host' : "",
            'stagging_ftp_port' : "",
            'stagging_ftp_username' : "",
            'stagging_ftp_password' : "",
            'ourserver_f_url' : "",
            'ourserver_b_url' : "",
            'ourserver_b_username1' : "",
            'ourserver_b_password1' : "",
            'ourserver_b_username2' : "",
            'ourserver_b_password2' : "",
            'ourserver_b_username3' : "",
            'ourserver_b_password3' : "",
            'ourserver_c_url' : "",
            'ourserver_c_username' : "",
            'ourserver_c_password' : "",
            'ourserver_ftp_host' : "",
            'ourserver_ftp_port' : "",
            'ourserver_ftp_username' : "",
            'ourserver_ftp_password' : "",
        };

        $scope.us = [];

        $scope.password_mgmts_view_file = '';
        $scope.index = function () {
            $http.get('password_mgmts/indexdata-view', {}).success(function (data) {
                $scope.data.password_mgmts = data.aaData;
                $scope.password_mgmts_view_file = 'tpl/password_mgmts_view_file.html';
            });
        }
        $scope.getArray = function () {
            var csv = [];
            angular.forEach($scope.data.password_mgmts, function (value, key) {
                csv[key] = {
                    domain: value.domain,
                    cpanel_url: value.cpanel_url,
                    username: value.username,
                    password: value.password
                }
            });
            return csv;
        };

        $scope.password_mgmts_create_file = '';
        $scope.resetData = function() {
            $scope.data = {
                'domain': '',
                'password_mgmts_id': '',
                'cpanel_url': '',
                'username': '',
                'password': '',
                 users : null
            };

            $http.post('password_mgmts/fetch-users-add', {})
                .success(function (data) {
                    $scope.us = data.users_data;
                    $scope.password_mgmts_create_file = 'tpl/password_mgmts_create_file.html';
                    console.log($scope.us);
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

        $scope.create = function () {
            console.log($scope.data);
            $http.post('password_mgmts/store-add', {

                user_ids : $scope.data.user_ids,
                project_name : $scope.data.project_name,
                live_f_url : $scope.data.live_f_url,
                live_b_url : $scope.data.live_b_url,
                live_b_username1 : $scope.data.live_b_username1,
                live_b_password1 : $scope.data.live_b_password1,
                live_b_username2 : $scope.data.live_b_username2,
                live_b_password2 : $scope.data.live_b_password2,
                live_b_username3 : $scope.data.live_b_username3,
                live_b_password3 : $scope.data.live_b_password3,
                live_c_url : $scope.data.live_c_url,
                live_c_username : $scope.data.live_c_username,
                live_c_password : $scope.data.live_c_password,
                live_ftp_host : $scope.data.live_ftp_host,
                live_ftp_port : $scope.data.live_ftp_port,
                live_ftp_username : $scope.data.live_ftp_username,
                live_ftp_password : $scope.data.live_ftp_password,
                stagging_f_url : $scope.data.stagging_f_url,
                stagging_b_url : $scope.data.stagging_b_url,
                stagging_b_username1 : $scope.data.stagging_b_username1,
                stagging_b_password1 : $scope.data.stagging_b_password1,
                stagging_b_username2 : $scope.data.stagging_b_username2,
                stagging_b_password2 : $scope.data.stagging_b_password2,
                stagging_b_username3 : $scope.data.stagging_b_username3,
                stagging_b_password3 : $scope.data.stagging_b_password3,
                stagging_c_url : $scope.data.stagging_c_url,
                stagging_c_username : $scope.data.stagging_c_username,
                stagging_c_password : $scope.data.stagging_c_password,
                stagging_ftp_host : $scope.data.stagging_ftp_host,
                stagging_ftp_port : $scope.data.stagging_ftp_port,
                stagging_ftp_username : $scope.data.stagging_ftp_username,
                stagging_ftp_password : $scope.data.stagging_ftp_password,
                ourserver_f_url : $scope.data.ourserver_f_url,
                ourserver_b_url : $scope.data.ourserver_b_url,
                ourserver_b_username1 : $scope.data.ourserver_b_username1,
                ourserver_b_password1 : $scope.data.ourserver_b_password1,
                ourserver_b_username2 : $scope.data.ourserver_b_username2,
                ourserver_b_password2 : $scope.data.ourserver_b_password2,
                ourserver_b_username3 : $scope.data.ourserver_b_username3,
                ourserver_b_password3 : $scope.data.ourserver_b_password3,
                ourserver_c_url : $scope.data.ourserver_c_url,
                ourserver_c_username : $scope.data.ourserver_c_username,
                ourserver_c_password : $scope.data.ourserver_c_password,
                ourserver_ftp_host : $scope.data.ourserver_ftp_host,
                ourserver_ftp_port : $scope.data.ourserver_ftp_port,
                ourserver_ftp_username : $scope.data.ourserver_ftp_username,
                ourserver_ftp_password : $scope.data.ourserver_ftp_password
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.password_mgmts.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };



        $scope.showData = function () {
            $scope.password_mgmts_show_file = '';
            $http.post('password_mgmts/show-find-view/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.password_mgmts = data.password_mgmts;
                    $scope.us = data.users_data;
                    $scope.password_mgmts_show_file = 'tpl/password_mgmts_show_file.html';
                });
        };

        $scope.editData = function () {
            $scope.password_mgmts_edit_file = '';
            $http.post('password_mgmts/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data.password_mgmts = data.password_mgmts;
                    $scope.us = data.users_data;
                    $scope.password_mgmts_edit_file = 'tpl/password_mgmts_edit_file.html';
                });
        };


        $scope.update = function () {

            console.log($scope.data.password_mgmts.user_ids);

            var new_user_ids = [];
            angular.forEach($scope.data.password_mgmts.user_ids, function (value, key) {
                new_user_ids[key] = value.user_id;
            });

            $http.post('password_mgmts/update-edit/' + $scope.data.password_mgmts.password_mgmts_id, {
                user_ids : new_user_ids,
                project_name : $scope.data.password_mgmts.project_name,
                live_f_url : $scope.data.password_mgmts.live_f_url,
                live_b_url : $scope.data.password_mgmts.live_b_url,
                live_b_username1 : $scope.data.password_mgmts.live_b_username1,
                live_b_password1 : $scope.data.password_mgmts.live_b_password1,
                live_b_username2 : $scope.data.password_mgmts.live_b_username2,
                live_b_password2 : $scope.data.password_mgmts.live_b_password2,
                live_b_username3 : $scope.data.password_mgmts.live_b_username3,
                live_b_password3 : $scope.data.password_mgmts.live_b_password3,
                live_c_url : $scope.data.password_mgmts.live_c_url,
                live_c_username : $scope.data.password_mgmts.live_c_username,
                live_c_password : $scope.data.password_mgmts.live_c_password,
                live_ftp_host : $scope.data.password_mgmts.live_ftp_host,
                live_ftp_port : $scope.data.password_mgmts.live_ftp_port,
                live_ftp_username : $scope.data.password_mgmts.live_ftp_username,
                live_ftp_password : $scope.data.password_mgmts.live_ftp_password,
                stagging_f_url : $scope.data.password_mgmts.stagging_f_url,
                stagging_b_url : $scope.data.password_mgmts.stagging_b_url,
                stagging_b_username1 : $scope.data.password_mgmts.stagging_b_username1,
                stagging_b_password1 : $scope.data.password_mgmts.stagging_b_password1,
                stagging_b_username2 : $scope.data.password_mgmts.stagging_b_username2,
                stagging_b_password2 : $scope.data.password_mgmts.stagging_b_password2,
                stagging_b_username3 : $scope.data.password_mgmts.stagging_b_username3,
                stagging_b_password3 : $scope.data.password_mgmts.stagging_b_password3,
                stagging_c_url : $scope.data.password_mgmts.stagging_c_url,
                stagging_c_username : $scope.data.password_mgmts.stagging_c_username,
                stagging_c_password : $scope.data.password_mgmts.stagging_c_password,
                stagging_ftp_host : $scope.data.password_mgmts.stagging_ftp_host,
                stagging_ftp_port : $scope.data.password_mgmts.stagging_ftp_port,
                stagging_ftp_username : $scope.data.password_mgmts.stagging_ftp_username,
                stagging_ftp_password : $scope.data.password_mgmts.stagging_ftp_password,
                ourserver_f_url : $scope.data.password_mgmts.ourserver_f_url,
                ourserver_b_url : $scope.data.password_mgmts.ourserver_b_url,
                ourserver_b_username1 : $scope.data.password_mgmts.ourserver_b_username1,
                ourserver_b_password1 : $scope.data.password_mgmts.ourserver_b_password1,
                ourserver_b_username2 : $scope.data.password_mgmts.ourserver_b_username2,
                ourserver_b_password2 : $scope.data.password_mgmts.ourserver_b_password2,
                ourserver_b_username3 : $scope.data.password_mgmts.ourserver_b_username3,
                ourserver_b_password3 : $scope.data.password_mgmts.ourserver_b_password3,
                ourserver_c_url : $scope.data.password_mgmts.ourserver_c_url,
                ourserver_c_username : $scope.data.password_mgmts.ourserver_c_username,
                ourserver_c_password : $scope.data.password_mgmts.ourserver_c_password,
                ourserver_ftp_host : $scope.data.password_mgmts.ourserver_ftp_host,
                ourserver_ftp_port : $scope.data.password_mgmts.ourserver_ftp_port,
                ourserver_ftp_username : $scope.data.password_mgmts.ourserver_ftp_username,
                ourserver_ftp_password : $scope.data.password_mgmts.ourserver_ftp_password
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.password_mgmts.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
