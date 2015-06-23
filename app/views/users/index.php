<!--<div ng-controller="UsersController"  ng-init="indexViewUser()">-->
<!--    <div data-ng-include="user_view_file" class="fade-in-up-big "></div>-->
<!--</div>-->
<!-- hbox layout -->
<div class="hbox hbox-auto-xs hbox-auto-sm bg-light " ng-controller="UsersController"  ng-init="
  app.settings.asideFixed = true;
  app.settings.asideDock = false;
  app.settings.container = false;
  app.hideAside = false;
  app.hideFooter = true;
  indexViewUser();
  ">
    <!-- column -->
    <div class="col w b-r">
        <div class="vbox">
            <div class="row-row">
                <div class="cell scrollable hover">
                    <div class="cell-inner">
                        <div class="list-group no-radius no-border no-bg m-b-none">
                            <a class="list-group-item b-b" ng-class="{'focus': (filter == '')}" ng-click="selectGroup({departments_id:''})">ALL Contacts</a>
                            <a ng-repeat="item in groups" ng-dblclick="editItem(item)" class="list-group-item m-l hover-anchor b-a no-select" ng-class="{'focus m-l-none': item.selected}" ng-click="selectGroup(item)">
<!--                                <span ng-click='deleteGroup(item)' class="pull-right text-muted hover-action"><i class="fa fa-times"></i></span>-->
                                <span class="block m-l-n" ng-class="{'m-n': item.selected }">{{ item.departments_name ? item.departments_name : 'Untitled' }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper b-t">
<!--                <span tooltip="Double click to Edit" class="pull-right text-muted inline wrapper-xs m-r-sm"><i class="fa fa-question"></i></span>-->
<!--                <a href class="btn btn-sm btn-default" ng-click="createGroup()"><i class="fa fa-plus fa-fw m-r-xs"></i> New Group</a>-->
            </div>
        </div>
    </div>
    <!-- /column -->
    <!-- column -->
    <div class="col w-lg lter b-r">
        <div class="vbox">
            <div class="wrapper-xs b-b">
                <div class="input-group m-b-xxs">
                    <span class="input-group-addon input-sm no-border no-bg"><i class="icon-magnifier text-md m-t-xxs"></i></span>
                    <input type="text" class="form-control input-sm no-border no-bg text-md" placeholder="Search {{group.departments_name ? group.departments_name : 'All Contacts'}}" ng-model="query">
                </div>
            </div>
            <div class="row-row">
                <div class="cell scrollable hover">
                    <div class="cell-inner">
                        <div class="m-t-n-xxs">
                            <div class="list-group list-group-lg no-radius no-border no-bg m-b-none">
                                <a ng-repeat="item in items | filter:{department_id:filter} | filter:query | orderBy:'first_name'" class="list-group-item m-l" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                                  <span class="block text-ellipsis m-l-n text-md" ng-class="{'m-l-none': item.selected }">
                                    {{ item.first_name }} <strong>{{ item.last_name }}</strong>
                                    <span ng-hide="item.first_name || item.last_name">No Name</span>
                                  </span>
                                </a>
                            </div>
                        </div>
                        <div class="text-center pos-abt w-full" style="top:50%;" ng-hide="(items | filter:{department_id:filter} | filter:query).length">No Contacts</div>
                    </div>
                </div>
            </div>
            <div class="wrapper b-t text-center">
<!--                <a href class="btn btn-sm btn-default btn-addon" ng-click="createItem()"><i class="fa fa-plus fa-fw m-r-xs"></i> New Contact</a>-->
            </div>
        </div>
    </div>
    <!-- /column -->

    <!-- column -->
    <div class="col bg-white-only">
        <div class="vbox">
            <div class="wrapper-sm b-b">
                <div class="m-t-n-xxs m-b-n-xxs m-l-xs">
                    <a class="btn btn-sm btn-default" href="#/app/users/edit/{{ item.user_encrypt_id }}"><i class="fa fa-pencil"></i> Edit</a>
                    <a class="btn btn-sm btn-default" href="#/app/users/view/{{ item.user_encrypt_id }}"><i class="fa fa-eye"></i> View</a>
                    <a class="btn btn-sm btn-default" href="#/app/users/delete/{{ item.user_encrypt_id }}"><i class="fa fa-close"></i> Delete</a>
                </div>
            </div>
            <div class="row-row">
                <div class="cell">
                    <div class="cell-inner">
                        <div class="wrapper-lg">
                            <div class="hbox h-auto m-b-lg">
                                <div class="col text-center w-sm">
                                    <div class="thumb-lg avatar inline">
                                        <img ng-src="<?= ImgProxy::link("public/{{item.profile_image}}", 100, 100,100,0); ?>" ng-show="item.profile_image">
                                    </div>
                                </div>
                                <div class="col v-middle h1 font-thin">
                                    <div ng-hide="item.editing">{{item.first_name}} {{item.last_name}}</div>
                                    <div ng-show="item.editing">
                                        <input type="text" placeholder="First" class="form-control w-auto input-lg m-b-n-xxs font-bold" ng-model="item.first_name" >
                                        <input type="text" placeholder="Last" class="form-control w-auto input-lg font-bold" ng-model="item.last_name" >
                                    </div>
                                </div>
                            </div>
                            <!-- fields -->
                            <div class="form-horizontal">
                                <div class="form-group m-b-sm">
                                    <label class="col-sm-3 control-label">Phone</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static">{{ item.user_contact.current_phone }}</p>
                                    </div>
                                </div>
                                <div class="form-group m-b-sm">
                                    <label class="col-sm-3 control-label">Designation</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static">{{ item.designation.designations_name }}</p>
                                    </div>
                                </div>
                                <div class="form-group m-b-sm">
                                    <label class="col-sm-3 control-label">DOB</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static">{{ item.user_personal.dob }}</p>
                                    </div>
                                </div>
                                <div class="form-group m-b-sm">
                                    <label class="col-sm-3 control-label">DOJ</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static">{{ item.doj }}</p>
                                    </div>
                                </div>
                                <div class="form-group m-b-sm">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static">{{ item.email }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- / fields -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /column -->
</div>
<!-- /hbox layout -->