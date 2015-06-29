/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('UsersController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope','$filter', '$timeout', '$compile', 'Upload',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope,$filter, $timeout, $compile, Upload) {

        $scope.data = {
            'users_approve': [],
            'userApproveData': [],
            'users': []

        };
        $scope.user_attachments1 = [{
            attachment_name: '',
            attachment_url: ''
        }];
        $scope.user_departments = [];
        $scope.users_data = [];
        $scope.user_view_file = '';

        $scope.filter = '';
        $scope.groups = [];

        $scope.indexViewUser = function(){
            //alert('i');
            $http.get('users/userdata-view', {}).success(function (data) {
                $scope.groups = data.departments;
                console.log($scope.groups);
                $scope.users_data = data.users;
                $scope.items = data.users;
                $scope.item = $filter('orderBy')($scope.items, 'first_name')[0];
                $scope.item.selected = true;
                $scope.user_view_file = 'tpl/user_view_file.html';
            });

            $scope.selectGroup = function(item){
                console.log($scope.groups)
                angular.forEach($scope.groups, function(item) {
                    item.selected = false;
                });
                $scope.group = item;
                $scope.group.selected = true;
                $scope.filter = item.departments_id;
            };

            $scope.selectItem = function(item){
                angular.forEach($scope.items, function(item) {
                    item.selected = false;
                    item.editing = false;
                });
                $scope.item = item;
                $scope.item.selected = true;
            };

            $scope.checkItem = function(obj, arr, key){
                var i=0;
                angular.forEach(arr, function(item) {
                    if(item[key].indexOf( obj[key] ) == 0){
                        var j = item[key].replace(obj[key], '').trim();
                        if(j){
                            i = Math.max(i, parseInt(j)+1);
                        }else{
                            i = 1;
                        }
                    }
                });
                return obj[key] + (i ? ' '+i : '');
            };
        };


        $scope.showData = function () {
            $http.post('users/showdata-view/'+$stateParams.id, {})
                .success(function (data) {
                    console.log(data);
                    $scope.data.skills = data.skills;
                    $scope.data.educational_qualifications = data.educational_qualifications;
                    $scope.data.languages = data.languages;
                    $scope.data.user = data.user[0];
                    console.log($scope.data.user.user_work_experience);
                    if ($scope.data.user.user_personal.marital_status == 0) {
                        $scope.MaritalStatusChangeVarView = 0;
                    }
                    else {
                        $scope.MaritalStatusChangeVarView = 1;
                    }
                    $('#dvLoading').fadeOut(2000);
                    console.log($scope.data.user);
                });
        };

        $scope.convertToInt= function (value) {
            console.log(value)
            return parseInt(value);
        };

        $scope.profile_edit_general_details = '';
        $scope.var_profile_edit_general_details = true;

        $scope.profile_edit_personal_details = '';
        $scope.var_profile_edit_personal_details = false;

        $scope.profile_edit_contact_details = '';
        $scope.var_profile_edit_contact_details = false;

        $scope.profile_edit_emergency_details = '';
        $scope.var_profile_edit_emergency_details = false;

        $scope.profile_edit_company_details = '';
        $scope.var_profile_edit_company_details = false;

        $scope.profile_edit_work_experience = '';
        $scope.var_profile_edit_work_experience = false;

        $scope.profile_edit_qualification_details = '';
        $scope.var_profile_edit_qualification_details = false;

        $scope.profile_edit_bank_details = '';
        $scope.var_profile_edit_bank_details = false;

        $scope.profile_edit_attachments = '';
        $scope.var_profile_edit_attachments = false;


        $scope.data.skills = [];

        $scope.editData = function () {
            $('#dvLoading').css("display", "block");
            $scope.profile_edit_personal_details = "";
            $scope.profile_edit_general_details = "";
            $scope.profile_edit_contact_details = "";
            $scope.profile_edit_emergency_details = "";
            $scope.profile_edit_company_details = "";
            $scope.profile_edit_work_experience = "";
            $scope.profile_edit_bank_details = "";
            $scope.profile_edit_attachments = "";
            $scope.profile_edit_qualification_details = "";
            $http.post('users/find-edit/'+$stateParams.id, {})
                .success(function (data) {
                    console.log(data);
                    $scope.data.skills = data.skills;
                    $scope.data.educational_qualifications = data.educational_qualifications;
                    $scope.data.languages = data.languages;

                    $scope.data.department = data.department;
                    $scope.data.designation = data.designation;
                    $scope.data.role = data.role;


                    $scope.data.user = data.user[0];
                    $scope.data.user.job_profile = $scope.data.user.job_profile.job_profiles_id;
                    angular.forEach($scope.data.designation, function (value, key) {
                        if($scope.data.user.designation_id == value.designations_id)
                        {
                            $scope.data.user.designation_id = (key);
                        }
                    });
                    console.log($scope.data.user.user_personal);
                    if($scope.data.user.user_personal != null)
                    {
                        if ($scope.data.user.user_personal.marital_status == 0) {
                            $scope.MaritalStatusChangeVar = 0;
                        }
                        else {
                            $scope.MaritalStatusChangeVar = 1;
                        }
                    }


                    $scope.profile_edit_personal_details = "tpl/profile_edit_personal_details.html";
                    $scope.profile_edit_general_details = "tpl/profile_edit_general_details.html";
                    $scope.profile_edit_contact_details = "tpl/profile_edit_contact_details.html";
                    $scope.profile_edit_emergency_details = "tpl/profile_edit_emergency_details.html";
                    $scope.profile_edit_company_details = "tpl/profile_edit_company_details.html";
                    $scope.profile_edit_work_experience = "tpl/profile_edit_work_experience.html";
                    $scope.profile_edit_bank_details = "tpl/profile_edit_bank_details.html";
                    $scope.profile_edit_attachments = "tpl/profile_edit_attachments.html";
                    $scope.profile_edit_qualification_details = "tpl/profile_edit_qualification_details.html";

                    console.log($scope.data.user);
                }).then(function () {
                    $timeout(function () {
                        $scope.var_profile_edit_general_details = false;
                        $scope.var_profile_edit_personal_details = false;
                        $scope.var_profile_edit_contact_details = false;
                        $scope.var_profile_edit_emergency_details = false;
                        $scope.var_profile_edit_company_details = false;
                        $scope.var_profile_edit_work_experience = false;
                        $scope.var_profile_edit_qualification_details = false;
                        $scope.var_profile_edit_bank_details = false;
                        $scope.var_profile_edit_attachments = false;
                    }, 5000);
                });
        };

        $scope.MaritalStatusChange = function () {
            if ($scope.data.user.user_personal.marital_status == 0) {
                $scope.MaritalStatusChangeVar = 0;
            }
            else {
                $scope.MaritalStatusChangeVar = 1;
            }
        };

        $scope.addWorkExperience = function () {
            $scope.data.user.user_work_experience.push({
                job_duration: '',
                company_name: '',
                company_number: '',
                company_address: ''
            });
        };

        $scope.removeWorkExperience = function (index) {
            $scope.data.user.user_work_experience.splice(index, 1);

        };

        $scope.addAttechments = function () {
            $scope.user_attachments1.push({
                attachment_name: '',
                attachment_url: ''
            });
        };

        $scope.removeAttechments = function (index) {
            $scope.user_attachments1.splice(index, 1);
        };


        $scope.addQualificationDetails = function () {
            $scope.data.user.users_qualification.push({
                educational_qualifications_id: '',
                degree: '',
                education_university: '',
                passing_year: '',
                grade: ''
            });
        };

        $scope.removeQualificationDetails = function (index) {
            $scope.data.user.users_qualification.splice(index, 1);

        }



        $scope.savePersonalDetails = function (files) {
            if (files != undefined) {
                $scope.formUpload = true;
                console.log(files[0]);
                if (files != null) {
                    uploadUsingUpload(files[0])
                }
            } else {
                $http.post('users/update-edit/'+$stateParams.id, {
                    user: $scope.data.user
                }).success(function (data) {

                    if (data.code == '200') {
                        Flash.create('success', data.msg);
                        //$state.go('app.password_mgmts.index-view');
                    }
                    if (data.code == '403') {
                        Flash.create('danger', data.msg);
                    }
                    $('#dvLoading').fadeOut(1000);
                }).error(function () {
                    $('#dvLoading').fadeOut(1000);
                });
            }
        };


        $scope.saveGeneralDetails = function () {
            $('#dvLoading').css("display", "block");
            var new_skill_ids = [];
            angular.forEach($scope.data.user.user_personal.skills, function (value, key) {
                new_skill_ids[key] = value.skills_id;
            });
            var new_language_ids = [];
            angular.forEach($scope.data.user.user_personal.languages, function (value, key) {
                new_language_ids[key] = value.languages_id;
            });
            $http.post('users/update-general-details-edit/'+$stateParams.id, {
                dob: $scope.data.user.user_personal.dob,
                blood_group: $scope.data.user.user_personal.blood_group,
                marital_status: $scope.data.user.user_personal.marital_status,
                spouse_name: $scope.data.user.user_personal.spouse_name,
                aniversary_date: $scope.data.user.user_personal.aniversary_date,
                driving_licence_no: $scope.data.user.user_personal.driving_licence_no,
                passport_no: $scope.data.user.user_personal.passport_no,
                skills: new_skill_ids,
                languages: new_language_ids,
                bio: $scope.data.user.user_personal.bio
            }).success(function (data) {

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    //$state.go('app.password_mgmts.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
                $('#dvLoading').fadeOut(1000);
            });
        };


        $scope.saveContactDetails = function () {
            //console.log($scope.data.user.user_contact);
            $('#dvLoading').css("display", "block");

            $http.post('users/update-contact-details-edit/'+$stateParams.id, {
                current_address: $scope.data.user.user_contact.current_address,
                current_city: $scope.data.user.user_contact.current_city,
                current_state: $scope.data.user.user_contact.current_state,
                current_zipcode: $scope.data.user.user_contact.current_zipcode,
                current_phone: $scope.data.user.user_contact.current_phone,
                current_skype: $scope.data.user.user_contact.current_skype,
                permanent_address: $scope.data.user.user_contact.permanent_address,
                permanent_city: $scope.data.user.user_contact.permanent_city,
                permanent_state: $scope.data.user.user_contact.permanent_state,
                permanent_zipcode: $scope.data.user.user_contact.permanent_zipcode,
                permanent_phone: $scope.data.user.user_contact.permanent_phone,
                permanent_skype: $scope.data.user.user_contact.permanent_skype
            }).success(function (data) {

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    //$state.go('app.password_mgmts.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
                $('#dvLoading').fadeOut(1000);
            });
        };


        $scope.saveCompanyDetails = function () {
            //console.log($scope.data.user.user_contact);


            $http.post('users/update-company-details-edit/'+$stateParams.id, {
                employee_id: $scope.data.user.employee_id,
                doj: $scope.data.user.doj,
                department_id: $scope.data.user.department_id,
                designation_id: $scope.data.designation[$scope.data.user.designation_id]['designations_id'],
                job_profile: $scope.data.user.job_profile,
                role_id: $scope.data.user.role_id

            }).success(function (data) {

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    //$state.go('app.password_mgmts.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            });
        };

        $scope.saveEmergencyDetails = function () {
            //console.log($scope.data.user.user_emergency);
            //return false;
            $('#dvLoading').css("display", "block");

            $http.post('users/update-emergency-details-edit/'+$stateParams.id, {
                contact_name: $scope.data.user.user_emergency.contact_name,
                contact_relation: $scope.data.user.user_emergency.contact_relation,
                contact_phone: $scope.data.user.user_emergency.contact_phone,
                contact_address: $scope.data.user.user_emergency.contact_address
            }).success(function (data) {

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    //$state.go('app.password_mgmts.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
                $('#dvLoading').fadeOut(1000);
            });
        };

        $scope.saveBankDetails = function () {
            //console.log($scope.data.user.user_bank_details);
            //return false;
            $('#dvLoading').css("display", "block");

            $http.post('user_profiles/update-bank-details-edit/'+$stateParams.id, {
                bank_name: $scope.data.user.user_bank_details.bank_name,
                branch_name: $scope.data.user.user_bank_details.branch_name,
                account_no: $scope.data.user.user_bank_details.account_no,
                account_type: $scope.data.user.user_bank_details.account_type,
                ifsc_no: $scope.data.user.user_bank_details.ifsc_no
            }).success(function (data) {

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    //$state.go('app.password_mgmts.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
                $('#dvLoading').fadeOut(1000);
            });
        };

        $scope.saveWorkExperience = function () {
            //console.log($scope.data.user.user_work_experience);
            //return false;
            $('#dvLoading').css("display", "block");

            $http.post('users/update-workexperience-edit/'+$stateParams.id, {
                work_experiences: $scope.data.user.user_work_experience
            }).success(function (data) {

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    //$state.go('app.password_mgmts.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
                $('#dvLoading').fadeOut(1000);
            }).error(function () {
                $('#dvLoading').fadeOut(1000);
            });
        };

        $scope.saveQualificationDetails = function () {
            //console.log($scope.data.user.users_qualification);
            //return false;
            $('#dvLoading').css("display", "block");

            $http.post('users/update-qualification-details-edit/'+$stateParams.id, {
                users_qualification: $scope.data.user.users_qualification
            }).success(function (data) {

                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    //$state.go('app.password_mgmts.index-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
                $('#dvLoading').fadeOut(1000);
            }).error(function () {
                $('#dvLoading').fadeOut(1000);
            });
        };

        $scope.saveAttechments = function (attachment, name, index) {
            console.log(attachment);
            $scope.formUpload = true;
            if (attachment != null) {
                uploadAttachments(attachment[0], name, index)
            }
        };


        function uploadAttachments(file, name, index) {
            console.log(file);

            file.upload = Upload.upload({
                url: 'users/update-attachments-edit/'+$stateParams.id,
                method: 'POST',
                headers: {
                    'my-header': 'my-header-value'
                },
                fields: {attachment_name: name},
                file: file,
                fileFormDataName: 'attachment'
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;
                });
            }, function (response) {

                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            });

            file.upload.progress(function (evt) {
                // Math.min is to fix IE which reports 200% sometimes
                file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
            file.upload.success(function (data) {
                $('.attachment_submit_' + index).remove();
            });

            file.upload.xhr(function (xhr) {
                // xhr.upload.addEventListener('abort', function(){console.log('abort complete')}, false);
            });
        }

        function uploadUsingUpload(file) {

            file.upload = Upload.upload({
                url: 'users/update-with-profilepic-edit/'+$stateParams.id,
                method: 'POST',
                headers: {
                    'my-header': 'my-header-value'
                },
                fields: {user: $scope.data.user},
                file: file,
                fileFormDataName: 'profile_pic'
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;
                });
            }, function (response) {

                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            });

            file.upload.progress(function (evt) {
                // Math.min is to fix IE which reports 200% sometimes
                file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });

            file.upload.xhr(function (xhr) {
                // xhr.upload.addEventListener('abort', function(){console.log('abort complete')}, false);
            });
        }
//----------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------
        $scope.approveFind = function () {

        }
        $scope.approve_user_view_file = '';
        $scope.index = function () {
            $http.get('users/approve-data-edit', {}).success(function (data) {
                $scope.data.users_approve = data.aaData;
                $scope.approve_user_view_file = 'tpl/approve_user_view_file.html';
            });
        };

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

        $scope.CountDepartments = function(id) {
            if(id == '')
            {

            }else {
                var count = 0;
                angular.forEach($scope.items, function (items) {
                    count += items.department_id == id ? 1 : 0;
                });
                return count;
            }
        }


    }]);
