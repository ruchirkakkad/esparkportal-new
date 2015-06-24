<div ng-controller="MailListCtrl">
    <!-- header -->
    <div class="wrapper bg-light lter b-b"></div>
    <!-- / header -->

    <!-- list -->
    <ul class="list-group list-group-lg no-radius m-b-none m-t-n-xxs">
        <li ng-repeat="mail in mails | filter:fold" ng-class="labelClass(mail.label)" class="list-group-item clearfix b-l-3x" style="{{mail.fold == 'unread' ? 'background-color : #e9e9e5' : '' }}">
            <a ui-sref="app.page.profile" class="avatar thumb pull-left m-r">
                <img ng-src="<?php echo ImgProxy::link("public/{{mail.avatar}}", 128, 128,100,0); ?>">
            </a>
            <div class="pull-right text-sm text-muted">
                <span class="hidden-xs">{{ mail.date | fromNow }}</span>
                <i class="fa fa-paperclip ng-hide m-l-sm" ng-show="{{mail.attach}}"></i>
            </div>
            <div class="clear">
                <div>
                    <a ui-sref="app.notifications.detail({mailId:mail.id})" class="text-md">{{mail.subject}}</a>
                    <span class="label {{ labelClass1(mail.label) }} m-l-sm" ng-class="labelClass1(mail.label)">{{mail.label}}</span>
                </div>
                <div class="text-ellipsis m-t-xs">{{ mail.content | limitTo:100 | htmlToPlaintext}}</div>
            </div>
        </li>
    </ul>
    <!-- / list -->
</div>