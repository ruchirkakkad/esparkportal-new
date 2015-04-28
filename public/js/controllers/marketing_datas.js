/**
 * Created by ruchir on 4/7/2015.
 */

app.controller('MarketingDatasController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope', '$interval', '$filter', '$timeout', 'editableOptions', 'editableThemes', '$modal', '$log',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope, $interval, $filter, $timeout, editableOptions, editableThemes, $modal, $log) {

        $scope.data = {
            'marketing_datas_id': null,
            'marketing_data_encryt_id': null,
            'owner_name': '',
            'company_name': null,
            'website': null,
            'phone': null,
            'email': null,
            'marketing_states_id': null,
            'marketing_categories_id': null,
            'user_id': null,
            'leads_statuses_id': null,
            'lead_statuses': [],
            'lead_statusesforfilter': [],
            'marketing_datas': [],
            'filter_status': '',
            'stateparam_id': $stateParams.id
        };

        $scope.date = new Date();

        $scope.resetData = function () {
            $scope.data = {
                'marketing_datas_id': null,
                'owner_name': '',
                'company_name': null,
                'website': null,
                'phone': null,
                'email': '',
                'marketing_states_id': null,
                'marketing_categories_id': null,
                'user_id': null,
                'leads_statuses_id': null,
                'lead_statuses': []
            };


            $http.post('marketing_datas/states-categories-add/' + $stateParams.id, {}).success(function (data) {
                $scope.data.states = data.states;
                $scope.data.categories = data.categories;
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });

        };

        $scope.create = function () {

            $scope.errors = [];
            $http.post('marketing_datas/store-add', {
                owner_name: $scope.data.owner_name,
                company_name: $scope.data.company_name,
                website: $scope.data.website,
                phone: $scope.data.phone,
                email: $scope.data.email,
                marketing_states_id: $scope.data.marketing_states_id,
                marketing_categories_id: $scope.data.marketing_categories_id
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    $scope.data.owner_name = null;
                    $scope.data.company_name = null;
                    $scope.data.website = null;
                    $scope.data.phone = null;
                    $scope.data.email = null;
                    $scope.data.marketing_states_id = null;
                    $scope.data.marketing_categories_id = null;
                    Flash.create('success', data.msg);
                    //$state.go('app.marketing_datas.index');
                }
                if (data.code == '403') {
                    $scope.errors = data.result;
                    //Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

        $scope.getcountries = function () {

            $http.post('marketing_datas/countries-add', {}).success(function (data) {
                $scope.data.countries = data.countries;
                $scope.data.categories = data.categories;
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

        $scope.getcountriesview = function () {
            $http.post('marketing_datas/countries-view', {}).success(function (data) {
                $scope.data.countries = data.countries;
                $scope.data.categories = data.categories;
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };
        var timer;
        $scope.gettimezonesview = function () {
            $http.post('marketing_datas/timezones-view/' + $stateParams.id, {}).success(function (data) {
                $scope.data.timezones = data.timezones;
                //$scope.data.categories = data.categories;

                $interval.cancel(timer);
                timer = $interval(function () {
                    angular.forEach($scope.data.timezones, function (value, key) {
                        $scope.data.timezones[key].timezones_time++;
                        $scope.data.timezones[key].timezones_time1 = new Date($scope.data.timezones[key].timezones_time * 1000);
                    });
                    $scope.date = new Date();
                }, 1000);

                angular.forEach($scope.data.timezones, function (value, key) {
                    $scope.data.timezones[key].timezones_time1 = new Date($scope.data.timezones[key].timezones_time * 1000);
                });


            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.timezone_wise_data = function () {
            $scope.pleaseWork = '';

            editableThemes.bs3.inputClass = 'input-sm';
            editableThemes.bs3.buttonsClass = 'btn-sm';
            editableOptions.theme = 'bs3';
            //  pagination
            $scope.itemsByPage = 100;
            $scope.data.marketing_datas = [];

            $http.get('marketing_datas/timezone-wise-data-view/' + $stateParams.id + '/' + $stateParams.countryid, {})
                .success(function (data) {

                    $scope.data.marketing_datas = data.aaData;

                    $scope.data.lead_statuses = data.lead_status;
                    $scope.data.lead_statusesforfilter = data.lead_status;

                    $scope.data.lead_statusesforfilter = $filter('filter')($scope.data.lead_statusesforfilter, {leads_statuses_id: '!9'})
                    console.log($scope.data.lead_statusesforfilter);
                    $scope.timezone = data.timezone;

                    $interval.cancel(timer);
                    timer = $interval(function () {
                        $scope.timezone.timezones_time++;
                        $scope.timezone.timezones_time1 = new Date($scope.timezone.timezones_time * 1000);
                        $scope.date = new Date();
                    }, 1000);
                    $scope.timezone.timezones_time1 = new Date($scope.timezone.timezones_time * 1000);


                    $scope.showLeadStatus = function (row) {
                        //alert(51);
                        var selected = [];
                        if (row && row.leads_statuses_id) {
                            selected = $filter('filter')($scope.data.lead_statuses, {leads_statuses_id: row.leads_statuses_id});
                        }
                        return selected.length ? selected[0].leads_statuses_name : 'Not set';
                    };


                    $scope.saveMarketingData = function (data, id) {
                        //$scope.user not updated yet

                        angular.extend(data, {id: id});
                        return $http.post('marketing_datas/change-lead-status-edit', data)
                            .success(function (data) {
                                var data = (data);

                                if (data.code == '200') {

                                    Flash.create('success', data.msg);
                                    //$state.go('app.marketing_datas.index');
                                }
                                if (data.code == '403') {
                                    $scope.errors = data.result;
                                    //Flash.create('danger', data.msg);
                                }
                            }, function (x) {
                                Flash.create('danger', 'Server Error');
                            });
                    };

                    $scope.pleaseWork = 'tpl/marketing_data_listing.html';


                }, function (x) {
                    Flash.create('danger', 'Server Error');
                });

        };


        //-------------------------- For csv Export ---------------------
        $scope.getArray = function () {
            var try12 = $scope.data.marketing_datas;
            var log = [];
            angular.forEach(try12, function (value, key) {
                log[key] = {
                    id: value.marketing_datas_id,
                    owner_name: value.owner_name,
                    company_name: value.company_name,
                    website: value.website,
                    phone: value.phone,
                    email: value.email,
                    leads_statuses_name: value.leads_statuses_name
                }
            });

            return log;
        };

        $scope.changeStatus = function () {
            $scope.pleaseWork = '';
            $http.post('marketing_datas/timezone-wise-data-filtered-view/' + $stateParams.id + '/' + $stateParams.countryid, {
                leads_statuses_id: $scope.data.filter_status
            }).success(function (data) {
                $scope.data.marketing_datas = data.aaData;

                $scope.pleaseWork = 'tpl/marketing_data_listing.html';

            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

        $scope.editData = function () {
            $scope.data = {
                'marketing_datas_id': null,
                'owner_name': '',
                'company_name': null,
                'website': null,
                'phone': null,
                'email': '',
                'marketing_states_id': null,
                'marketing_categories_id': null,
                'user_id': null,
                'leads_statuses_id': null,
                'lead_statuses': []
            };


            $http.post('marketing_datas/find-edit/' + $stateParams.id, {}).success(function (data) {
                $scope.data.marketing_datas_id = data.marketing_datas_id;
                $scope.data.owner_name = data.owner_name;
                $scope.data.company_name = data.company_name;
                $scope.data.website = data.website;
                $scope.data.phone = data.phone;
                $scope.data.email = data.email;
                $scope.data.marketing_states_name = data.marketing_states_name;
                $scope.data.marketing_categories_name = data.marketing_categories_name;

            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        }


        $scope.update = function () {


            $http.post('marketing_datas/update-edit/' + $scope.data.marketing_datas_id, {
                owner_name: $scope.data.owner_name,
                company_name: $scope.data.company_name,
                website: $scope.data.website,
                phone: $scope.data.phone,
                email: $scope.data.email
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.marketing_datas.index-one-view');
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

        var d = new Date();
        d.setHours(14);
        d.setMinutes(0);

        $scope.note = {
            data_id: null,
            message: null,
            note_date: null,
            note_time: d
        };

        $scope.open = function (note, id) {
            $scope.note = note;
            $scope.note.message

            $scope.note.data_id = id;

            $modal.open({
                templateUrl: 'myModalContent.html',
                backdrop: true,
                windowClass: 'modal',
                controller: function ($scope, $modalInstance, $log, user) {
                    var d = new Date();
                    d.setHours(14);
                    d.setMinutes(0);

                    $scope.note = {
                        data_id: null,
                        message: null,
                        note_date: null,
                        note_time: d
                    };
                    $scope.note = note;
                    $scope.submit = function () {
                        $http.post('marketing_datas/add-note-edit', {
                            note: $scope.note
                        }).success(function (data) {

                        }, function (x) {
                            Flash.create('danger', 'Server Error');
                        });
                        $log.log('Submiting user info.');
                        $log.log(JSON.stringify($scope.note));
                        $log.log(JSON.stringify($scope.note.data_id));
                        $modalInstance.dismiss('cancel');
                    }
                    $scope.cancel = function () {
                        $log.log(JSON.stringify(user));
                        $modalInstance.dismiss('cancel');
                    };
                },
                resolve: {
                    user: function () {
                        return $scope.user;
                    }
                }
            });
        };
    }]);