/**
 * Created by hardik on 6/12/2015.
 */

app.controller('RecruitCandidatesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope', '$filter', '$timeout', '$compile', 'Upload', '$modal',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope, $filter, $timeout, $compile, Upload, $modal) {

        $scope.data = {
            candidate: [],
            users_qualification: [],
            candidates: [],
            index: 0
        };


        $scope.user = {id: "", name: ""}


        $scope.change_status = function (index) {
            $scope.data.index = index;
            $scope.data.candidate = $scope.data.candidates[index];
            var modalInstance = $modal.open({
                templateUrl: 'changeStatus.html',
                controller: 'changeStatusCtrl',
                scope: $scope
            });

        };
        $scope.change_action = function (index) {
            $scope.data.index = index;
            $scope.data.candidate = $scope.data.candidates[index];
            $scope.data.candidate.date = '';
            $scope.data.candidate.time = '';
            $scope.data.candidate.subject = '';
            $scope.data.candidate.message = '';
            //console.log($scope.data.candidate.name);
            var modalInstance = $modal.open({
                templateUrl: 'changeAction.html',
                controller: 'changeActionCtrl',
                scope: $scope
            });

        };

        $scope.index = function () {
            $http.get('recruit_candidates/index-data-view', {})
                .success(function (data) {
                    $scope.data.candidates = data.aaData;
                    $scope.recruit_candidates_view_file = 'tpl/recruit_candidates_view_file.html';
                });
        };

        $scope.resetData = function () {
            $http.get('recruit_candidates/createdata-add', {})
                .success(function (data) {
                    $scope.data.educational_qualifications = data.educational_qualifications;
                    $scope.data.designations = data.designations;
                    $scope.data.skills = data.skills;
                });
        };

        $scope.create = function (files) {

            if (files != undefined) {

                if (files != null) {
                    uploadUsingUpload(files[0])
                }
            } else {
                $http.post('recruit_candidates/store-add', {
                    recruit_candidates_fname: $scope.data.recruit_candidates_fname,
                    recruit_candidates_mname: $scope.data.recruit_candidates_mname,
                    recruit_candidates_lname: $scope.data.recruit_candidates_lname,
                    recruit_candidates_address: $scope.data.recruit_candidates_address,
                    recruit_candidates_email: $scope.data.recruit_candidates_email,
                    recruit_candidates_contact_no: $scope.data.recruit_candidates_contact_no,
                    recruit_candidates_apply_for: $scope.data.recruit_candidates_apply_for,
                    recruit_candidates_skills: $scope.data.recruit_candidates_skills,
                    recruit_candidates_category: $scope.data.recruit_candidates_category,
                    users_qualification: $scope.data.users_qualification
                }).success(function (data) {
                    if (data.code == '200') {
                        Flash.create('success', data.msg);
                        $state.go('app.recruit_candidates');
                    }
                    if (data.code == '403') {
                        Flash.create('danger', data.msg);
                    }
                }, function (x) {
                    Flash.create('danger', 'Server Error');
                });
            }
        };


        $scope.addQualificationDetails = function () {
            $scope.data.users_qualification.push({
                educational_qualifications_id: '',
                degree: '',
                education_university: '',
                passing_year: '',
                grade: ''
            });
        };

        $scope.removeQualificationDetails = function (index) {
            $scope.data.users_qualification.splice(index, 1);
        }


        function uploadUsingUpload(file) {

            file.upload = Upload.upload({
                url: 'recruit_candidates/store-resume-add',
                method: 'POST',
                headers: {
                    'my-header': 'my-header-value'
                },
                fields: {
                    recruit_candidates_fname: $scope.data.recruit_candidates_fname,
                    recruit_candidates_mname: $scope.data.recruit_candidates_mname,
                    recruit_candidates_lname: $scope.data.recruit_candidates_lname,
                    recruit_candidates_address: $scope.data.recruit_candidates_address,
                    recruit_candidates_email: $scope.data.recruit_candidates_email,
                    recruit_candidates_contact_no: $scope.data.recruit_candidates_contact_no,
                    recruit_candidates_apply_for: $scope.data.recruit_candidates_apply_for,
                    recruit_candidates_skills: $scope.data.recruit_candidates_skills,
                    recruit_candidates_category: $scope.data.recruit_candidates_category,
                    users_qualification: $scope.data.users_qualification
                },
                file: file,
                fileFormDataName: 'resume'
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
                if (data.code == '200') {
                    Flash.create('success', data.msg);
                    $state.go('app.recruit_candidates');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            });
            file.upload.xhr(function (xhr) {
                // xhr.upload.addEventListener('abort', function(){console.log('abort complete')}, false);
            });
        }

    }]);
/* EOF */
app.controller('changeStatusCtrl', function ($scope, $modalInstance, $http) {
    $scope.ok = function () {
        console.log($scope.status);
        $http.post('recruit_candidates/change-status-view', {
            candidate: $scope.data.candidate,
            status: $scope.status
        }).success(function (data) {
            $scope.data.candidates[$scope.data.index].recruit_candidates_action = data.result.candidate.recruit_candidates_action;
            $scope.data.candidates[$scope.data.index].recruit_candidates_status = data.result.candidate.recruit_candidates_status;
            console.log($scope.data.candidates[$scope.data.index]);
        });
        $modalInstance.close();
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});
app.controller('changeActionCtrl', function ($scope, $modalInstance, $http) {
    $scope.ok = function () {
        $http.post('recruit_candidates/change-status-to-scheduled-view', {
            candidate: $scope.data.candidate
        }).success(function (data) {
            $scope.data.candidates[$scope.data.index].recruit_candidates_action = data.result.candidate.recruit_candidates_action;
            $scope.data.candidates[$scope.data.index].reschedule_count = data.result.action_count;
        });

        $modalInstance.close();
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});