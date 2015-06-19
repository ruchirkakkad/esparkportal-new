/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('AnnouncementsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope', '$filter', '$timeout', '$compile', 'Upload',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope, $filter, $timeout, $compile, Upload) {

        $scope.data = {
            'announcements_name': '',
            'announcements_id': '',
            'announcements': [],
            'users': [],
            'to': []
        };
        $scope.announcements_view_file = '';
        $scope.index = function () {
            $scope.announcements_view_file = '';
            $http.get('announcements/indexdata-view', {}).success(function (data) {
                $scope.data.announcements = data.aaData;
                $scope.announcements_view_file = 'tpl/announcements_view_file.html';
            });
        }
        $scope.getArray = function () {
            var csv = [];
            angular.forEach($scope.data.announcements, function (value, key) {
                csv[key] = {
                    id: value.announcements_id,
                    name: value.announcements_name
                }
            });
            return csv;
        };
        $scope.resetData = function () {
            $scope.announcements_create_file = '';
            $http.post('announcements/users-add', {})
                .success(function (data) {
                    $scope.data.users = data;
                    $scope.announcements_create_file = 'tpl/announcements_create_file.html';
                });
            $scope.data = {
                'subject': '',
                'announcements_id': ''
            };
        };

        $scope.create = function () {
            $scope.create = function (files) {

                if (files != undefined) {

                    if (files != null) {
                        uploadUsingUpload(files[0])
                    }
                } else {
                    $http.post('announcements/store-add', {
                        to: $scope.data.to,
                        subject: $scope.data.subject,
                        content: $scope.data.content,
                        label: $scope.data.label,
                    }).success(function (data) {
                        if (data.code == '200') {
                            Flash.create('success', data.msg);
                            $state.go('app.announcements.list');
                        }
                        if (data.code == '403') {
                            Flash.create('danger', data.msg);
                        }
                    }, function (x) {
                        Flash.create('danger', 'Server Error');
                    });
                }
            };
        };

        function uploadUsingUpload(file) {

            file.upload = Upload.upload({
                url: 'announcements/store-resume-add',
                method: 'POST',
                headers: {
                    'my-header': 'my-header-value'
                },
                fields: {
                    to: $scope.data.to,
                    subject: $scope.data.subject,
                    content: $scope.data.content,
                    label: $scope.data.label,
                },
                file: file,
                fileFormDataName: 'attach'
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
                    $state.go('app.announcements.list');
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
app.controller('MailCtrl123', ['$scope', function ($scope) {
    $scope.folds = [
        {name: 'All', filter: ''}
    ];

    $scope.labels = [
        {name: 'General', filter: 'general', color: '#23b7e5'},
        {name: 'Event', filter: 'event', color: '#fad733'},
        {name: 'Meeting', filter: 'meeting', color: '#27c24c'}
    ];


    $scope.labelClass = function (label) {
        return {
            'b-l-info': angular.lowercase(label) === 'general',
            'b-l-warning': angular.lowercase(label) === 'event',
            'b-l-success': angular.lowercase(label) === 'meeting'
        };
    };
    $scope.labelClass1 = function (label) {
        return {
            'bg-info': angular.lowercase(label) === 'general',
            'bg-warning': angular.lowercase(label) === 'event',
            'bg-success': angular.lowercase(label) === 'meeting'
        };
    };

}]);

app.controller('MailListCtrl123', ['$scope', 'mails123', '$stateParams', '$http', '$sce',
    function ($scope, mails123, $stateParams, $http, $sce) {
        $scope.fold = $stateParams.fold;
        mails123.all().then(function (mails) {
            $scope.mails = mails;
        });
    }]);

app.controller('MailDetailCtrl123', ['$scope', 'mails123', '$stateParams', '$http', '$sce',
    function ($scope, mails123, $stateParams, $http, $sce) {
        mails123.get($stateParams.mailId).then(function (mail) {
            $scope.mail = mail;
        })
    }]);


angular.module('app').directive('labelColor', function () {
    return function (scope, $el, attrs) {
        $el.css({'color': attrs.color});
    }
});


// A RESTful factory for retreiving mails from 'mails.json'
app.factory('mails123', ['$http', function ($http) {
    var path = 'announcements/data-view';
    var factory = {};
    factory.all = function () {
        return $http.get(path).then(function (resp) {
            return resp.data.mails;
        });
    };
    factory.get = function (id) {
        return factory.all().then(function (resp) {
            var mails = resp;
            for (var i = 0; i < mails.length; i++) {
                if (mails[i].id == id) return mails[i];
            }
            return null;
        });
    };
    return factory;
}]);