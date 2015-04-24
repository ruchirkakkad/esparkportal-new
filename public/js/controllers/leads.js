/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('LeadsController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope', '$interval', '$filter', '$timeout', 'editableOptions', 'editableThemes',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope, $interval, $filter, $timeout, editableOptions, editableThemes) {

        $scope.data = {
            'lead_statuses': [],
            'leads': [],
        };

        $scope.date = new Date();

        $scope.getLeads = function() {
            $scope.data.leads = "";
            $http.post('leads/leads-listing-view', {}).success(function (data) {
                $scope.data.leads = data.leads;
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };
        //var timer;
        //$scope.gettimezonesview = function () {
        //    $http.post('leads/timezones-view/' + $stateParams.id, {}).success(function (data) {
        //        $scope.data.timezones = data.timezones;
        //        //$scope.data.categories = data.categories;
        //
        //        $interval.cancel(timer);
        //        timer = $interval(function () {
        //            angular.forEach($scope.data.timezones, function (value, key) {
        //                $scope.data.timezones[key].timezones_time++;
        //                $scope.data.timezones[key].timezones_time1 = new Date($scope.data.timezones[key].timezones_time * 1000);
        //            });
        //            $scope.date = new Date();
        //        }, 1000);
        //
        //        angular.forEach($scope.data.timezones, function (value, key) {
        //            $scope.data.timezones[key].timezones_time1 = new Date($scope.data.timezones[key].timezones_time * 1000);
        //        });
        //
        //
        //    }, function (x) {
        //        Flash.create('danger', 'Server Error');
        //    });
        //};


        $scope.leads_wise_data = function () {

            $scope.leads_view_html = '';

            editableThemes.bs3.inputClass = 'input-sm';
            editableThemes.bs3.buttonsClass = 'btn-sm';
            editableOptions.theme = 'bs3';
            //  pagination
            $scope.itemsByPage = 100;
            $scope.data.leads = [];
            $scope.lead_name = "";
            $http.get('leads/leads-wise-data-view/' + $stateParams.id, {})
                .success(function (data) {

                    $scope.data.leads = data.aaData;

                    $scope.data.lead_statuses = data.lead_status;

                    $scope.lead_name = data.lead_name;

                    $scope.showLeadStatus = function (row) {

                        var selected = [];
                        if (row && row.leads_statuses_id) {
                            selected = $filter('filter')($scope.data.lead_statuses, {leads_statuses_id: row.leads_statuses_id});
                        }
                        return selected.length ? selected[0].leads_statuses_name : 'Not set';
                    };


                    $scope.saveMarketingData = function (data, id) {
                        //$scope.user not updated yet
                        console.log(data)
                        angular.extend(data, {id: id});
                        return $http.post('leads/change-lead-status-edit', data)
                            .success(function (data) {
                                var data = (data);

                                if (data.code == '200') {

                                    Flash.create('success', data.msg);

                                }
                                if (data.code == '403') {
                                    //$scope.errors = data.result;
                                    Flash.create('danger', data.msg);
                                }
                            }, function (x) {
                                Flash.create('danger', 'Server Error');
                            });
                    };

                    $scope.leads_view_html = 'tpl/leads_view_html.html';


                }, function (x) {
                    Flash.create('danger', 'Server Error');
                });
        };


        //-------------------------- For csv Export ---------------------
        $scope.getArray = function () {
            var try12 = $scope.data.leads;
            var log = [];
            angular.forEach(try12, function (value, key) {
                log[key] = {
                    id: value.leads_id,
                    owner_name: value.owner_name,
                    company_name: value.company_name,
                    website: value.website,
                    phone: value.phone,
                    email: value.email,
                    leads_statuses_name: value.leads_statuses_name
                }
            });
            console.log(log)
            return log;
        };

        $scope.changeStatus = function () {
            $scope.leads_view_html = '';
            $http.post('leads/timezone-wise-data-filtered-view/' + $stateParams.id, {
                leads_statuses_id: $scope.data.filter_status
            }).success(function (data) {
                $scope.data.leads = data.aaData;

                $scope.leads_view_html = 'tpl/marketing_data_listing.html';
                console.log(data);
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);