/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('FollowupController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope', '$interval', '$filter', '$timeout', 'editableOptions', 'editableThemes', '$modal', '$log',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope, $interval, $filter, $timeout, editableOptions, editableThemes, $modal, $log) {

        $scope.data = {
            'lead_statuses': [],
            'followup': [],
            marketing_data: [],
            notes: [],
            new_message: '',
            new_note_time: '',
            new_note_date: '',
            dateArray : []
        };

        $scope.date = new Date();

        $scope.priorityArray = {
            '0': '#F8ECE0',
            '1': '#FA5858',
            '2': '#FAAC58',
            '3': '#F5D0A9',
            '4': '#CEF6E3',
            '5': '#ECE0F8',
            '6': '#F6CED8',
            '7': '#F2F2F2',
            '8': '#F6CEEC',
            '9': '#D8D8D8',
            '10': '#F2F2F2'
        };

        var dateArr = [];
        for(var i=0;i<10;i++) {
            var date = new Date();
            date.setDate(date.getDate() + i);
            var d = date.getDate();
            var m = date.getMonth() + 1;
            var y = date.getFullYear();
            var key = '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
            dateArr[key] = $scope.priorityArray[i];
        }

        $scope.data.dateArray = dateArr;

        console.log(dateArr['2015-05-02']);

        $scope.followup_data = function () {

            $scope.followup_view_html = '';

            editableThemes.bs3.inputClass = 'input-sm';
            editableThemes.bs3.buttonsClass = 'btn-sm';
            editableOptions.theme = 'bs3';
            //  pagination
            $scope.itemsByPage = 100;
            $scope.data.followup = [];

            $http.get('followup/indexdata-view', {})
                .success(function (data) {

                    $scope.data.followup = data.followup;
                    console.log($scope.data.followup);
                    $scope.data.lead_statuses = data.lead_status;

                    $scope.followup_view_html = 'tpl/followup_view_html.html';

                }, function (x) {
                    Flash.create('danger', 'Server Error');
                });
        };


        $scope.getNoteData = function () {
            $http.post('followup/note-data-edit/' + $stateParams.id, {})
                .success(function (data) {

                    $scope.data.marketing_data = data.marketing_data;
                    $scope.data.notes = data.notes;

                }, function (x) {
                    Flash.create('danger', 'Server Error');
                });
        };

        //-------------------------- For csv Export ---------------------
        $scope.getArray = function () {
            var try12 = $scope.data.followup;
            var log = [];
            angular.forEach(try12, function (value, key) {
                log[key] = {
                    date: value.note_date,
                    time: value.note_time,
                    message: value.message,
                    owner_name: value.owner_name,
                    website: value.website,
                    phone: value.phone
                }
            });
            console.log(log)
            return log;
        };

        $scope.addNote = function () {
            $scope.data.notes = [];
            $http.post('followup/add-note-edit/' + $stateParams.id, {
                message: $scope.data.new_message,
                note_time: $scope.data.new_note_time,
                note_date: $scope.data.new_note_date
            }).success(function (data) {
                $scope.data.new_message = '';
                $scope.data.new_note_time = '';
                $scope.data.new_note_date = '';
                $scope.data.notes = (data.result);

            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        }

    }]);