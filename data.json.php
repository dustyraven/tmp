<?php
require_once 'inc/common.php';

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

    $reviews = [
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
        ];


    $product = (object)[
                    'name' => 'Prod1 name ala bala portokala',
                    'description' => 'Prod1 long description: '.$lorem,
                    'price'     => 64.23,
                    'currency'  => 'BGN',
                    'availability' => 'InStock',
                    'images'    => [
                                    (object)['index' => 0, 'src' => 'product.jpg', 'alt' => '', 'active' => 'active'],
                                    (object)['index' => 1, 'src' => 'product.jpg', 'alt' => ''],
                                    (object)['index' => 2, 'src' => 'product.jpg', 'alt' => ''],
                                    (object)['index' => 3, 'src' => 'product.jpg', 'alt' => ''],
                                    (object)['index' => 4, 'src' => 'product.jpg', 'alt' => ''],
                            ],
                    'rating'    => 4.2,
                    'votes'     => 667,
                ];


    $product = $PDB->generateProduct(1);

    // images
    $images = [];
    foreach($product->images as $idx => $img)
        $images[$idx] = (object)['index' => $idx, 'src' => $img, 'alt' => '', 'active' => (0 == $idx ? 'active' : false)];
    $product->images = $images;

    // parameters
    $parameters = [];
    foreach($product->parameters as $key => $val)
        $parameters[] = (object)['key' => $key, 'val' => $val];
    $product->parameters = $parameters;

    // reviews
    $product->reviews = $reviews;

    $data[] = (object)[
                'selector'  => '#main',
                'template'  => getTpl('product'),
                'data'      => $product,
                ];
}

if(array_key_exists('list', $_GET))
{
    $data = updateData($data, 'title', (object)['selector' => 'title','text' => 'List']);
    $data = updateData($data, 'url', (object)['url' => 'list']);

    $products = [];
    for($i = 0; $i < 20; $i++)
        $products[] = $PDB->generateProduct(1);


    $data[] = (object)[
                'selector'  => '#main',
                'template'  => getTpl('products'),
                'data'      =>  $products,
            ];

}


ob_start('ob_gzhandler');
echo json_encode($data);
