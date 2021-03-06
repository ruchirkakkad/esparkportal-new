<!DOCTYPE html>
<html lang="en" data-ng-app="app" ng-controller="AppCtrl">
<head>
    <meta charset="utf-8"/>
    <link href="img/favicon.ico" rel="icon" size="64x64">
    <title>E-Portal</title>
    <meta name="description"
          content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    {{ HTML::style('bower_components/bootstrap/dist/css/bootstrap.css') }}
    {{ HTML::style('bower_components/animate.css/animate.css') }}
    {{ Html::style('bower_components/font-awesome/css/font-awesome.min.css') }}
    {{ Html::style('bower_components/simple-line-icons/css/simple-line-icons.css') }}

    <link rel="stylesheet" href="bower_components/angular-filemanager/dist/angular-filemanager.css">
    {{ Html::style('css/font.css') }}

    {{ Html::style('css/app.css') }}
    {{ Html::style('css/newcss.css') }}

    {{--
    <link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css">
    --}}

    {{ Html::style('css/css/daterangepicker-bs3.css') }}
    {{ Html::style('css/css/datetimepicker.css') }}
    {{ Html::style('css/ivh-treeview.css') }}
    {{ Html::style('css/ivh-treeview-theme-basic.css') }}
    <link href="css/loader.css" rel="stylesheet" type="text/css">
    <link href="css/loader1.css" rel="stylesheet" type="text/css">

</head>
<body>
    {{--<div class="loading-spiner-holder" data-loading ><div class="loading-spiner"><img src="img/page_loader.gif" /></div></div>--}}
    {{--<div id="dvLoading" style="display: none;" data-loading></div>--}}
    <div class="pre-loader" data-loading>
    	   <div class="box1"></div>
    	   <div class="box2"></div>
    	   <div class="box3"></div>
    	   <div class="box4"></div>
    	   <div class="box5"></div>
    	</div>

    	{{--<div id="ss-loading" data-loading>--}}
            {{--<div id="ss-loading-center">--}}
                {{--<div id="ss-loading-center-absolute">--}}
                    {{--<div id="object_one" class="object"></div>--}}
                    {{--<div id="object_two" class="object"></div>--}}
                    {{--<div id="object_three" class="object"></div>--}}
                    {{--<div id="object_four" class="object"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    <div class="app" id="app"
         ng-class="{'app-header-fixed':app.settings.headerFixed, 'app-aside-fixed':app.settings.asideFixed, 'app-aside-folded':false, 'app-aside-dock':true, 'container':app.settings.container}"
         ui-view></div>
    
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
    
    
    <script type="text/javascript">
        FileAPI = {
            debug: true
        };
    </script>
    {{ Html::script('bower_components/ng-file-upload/ng-file-upload-shim.js'); }}
    {{ Html::script('bower_components/ng-file-upload/ng-file-upload.js'); }}
    {{--
    <script src="js/ng-file-upload/ng-file-upload-shim.js"></script>
    --}}
    {{--
    <script src="js/ng-file-upload/ng-file-upload.js"></script>
    --}}
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/4.8.0/codemirror.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/4.8.0/codemirror.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/4.8.0/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/4.8.0/mode/htmlembedded/htmlembedded.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/4.8.0/mode/xml/xml.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/4.8.0/mode/javascript/javascript.min.js"></script>
    


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
    {{ Html::script('js/controllers/custom.js'); }}
    <!-- Lazy loading -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.2.2/textAngular-sanitize.min.js'></script>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.2.2/textAngular.min.js'></script>
    <script type="text/javascript" src="js/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/js/moment.min.js"></script>
    <script type="text/javascript" src="js/js/daterangepicker.js"></script>
    <script type="text/javascript" src="js/js/ng-bs-daterangepicker.js"></script>
    <script type="text/javascript" src="js/js/datetimepicker.js"></script>
    {{ Html::script('js/ivh-treeview.js'); }}

    <!-- angular-filemanager -->
    <script src="bower_components/angular-filemanager/dist/angular-filemanager.min.js"></script>
    <script src="bower_components/angular-filemanager/dist/cached-templates.js"></script>
</body>
</html>