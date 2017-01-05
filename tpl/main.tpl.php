<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

    <title>WellMan</title>

    <base href="<?php echo BASE;?>">
    <style type="text/css" id="langcurcss"></style>
</head>
<body>


    <nav class="navbar navbar-light navbar-fixed-top bg-faded" style="background-color:#663399;"></nav>

    <div id="layout" class="container-fluid">
        <div style="text-align:center;"><?php echo i18n::_('Loading');?>...</div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <pre id="dump"></pre>
            </div>
        </div>
    </div>

    <div id="loader">
        <i class="fa fa-spinner fa-spin centered fa-5x" aria-hidden="true"></i>
    </div>

    <script type="text/javascript">

        'use strict';

        function loadRes(sources, callback, args) {

            var src = sources.shift(), el, container, r = false;
            if(src) {
                if(src.match(/\.js$/i)) {
                    container = 'body';
                    el = document.createElement('script');
                    el.type = 'text/javascript';

                    // TODO - remove this
                    if(-1 !== src.indexOf('test')) {
                        src += '?_' + new Date().getTime();
                    }

                    el.src = src;
                } else if(src.match(/\.css$/i)) {
                    container = 'head';
                    el = document.createElement('link');
                    el.rel = 'stylesheet';
                    el.href = src;
                } else {
                    console.error('Unsupported type of file ' + src);
                    return false;
                }

                el.onload = el.onreadystatechange = function() {
                    if (!r && (!this.readyState || this.readyState === 'complete')) {
                        r = true;
                        loadRes(sources, callback, args);
                    }
                };

                document.getElementsByTagName(container)[0].appendChild(el);
            }
            else if('function' == typeof callback) {
                callback.apply(args);
            }
        }

        loadRes([
                'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css',
                './css/font-awesome.min.css',
                './css/style.css',
                'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js',
                'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js',
                './js/mustache.min.js',
                './js/test.js'
            ]);

    </script>

</body>
</html>
