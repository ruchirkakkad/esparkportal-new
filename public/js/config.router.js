'use strict';

/**
 * Config for the router
 */
angular.module('app')
    .run(
    ['$rootScope', '$state', '$stateParams',
        function ($rootScope, $state, $stateParams) {
            $rootScope.$state = $state;
            $rootScope.$stateParams = $stateParams;
        }
    ]
)
    .config(
    ['$stateProvider', '$urlRouterProvider', 'JQ_CONFIG',
        function ($stateProvider, $urlRouterProvider, JQ_CONFIG) {

            $urlRouterProvider
                .otherwise('/access/signin');
            $stateProvider
                .state('access', {
                    url: '/access',
                    template: '<div ui-view class="fade-in-right-big smooth"></div>'
                })
                .state('access.signin', {
                    url: '/signin',
                    controller: 'GuestCheckCtrl',
                    templateUrl: 'login',
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/signin.js']);
                            }]
                    }
                })
                .state('access.signup', {
                    url: '/signup',
                    templateUrl: 'signup',
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/signup.js']);
                            }]
                    }
                })
                .state('access.logout', {
                    url: '/logout',
                    //template: '<div ng-controller="logoutController" ></div>',
                    controller: function ($scope, $http, $state) {
                        $http.post('logout', {}).success(function (data) {
                            $state.go('access.signin');
                        }, function (x) {
                        });
                    }
                })
                .state('access.forgotpwd', {
                    url: '/forgotpwd',
                    templateUrl: 'tpl/page_forgotpwd.html'
                })
                .state('access.404', {
                    url: '/404',
                    templateUrl: 'tpl/page_404.html'
                })
                //.state('app', {
                //    abstract: true,
                //    url: '/app',
                //    templateUrl: 'tpl/app.html'
                //})
                .state('app', {
                    abstract: true,
                    url: '/app',
                    templateUrl: 'appView'
                })
                .state('app.dashboard', {
                    url: '/dashboard',
                    templateUrl: 'dashboard',
                    controller: "AuthCheckCtrl"
                })
                .state('app.modules', {
                    url: '/modules',
                    template: '<div ui-view class="fade-in-up"></div>'
                })
                .state('app.modules.index', {
                    url: '/index',
                    templateUrl: 'modules/index',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/module-store.js']);
                            }]
                    }
                })
                .state('app.modules.create', {
                    url: '/create',
                    templateUrl: 'modules/create',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/module-store.js']);
                            }]
                    }
                })
                .state('app.modules.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'modules/edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/module-store.js']);
                            }]

                    }
                })
                .state('app.modules.delete', {
                    url: '/delete/{id}',
                    controller: function ($http, $state, $stateParams, Flash) {

                        $http.post('checkAuthentication', {})
                            .success(function (data) {
                                if (data == '0') {
                                    $state.go('access.signin');
                                }
                            }, function (x) {
                            });

                        $http.get('/modules/destroy/' + $stateParams.id)
                            .success(function (data) {
                                if (data.code == '200') {
                                    var message = '<strong>Delete!</strong> You successfully deleted the module.';
                                    Flash.create('success', message);
                                    $state.go('app.modules.index');
                                }
                                if (data.code == '403') {
                                    $state.go('app.modules.index');
                                }
                            });
                    }
                })
                .state('app.marketing_countries', {
                    url: '/marketing_countries',
                    template: '<div ui-view  ng-controller="MarketingCountriesController" class="fade-in-right-big"></div>'
                })
                .state('app.marketing_countries.index', {
                    url: '/index',
                    templateUrl: 'marketing_countries/index-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/marketing_countries.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.marketing_countries.create', {
                    url: '/create',
                    templateUrl: 'marketing_countries/create-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/marketing_countries.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.marketing_countries.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'marketing_countries/edit-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/marketing_countries.js'
                                            ]
                                        });
                                    }
                                );
                            }]

                    }
                })
                .state('app.marketing_countries.delete', {
                    url: '/delete/{id}',
                    controller: function ($http, $state, $stateParams, Flash) {

                        $http.post('checkAuthentication', {})
                            .success(function (data) {
                                if (data == '0') {
                                    $state.go('access.signin');
                                }
                            }, function (x) {
                            });

                        $http.get('/marketing_countries/destroy-delete/' + $stateParams.id)
                            .success(function (data) {
                                if (data.code == '200') {
                                    Flash.create('success', data.msg);
                                    $state.go('app.marketing_countries.index');
                                }
                                if (data.code == '403') {
                                    Flash.create('danger', data.msg);
                                    $state.go('app.marketing_countries.index');
                                }
                            });
                    }
                })
                .state('app.timezones', {
                    url: '/timezones',
                    template: '<div ui-view  ng-controller="TimezonesController" class="fade-in-right-big"></div>'
                })
                .state('app.timezones.index', {
                    url: '/index',
                    templateUrl: 'timezones/index-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/timezones.js']);
                            }]
                    }
                })
                .state('app.timezones.create', {
                    url: '/create',
                    templateUrl: 'timezones/create-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/timezones.js']);
                            }]
                    }
                })
                .state('app.timezones.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'timezones/edit-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/timezones.js']);
                            }]

                    }
                })
                .state('app.timezones.delete', {
                    url: '/delete/{id}',
                    controller: function ($http, $state, $stateParams, Flash) {

                        $http.post('checkAuthentication', {})
                            .success(function (data) {
                                if (data == '0') {
                                    $state.go('access.signin');
                                }
                            }, function (x) {
                            });

                        $http.get('/timezones/destroy-delete/' + $stateParams.id)
                            .success(function (data) {
                                if (data.code == '200') {
                                    Flash.create('success', data.msg);
                                    $state.go('app.timezones.index');
                                }
                                if (data.code == '403') {
                                    Flash.create('danger', data.msg);
                                    $state.go('app.timezones.index');
                                }
                            });
                    }
                })
                .state('app.leads_statuses', {
                    url: '/leads_statuses',
                    template: '<div ui-view  ng-controller="LeadStatusesController" class="fade-in-right-big"></div>'
                })
                .state('app.leads_statuses.index', {
                    url: '/index',
                    templateUrl: 'leads_statuses/index-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/leads_statuses.js',
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.leads_statuses.create', {
                    url: '/create',
                    templateUrl: 'leads_statuses/create-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/leads_statuses.js',
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.leads_statuses.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'leads_statuses/edit-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/leads_statuses.js',
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.leads_statuses.delete', {
                    url: '/delete/{id}',
                    controller: function ($http, $state, $stateParams, Flash) {

                        $http.post('checkAuthentication', {})
                            .success(function (data) {
                                if (data == '0') {
                                    $state.go('access.signin');
                                }
                            }, function (x) {
                            });

                        $http.get('/leads_statuses/destroy-delete/' + $stateParams.id)
                            .success(function (data) {
                                if (data.code == '200') {
                                    Flash.create('success', data.msg);
                                    $state.go('app.leads_statuses.index');
                                }
                                if (data.code == '403') {
                                    Flash.create('danger', data.msg);
                                    $state.go('app.leads_statuses.index');
                                }
                            });
                    }
                })
                .state('app.marketing_datas', {
                    url: '/marketing_datas',
                    template: '<div ui-view  ng-controller="MarketingDatasController" class="fade-in-right-big"></div>'
                })
                .state('app.marketing_datas.create-one-add', {
                    url: '/create-one',
                    templateUrl: 'marketing_datas/create-one-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table', 'xeditable']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                //'js/controllers/xeditable.js',
                                                'js/controllers/marketing_datas.js',
                                                //'js/controllers/table.js'

                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.marketing_datas.create-two-add', {
                    url: '/create-two-add/{id}',
                    templateUrl: 'marketing_datas/create-two-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table', 'xeditable']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                //'js/controllers/xeditable.js',
                                                'js/controllers/marketing_datas.js',
                                                //'js/controllers/table.js'

                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.marketing_datas.index-one-view', {
                    url: '/index-one-view',
                    templateUrl: 'marketing_datas/index-one-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table', 'xeditable']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                //'js/controllers/xeditable.js',
                                                'js/controllers/marketing_datas.js',
                                                //'js/controllers/table.js'

                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.marketing_datas.index-two-view', {
                    url: '/index-two-view/{id}',
                    templateUrl: 'marketing_datas/index-two-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table', 'xeditable']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                //'js/controllers/xeditable.js',
                                                'js/controllers/marketing_datas.js',
                                                //'js/controllers/table.js'

                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                //.state('app.marketing_datas.index-three-view', {
                //    url: '/index-three-view/{id}',
                //    templateUrl: 'marketing_datas/index-three-view',
                //    controller: "AuthCheckCtrl",
                //    resolve: {
                //        deps: ['$ocLazyLoad',
                //            function( $ocLazyLoad ){
                //                return $ocLazyLoad.load('smart-table').then(
                //                    function(){
                //                        return $ocLazyLoad.load({
                //                            files: [
                //                                'js/controllers/marketing_datas.js',
                //                                'js/controllers/table.js'
                //                            ]
                //                        });
                //                    }
                //                );
                //            }]
                //    }
                //})
                .state('app.marketing_datas.index-three-view', {
                    url: '/index-three-view/{id}',
                    templateUrl: 'marketing_datas/index-three-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table', 'xeditable']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                //'js/controllers/xeditable.js',
                                                'js/controllers/marketing_datas.js',
                                                //'js/controllers/table.js'

                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.marketing_datas.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'marketing_datas/edit-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table', 'xeditable']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/marketing_datas.js',
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.leads', {
                    url: '/leads',
                    template: '<div ui-view  ng-controller="LeadsController" class="fade-in-right-big"></div>'
                })
                .state('app.leads.index-one-view', {
                    url: '/index-one-view',
                    templateUrl: 'leads/index-one-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table', 'xeditable']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/leads.js',
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.leads.index-two-view', {
                    url: '/index-two-view/{id}',
                    templateUrl: 'leads/index-two-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table', 'xeditable']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/leads.js',
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })

                .state('app.marketing_categories', {
                    url: '/marketing_categories',
                    template: '<div ui-view  ng-controller="MarketingCategoriesController" class="fade-in-right-big"></div>'
                })
                .state('app.marketing_categories.index', {
                    url: '/index',
                    templateUrl: 'marketing_categories/index-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/marketing_categories.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.marketing_categories.create', {
                    url: '/create',
                    templateUrl: 'marketing_categories/create-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/marketing_categories.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.marketing_categories.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'marketing_categories/edit-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/marketing_categories.js'
                                            ]
                                        });
                                    }
                                );
                            }]

                    }
                })
                .state('app.marketing_categories.delete', {
                    url: '/delete/{id}',
                    controller: function ($http, $state, $stateParams, Flash) {

                        $http.post('checkAuthentication', {})
                            .success(function (data) {
                                if (data == '0') {
                                    $state.go('access.signin');
                                }
                            }, function (x) {
                            });

                        $http.get('/marketing_categories/destroy-delete/' + $stateParams.id)
                            .success(function (data) {
                                if (data.code == '200') {
                                    Flash.create('success', data.msg);
                                    $state.go('app.marketing_categories.index');
                                }
                                if (data.code == '403') {
                                    Flash.create('danger', data.msg);
                                    $state.go('app.marketing_categories.index');
                                }
                            });
                    }
                })
                .state('app.marketing_states', {
                    url: '/marketing_states',
                    template: '<div ui-view  ng-controller="MarketingStatesController" class="fade-in-right-big"></div>'
                })
                .state('app.marketing_states.index', {
                    url: '/index',
                    templateUrl: 'marketing_states/index-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/marketing_states.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.marketing_states.create', {
                    url: '/create',
                    templateUrl: 'marketing_states/create-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/marketing_states.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.marketing_states.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'marketing_states/edit-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/marketing_states.js'
                                            ]
                                        });
                                    }
                                );
                            }]

                    }
                })
                .state('app.marketing_states.delete', {
                    url: '/delete/{id}',
                    controller: function ($http, $state, $stateParams, Flash) {

                        $http.post('checkAuthentication', {})
                            .success(function (data) {
                                if (data == '0') {
                                    $state.go('access.signin');
                                }
                            }, function (x) {
                            });

                        $http.get('/marketing_states/destroy-delete/' + $stateParams.id)
                            .success(function (data) {
                                if (data.code == '200') {
                                    Flash.create('success', data.msg);
                                    $state.go('app.marketing_states.index');
                                }
                                if (data.code == '403') {
                                    Flash.create('danger', data.msg);
                                    $state.go('app.marketing_states.index');
                                }
                            });
                    }
                })



                .state('app.roles', {
                    url: '/roles',
                    template: '<div ui-view  ng-controller="RolesController" class="fade-in-right-big"></div>'
                })
                .state('app.roles.index', {
                    url: '/index',
                    templateUrl: 'roles/index-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/roles.js']);
                            }]
                    }
                })
                .state('app.roles.create', {
                    url: '/create',
                    templateUrl: 'roles/create-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/roles.js']);
                            }]
                    }
                })
                .state('app.roles.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'roles/edit-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/roles.js']);
                            }]

                    }
                })
                .state('app.roles.delete', {
                    url: '/delete/{id}',
                    controller: function ($http, $state, $stateParams, Flash) {

                        $http.post('checkAuthentication', {})
                            .success(function (data) {
                                if (data == '0') {
                                    $state.go('access.signin');
                                }
                            }, function (x) {
                            });

                        $http.get('/roles/destroy-delete/' + $stateParams.id)
                            .success(function (data) {
                                if (data.code == '200') {
                                    Flash.create('success', data.msg);
                                    $state.go('app.roles.index');
                                }
                                if (data.code == '403') {
                                    Flash.create('danger', data.msg);
                                    $state.go('app.roles.index');
                                }
                            });
                    }
                })





                .state('app.permissions', {
                    url: '/permissions',
                    template: '<div ui-view  ng-controller="PermissionsController" class="fade-in-right-big"></div>'
                })
                .state('app.permissions.index', {
                    url: '/index',
                    templateUrl: 'permissions/index-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('angularBootstrapNavTree').then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/tree.js',
                                                'js/controllers/permissions.js'
                                            ]
                                        });
                                    }
                                );
                            }
                        ]
                    }
                })
                .state('app.permissions.create', {
                    url: '/create',
                    templateUrl: 'permissions/create-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/permissions.js']);
                            }]
                    }
                })
                .state('app.permissions.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'permissions/edit-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/permissions.js']);
                            }]

                    }
                })
                .state('app.permissions.delete', {
                    url: '/delete/{id}',
                    controller: function ($http, $state, $stateParams, Flash) {

                        $http.post('checkAuthentication', {})
                            .success(function (data) {
                                if (data == '0') {
                                    $state.go('access.signin');
                                }
                            }, function (x) {
                            });

                        $http.get('/permissions/destroy-delete/' + $stateParams.id)
                            .success(function (data) {
                                if (data.code == '200') {
                                    Flash.create('success', data.msg);
                                    $state.go('app.permissions.index');
                                }
                                if (data.code == '403') {
                                    Flash.create('danger', data.msg);
                                    $state.go('app.permissions.index');
                                }
                            });
                    }
                })



                .state('app.dashboard-v2', {
                    url: '/dashboard-v2',
                    templateUrl: 'tpl/app_dashboard_v2.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['js/controllers/chart.js']);
                            }]
                    }
                })
                .state('app.ui', {
                    url: '/ui',
                    template: '<div ui-view class="fade-in-up"></div>'
                })
                .state('app.ui.buttons', {
                    url: '/buttons',
                    templateUrl: 'tpl/ui_buttons.html'
                })
                .state('app.ui.icons', {
                    url: '/icons',
                    templateUrl: 'tpl/ui_icons.html'
                })
                .state('app.ui.grid', {
                    url: '/grid',
                    templateUrl: 'tpl/ui_grid.html'
                })
                .state('app.ui.widgets', {
                    url: '/widgets',
                    templateUrl: 'tpl/ui_widgets.html'
                })
                .state('app.ui.bootstrap', {
                    url: '/bootstrap',
                    templateUrl: 'tpl/ui_bootstrap.html'
                })
                .state('app.ui.sortable', {
                    url: '/sortable',
                    templateUrl: 'tpl/ui_sortable.html'
                })
                .state('app.ui.scroll', {
                    url: '/scroll',
                    templateUrl: 'tpl/ui_scroll.html',
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load('js/controllers/scroll.js');
                            }]
                    }
                })
                .state('app.ui.portlet', {
                    url: '/portlet',
                    templateUrl: 'tpl/ui_portlet.html'
                })
                .state('app.ui.timeline', {
                    url: '/timeline',
                    templateUrl: 'tpl/ui_timeline.html'
                })
                .state('app.ui.tree', {
                    url: '/tree',
                    templateUrl: 'tpl/ui_tree.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('angularBootstrapNavTree').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/tree.js');
                                    }
                                );
                            }
                        ]
                    }
                })
                .state('app.ui.toaster', {
                    url: '/toaster',
                    templateUrl: 'tpl/ui_toaster.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('toaster').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/toaster.js');
                                    }
                                );
                            }]
                    }
                })
                .state('app.ui.jvectormap', {
                    url: '/jvectormap',
                    templateUrl: 'tpl/ui_jvectormap.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('js/controllers/vectormap.js');
                            }]
                    }
                })
                .state('app.ui.googlemap', {
                    url: '/googlemap',
                    templateUrl: 'tpl/ui_googlemap.html',
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load([
                                    'js/app/map/load-google-maps.js',
                                    'js/app/map/ui-map.js',
                                    'js/app/map/map.js']).then(
                                    function () {
                                        return loadGoogleMaps();
                                    }
                                );
                            }]
                    }
                })
                .state('app.chart', {
                    url: '/chart',
                    templateUrl: 'tpl/ui_chart.html',
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load('js/controllers/chart.js');
                            }]
                    }
                })
                // table
                .state('app.table', {
                    url: '/table',
                    template: '<div ui-view></div>'
                })
                .state('app.table.static', {
                    url: '/static',
                    templateUrl: 'tpl/table_static.html'
                })
                .state('app.table.datatable', {
                    url: '/datatable',
                    templateUrl: 'tpl/table_datatable.html'
                })
                .state('app.table.footable', {
                    url: '/footable',
                    templateUrl: 'tpl/table_footable.html'
                })
                .state('app.table.grid', {
                    url: '/grid',
                    templateUrl: 'tpl/table_grid.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('ngGrid').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/grid.js');
                                    }
                                );
                            }]
                    }
                })
                .state('app.table.uigrid', {
                    url: '/uigrid',
                    templateUrl: 'tpl/table_uigrid.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('ui.grid').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/uigrid.js');
                                    }
                                );
                            }]
                    }
                })
                .state('app.table.editable', {
                    url: '/editable',
                    templateUrl: 'tpl/table_editable.html',
                    controller: 'XeditableCtrl',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('xeditable').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/xeditable.js');
                                    }
                                );
                            }]
                    }
                })
                .state('app.table.smart', {
                    url: '/smart',
                    templateUrl: 'tpl/table_smart.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('smart-table').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/table.js');
                                    }
                                );
                            }]
                    }
                })
                // form
                .state('app.form', {
                    url: '/form',
                    template: '<div ui-view class="fade-in"></div>',
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load('js/controllers/form.js');
                            }]
                    }
                })
                .state('app.form.components', {
                    url: '/components',
                    templateUrl: 'tpl/form_components.html',
                    resolve: {
                        deps: ['uiLoad', '$ocLazyLoad',
                            function (uiLoad, $ocLazyLoad) {
                                return uiLoad.load(JQ_CONFIG.daterangepicker)
                                    .then(
                                    function () {
                                        return uiLoad.load('js/controllers/form.components.js');
                                    }
                                ).then(
                                    function () {
                                        return $ocLazyLoad.load('ngBootstrap');
                                    }
                                );
                            }
                        ]
                    }
                })
                .state('app.form.elements', {
                    url: '/elements',
                    templateUrl: 'tpl/form_elements.html'
                })
                .state('app.form.validation', {
                    url: '/validation',
                    templateUrl: 'tpl/form_validation.html'
                })
                .state('app.form.wizard', {
                    url: '/wizard',
                    templateUrl: 'tpl/form_wizard.html'
                })
                .state('app.form.fileupload', {
                    url: '/fileupload',
                    templateUrl: 'tpl/form_fileupload.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('angularFileUpload').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/file-upload.js');
                                    }
                                );
                            }]
                    }
                })
                .state('app.form.imagecrop', {
                    url: '/imagecrop',
                    templateUrl: 'tpl/form_imagecrop.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('ngImgCrop').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/imgcrop.js');
                                    }
                                );
                            }]
                    }
                })
                .state('app.form.select', {
                    url: '/select',
                    templateUrl: 'tpl/form_select.html',
                    controller: 'SelectCtrl',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('ui.select').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/select.js');
                                    }
                                );
                            }]
                    }
                })
                .state('app.form.slider', {
                    url: '/slider',
                    templateUrl: 'tpl/form_slider.html',
                    controller: 'SliderCtrl',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('vr.directives.slider').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/slider.js');
                                    }
                                );
                            }]
                    }
                })
                .state('app.form.editor', {
                    url: '/editor',
                    templateUrl: 'tpl/form_editor.html',
                    controller: 'EditorCtrl',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('textAngular').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/editor.js');
                                    }
                                );
                            }]
                    }
                })
                .state('app.form.xeditable', {
                    url: '/xeditable',
                    templateUrl: 'tpl/form_xeditable.html',
                    controller: 'XeditableCtrl',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load('xeditable').then(
                                    function () {
                                        return $ocLazyLoad.load('js/controllers/xeditable.js');
                                    }
                                );
                            }]
                    }
                })
                // pages
                .state('app.page', {
                    url: '/page',
                    template: '<div ui-view class="fade-in-down"></div>'
                })
                .state('app.page.profile', {
                    url: '/profile',
                    templateUrl: 'tpl/page_profile.html'
                })
                .state('app.page.post', {
                    url: '/post',
                    templateUrl: 'tpl/page_post.html'
                })
                .state('app.page.search', {
                    url: '/search',
                    templateUrl: 'tpl/page_search.html'
                })
                .state('app.page.invoice', {
                    url: '/invoice',
                    templateUrl: 'tpl/page_invoice.html'
                })
                .state('app.page.price', {
                    url: '/price',
                    templateUrl: 'tpl/page_price.html'
                })
                .state('app.docs', {
                    url: '/docs',
                    templateUrl: 'tpl/docs.html'
                })
                // others
                .state('lockme', {
                    url: '/lockme',
                    templateUrl: 'tpl/page_lockme.html'
                })


                // fullCalendar
                .state('app.calendar', {
                    url: '/calendar',
                    templateUrl: 'tpl/app_calendar.html',
                    // use resolve to load other dependences
                    resolve: {
                        deps: ['$ocLazyLoad', 'uiLoad',
                            function ($ocLazyLoad, uiLoad) {
                                return uiLoad.load(
                                    JQ_CONFIG.fullcalendar.concat('js/app/calendar/calendar.js')
                                ).then(
                                    function () {
                                        return $ocLazyLoad.load('ui.calendar');
                                    }
                                )
                            }]
                    }
                })

                // mail
                .state('app.mail', {
                    abstract: true,
                    url: '/mail',
                    templateUrl: 'tpl/mail.html',
                    // use resolve to load other dependences
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/app/mail/mail.js',
                                    'js/app/mail/mail-service.js',
                                    JQ_CONFIG.moment]);
                            }]
                    }
                })
                .state('app.mail.list', {
                    url: '/inbox/{fold}',
                    templateUrl: 'tpl/mail.list.html'
                })
                .state('app.mail.detail', {
                    url: '/{mailId:[0-9]{1,4}}',
                    templateUrl: 'tpl/mail.detail.html'
                })
                .state('app.mail.compose', {
                    url: '/compose',
                    templateUrl: 'tpl/mail.new.html'
                })

                .state('layout', {
                    abstract: true,
                    url: '/layout',
                    templateUrl: 'tpl/layout.html'
                })
                .state('layout.fullwidth', {
                    url: '/fullwidth',
                    views: {
                        '': {
                            templateUrl: 'tpl/layout_fullwidth.html'
                        },
                        'footer': {
                            templateUrl: 'tpl/layout_footer_fullwidth.html'
                        }
                    },
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/vectormap.js']);
                            }]
                    }
                })
                .state('layout.mobile', {
                    url: '/mobile',
                    views: {
                        '': {
                            templateUrl: 'tpl/layout_mobile.html'
                        },
                        'footer': {
                            templateUrl: 'tpl/layout_footer_mobile.html'
                        }
                    }
                })
                .state('layout.app', {
                    url: '/app',
                    views: {
                        '': {
                            templateUrl: 'tpl/layout_app.html'
                        },
                        'footer': {
                            templateUrl: 'tpl/layout_footer_fullwidth.html'
                        }
                    },
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/controllers/tab.js']);
                            }]
                    }
                })
                .state('apps', {
                    abstract: true,
                    url: '/apps',
                    templateUrl: 'tpl/layout.html'
                })
                .state('apps.note', {
                    url: '/note',
                    templateUrl: 'tpl/apps_note.html',
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/app/note/note.js',
                                    JQ_CONFIG.moment]);
                            }]
                    }
                })
                .state('apps.contact', {
                    url: '/contact',
                    templateUrl: 'tpl/apps_contact.html',
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/app/contact/contact.js']);
                            }]
                    }
                })
                .state('app.weather', {
                    url: '/weather',
                    templateUrl: 'tpl/apps_weather.html',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(
                                    {
                                        name: 'angular-skycons',
                                        files: ['js/app/weather/skycons.js',
                                            'js/app/weather/angular-skycons.js',
                                            'js/app/weather/ctrl.js',
                                            JQ_CONFIG.moment]
                                    }
                                );
                            }]
                    }
                })
                .state('app.todo', {
                    url: '/todo',
                    templateUrl: 'tpl/apps_todo.html',
                    resolve: {
                        deps: ['uiLoad',
                            function (uiLoad) {
                                return uiLoad.load(['js/app/todo/todo.js',
                                    JQ_CONFIG.moment]);
                            }]
                    }
                })
                .state('app.todo.list', {
                    url: '/{fold}'
                })
                .state('music', {
                    url: '/music',
                    templateUrl: 'tpl/music.html',
                    controller: 'MusicCtrl',
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load([
                                    'com.2fdevs.videogular',
                                    'com.2fdevs.videogular.plugins.controls',
                                    'com.2fdevs.videogular.plugins.overlayplay',
                                    'com.2fdevs.videogular.plugins.poster',
                                    'com.2fdevs.videogular.plugins.buffering',
                                    'js/app/music/ctrl.js',
                                    'js/app/music/theme.css'
                                ]);
                            }]
                    }
                })
                .state('music.home', {
                    url: '/home',
                    templateUrl: 'tpl/music.home.html'
                })
                .state('music.genres', {
                    url: '/genres',
                    templateUrl: 'tpl/music.genres.html'
                })
                .state('music.detail', {
                    url: '/detail',
                    templateUrl: 'tpl/music.detail.html'
                })
                .state('music.mtv', {
                    url: '/mtv',
                    templateUrl: 'tpl/music.mtv.html'
                })
                .state('music.mtvdetail', {
                    url: '/mtvdetail',
                    templateUrl: 'tpl/music.mtv.detail.html'
                })
                .state('music.playlist', {
                    url: '/playlist/{fold}',
                    templateUrl: 'tpl/music.playlist.html'
                })
                
                
                 .state('app.users', {
                    url: '/users',
                    template: '<div ui-view  ng-controller="UsersController" class="fade-in-right-big"></div>'

                })
                .state('app.users.index', {
                    url: '/index',
                    templateUrl: 'users/index-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/users.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.users.create', {
                    url: '/create',
                    templateUrl: 'users/create-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                         deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/users.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.users.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'users/edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/users.js'
                                            ]
                                        });
                                    }
                                );
                            }]

                    }
                })
                .state('app.users.approve', {
                    url: '/approve',
                    templateUrl: 'users/approve-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/users.js'
                                            ]
                                        });
                                    }
                                );
                            }]

                    }
                })
                .state('app.users.approve-change-edit', {
                    url: '/approve-change-edit/{id}',
                    templateUrl: 'users/approve-change-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/users.js'
                                            ]
                                        });
                                    }
                                );
                            }]

                    }
                })
                .state('app.users.delete', {
                    url: '/delete/{id}',
                    controller: function ($http, $state, $stateParams, Flash) {

                        $http.post('checkAuthentication', {})
                            .success(function (data) {
                                if (data == '0') {
                                    $state.go('access.signin');
                                }
                            }, function (x) {
                            });

                        $http.get('users/destroy-delete/' + $stateParams.id)
                            .success(function (data) {
                                if (data.code == '200') {
                                    var message = '<strong>Delete!</strong> You successfully deleted the user.';
                                    Flash.create('success', message);
                                    $state.go(data.redirect);
                                }
                                if (data.code == '403') {
                                    $state.go(data.redirect);
                                }
                            });
                    }
                })
                  .state('app.departments', {
                    url: '/departments',
                    template: '<div ui-view  ng-controller="DepartmentsController" class="fade-in-right-big"></div>'
                })
                .state('app.departments.index', {
                    url: '/index',
                    templateUrl: 'departments/index-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                         deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/departments.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.departments.create', {
                    url: '/create',
                    templateUrl: 'departments/create-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                      deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/departments.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.departments.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'departments/edit-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/departments.js'
                                            ]
                                        });
                                    }
                                );
                            }]

                    }
                })
                .state('app.departments.delete', {
                    url: '/delete/{id}',
                    controller: function ($http, $state, $stateParams, Flash) {

                        $http.post('checkAuthentication', {})
                            .success(function (data) {
                                if (data == '0') {
                                    $state.go('access.signin');
                                }
                            }, function (x) {
                            });

                        $http.get('/departments/destroy-delete/' + $stateParams.id)
                            .success(function (data) {
                                if (data.code == '200') {
                                    Flash.create('success', data.msg);
                                    $state.go('app.departments.index');
                                }
                                if (data.code == '403') {
                                    Flash.create('danger', data.msg);
                                    $state.go('app.departments.index');
                                }
                            });
                    }
                })
                                
                  .state('app.designations', {
                    url: '/designations',
                    template: '<div ui-view  ng-controller="DesignationsController" class="fade-in-right-big"></div>'
                })
                .state('app.designations.index', {
                    url: '/index',
                    templateUrl: 'designations/index-view',
                    controller: "AuthCheckCtrl",
                    resolve: {
                         deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/designations.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.designations.create', {
                    url: '/create',
                    templateUrl: 'designations/create-add',
                    controller: "AuthCheckCtrl",
                    resolve: {
                      deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/designations.js'
                                            ]
                                        });
                                    }
                                );
                            }]
                    }
                })
                .state('app.designations.edit', {
                    url: '/edit/{id}',
                    templateUrl: 'designations/edit-edit',
                    controller: "AuthCheckCtrl",
                    resolve: {
                        deps: ['$ocLazyLoad',
                            function ($ocLazyLoad) {
                                return $ocLazyLoad.load(['smart-table']).then(
                                    function () {
                                        return $ocLazyLoad.load({
                                            files: [
                                                'js/controllers/designations.js'
                                            ]
                                        });
                                    }
                                );
                            }]

                    }
                })
                .state('app.designations.delete', {
                    url: '/delete/{id}',
                    controller: function ($http, $state, $stateParams, Flash) {

                        $http.post('checkAuthentication', {})
                            .success(function (data) {
                                if (data == '0') {
                                    $state.go('access.signin');
                                }
                            }, function (x) {
                            });

                        $http.get('/designations/destroy-delete/' + $stateParams.id)
                            .success(function (data) {
                                if (data.code == '200') {
                                    Flash.create('success', data.msg);
                                    $state.go('app.designations.index');
                                }
                                if (data.code == '403') {
                                    Flash.create('danger', data.msg);
                                    $state.go('app.designations.index');
                                }
                            });
                    }
                })
        }
    ]
);