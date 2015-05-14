/**
 * calendarDemoApp - 0.1.3
 */

app.controller('FullcalendarCtrl', ['$scope', '$http', function ($scope, $http) {

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    /* event source that pulls from google.com */
    $scope.eventSource = {
        url: "http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic",
        className: 'gcal-event',           // an option!
        currentTimezone: 'America/Chicago' // an option!
    };

    /* event source that contains custom events on the scope */
    $scope.events = [
        {
            title: 'All Day Event',
            start: new Date(y - 10, m, 1),
            className: ['b-l b-2x b-info'],
            location: 'New York',
            info: 'This a all day event that will start from 9:00 am to 9:00 pm, have fun!'
        },
    ];


    $scope.data = {
        followup: [],
        lead_status: 0
    };
    $scope.calender_view = '';
    $http.get('followup/calenderdata-view', {})
        .success(function (data) {
            //$scope.events = [];

            $scope.data.followup = data.followup;
            $scope.data.lead_status = data.lead_status;
            //console.log($scope.data.followup);
            var counter = 0;
            angular.forEach($scope.data.followup, function (item) {
                //var date = new Date(item.note_date);
                //
                //var d = date.getDate();
                //var m = date.getMonth();
                //var y = date.getFullYear();
                counter++;
                $scope.events.push({
                    title: item.owner_name,
                    start: new Date(item.note_date),
                    className: ['b-l b-2x b-info'],
                    location: item.marketing_states_name,
                    info: item.message
                });
            });

            if ($scope.data.lead_status == counter) {
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
            $scope.events.push({
                title: 'New Event',
                start: date,
                className: ['b-l b-2x b-info']
            });
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
            editable: true,
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

    /* add custom event*/
    $scope.addEvent = function () {
        $scope.events.push({
            title: 'New Event',
            start: new Date(y, m, d),
            className: ['b-l b-2x b-info']
        });
    };

    /* remove event */
    $scope.remove = function (index) {
        $scope.events.splice(index, 1);
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
