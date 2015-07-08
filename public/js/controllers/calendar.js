/**
 * Created by ruchir on 5/14/2015.
 */
app.controller('CalendarController', ['$scope', '$http', function ($scope, $http) {

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    /* event source that contains custom events on the scope */
    $scope.events = [
        {
            title: '',
            start: new Date(y - 10, m, 1),
            className: ['b-l b-2x b-info'],
            location: '',
            info: ''
        },
    ];


    $scope.data = {
        calendar_data: [],
        total: 0
    };
    $scope.calender_view = '';
    $http.get('dashboard_calendar/calenderdata-view', {})
        .success(function (data) {

            $scope.data.calendar_data = data.calendar_data;
            $scope.data.total = data.total;
            //console.log($scope.data.followup);
            var counter = 0;
            angular.forEach($scope.data.calendar_data, function (item) {
                counter++;
                $scope.events.push({
                    title: item.title,
                    start: item.start,
                    className: [item.className]
                });
            });

            if ($scope.data.total == counter) {
                $scope.calender_view = 'tpl/calender_view.html';
            }


        }, function (x) {
            Flash.create('danger', 'Server Error');
        });


    /* alert on dayClick */
    $scope.precision = 400;
    $scope.lastClickTime = 0;
    $scope.alertOnEventClick = function (date, jsEvent, view) {
        var time = new Date().getTime();
        if (time - $scope.lastClickTime <= $scope.precision) {
            //$scope.events.push({
            //    title: 'New Event',
            //    start: date,
            //    className: ['b-l b-2x b-info']
            //});
        }
        $scope.lastClickTime = time;
    };
    /* alert on Drop */
    $scope.alertOnDrop = function (event, delta, revertFunc, jsEvent, ui, view) {
        $scope.alertMessage = ('Event Droped to make dayDelta ' + delta);
    };
    /* alert on Resize */
    $scope.alertOnResize = function (event, delta, revertFunc, jsEvent, ui, view) {
        $scope.alertMessage = ('Event Resized to make dayDelta ' + delta);
    };

    $scope.overlay = $('.fc-overlay');
    $scope.alertOnMouseOver = function (event, jsEvent, view) {
        $scope.event = event;
        $scope.overlay.removeClass('left right top').find('.arrow').removeClass('left right top pull-up');
        var wrap = $(jsEvent.target).closest('.fc-event');
        var cal = wrap.closest('.calendar');
        var left = wrap.offset().left - cal.offset().left;
        var right = cal.width() - (wrap.offset().left - cal.offset().left + wrap.width());
        var top = cal.height() - (wrap.offset().top - cal.offset().top + wrap.height());
        if (right > $scope.overlay.width()) {
            $scope.overlay.addClass('left').find('.arrow').addClass('left pull-up')
        } else if (left > $scope.overlay.width()) {
            $scope.overlay.addClass('right').find('.arrow').addClass('right pull-up');
        } else {
            $scope.overlay.find('.arrow').addClass('top');
        }
        if (top < $scope.overlay.height()) {
            $scope.overlay.addClass('top').find('.arrow').removeClass('pull-up').addClass('pull-down')
        }
        (wrap.find('.fc-overlay').length == 0) && wrap.append($scope.overlay);
    };

    /* config object */
    $scope.uiConfig = {
        calendar: {
            height: 450,
            editable: false,
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            dayClick: $scope.alertOnEventClick,
            eventDrop: $scope.alertOnDrop,
            eventResize: $scope.alertOnResize,
            eventMouseover: $scope.alertOnMouseOver
        }
    };

    /* Change View */
    $scope.changeView = function (view, calendar) {
        $('.calendar').fullCalendar('changeView', view);
    };

    $scope.today = function (calendar) {
        $('.calendar').fullCalendar('today');
    };

    /* event sources array*/
    $scope.eventSources = [$scope.events];
}]);
/* EOF */