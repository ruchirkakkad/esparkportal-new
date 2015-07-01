// config

var app =
        angular.module('app')
            .config(
            ['$controllerProvider', '$compileProvider', '$filterProvider', '$provide',
                function ($controllerProvider, $compileProvider, $filterProvider, $provide) {

                    // lazy controller, directive and service
                    app.controller = $controllerProvider.register;
                    app.directive = $compileProvider.directive;
                    app.filter = $filterProvider.register;
                    app.factory = $provide.factory;
                    app.service = $provide.service;
                    app.constant = $provide.constant;
                    app.value = $provide.value;
                }
            ])
            .config(['$translateProvider', function ($translateProvider) {
                // Register a loader for the static files
                // So, the module will search missing translation tables under the specified urls.
                // Those urls are [prefix][langKey][suffix].
                $translateProvider.useStaticFilesLoader({
                    prefix: 'l10n/',
                    suffix: '.js'
                });
                // Tell the module what language to use by default
                $translateProvider.preferredLanguage('en');
                // Tell the module to store the language in the local storage
                $translateProvider.useLocalStorage();
            }])
            .run(function ($rootScope, $http, $location) {
                //$rootScope.permission =[];

                $http.post('setAngularPermission', {})
                    .success(function (data) {

                        if (data == '0') {
                            //$scope.authError = 'Email or Password not right';
                        } else {
                            $rootScope.permission = data.permission;
                            $rootScope.user = data.user;
                        }
                    });


            })
            .run(['$rootScope', 'PreviousState',
                function ($rootScope, PreviousState) {
                    $rootScope.PreviousState = PreviousState;
                }])
    ;

app.directive('input', function ($compile, $parse) {
    return {
        restrict: 'E',
        require: '?ngModel',
        link: function ($scope, $element, $attributes, ngModel) {
            if ($attributes.type !== 'daterange' || ngModel === null) return;

            var options = {};
            options.format = $attributes.format || 'YYYY-MM-DD';
            options.separator = $attributes.separator || ' - ';
            options.minDate = $attributes.minDate && moment($attributes.minDate);
            options.maxDate = $attributes.maxDate && moment($attributes.maxDate);
            options.dateLimit = $attributes.limit && moment.duration.apply(this, $attributes.limit.split(' ').map(function (elem, index) {
                return index === 0 && parseInt(elem, 10) || elem;
            }));
            options.ranges = $attributes.ranges && $parse($attributes.ranges)($scope);
            options.locale = $attributes.locale && $parse($attributes.locale)($scope);
            options.opens = $attributes.opens && $parse($attributes.opens)($scope);

            function format(date) {
                return date.format(options.format);
            }

            function formatted(dates) {
                return [format(dates.startDate), format(dates.endDate)].join(options.separator);
            }

            ngModel.$formatters.unshift(function (modelValue) {
                if (!modelValue) return '';
                return modelValue;
            });

            ngModel.$parsers.unshift(function (viewValue) {
                return viewValue;
            });

            ngModel.$render = function () {
                if (!ngModel.$viewValue || !ngModel.$viewValue.startDate) return;
                $element.val(formatted(ngModel.$viewValue));
            };

            $scope.$watch($attributes.ngModel, function (modelValue) {
                if (!modelValue || (!modelValue.startDate)) {
                    ngModel.$setViewValue({startDate: moment().startOf('day'), endDate: moment().startOf('day')});
                    return;
                }
                $element.data('daterangepicker').startDate = modelValue.startDate;
                $element.data('daterangepicker').endDate = modelValue.endDate;
                $element.data('daterangepicker').updateView();
                $element.data('daterangepicker').updateCalendars();
                $element.data('daterangepicker').updateInputText();
            });

            $element.daterangepicker(options, function (start, end) {
                $scope.$apply(function () {
                    ngModel.$setViewValue({startDate: start, endDate: end});
                    ngModel.$render();
                });
            });
        }
    };
});
app.factory('PreviousState', ['$rootScope', '$state',
    function ($rootScope, $state) {

        var lastHref = "/dashboard",
            lastStateName = "dashboard",
            lastParams = {};

        $rootScope.$on("$stateChangeSuccess", function (event, toState, toParams, fromState, fromParams) {
            lastStateName = fromState.name;
            lastParams = fromParams;
            lastHref = $state.href(lastStateName, lastParams);
        });

        return {
            getLastHref: function () {
                return lastHref;
            },
            goToLastState: function () {
                console.log(lastStateName);
                console.log(lastParams);
                return $state.go(lastStateName, lastParams);
            }
        };

    }]);

app.filter('htmlToPlaintext', function() {
        return function(text) {
            return String(text).replace(/<[^>]+>/gm, '');
        };
    }
);

app.directive('ngReallyClick', [function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            element.bind('click', function() {
                //var message = attrs.ngReallyMessage;
                var message = 'Are you sure?';
                console.log('in');
                if (message && confirm(message)) {
                    scope.$apply(attrs.ngReallyClick);
                }
            });
        }
    }
}]);
