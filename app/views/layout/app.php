<!-- navbar -->
<!--<div data-ng-include=" 'tpl/blocks/header.html' " class="app-header navbar">-->
<div data-ng-include=" '<?php echo url('headerView'); ?>' " class="app-header navbar">
</div>
<!-- / navbar -->

<!-- menu -->
<!--<div data-ng-include=" 'tpl/blocks/aside.html' " class="app-aside hidden-xs {{app.settings.asideColor}}">-->
<div data-ng-include=" '<?php echo url('asideView'); ?>' " class="app-aside hidden-xs bg-black">
</div>
<!-- / menu -->

<!-- content -->
<div class="app-content">
    <div ui-butterbar></div>
    <a href class="off-screen-toggle hide" ui-toggle-class="off-screen" data-target=".app-aside"></a>
    <div class="app-content-body fade-in-up" ui-view></div>
</div>
<!-- /content -->

<!-- footer -->
<div class="app-footer wrapper b-t bg-light">
    <span class="pull-right">eSparkBiz Technologies Pvt. Ltd.<a href ui-scroll-to="app" class="m-l-sm text-muted"><iclass="fa fa-long-arrow-up"></i></a></span>
    &copy; 2015 Copyright.
</div>
<!-- / footer -->

<!--<div data-ng-include=" 'tpl/blocks/settings.html' " class="settings panel panel-default"></div>-->