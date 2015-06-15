/**
 * Created by ruchir on 6/15/2015.
 */
app.controller('ExpensesController', ['$scope', '$http', '$state', 'Flash', '$stateParams', '$rootScope',
    function ($scope, $http, $state, Flash, $stateParams, $rootScope) {

        $scope.data = {
            'expenses_name': '',
            'expenses_id': '',
            'expenses' : []
        };
        $scope.index = function() {
            $scope.expenses_view_file = '';
            $http.get('expenses/indexdata-view', {}).success(function (data) {
                $scope.data.expenses = data.aaData;
                $scope.expenses_view_file = 'tpl/expenses_view_file.html';
            });
        };

        $scope.getArray = function(){
            var csv = [];
            angular.forEach($scope.data.expenses, function(value, key) {
                csv[key] = {
                    date: value.date,
                    expense_type: value.expense_type,
                    amount_type: value.amount_type,
                    cheque_number: value.cheque_number,
                    reason: value.reason,
                    amount: value.amount
                }
            });
            return csv;
        };
        $scope.resetData = function() {
            $scope.data = {
                'expenses_name': '',
                'expenses_id': ''
            };
        };

        $scope.create = function () {

            $http.post('expenses/store-add', {
                date: $scope.data.date,
                expense_type: $scope.data.expense_type,
                amount_type: $scope.data.amount_type,
                cheque_number: $scope.data.cheque_number,
                reason: $scope.data.reason,
                amount: $scope.data.amount
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.expenses.index-view',{},{reload: true});
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };


        $scope.editData = function () {
            $http.post('expenses/find-edit/' + $stateParams.id, {})
                .success(function (data) {
                    $scope.data = data;
                });
        }


        $scope.update = function () {


            $http.post('expenses/update-edit/' + $scope.data.expenses_id, {
                date: $scope.data.date,
                expense_type: $scope.data.expense_type,
                amount_type: $scope.data.amount_type,
                cheque_number: $scope.data.cheque_number,
                reason: $scope.data.reason,
                amount: $scope.data.amount
            }).success(function (data) {

                var data = (data);

                if (data.code == '200') {

                    Flash.create('success', data.msg);
                    $state.go('app.expenses.index-view',{},{reload: true});
                }
                if (data.code == '403') {
                    Flash.create('danger', data.msg);
                }
            }, function (x) {
                Flash.create('danger', 'Server Error');
            });
        };

    }]);
