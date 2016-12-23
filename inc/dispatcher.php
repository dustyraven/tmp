<?php

if(!empty($_POST['_sess']))
    $_sess = base64_decode($_POST['_sess']);

$get = [];

if(!count($_GET))
    return $get;



$tmp = array_keys($_GET);

if('product' == $tmp[0])
    $get['product'] = false;

elseif($PDB->isSku($tmp[0]))
    $get['product'] = (string)$tmp[0];

elseif('list' == $tmp[0])
    $get['list'] = '---------';

elseif($PDB->isFilter($tmp[0]))
    $get['list'] = (string)$tmp[0];

return $get;
