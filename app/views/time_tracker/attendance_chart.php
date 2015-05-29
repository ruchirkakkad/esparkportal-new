<div ng-init="attendanceChartReportData();
    app.settings.asideFolded = true;
    app.settings.asideDock = true;
  ">
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Chart</h1>
    </div>
    <div class="wrapper-md">
        <div flash-message="5000"></div>

        <div data-ng-include="attendance_chart_report" class="fade-in-up-big "></div>

    </div>
</div>