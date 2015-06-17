<div ng-controller="MailDetailCtrl">
    <!-- header -->
    <div class="wrapper bg-light lter b-b">
        <a ui-sref="app.notifications.list" class="btn btn-sm btn-default w-xxs m-r-sm" tooltip="Back to Inbox"><i class="fa fa-long-arrow-left"></i></a>
    </div>
    <!-- / header -->
    <div class="wrapper b-b">
        <h2 class="font-thin m-n">{{mail.subject}}</h2>
    </div>
    <div class="wrapper b-b">
        <img ng-src="{{mail.avatar}}" class="img-circle thumb-xs m-r-sm">
        from <a href>{{mail.from}}</a> on {{mail.date}}
    </div>
    <div class="wrapper">
        {{mail.content}}
    </div>
    <div class="wrapper">
        <div ng-repeat="attach in mail.attach" class="panel b-a inline m-r-sm m-b-sm bg-light">
            <div class="wrapper-xs b-b"><i class="fa fa-paperclip"></i> {{attach.name}}</div>
            <div class="wrapper-xs w-sm lt">
                <a ng-href="{{attach.url}}"><img ng-src="{{attach.url}}" class="img-full"></a>
            </div>
        </div>
        <div class="panel b-a inline m-r-sm m-b-sm bg-light">
            <div class="wrapper-xs b-b"><i class="fa fa-paperclip"></i>Testindg</div>
            <div class="wrapper-xs w-sm lt">
<!--                <img ng-src="{{contentUrl}}" class="img-full"></a>-->
                <embed ng-src="{{contentUrl}}" style="width:140px;height:140px;"></embed>
            </div>
        </div>
    </div>

</div>