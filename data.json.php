<?php
require_once 'inc/common.php';

$get = [];

if(count($_GET))
{
    $tmp = array_keys($_GET);

    if('product' == $tmp[0])
        $get['product'] = false;
    elseif($PDB->isSku($tmp[0]))
        $get['product'] = $tmp[0];
}

$lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

$data = [
        //(object)['url' => 'test.html'],

        //(object)['url' => basename($_SERVER['HTTP_REFERER'])],

        (object)[
            'selector'  => '#main',
            'template'  => getTpl('home'),
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
            'html'      => print_r($get, true),
        ],
    ];



if(array_key_exists('product', $get))
{

    $sku = $get['product'];

    $product = $PDB->generateProduct(1, $sku);

    $data = updateData($data, 'title', (object)['selector' => 'title','text' => $product->name]);
    $data = updateData($data, 'url', (object)['url' => $product->sku]);

    // reviews
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
    $product->reviews = $reviews;

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

    // rating
    $product->rating = number_format(round($product->rating, 1),2);

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
    {
        $product = $PDB->generateProduct(1);
        $product->rating = number_format(round($product->rating, 1),2);
        $products[] = $product;
    }

    $data[] = (object)[
                'selector'  => '#main',
                'template'  => getTpl('products'),
                'data'      =>  $products,
            ];

}


ob_start('ob_gzhandler');
echo json_encode($data);
