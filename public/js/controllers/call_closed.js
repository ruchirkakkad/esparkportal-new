/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('CallClosedController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope', '$interval', '$filter', '$timeout', 'editableOptions', 'editableThemes', '$modal', '$log',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope, $interval, $filter, $timeout, editableOptions, editableThemes, $modal, $log) {

        $scope.data = {
            'call_closed': [],
            marketing_data: [],
            notes: [],
            new_message: '',
            new_note_time: '',
            new_note_date: '',
            dateArray : []
        };

        $scope.call_closed_data = function () {

            $scope.call_closed_view_html = '';

            editableThemes.bs3.inputClass = 'input-sm';
            editableThemes.bs3.buttonsClass = 'btn-sm';
            editableOptions.theme = 'bs3';
            //  pagination
            $scope.itemsByPage = 100;
            $scope.data.call_closed = [];

            $http.get('call_closed/indexdata-view', {})
                .success(function (data) {

                    $scope.data.call_closed = data.call_closed;
                    $scope.call_closed_view_html = 'tpl/call_closed_view_html.html';

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
    }]);