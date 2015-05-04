/**
 * Created by ruchir on 5/4/2015.
 */

app.controller('UserProfilesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.itemsByPage = 100;

        $scope.data = {
            user: {
                    'work_experiences': [
                        {
                            job_duration: '',
                            company_name: '',
                            company_number: '',
                            company_address: ''
                        }
                    ],
                attechments : [
                    {
                        attachment_name: '',
                        attachment_url: ''
                    }
                ]
                }

        };

        $scope.addWorkExperience = function (){
            $scope.data.user.work_experiences.push({
                job_duration: '',
                company_name: '',
                company_number: '',
                company_address: ''
            });
        };

        $scope.addAttechments = function (){
            $scope.data.user.attechments.push({
                attachment_name: '',
                attachment_url: ''
            });
        };
        $scope.us = [];

        $scope.password_mgmts_view_file = '';
        $scope.index = function () {
            $http.get('password_mgmts/indexdata-view', {}).success(function (data) {
                $scope.data.password_mgmts = data.aaData;
                $scope.password_mgmts_view_file = 'tpl/password_mgmts_view_file.html';
            });
        }

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
                user_ids: new_user_ids,
                project_name: $scope.data.password_mgmts.project_name,
                live_f_url: $scope.data.password_mgmts.live_f_url,
                live_b_url: $scope.data.password_mgmts.live_b_url,
                live_b_username1: $scope.data.password_mgmts.live_b_username1,
                live_b_password1: $scope.data.password_mgmts.live_b_password1,
                live_b_username2: $scope.data.password_mgmts.live_b_username2,
                live_b_password2: $scope.data.password_mgmts.live_b_password2,
                live_b_username3: $scope.data.password_mgmts.live_b_username3,
                live_b_password3: $scope.data.password_mgmts.live_b_password3,
                live_c_url: $scope.data.password_mgmts.live_c_url,
                live_c_username: $scope.data.password_mgmts.live_c_username,
                live_c_password: $scope.data.password_mgmts.live_c_password,
                live_ftp_host: $scope.data.password_mgmts.live_ftp_host,
                live_ftp_port: $scope.data.password_mgmts.live_ftp_port,
                live_ftp_username: $scope.data.password_mgmts.live_ftp_username,
                live_ftp_password: $scope.data.password_mgmts.live_ftp_password,
                stagging_f_url: $scope.data.password_mgmts.stagging_f_url,
                stagging_b_url: $scope.data.password_mgmts.stagging_b_url,
                stagging_b_username1: $scope.data.password_mgmts.stagging_b_username1,
                stagging_b_password1: $scope.data.password_mgmts.stagging_b_password1,
                stagging_b_username2: $scope.data.password_mgmts.stagging_b_username2,
                stagging_b_password2: $scope.data.password_mgmts.stagging_b_password2,
                stagging_b_username3: $scope.data.password_mgmts.stagging_b_username3,
                stagging_b_password3: $scope.data.password_mgmts.stagging_b_password3,
                stagging_c_url: $scope.data.password_mgmts.stagging_c_url,
                stagging_c_username: $scope.data.password_mgmts.stagging_c_username,
                stagging_c_password: $scope.data.password_mgmts.stagging_c_password,
                stagging_ftp_host: $scope.data.password_mgmts.stagging_ftp_host,
                stagging_ftp_port: $scope.data.password_mgmts.stagging_ftp_port,
                stagging_ftp_username: $scope.data.password_mgmts.stagging_ftp_username,
                stagging_ftp_password: $scope.data.password_mgmts.stagging_ftp_password,
                ourserver_f_url: $scope.data.password_mgmts.ourserver_f_url,
                ourserver_b_url: $scope.data.password_mgmts.ourserver_b_url,
                ourserver_b_username1: $scope.data.password_mgmts.ourserver_b_username1,
                ourserver_b_password1: $scope.data.password_mgmts.ourserver_b_password1,
                ourserver_b_username2: $scope.data.password_mgmts.ourserver_b_username2,
                ourserver_b_password2: $scope.data.password_mgmts.ourserver_b_password2,
                ourserver_b_username3: $scope.data.password_mgmts.ourserver_b_username3,
                ourserver_b_password3: $scope.data.password_mgmts.ourserver_b_password3,
                ourserver_c_url: $scope.data.password_mgmts.ourserver_c_url,
                ourserver_c_username: $scope.data.password_mgmts.ourserver_c_username,
                ourserver_c_password: $scope.data.password_mgmts.ourserver_c_password,
                ourserver_ftp_host: $scope.data.password_mgmts.ourserver_ftp_host,
                ourserver_ftp_port: $scope.data.password_mgmts.ourserver_ftp_port,
                ourserver_ftp_username: $scope.data.password_mgmts.ourserver_ftp_username,
                ourserver_ftp_password: $scope.data.password_mgmts.ourserver_ftp_password
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
