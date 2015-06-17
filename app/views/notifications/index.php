
<div class="hbox hbox-auto-xs hbox-auto-sm" ng-controller="MailCtrl">
    <div class="col w-md bg-light dk b-r bg-auto">
        <div class="wrapper b-b bg">
<!--            <button class="btn btn-sm btn-default pull-right visible-sm visible-xs" ui-toggle-class="show" target="#email-menu"><i class="fa fa-bars"></i></button>-->
<!--            <a ui-sref="app.mail.compose" class="btn btn-sm btn-danger w-xs font-bold">Compose</a>-->
        </div>
        <div class="wrapper hidden-sm hidden-xs" id="email-menu">
            <ul class="nav nav-pills nav-stacked nav-sm">
                <li ng-repeat="fold in folds" ui-sref-active="active">
                    <a ui-sref="app.notifications.list({fold:fold.filter})">
                        {{fold.name}}
                    </a>
                </li>
            </ul>
            <div class="wrapper">Labels</div>
            <ul class="nav nav-pills nav-stacked nav-sm">
                <li ng-repeat="label in labels" ui-sref-active="active">
                    <a ui-sref="app.notifications.list({fold:label.filter})">
                        <i class="fa fa-fw fa-circle text-muted" color="{{label.color}}" label-color ></i>
                        {{label.name}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col">
        <div ui-view ></div>
    </div>
</div>