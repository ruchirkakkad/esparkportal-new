<!DOCTYPE html>
<html lang="en" data-ng-app="app" ng-controller="AppCtrl">
<head>
    <meta charset="utf-8" />
    <title>Be Angular | Bootstrap Admin Web App with AngularJS</title>
    <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    {{ HTML::style('bower_components/bootstrap/dist/css/bootstrap.css') }}
    {{ HTML::style('bower_components/animate.css/animate.css') }}
    {{ Html::style('bower_components/font-awesome/css/font-awesome.min.css') }}
    {{ Html::style('bower_components/simple-line-icons/css/simple-line-icons.css') }}
    {{ Html::style('css/font.css') }}

    {{ Html::style('css/app.css') }}
    {{ Html::style('css/newcss.css') }}


    {{ Html::style('css/ivh-treeview.css') }}
    {{ Html::style('css/ivh-treeview-theme-basic.css') }}

</head>
<body >
<div class="app" id="app" ng-class="{'app-header-fixed':app.settings.headerFixed, 'app-aside-fixed':app.settings.asideFixed, 'app-aside-folded':false, 'app-aside-dock':app.settings.asideDock, 'container':app.settings.container}" ui-view>

</div>

  <!-- jQuery -->
{{ Html::script('bower_components/jquery/dist/jquery.min.js'); }}
  <!-- Angular -->
  {{ Html::script('bower_components/angular/angular.js'); }}


{{ Html::script('bower_components/angular-animate/angular-animate.js'); }}
{{ Html::script('bower_components/angular-cookies/angular-cookies.js'); }}
{{ Html::script('bower_components/angular-resource/angular-resource.js'); }}
{{ Html::script('bower_components/angular-sanitize/angular-sanitize.js'); }}
{{ Html::script('bower_components/angular-touch/angular-touch.js'); }}

{{ Html::script('bower_components/angular-ui-router/release/angular-ui-router.js'); }}
{{ Html::script('bower_components/ngstorage/ngStorage.js'); }}
{{ Html::script('bower_components/angular-ui-utils/ui-utils.js'); }}
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/ng-csv/0.3.2/ng-csv.min.js'); }}
  <!-- bootstrap -->
{{ Html::script('bower_components/angular-bootstrap/ui-bootstrap-tpls.js'); }}

  <!-- lazyload -->
{{ Html::script('bower_components/oclazyload/dist/ocLazyLoad.js'); }}

  <!-- translate -->
{{ Html::script('bower_components/angular-translate/angular-translate.js'); }}
{{ Html::script('bower_components/angular-translate-loader-static-files/angular-translate-loader-static-files.js'); }}
{{ Html::script('bower_components/angular-translate-storage-cookie/angular-translate-storage-cookie.js'); }}
{{ Html::script('bower_components/angular-translate-storage-local/angular-translate-storage-local.js'); }}

  <!-- App -->

{{ Html::script('js/app.js'); }}
{{ Html::script('js/config.js'); }}
{{ Html::script('js/config.lazyload.js'); }}
{{ Html::script('js/config.router.js'); }}
{{ Html::script('js/main.js'); }}
{{ Html::script('js/services/ui-load.js'); }}
{{ Html::script('js/filters/fromNow.js'); }}
{{ Html::script('js/directives/setnganimate.js'); }}
{{ Html::script('js/directives/ui-butterbar.js'); }}
{{ Html::script('js/directives/ui-focus.js'); }}
{{ Html::script('js/directives/ui-fullscreen.js'); }}
{{ Html::script('js/directives/ui-jq.js'); }}
{{ Html::script('js/directives/ui-module.js'); }}
{{ Html::script('js/directives/ui-nav.js'); }}
{{ Html::script('js/directives/ui-scroll.js'); }}
{{ Html::script('js/directives/ui-shift.js'); }}
{{ Html::script('js/directives/ui-toggleclass.js'); }}
{{ Html::script('js/angular-flash.js'); }}
{{ Html::script('js/controllers/bootstrap.js'); }}
  <!-- Lazy loading -->

{{ Html::script('js/ivh-treeview.js'); }}

</body>
</html>