<div ng-init="call_closed_data()">
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">
           Call Closed
        </h1>
    </div>

    <div class="wrapper-md">
        <div ng-include="call_closed_view_html"></div>
        <div flash-message="5000"></div>
    </div>
</div>