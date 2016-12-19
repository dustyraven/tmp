<?php

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

$lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

$data = [
        (object)['url' => 'test.html'],

        //(object)['url' => basename($_SERVER['HTTP_REFERER'])],

        (object)[
            'selector'  => '#main',
            'template'  => getTpl('btn'),
            'data'      =>  [
                (object)['name' => 'Dusty', 'family' => 'Raven'],
                (object)['name' => 'Spas', 'family' => 'Petrov'],
                (object)['name' => 'Freddie', 'family' => 'Mercury'],
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
        (object)[
            'selector'  => '#left',
            'html'      => getTpl('left'),
        ],
        (object)[
            'selector'  => '#get',
            'html'      => print_r($_GET, true),
        ],
    ];



if(array_key_exists('product', $_GET))
{
    $data = updateData($data, 'title', (object)['selector' => 'title','text' => 'Product']);
    $data = updateData($data, 'url', (object)['url' => 'product']);

    $data[] = (object)[
                'selector'  => '#main',
                'template'  => getTpl('product'),
                'data'      =>  [(object)[
                                    'name' => 'Prod1 name ala bala portokala',
                                    'description' => 'Prod1 long description: '.$lorem,
                                    'price'     => 64.23,
                                    'currency'  => 'BGN',
                                    'availability' => 'InStock',
                                    'images'    => [
                                                    (object)['index' => 0, 'src' => 'product.jpg', 'alt' => '', 'active' => 'active'],
                                                    (object)['index' => 0, 'src' => 'product.jpg', 'alt' => ''],
                                                    (object)['index' => 0, 'src' => 'product.jpg', 'alt' => ''],
                                                    (object)['index' => 0, 'src' => 'product.jpg', 'alt' => ''],
                                                    (object)['index' => 0, 'src' => 'product.jpg', 'alt' => ''],
                                            ],
                                    'rating'    => 4.2,
                                    'votes'     => 667,
                                    'reviews'   => [
                                        (object)[
                                                'name'          => 'review name',
                                                'author'        => 'some author',
                                                'date'          => '2016-12-03',
                                                'rating'        => 5,
                                                'description'   => 'some review text, lorem ala bala',
                                            ],
                                        (object)[
                                                'name'          => 'review name 2',
                                                'author'        => 'some author 2',
                                                'date'          => '2016-12-07',
                                                'rating'        => 3,
                                                'description'   => 'abe lorem ala bala, da e ipsum portokala',
                                            ],
                                    ],
                                ],
                ],
            ];
}
if(array_key_exists('list', $_GET))
{
    $data = updateData($data, 'title', (object)['selector' => 'title','text' => 'List']);
    $data = updateData($data, 'url', (object)['url' => 'list']);

    $data[] = (object)[
                'selector'  => '#main',
                'template'  => getTpl('products'),
                'data'      =>  [
                    (object)['name' => 'Prod1 name ala bala portokala', 'description' => 'Prod1 short description', 'price' => 1.23, 'currency' => 'BGN', 'availability' => 'InStock'],
                    (object)['name' => 'Prod2 name', 'description' => 'Prod2 short description', 'price' => 2.34, 'currency' => 'BGN', 'availability' => 'OutOfStock'],
                    (object)['name' => 'Prod3 name', 'description' => 'Prod3 short description', 'price' => 3.45, 'currency' => 'BGN', 'availability' => 'InStock'],
                    (object)['name' => 'Prod4 name', 'description' => 'Prod4 short description', 'price' => 4.56, 'currency' => 'BGN', 'availability' => 'OutOfStock'],
                    (object)['name' => 'Prod5 name', 'description' => 'Prod5 short description', 'price' => 5.67, 'currency' => 'BGN', 'availability' => 'InStock'],
                    (object)['name' => 'Prod1 name ala bala portokala', 'description' => 'Prod1 short description', 'price' => 1.23, 'currency' => 'BGN', 'availability' => 'InStock'],
                    (object)['name' => 'Prod2 name', 'description' => 'Prod2 short description', 'price' => 2.34, 'currency' => 'BGN', 'availability' => 'OutOfStock'],
                    (object)['name' => 'Prod3 name', 'description' => 'Prod3 short description', 'price' => 3.45, 'currency' => 'BGN', 'availability' => 'InStock'],
                    (object)['name' => 'Prod4 name', 'description' => 'Prod4 short description', 'price' => 4.56, 'currency' => 'BGN', 'availability' => 'OutOfStock'],
                    (object)['name' => 'Prod5 name', 'description' => 'Prod5 short description', 'price' => 5.67, 'currency' => 'BGN', 'availability' => 'InStock'],
                ],
            ];

}


ob_start('ob_gzhandler');
echo json_encode($data);
