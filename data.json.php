<?php
//require 'inc/common.php';



$data = [
        (object)['url' => BASE],

        //(object)['url' => basename($_SERVER['HTTP_REFERER'])],
        (object)[
            'selector'  => '#layout',
            'template'  => getTpl('layout3c'),
            'data'      =>  [],
        ],

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
            'html'      => 'WellMan',
        ],
        (object)[
            'selector'  => 'title',
            'text'      => 'WellMan',
        ],
        (object)[
            'selector'  => 'nav',
            'template'  => getTpl('nav'),
            'data'      => [
                            'lang' => LANG,
                            'langs' => $langs,
                            'currency' => CURRENCY,
                            'currencies' => $currencies
                        ],
        ],
        (object)[
            'selector'  => '#left',
            'template'  => getTpl('left'),
            'data'      => [],
        ],
        (object)[
            'selector'  => '#dump',
            'html'      => print_r($_sess, true),
        ],
        (object)[
            'selector'  => '#topCardContent',
            'html'      => '0.00',
        ],
        (object)[
            'selector'  => '#langcurcss',
            'text'      => getTpl('langcurcss'),
        ],
        /*
        (object)[
            'modal'     => '#myModal',
            'template'  => getTpl('modal'),
            'data'      => (object)[
                            'title' => 'Some title',
                            'footer' => ' '
                           ],
        ],
        */

    ];


/**
 *  PRODUCT
 */
if(array_key_exists('product', $get))
{

    $sku = $get['product'];

    $product = $PDB->generateProduct(1, $sku);

    $data = updateData($data, 'title', (object)['selector' => 'title','text' => $product->name]);
    $data = updateData($data, 'url', (object)['url' => $product->sku]);
    $data = updateData($data, '#layout', (object)['selector' => '#layout','template' => getTpl('layout2c'),'data' => [] ]);

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
                    'description'   => $lorem,
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


/**
 *  LIST
 */
if(array_key_exists('list', $get))
{
    $filter = $get['list'];

    $data = updateData($data, 'title', (object)['selector' => 'title','text' => i18n::_('Products List') ]);
    $data = updateData($data, 'url', (object)['url' => $filter]);

    $filtered = $PDB->filterProducts(['filter' => $filter]);

    $tmp = (object)[
                'selector'  => '#main',
                'template'  => getTpl('products'),
                'data'      => $filtered->products,
            ];
    $data = updateData($data, '#main', $tmp);


    $possible = $PDB->possibleFilters($filter, $filtered->possible);



    $tmp = (object)[
                'selector'  => '#left',
                'template'  => getTpl('left'),
                'data'      => $possible,
            ];
    $data = updateData($data, '#left', $tmp);



    $bc = [];
    foreach($possible as $poss)
    {
        foreach($poss->values as $val)
        {
            if($val->checked)
            {
                $bc[] = (object)['name' => $poss->name, 'position' => $poss->position, 'value' => $val->name];
            }
        }
    }
    $tmp = (object)[
                'selector'  => '#breadcrumbs',
                'template'  => getTpl('bcfilter'),
                'data'      => $bc,
            ];
    $data = updateData($data, '#breadcrumbs', $tmp);

}


/**
 *  OUTPUT
 */
//ob_start('ob_gzhandler');
echo json_encode($data);

