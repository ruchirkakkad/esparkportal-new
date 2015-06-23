<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Add Announcement</h1>
</div>
<div ng-controller="AnnouncementsController" class="wrapper-md" ng-init="resetData()">
    <div flash-message="5000"></div>
    <div>
        <div ng-include="announcements_create_file"></div>
    </div>
</div>