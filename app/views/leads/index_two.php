<div ng-init="leads_wise_data()">
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">
           {{ lead_name }}
        </h1>
    </div>

    <div class="wrapper-md">
        <div ng-include="leads_view_html"></div>
        <div flash-message="5000"></div>
    </div>
</div>