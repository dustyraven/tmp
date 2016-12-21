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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <title>ALA BALA</title>

    <base href="<?php echo BASE;?>">

    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>


    <nav class="navbar navbar-light navbar-fixed-top bg-faded"></nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3" id="left"></div>
            <div class="col-sm-9 row" id="content">
                <div class="col-xs-12" id="breadcrumbs"></div>
                <div class="col-xs-12" id="main">
                    Loading...
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12">
                <pre id="get"></pre>
            </div>
        </div>
    </div>

    <div id="loader">
        <i class="fa fa-spinner fa-spin centered fa-5x" aria-hidden="true"></i>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/mustache.min.js"></script>
    <script type="text/javascript" src="./js/test.js"></script>
</body>
</html>
