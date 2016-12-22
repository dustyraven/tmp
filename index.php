<?php
require_once 'inc/common.php';


if(AJAX)
    require 'data.json.php';
else
    echo getTpl('main');

