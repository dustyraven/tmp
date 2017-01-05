<?php
error_reporting(E_ALL);


spl_autoload_register(function($class){
        $file = '/var/www/lib/'.str_replace('_', '/', $class).'.class.php';
        if(file_exists($file)) require $file;
});

dUtils::common_init();
dError::init(true);

/////////////////
//  SESS
/////////////////
$_sess = empty($_POST['_sess']) ? (object)[] : json_decode(base64_decode($_POST['_sess']));

$_lang = ($_sess && !empty($_sess->lang)) ? $_sess->lang : 'bg';
$_curr = ($_sess && !empty($_sess->currency)) ? $_sess->currency : 'bgn';

define('LANG', $_lang);
define('CURRENCY', $_curr);


$lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

$langs = [];

foreach (['bg','en','it','ru'] as $l)
    if(defined('LANG') && LANG == $l)
        continue;
    else
        $langs[] = $l;

$currencies = [];

foreach (['bgn','eur','usd'] as $c)
    if(defined('CURRENCY') && CURRENCY == $c)
        continue;
    else
        $currencies[] = $c;


//////////////////
//////////////////
$_ = i18n::init($_lang);
i18n::setMode('return');

require_once __DIR__.DIRECTORY_SEPARATOR.'Pdb.class.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'dispatcher.php';


define('BASE','https://dusty.work/wellman/');

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


