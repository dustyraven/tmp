<?php
error_reporting(E_ALL);

require_once __DIR__.DIRECTORY_SEPARATOR.'Pdb.class.php';


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


