<?php

function getTpl($tpl)
{
    ob_start();
    include 'tpl/'.$tpl.'.tpl.php';
    return ob_get_clean();
}

$data = [
        //(object)['url' => 'testing'],

        (object)[
            'selector'  => '#cont1',
            'template'  => getTpl('btn'),
            'data'      =>  [
                (object)['name' => 'Dusty', 'family' => 'Raven'],
                (object)['name' => 'Spas', 'family' => 'Petrov'],
                (object)['name' => 'Freddie', 'family' => 'Mercury'],
            ],
        ],
        (object)[
            'selector'  => '#cont2',
            'template'  => getTpl('product'),
            'data'      =>  [
                (object)['name' => 'Prod1 name ala bala portokala', 'description' => 'Prod1 short description', 'price' => 1.23, 'currency' => 'BGN', 'availability' => 'InStock'],
                (object)['name' => 'Prod2 name', 'description' => 'Prod2 short description', 'price' => 2.34, 'currency' => 'BGN', 'availability' => 'OutOfStock'],
                (object)['name' => 'Prod3 name', 'description' => 'Prod3 short description', 'price' => 3.45, 'currency' => 'BGN', 'availability' => 'InStock'],
                (object)['name' => 'Prod4 name', 'description' => 'Prod4 short description', 'price' => 4.56, 'currency' => 'BGN', 'availability' => 'OutOfStock'],
                (object)['name' => 'Prod5 name', 'description' => 'Prod5 short description', 'price' => 5.67, 'currency' => 'BGN', 'availability' => 'InStock'],
            ],
        ],
        (object)[
            'selector'  => 'h1',
            'html'      => 'TESTING',
        ],
        (object)[
            'selector'  => 'title',
            'text'      => 'TESTISI',
        ],
        (object)[
            'selector'  => 'nav',
            'html'      => getTpl('nav'),
        ],
    ];

ob_start('ob_gzhandler');
echo json_encode($data);
