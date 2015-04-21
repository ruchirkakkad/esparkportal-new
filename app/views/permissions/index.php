<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="viewPermission()">
    <div class="col w-lg bg-light b-r bg-auto">
        <div class="wrapper-md">
            <a ng-repeat="role in data.roles" ng-click="selectRole({{role.id}},'{{role.name}}')"
               class="btn btn-default btn-block m-b">{{role.name}}</a>

        </div>
    </div>

    <div class="col" ng-show="data.showRoles">
        <div flash-message="5000"></div>
        <div class="wrapper-md">
            <div ng-include="tree_view" class="fade-in-down-big "></div>
        </div>

    </div>

</div>