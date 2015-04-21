<div ng-init="timezone_wise_data()">
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">
            <b>{{ timezone.timezones_name }}</b> : {{ timezone.timezones_time1  | date:'dd-MM-yyyy h:mm:ss a'  }} | |
            <b>India</b> : {{ date  | date:'dd-MM-yyyy h:mm:ss a'  }}

        </h1>
    </div>

    <div class="wrapper-md">
        <div ng-include="pleaseWork"></div>
        <div flash-message="5000"></div>

    </div>
</div>