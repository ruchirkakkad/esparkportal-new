/**
 * Created by ruchir on 6/16/2015.
 */
app.controller('MailCtrl', ['$scope', function($scope) {
    $scope.folds = [
        {name: 'All', filter:''},
        {name: 'Unread', filter:'unread'}
    ];

    $scope.labels = [
        {name: 'General', filter:'general', color:'#23b7e5'},
        {name: 'Leave', filter:'leave', color:'#7266ba'},
        {name: 'Event', filter:'event', color:'#fad733'},
        {name: 'Meeting', filter:'meeting', color:'#27c24c'}
    ];



    $scope.labelClass = function(label) {
        return {
            'b-l-info': angular.lowercase(label) === 'general',
            'b-l-primary': angular.lowercase(label) === 'leave',
            'b-l-warning': angular.lowercase(label) === 'event',
            'b-l-success': angular.lowercase(label) === 'meeting'
        };
    };
    $scope.labelClass1 = function(label) {
        return {
            'bg-info': angular.lowercase(label) === 'general',
            'bg-primary': angular.lowercase(label) === 'leave',
            'bg-warning': angular.lowercase(label) === 'event',
            'bg-success': angular.lowercase(label) === 'meeting'
        };
    };

}]);

app.controller('MailListCtrl', ['$scope', 'mails', '$stateParams','$http','$sce',
    function($scope, mails, $stateParams,$http,$sce) {
    $scope.fold = $stateParams.fold;
    mails.all().then(function(mails){
        $scope.mails = mails;
    });
}]);

app.controller('MailDetailCtrl', ['$scope', 'mails', '$stateParams','$http','$sce',
    function($scope, mails, $stateParams,$http,$sce) {
    mails.get($stateParams.mailId).then(function(mail){
        $scope.mail = mail;
        $http.post('uploads/admin@admin.com/attachments/t.pdf',{}, {responseType:'arraybuffer'})
            .success(function (response) {
                var file = new Blob([response], {type: 'application/pdf'});
                var fileURL = URL.createObjectURL(file);
                console.log(fileURL);
                $scope.contentUrl = $sce.trustAsResourceUrl(fileURL);
                console.log($scope.contentUrl);
            });
    })
}]);

app.controller('MailNewCtrl', ['$scope', function($scope) {
    $scope.mail = {
        to: '',
        subject: '',
        content: ''
    }
    $scope.tolist = [
        {name: 'James', email:'james@gmail.com'},
        {name: 'Luoris Kiso', email:'luoris.kiso@hotmail.com'},
        {name: 'Lucy Yokes', email:'lucy.yokes@gmail.com'}
    ];
}]);

angular.module('app').directive('labelColor', function(){
    return function(scope, $el, attrs){
        $el.css({'color': attrs.color});
    }
});


// A RESTful factory for retreiving mails from 'mails.json'
app.factory('mails', ['$http', function ($http) {
    var path = 'notifications/data';
    var factory = {};
    factory.all = function () {
        return $http.get(path).then(function (resp) {
            return resp.data.mails;
        });
    };
    factory.get = function (id) {
        return $http.get(path).then(function(resp){
            var mails = resp.data.mails;
            for (var i = 0; i < mails.length; i++) {
                if (mails[i].id == id) return mails[i];
            }
            return null;
        })
    };
    return factory;
}]);