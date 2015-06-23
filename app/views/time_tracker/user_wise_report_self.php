<div ng-init="userWiseReportDataSelf()">
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">{{ data.user.first_name }} {{ data.user.last_name }}</h1>
    </div>
    <div class="wrapper-md">
        <div flash-message="5000"></div>

        <div data-ng-include="user_wise_report" class="fade-in-up-big "></div>

    </div>
</div>