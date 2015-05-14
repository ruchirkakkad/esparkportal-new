/**
 * Created by ruchir on 5/4/2015.
 */

app.controller('UserProfilesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope', '$timeout', '$compile', 'Upload',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope, $timeout, $compile, Upload) {

        $scope.itemsByPage = 100;

        $scope.user_attachments1 = [{
            attachment_name: '',
            attachment_url: ''
        }];
        $scope.MaritalStatusChangeVar = 0;
        $scope.MaritalStatusChangeVarView = 0;
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
                attechments: [
                    {
                        attachment_name: '',
                        attachment_url: ''
                    }
                ],
                qualification_details: [
                    {
                        educational_qualifications_id: '',
                        degree: '',
                        education_university: '',
                        passing_year: '',
                        grade: ''
                    }
                ]
            }

        };


        $scope.indexData = function () {
            $http.post('user_profiles/indexdata-view', {})
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

        }

        $scope.addAttechments = function () {
            $scope.user_attachments1.push({
                attachment_name: '',
                attachment_url: ''
            });

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
            $http.post('user_profiles/find-edit', {})
                .success(function (data) {
                    console.log(data);
                    $scope.data.skills = data.skills;
                    $scope.data.educational_qualifications = data.educational_qualifications;
                    $scope.data.languages = data.languages;
                    $scope.data.user = data.user[0];

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

                    $('#dvLoading').fadeOut(2000);
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
                    $('#dvLoading').fadeOut(2000);
                });
        };


        $scope.savePersonalDetails = function (files) {
            if (files != undefined) {
                $scope.formUpload = true;
                console.log(files[0]);
                if (files != null) {
                    uploadUsingUpload(files[0])
                }
            } else {
                $http.post('user_profiles/update-edit', {
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
            $http.post('user_profiles/update-general-details-edit', {
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

            $http.post('user_profiles/update-contact-details-edit', {
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


        $scope.saveEmergencyDetails = function () {
            //console.log($scope.data.user.user_emergency);
            //return false;
            $('#dvLoading').css("display", "block");

            $http.post('user_profiles/update-emergency-details-edit', {
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

            $http.post('user_profiles/update-bank-details-edit', {
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

            $http.post('user_profiles/update-workexperience-edit', {
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

            $http.post('user_profiles/update-qualification-details-edit', {
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
                url: 'user_profiles/update-attachments-edit',
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
                url: 'user_profiles/update-with-profilepic-edit',
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
    }]);
