<?php
error_reporting(E_ALL);

spl_autoload_register(function($class){
        $file = '/var/www/lib/'.str_replace('_', '/', $class).'.class.php';
        if(file_exists($file)) require $file;
});

dUtils::common_init();
dError::init(true);

require_once __DIR__.DIRECTORY_SEPARATOR.'Pdb.class.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'dispatcher.php';


define('BASE','https://dusty.work/tmp/');

function getTpl($tpl)
{
    ob_start();
    include 'tpl/'.$tpl.'.tpl.php';
    return ob_get_clean();
}

function updateData($data, $selector, $update = false)
{
    $k = false;
    foreach ($data as $key => $value)
        if(!empty($value->selector) && $value->selector == $selector)
        {
            $k = $key;
            break;
        }
    if($k)
    {
        if(!$update)
            unset($data[$k]);
        else
            $data[$k] = $update;
    }
    elseif ($update)
    {
        $data[] = $update;
    }
    return $data;
}


