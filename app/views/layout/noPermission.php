<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Whoops! There was an error.</title>

<style>.cf:before, .cf:after {content: " ";display: table;} .cf:after {clear: both;} .cf {*zoom: 1;}
body {
    font: 14px helvetica, arial, sans-serif;
    color: #2B2B2B;
    background-color: #D4D4D4;
    padding:0;
    margin: 0;
    max-height: 100%;
}
a {
    text-decoration: none;
}

.container{
    height: 100%;
    width: 100%;
    position: fixed;
    margin: 0;
    padding: 0;
    left: 0;
    top: 0;
}

.branding {
    position: absolute;
    top: 10px;
    right: 20px;
    color: #777777;
    font-size: 10px;
    z-index: 100;
}
.branding a {
    color: #CD3F3F;
}

header {
    padding: 30px 20px;
    color: white;
    background: #272727;
    box-sizing: border-box;
    border-left: 5px solid #CD3F3F;
}
.exc-title {
    margin: 0;
    color: #616161;
    text-shadow: 0 1px 2px rgba(0, 0, 0, .1);
}
.exc-title-primary { color: #CD3F3F; }
.exc-message {
    font-size: 32px;
    margin: 5px 0;
    word-wrap: break-word;
}

.stack-container {
    height: 100%;
    position: relative;
}

.details-container {
    height: 100%;
    overflow: auto;
    float: right;
    width: 70%;
    background: #DADADA;
}
.details {
    padding: 10px;
    padding-left: 5px;
    border-left: 5px solid rgba(0, 0, 0, .1);
}

.frames-container {
    height: 100%;
    overflow: auto;
    float: left;
    width: 30%;
    background: #FFF;
}
.frame {
    padding: 14px;
    background: #F3F3F3;
    border-right: 1px solid rgba(0, 0, 0, .2);
    cursor: pointer;
}
.frame.active {
    background-color: #4288CE;
    color: #F3F3F3;
    box-shadow: inset -2px 0 0 rgba(255, 255, 255, .1);
    text-shadow: 0 1px 0 rgba(0, 0, 0, .2);
}

.frame:not(.active):hover {
    background: #BEE9EA;
}

.frame-class, .frame-function, .frame-index {
    font-weight: bold;
}

.frame-index {
    font-size: 11px;
    color: #BDBDBD;
}

.frame-class {
    color: #4288CE;
}
.active .frame-class {
    color: #BEE9EA;
}

.frame-file {
    font-family: "Inconsolata", "Fira Mono", "Source Code Pro", Monaco, Consolas, "Lucida Console", monospace;
    word-wrap:break-word;
}

.frame-file .editor-link {
    color: #272727;
}

.frame-line {
    font-weight: bold;
    color: #4288CE;
}

.active .frame-line { color: #BEE9EA; }
.frame-line:before {
    content: ":";
}

.frame-code {
    padding: 10px;
    padding-left: 5px;
    background: #BDBDBD;
    display: none;
    border-left: 5px solid #4288CE;
}

.frame-code.active {
    display: block;
}

.frame-code .frame-file {
    background: #C6C6C6;
    color: #525252;
    text-shadow: 0 1px 0 #E7E7E7;
    padding: 10px 10px 5px 10px;

    border-top-right-radius: 6px;
    border-top-left-radius:  6px;

    border: 1px solid rgba(0, 0, 0, .1);
    border-bottom: none;
    box-shadow: inset 0 1px 0 #DADADA;
}

.code-block {
    padding: 10px;
    margin: 0;
    box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
}

.linenums {
    margin: 0;
    margin-left: 10px;
}

.frame-comments {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
    border: 1px solid rgba(0, 0, 0, .2);
    border-top: none;

    border-bottom-right-radius: 6px;
    border-bottom-left-radius:  6px;

    padding: 5px;
    font-size: 12px;
    background: #404040;
}

.frame-comments.empty {
    padding: 8px 15px;
}

.frame-comments.empty:before {
    content: "No comments for this stack frame.";
    font-style: italic;
    color: #828282;
}

.frame-comment {
    padding: 10px;
    color: #D2D2D2;
}
.frame-comment a {
    color: #BEE9EA;
    font-weight: bold;
    text-decoration: none;
}
.frame-comment a:hover {
    color: #4bb1b1;
}

.frame-comment:not(:last-child) {
    border-bottom: 1px dotted rgba(0, 0, 0, .3);
}

.frame-comment-context {
    font-size: 10px;
    font-weight: bold;
    color: #86D2B6;
}

.data-table-container label {
    font-size: 16px;
    font-weight: bold;
    color: #4288CE;
    margin: 10px 0;
    padding: 10px 0;

    display: block;
    margin-bottom: 5px;
    padding-bottom: 5px;
    border-bottom: 1px dotted rgba(0, 0, 0, .2);
}
.data-table {
    width: 100%;
    margin: 10px 0;
}

.data-table tbody {
    font: 13px "Inconsolata", "Fira Mono", "Source Code Pro", Monaco, Consolas, "Lucida Console", monospace;
}

.data-table thead {
    display: none;
}

.data-table tr {
    padding: 5px 0;
}

.data-table td:first-child {
    width: 20%;
    min-width: 130px;
    overflow: hidden;
    font-weight: bold;
    color: #463C54;
    padding-right: 5px;

}

.data-table td:last-child {
    width: 80%;
    -ms-word-break: break-all;
    word-break: break-all;
    word-break: break-word;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    hyphens: auto;
}

.data-table .empty {
    color: rgba(0, 0, 0, .3);
    font-style: italic;
}

.handler {
    padding: 10px;
    font: 14px "Inconsolata", "Fira Mono", "Source Code Pro", Monaco, Consolas, "Lucida Console", monospace;
}

.handler.active {
    color: #BBBBBB;
    background: #989898;
    font-weight: bold;
}

/* prettify code style
Uses the Doxy theme as a base */
pre .str, code .str { color: #BCD42A; }  /* string  */
pre .kwd, code .kwd { color: #4bb1b1;  font-weight: bold; }  /* keyword*/
pre .com, code .com { color: #888; font-weight: bold; } /* comment */
pre .typ, code .typ { color: #ef7c61; }  /* type  */
pre .lit, code .lit { color: #BCD42A; }  /* literal */
pre .pun, code .pun { color: #fff; font-weight: bold;  } /* punctuation  */
pre .pln, code .pln { color: #e9e4e5; }  /* plaintext  */
pre .tag, code .tag { color: #4bb1b1; }  /* html/xml tag  */
pre .htm, code .htm { color: #dda0dd; }  /* html tag */
pre .xsl, code .xsl { color: #d0a0d0; }  /* xslt tag */
pre .atn, code .atn { color: #ef7c61; font-weight: normal;} /* html/xml attribute name */
pre .atv, code .atv { color: #bcd42a; }  /* html/xml attribute value  */
pre .dec, code .dec { color: #606; }  /* decimal  */
pre.prettyprint, code.prettyprint {
    font-family: "Inconsolata", "Fira Mono", "Source Code Pro", Monaco, Consolas, "Lucida Console", monospace;
    background: #333;
    color: #e9e4e5;
}
pre.prettyprint {
    white-space: pre-wrap;
}

pre.prettyprint a, code.prettyprint a {
    text-decoration:none;
}

.linenums li {
    color: #A5A5A5;
}

.linenums li.current{
    background: rgba(255, 100, 100, .07);
    padding-top: 4px;
    padding-left: 1px;
}
.linenums li.current.active {
    background: rgba(255, 100, 100, .17);
}

#plain-exception {
    display: none;
}

#copy-button {
    display: none;
    float: right;
    cursor: pointer;
    border: 0;
}

.clipboard {
    width:            29px;
    height:           28px;
    background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAcCAYAAACdz7SqAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3gUUByMD0ZSoGQAAAB1pVFh0Q29tbWVudAAAAAAAQ3JlYXRlZCB3aXRoIEdJTVBkLmUHAAACAklEQVRIx72Wv0sbYRjHP29y1VoXxR9UskjpXTaHoBUcpGgKkS5OZ1Ec/QeKOIhalEghoOCqQsGhFAWbISKYyaFDS1BKKW0TCYrQSdElXSReh9bkksu9iZdLbnrvvee9z/N83+d9nldo2gvjzd5Hxp4246W6J5tJszsxwvxPIbXzwBQDLgABvM1P6JsAwzCkdopl5vqIuWev2K4QpH/4QjjQci/nPCVny3iaNzMcrVUsC1sChFMpwtTu8dTqx7J9dR3a2BngUb0j7Xr+jtjasBR8f+jpNqqqoqoqmqblxjOJq/8GTfhCK8TWhmmykdhRpEIIhBCWMcD51wQXN3KwY3nvYGYgQPbXOMHJKOlMA77QCvsbugXsOFLZ+5+jGULBtyQuFB4PzlrAVSWSGWaptpdbjAcniaZv6RhcIL6VByvVZqsQouBMdutJkrrVrr1/gdjqN4Ze/3DvyBwcnnF9I7N4gC8YYdqNSHP7uD5G/7pdJRrl/ecIva1t9IRcgpolLk6qQic8eB+6GOkdrDjSf/OiTD91CS4r+jXrMqWkrgvUtuDbeVNTKGzw6SRDto5QBc5Yehlg0WbTc8mwHCeld1u+yZSySySlspTHFmZUeIkrgBYvtvPcyBdXkqWKq5OLmbk/luqVYjPOd3lxLXf/J/P7mJ0oCL/fX1Yfs4RO5CxW8C97dLBw2Q3fUwAAAABJRU5ErkJggg==');
    background-repeat: no-repeat;
}

.help button {
    cursor: help;
    height:   28px;
    float: right;
    margin-left: 10px;
}

.help button:hover + #help-overlay {
    display: block;
}

#help-overlay {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(54, 54, 54, 0.5);
}

#help-overlay div {
    width: 200px;
    padding: 5px;
    color: #463c54;
    background-color: white;
    border-radius: 10px;
}

#help-clipboard {
    position: absolute;
    right: 30px;
    top: 90px;
}

#help-framestack {
    position: absolute;
    left: 200px;
    top: 50px;
}

#help-exc-message {
    position: absolute;
    left: 65%;
    top: 10px;
}

#help-code {
    position: absolute;
    right: 30px;
    top: 250px;
}

#help-request {
    position: absolute;
    right: 30px;
    top: 480px;
}

#help-appinfo {
    position: absolute;
    right: 30px;
    top: 550px;
}

/* inspired by githubs kbd styles */
kbd {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #fcfcfc;
    border-color: #ccc #ccc #bbb;
    border-image: none;
    border-radius: 3px;
    border-style: solid;
    border-width: 1px;
    box-shadow: 0 -1px 0 #bbb inset;
    color: #555;
    display: inline-block;
    font-size: 11px;
    line-height: 10px;
    padding: 3px 5px;
    vertical-align: middle;
}</style>
</head>
<body>

<div class="Whoops container">

<div class="stack-container">
<div class="frames-container cf ">
<div class="frame active" id="frame-line-0">
    <div class="frame-method-info">
        <span class="frame-index">23.</span>
        <span class="frame-class">InvalidArgumentException</span>
        <span class="frame-function"></span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">9511</span>
    </span>
</div>
<div class="frame " id="frame-line-1">
    <div class="frame-method-info">
        <span class="frame-index">22.</span>
        <span class="frame-class">Illuminate\View\FileViewFinder</span>
        <span class="frame-function">findInPaths</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">9484</span>
    </span>
</div>
<div class="frame " id="frame-line-2">
    <div class="frame-method-info">
        <span class="frame-index">21.</span>
        <span class="frame-class">Illuminate\View\FileViewFinder</span>
        <span class="frame-function">find</span>
    </div>

    <span class="frame-file">
      &hellip;\vendor\laravel\framework\src\Illuminate\View\Factory.php<!--
   --><span class="frame-line">124</span>
    </span>
</div>
<div class="frame " id="frame-line-3">
    <div class="frame-method-info">
        <span class="frame-index">20.</span>
        <span class="frame-class">Illuminate\View\Factory</span>
        <span class="frame-function">make</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">3267</span>
    </span>
</div>
<div class="frame " id="frame-line-4">
    <div class="frame-method-info">
        <span class="frame-index">19.</span>
        <span class="frame-class">Illuminate\Support\Facades\Facade</span>
        <span class="frame-function">__callStatic</span>
    </div>

    <span class="frame-file">
      &hellip;\app\controllers\LayoutController.php<!--
   --><span class="frame-line">8</span>
    </span>
</div>
<div class="frame " id="frame-line-5">
    <div class="frame-method-info">
        <span class="frame-index">18.</span>
        <span class="frame-class">Illuminate\Support\Facades\View</span>
        <span class="frame-function">make</span>
    </div>

    <span class="frame-file">
      &hellip;\app\controllers\LayoutController.php<!--
   --><span class="frame-line">8</span>
    </span>
</div>
<div class="frame " id="frame-line-6">
    <div class="frame-method-info">
        <span class="frame-index">17.</span>
        <span class="frame-class">LayoutController</span>
        <span class="frame-function">noPermission</span>
    </div>

    <span class="frame-file">
      <#unknown><!--
   --><span class="frame-line">0</span>
    </span>
</div>
<div class="frame " id="frame-line-7">
    <div class="frame-method-info">
        <span class="frame-index">16.</span>
        <span class="frame-class"></span>
        <span class="frame-function">call_user_func_array</span>
    </div>

    <span class="frame-file">
      &hellip;\vendor\laravel\framework\src\Illuminate\Routing\Controller.php<!--
   --><span class="frame-line">231</span>
    </span>
</div>
<div class="frame " id="frame-line-8">
    <div class="frame-method-info">
        <span class="frame-index">15.</span>
        <span class="frame-class">Illuminate\Routing\Controller</span>
        <span class="frame-function">callAction</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">5847</span>
    </span>
</div>
<div class="frame " id="frame-line-9">
    <div class="frame-method-info">
        <span class="frame-index">14.</span>
        <span class="frame-class">Illuminate\Routing\ControllerDispatcher</span>
        <span class="frame-function">call</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">5835</span>
    </span>
</div>
<div class="frame " id="frame-line-10">
    <div class="frame-method-info">
        <span class="frame-index">13.</span>
        <span class="frame-class">Illuminate\Routing\ControllerDispatcher</span>
        <span class="frame-function">dispatch</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">5040</span>
    </span>
</div>
<div class="frame " id="frame-line-11">
    <div class="frame-method-info">
        <span class="frame-index">12.</span>
        <span class="frame-class">Illuminate\Routing\Router</span>
        <span class="frame-function">Illuminate\Routing\{closure}</span>
    </div>

    <span class="frame-file">
      <#unknown><!--
   --><span class="frame-line">0</span>
    </span>
</div>
<div class="frame " id="frame-line-12">
    <div class="frame-method-info">
        <span class="frame-index">11.</span>
        <span class="frame-class"></span>
        <span class="frame-function">call_user_func_array</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">5398</span>
    </span>
</div>
<div class="frame " id="frame-line-13">
    <div class="frame-method-info">
        <span class="frame-index">10.</span>
        <span class="frame-class">Illuminate\Routing\Route</span>
        <span class="frame-function">run</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">5065</span>
    </span>
</div>
<div class="frame " id="frame-line-14">
    <div class="frame-method-info">
        <span class="frame-index">9.</span>
        <span class="frame-class">Illuminate\Routing\Router</span>
        <span class="frame-function">dispatchToRoute</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">5053</span>
    </span>
</div>
<div class="frame " id="frame-line-15">
    <div class="frame-method-info">
        <span class="frame-index">8.</span>
        <span class="frame-class">Illuminate\Routing\Router</span>
        <span class="frame-function">dispatch</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">715</span>
    </span>
</div>
<div class="frame " id="frame-line-16">
    <div class="frame-method-info">
        <span class="frame-index">7.</span>
        <span class="frame-class">Illuminate\Foundation\Application</span>
        <span class="frame-function">dispatch</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">696</span>
    </span>
</div>
<div class="frame " id="frame-line-17">
    <div class="frame-method-info">
        <span class="frame-index">6.</span>
        <span class="frame-class">Illuminate\Foundation\Application</span>
        <span class="frame-function">handle</span>
    </div>

    <span class="frame-file">
      &hellip;\vendor\barryvdh\laravel-debugbar\src\Middleware\Stack.php<!--
   --><span class="frame-line">34</span>
    </span>
</div>
<div class="frame " id="frame-line-18">
    <div class="frame-method-info">
        <span class="frame-index">5.</span>
        <span class="frame-class">Barryvdh\Debugbar\Middleware\Stack</span>
        <span class="frame-function">handle</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">7825</span>
    </span>
</div>
<div class="frame " id="frame-line-19">
    <div class="frame-method-info">
        <span class="frame-index">4.</span>
        <span class="frame-class">Illuminate\Session\Middleware</span>
        <span class="frame-function">handle</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">8432</span>
    </span>
</div>
<div class="frame " id="frame-line-20">
    <div class="frame-method-info">
        <span class="frame-index">3.</span>
        <span class="frame-class">Illuminate\Cookie\Queue</span>
        <span class="frame-function">handle</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">8379</span>
    </span>
</div>
<div class="frame " id="frame-line-21">
    <div class="frame-method-info">
        <span class="frame-index">2.</span>
        <span class="frame-class">Illuminate\Cookie\Guard</span>
        <span class="frame-function">handle</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">11045</span>
    </span>
</div>
<div class="frame " id="frame-line-22">
    <div class="frame-method-info">
        <span class="frame-index">1.</span>
        <span class="frame-class">Stack\StackedHttpKernel</span>
        <span class="frame-function">handle</span>
    </div>

    <span class="frame-file">
      &hellip;\bootstrap\compiled.php<!--
   --><span class="frame-line">657</span>
    </span>
</div>
<div class="frame " id="frame-line-23">
    <div class="frame-method-info">
        <span class="frame-index">0.</span>
        <span class="frame-class">Illuminate\Foundation\Application</span>
        <span class="frame-function">run</span>
    </div>

    <span class="frame-file">
      &hellip;\public\index.php<!--
   --><span class="frame-line">49</span>
    </span>
</div>
</div>
<div class="details-container cf">
<header>
    <div class="exception">
        <h3 class="exc-title">
            <span class="exc-title-primary">InvalidArgumentException</span>
        </h3>

        <div class="help">
            <button title="show help">HELP</button>

            <div id="help-overlay">
                <div id="help-framestack">Callstack information; navigate with mouse or keyboard using <kbd>Ctrl+&uparrow;</kbd> or <kbd>Ctrl+&downarrow;</kbd></div>
                <div id="help-clipboard">Copy-to-clipboard button</div>
                <div id="help-exc-message">Exception message and its type</div>
                <div id="help-code">Code snippet where the error was thrown</div>
                <div id="help-request">Server state information</div>
                <div id="help-appinfo">Application provided context information</div>
            </div>
        </div>

        <button id="copy-button" class="clipboard" data-clipboard-target="plain-exception" title="copy exception into clipboard"></button>
  <span id="plain-exception">InvalidArgumentException thrown with message &quot;View [layout.noPermission] not found.&quot;

Stacktrace:
#23 InvalidArgumentException in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:9511
#22 Illuminate\View\FileViewFinder:findInPaths in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:9484
#21 Illuminate\View\FileViewFinder:find in D:\wamp\www\esparkportal-new\vendor\laravel\framework\src\Illuminate\View\Factory.php:124
#20 Illuminate\View\Factory:make in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:3267
#19 Illuminate\Support\Facades\Facade:__callStatic in D:\wamp\www\esparkportal-new\app\controllers\LayoutController.php:8
#18 Illuminate\Support\Facades\View:make in D:\wamp\www\esparkportal-new\app\controllers\LayoutController.php:8
#17 LayoutController:noPermission in &lt;#unknown&gt;:0
#16 call_user_func_array in D:\wamp\www\esparkportal-new\vendor\laravel\framework\src\Illuminate\Routing\Controller.php:231
#15 Illuminate\Routing\Controller:callAction in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:5847
#14 Illuminate\Routing\ControllerDispatcher:call in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:5835
#13 Illuminate\Routing\ControllerDispatcher:dispatch in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:5040
#12 Illuminate\Routing\Router:Illuminate\Routing\{closure} in &lt;#unknown&gt;:0
#11 call_user_func_array in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:5398
#10 Illuminate\Routing\Route:run in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:5065
#9 Illuminate\Routing\Router:dispatchToRoute in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:5053
#8 Illuminate\Routing\Router:dispatch in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:715
#7 Illuminate\Foundation\Application:dispatch in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:696
#6 Illuminate\Foundation\Application:handle in D:\wamp\www\esparkportal-new\vendor\barryvdh\laravel-debugbar\src\Middleware\Stack.php:34
#5 Barryvdh\Debugbar\Middleware\Stack:handle in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:7825
#4 Illuminate\Session\Middleware:handle in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:8432
#3 Illuminate\Cookie\Queue:handle in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:8379
#2 Illuminate\Cookie\Guard:handle in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:11045
#1 Stack\StackedHttpKernel:handle in D:\wamp\www\esparkportal-new\bootstrap\compiled.php:657
#0 Illuminate\Foundation\Application:run in D:\wamp\www\esparkportal-new\public\index.php:49
</span>

        <p class="exc-message">
            View [layout.noPermission] not found.  </p>
    </div>
</header>
<div class="frame-code-container ">
<div class="frame-code active" id="frame-code-0">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=9511" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:9504">        foreach ((array) $paths as $path) {
            foreach ($this-&gt;getPossibleViewFiles($name) as $file) {
                if ($this-&gt;files-&gt;exists($viewPath = $path . &#039;/&#039; . $file)) {
                    return $viewPath;
                }
            }
        }
        throw new \InvalidArgumentException(&quot;View [{$name}] not found.&quot;);
    }
    protected function getPossibleViewFiles($name)</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-1">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=9484" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:9477">    {
        if (isset($this-&gt;views[$name])) {
            return $this-&gt;views[$name];
        }
        if ($this-&gt;hasHintInformation($name = trim($name))) {
            return $this-&gt;views[$name] = $this-&gt;findNamedPathView($name);
        }
        return $this-&gt;views[$name] = $this-&gt;findInPaths($name, $this-&gt;paths);
    }
    protected function findNamedPathView($name)</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-2">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cvendor%5Claravel%5Cframework%5Csrc%5CIlluminate%5CView%5CFactory.php&line=124" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\vendor\laravel\framework\src\Illuminate\View\Factory.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:117">	 * @param  array   $mergeData
	 * @return \Illuminate\View\View
	 */
	public function make($view, $data = array(), $mergeData = array())
	{
		if (isset($this-&gt;aliases[$view])) $view = $this-&gt;aliases[$view];

		$path = $this-&gt;finder-&gt;find($view);

		$data = array_merge($mergeData, $this-&gt;parseData($data));</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-3">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=3267" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:3260">    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();
        switch (count($args)) {
            case 0:
                return $instance-&gt;{$method}();
            case 1:
                return $instance-&gt;{$method}($args[0]);
            case 2:
                return $instance-&gt;{$method}($args[0], $args[1]);</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-4">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Capp%5Ccontrollers%5CLayoutController.php&line=8" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\app\controllers\LayoutController.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:1">&lt;?php

class LayoutController extends \BaseController
{

    public function noPermission()
    {
        return View::make(&#039;layout.noPermission&#039;);
    }

</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-5">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Capp%5Ccontrollers%5CLayoutController.php&line=8" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\app\controllers\LayoutController.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:1">&lt;?php

class LayoutController extends \BaseController
{

    public function noPermission()
    {
        return View::make(&#039;layout.noPermission&#039;);
    }

</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-6">
    <div class="frame-file">
        <strong>&lt;#unknown&gt;</strong>
    </div>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-7">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cvendor%5Claravel%5Cframework%5Csrc%5CIlluminate%5CRouting%5CController.php&line=231" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\vendor\laravel\framework\src\Illuminate\Routing\Controller.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:224">	 * @param  array   $parameters
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function callAction($method, $parameters)
	{
		$this-&gt;setupLayout();

		$response = call_user_func_array(array($this, $method), $parameters);

		// If no response is returned from the controller action and a layout is being</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-8">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=5847" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:5840">    {
        Controller::setFilterer($this-&gt;filterer);
        return $this-&gt;container-&gt;make($controller);
    }
    protected function call($instance, $route, $method)
    {
        $parameters = $route-&gt;parametersWithoutNulls();
        return $instance-&gt;callAction($method, $parameters);
    }
    protected function before($instance, $route, $request, $method)</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-9">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=5835" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:5828">    }
    public function dispatch(Route $route, Request $request, $controller, $method)
    {
        $instance = $this-&gt;makeController($controller);
        $this-&gt;assignAfter($instance, $route, $request, $method);
        $response = $this-&gt;before($instance, $route, $request, $method);
        if (is_null($response)) {
            $response = $this-&gt;call($instance, $route, $method);
        }
        return $response;</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-10">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=5040" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:5033">    protected function getClassClosure($controller)
    {
        $d = $this-&gt;getControllerDispatcher();
        return function () use($d, $controller) {
            $route = $this-&gt;current();
            $request = $this-&gt;getCurrentRequest();
            list($class, $method) = explode(&#039;@&#039;, $controller);
            return $d-&gt;dispatch($route, $request, $class, $method);
        };
    }</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-11">
    <div class="frame-file">
        <strong>&lt;#unknown&gt;</strong>
    </div>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-12">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=5398" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:5391">        }
    }
    public function run()
    {
        $parameters = array_filter($this-&gt;parameters(), function ($p) {
            return isset($p);
        });
        return call_user_func_array($this-&gt;action[&#039;uses&#039;], $parameters);
    }
    public function matches(Request $request, $includingMethod = true)</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-13">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=5065" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:5058">    }
    public function dispatchToRoute(Request $request)
    {
        $route = $this-&gt;findRoute($request);
        $this-&gt;events-&gt;fire(&#039;router.matched&#039;, array($route, $request));
        $response = $this-&gt;callRouteBefore($route, $request);
        if (is_null($response)) {
            $response = $route-&gt;run($request);
        }
        $response = $this-&gt;prepareResponse($request, $response);</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-14">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=5053" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:5046">        return isset($group[&#039;namespace&#039;]) ? $group[&#039;namespace&#039;] . &#039;\\&#039; . $uses : $uses;
    }
    public function dispatch(Request $request)
    {
        $this-&gt;currentRequest = $request;
        $response = $this-&gt;callFilter(&#039;before&#039;, $request);
        if (is_null($response)) {
            $response = $this-&gt;dispatchToRoute($request);
        }
        $response = $this-&gt;prepareResponse($request, $response);</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-15">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=715" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:708">            if (!is_null($response)) {
                return $this-&gt;prepareResponse($response, $request);
            }
        }
        if ($this-&gt;runningUnitTests() &amp;&amp; !$this[&#039;session&#039;]-&gt;isStarted()) {
            $this[&#039;session&#039;]-&gt;start();
        }
        return $this[&#039;router&#039;]-&gt;dispatch($this-&gt;prepareRequest($request));
    }
    public function terminate(SymfonyRequest $request, SymfonyResponse $response)</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-16">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=696" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:689">        });
    }
    public function handle(SymfonyRequest $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        try {
            $this-&gt;refreshRequest($request = Request::createFromBase($request));
            $this-&gt;boot();
            return $this-&gt;dispatch($request);
        } catch (\Exception $e) {
            if (!$catch || $this-&gt;runningUnitTests()) {</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-17">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cvendor%5Cbarryvdh%5Claravel-debugbar%5Csrc%5CMiddleware%5CStack.php&line=34" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\vendor\barryvdh\laravel-debugbar\src\Middleware\Stack.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:27">     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        /** @var \Barryvdh\Debugbar\LaravelDebugbar $debugbar */
        $debugbar = $this-&gt;app[&#039;debugbar&#039;];

        /** @var \Illuminate\Http\Response $response */
        $response = $this-&gt;kernel-&gt;handle($request, $type, $catch);

        return $debugbar-&gt;modifyResponse($request, $response);</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-18">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=7825" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:7818">    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $this-&gt;checkRequestForArraySessions($request);
        if ($this-&gt;sessionConfigured()) {
            $session = $this-&gt;startSession($request);
            $request-&gt;setSession($session);
        }
        $response = $this-&gt;app-&gt;handle($request, $type, $catch);
        if ($this-&gt;sessionConfigured()) {
            $this-&gt;closeSession($session);</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-19">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=8432" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:8425">    public function __construct(HttpKernelInterface $app, CookieJar $cookies)
    {
        $this-&gt;app = $app;
        $this-&gt;cookies = $cookies;
    }
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $response = $this-&gt;app-&gt;handle($request, $type, $catch);
        foreach ($this-&gt;cookies-&gt;getQueuedCookies() as $cookie) {
            $response-&gt;headers-&gt;setCookie($cookie);</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-20">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=8379" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:8372">    public function __construct(HttpKernelInterface $app, Encrypter $encrypter)
    {
        $this-&gt;app = $app;
        $this-&gt;encrypter = $encrypter;
    }
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        return $this-&gt;encrypt($this-&gt;app-&gt;handle($this-&gt;decrypt($request), $type, $catch));
    }
    protected function decrypt(Request $request)</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-21">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=11045" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:11038">    public function __construct(HttpKernelInterface $app, array $middlewares)
    {
        $this-&gt;app = $app;
        $this-&gt;middlewares = $middlewares;
    }
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        return $this-&gt;app-&gt;handle($request, $type, $catch);
    }
    public function terminate(Request $request, Response $response)</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-22">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cbootstrap%5Ccompiled.php&line=657" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\bootstrap\compiled.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:650">        if ($this-&gt;isBooted()) {
            $this-&gt;fireAppCallbacks(array($callback));
        }
    }
    public function run(SymfonyRequest $request = null)
    {
        $request = $request ?: $this[&#039;request&#039;];
        $response = with($stack = $this-&gt;getStackedClient())-&gt;handle($request);
        $response-&gt;send();
        $stack-&gt;terminate($request, $response);</pre>

    <div class="frame-comments empty">
    </div>

</div>
<div class="frame-code " id="frame-code-23">
    <div class="frame-file">
        Open:
        <a href="subl://open?url=file://D%3A%5Cwamp%5Cwww%5Cesparkportal-new%5Cpublic%5Cindex.php&line=49" class="editor-link">
            <strong>D:\wamp\www\esparkportal-new\public\index.php</strong>
        </a>
    </div>
                    <pre class="code-block prettyprint linenums:42">| Once we have the application, we can simply call the run method,
| which will execute the request and send the response back to
| the client&#039;s browser allowing them to enjoy the creative
| and wonderful application we have whipped up for them.
|
*/

$app-&gt;run();
 </pre>

    <div class="frame-comments empty">
    </div>

</div>
</div>
<div class="details">
<div class="data-table-container" id="data-tables">
    <div class="data-table" id="sg-serverrequest-data">
        <label>Server/Request Data</label>
        <table class="data-table">
            <thead>
            <tr>
                <td class="data-table-k">Key</td>
                <td class="data-table-v">Value</td>
            </tr>
            </thead>
            <tr>
                <td>REDIRECT_REDIRECT_STATUS</td>
                <td>200</td>
            </tr>
            <tr>
                <td>REDIRECT_STATUS</td>
                <td>200</td>
            </tr>
            <tr>
                <td>HTTP_HOST</td>
                <td>espark-portal-new.local</td>
            </tr>
            <tr>
                <td>HTTP_USER_AGENT</td>
                <td>Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0</td>
            </tr>
            <tr>
                <td>HTTP_ACCEPT</td>
                <td>text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8</td>
            </tr>
            <tr>
                <td>HTTP_ACCEPT_LANGUAGE</td>
                <td>en-US,en;q=0.5</td>
            </tr>
            <tr>
                <td>HTTP_ACCEPT_ENCODING</td>
                <td>gzip, deflate</td>
            </tr>
            <tr>
                <td>HTTP_COOKIE</td>
                <td>laravel_session=eyJpdiI6InNWVm41KzJyOXdXR1NmSDlNa0RIN3c9PSIsInZhbHVlIjoicHdiXC91dTU5cDVla2dLd1ZzZXlFSXV1VWt3NU45dXEwU0c1SlRoK3pqSFRTOHJiQk1jU2ZwR0xYTFZIMm9KMUhWZVJSbHp0NlZnNVZEQzJNY1JtWUxBPT0iLCJtYWMiOiI0NWVmYWY2Y2QxOTIwOTQwYjk1OWE2NzkwYzY2MzI3MThhYzkxYjg5ODYxNTVlYTM3Yzg1MjhmODEwNWRjNTQ1In0%3D</td>
            </tr>
            <tr>
                <td>HTTP_CONNECTION</td>
                <td>keep-alive</td>
            </tr>
            <tr>
                <td>HTTP_CACHE_CONTROL</td>
                <td>max-age=0</td>
            </tr>
            <tr>
                <td>PATH</td>
                <td>E:\app\ruchir.kakkad\product\11.2.0\dbhome_2\bin;E:\app\ruchir.kakkad\product\11.2.0\dbhome_1\bin;C:\Program Files\Common Files\Microsoft Shared\Windows Live;C:\Program Files (x86)\Common Files\Microsoft Shared\Windows Live;C:\ProgramData\Oracle\Java\javapath;C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;C:\Program Files (x86)\Intel\OpenCL SDK\2.0\bin\x86;C:\Program Files (x86)\Intel\OpenCL SDK\2.0\bin\x64;C:\wamp\bin\php\php5.4.12;C:\Program Files (x86)\Git\cmd;C:\wamp\bin\php\php5.5.12;C:\Program Files (x86)\nodejs\;C:\HashiCorp\Vagrant\bin;C:\Program Files\TortoiseSVN\bin;C:\Windows\SysWOW64\instantclient_12_1;C:\wamp\bin\php\php5.4.16\ext;C:/wamp/bin/apache/Apache2.4.4/bin;C:\Program Files\nodejs\;C:\Users\ruchir.kakkad.ESPARKINFO\AppData\Roaming\npm\node_modules\express-generator\bin\express.cmd;D:\wamp\bin\php\php5.4.12;D:\wamp\bin\php\php5.5.12;C:\ProgramData\ComposerSetup\bin;C:\Users\ruchir\AppData\Roaming\Composer\vendor\bin;C:\Users\ruchir\AppData\Roaming\npm;C:\Program Files (x86)\Skype\Phone\;</td>
            </tr>
            <tr>
                <td>SystemRoot</td>
                <td>C:\Windows</td>
            </tr>
            <tr>
                <td>COMSPEC</td>
                <td>C:\Windows\system32\cmd.exe</td>
            </tr>
            <tr>
                <td>PATHEXT</td>
                <td>.COM;.EXE;.BAT;.CMD;.VBS;.VBE;.JS;.JSE;.WSF;.WSH;.MSC</td>
            </tr>
            <tr>
                <td>WINDIR</td>
                <td>C:\Windows</td>
            </tr>
            <tr>
                <td>SERVER_SIGNATURE</td>
                <td>&lt;address&gt;Apache/2.4.9 (Win64) OpenSSL/1.0.1g PHP/5.5.12 Server at espark-portal-new.local Port 80&lt;/address&gt;
                </td>
            </tr>
            <tr>
                <td>SERVER_SOFTWARE</td>
                <td>Apache/2.4.9 (Win64) OpenSSL/1.0.1g PHP/5.5.12</td>
            </tr>
            <tr>
                <td>SERVER_NAME</td>
                <td>espark-portal-new.local</td>
            </tr>
            <tr>
                <td>SERVER_ADDR</td>
                <td>127.0.0.1</td>
            </tr>
            <tr>
                <td>SERVER_PORT</td>
                <td>80</td>
            </tr>
            <tr>
                <td>REMOTE_ADDR</td>
                <td>127.0.0.1</td>
            </tr>
            <tr>
                <td>DOCUMENT_ROOT</td>
                <td>D:/wamp/www/esparkportal-new</td>
            </tr>
            <tr>
                <td>REQUEST_SCHEME</td>
                <td>http</td>
            </tr>
            <tr>
                <td>CONTEXT_PREFIX</td>
                <td></td>
            </tr>
            <tr>
                <td>CONTEXT_DOCUMENT_ROOT</td>
                <td>D:/wamp/www/esparkportal-new</td>
            </tr>
            <tr>
                <td>SERVER_ADMIN</td>
                <td>webmaster@dummy-host2.example.com</td>
            </tr>
            <tr>
                <td>SCRIPT_FILENAME</td>
                <td>D:/wamp/www/esparkportal-new/public/index.php</td>
            </tr>
            <tr>
                <td>REMOTE_PORT</td>
                <td>51110</td>
            </tr>
            <tr>
                <td>REDIRECT_URL</td>
                <td>/public/noPermission</td>
            </tr>
            <tr>
                <td>GATEWAY_INTERFACE</td>
                <td>CGI/1.1</td>
            </tr>
            <tr>
                <td>SERVER_PROTOCOL</td>
                <td>HTTP/1.1</td>
            </tr>
            <tr>
                <td>REQUEST_METHOD</td>
                <td>GET</td>
            </tr>
            <tr>
                <td>QUERY_STRING</td>
                <td></td>
            </tr>
            <tr>
                <td>REQUEST_URI</td>
                <td>/noPermission</td>
            </tr>
            <tr>
                <td>SCRIPT_NAME</td>
                <td>/public/index.php</td>
            </tr>
            <tr>
                <td>PHP_SELF</td>
                <td>/public/index.php</td>
            </tr>
            <tr>
                <td>REQUEST_TIME_FLOAT</td>
                <td>1433493797.014</td>
            </tr>
            <tr>
                <td>REQUEST_TIME</td>
                <td>1433493797</td>
            </tr>
        </table>
    </div>
    <div class="data-table" id="sg-get-data">
        <label>GET Data</label>
        <span class="empty">empty</span>
    </div>
    <div class="data-table" id="sg-post-data">
        <label>POST Data</label>
        <span class="empty">empty</span>
    </div>
    <div class="data-table" id="sg-files">
        <label>Files</label>
        <span class="empty">empty</span>
    </div>
    <div class="data-table" id="sg-cookies">
        <label>Cookies</label>
        <table class="data-table">
            <thead>
            <tr>
                <td class="data-table-k">Key</td>
                <td class="data-table-v">Value</td>
            </tr>
            </thead>
            <tr>
                <td>laravel_session</td>
                <td>eyJpdiI6InNWVm41KzJyOXdXR1NmSDlNa0RIN3c9PSIsInZhbHVlIjoicHdiXC91dTU5cDVla2dLd1ZzZXlFSXV1VWt3NU45dXEwU0c1SlRoK3pqSFRTOHJiQk1jU2ZwR0xYTFZIMm9KMUhWZVJSbHp0NlZnNVZEQzJNY1JtWUxBPT0iLCJtYWMiOiI0NWVmYWY2Y2QxOTIwOTQwYjk1OWE2NzkwYzY2MzI3MThhYzkxYjg5ODYxNTVlYTM3Yzg1MjhmODEwNWRjNTQ1In0=</td>
            </tr>
        </table>
    </div>
    <div class="data-table" id="sg-session">
        <label>Session</label>
        <span class="empty">empty</span>
    </div>
    <div class="data-table" id="sg-environment-variables">
        <label>Environment Variables</label>
        <span class="empty">empty</span>
    </div>
</div>

<div class="data-table-container" id="handlers">
    <label>Registered Handlers</label>
    <div class="handler active">
        0. Whoops\Handler\PrettyPageHandler      </div>
</div>

</div>
</div>
</div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/zeroclipboard/1.3.5/ZeroClipboard.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.js"></script>

</body>
</html>
