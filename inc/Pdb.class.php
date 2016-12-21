<?php


/**
 *  0 - razmer
 *  0 - jaka - collar
 *  0 - kroika - style
 *  0 - cviat
 *  0 - tip
 */

/*
        CHEST               NECK
        INCHES  CM          INCHES  CM
XXXS    30-32   76-81       14      36
XXS     32-34   81-86       14.5    37.5
XS      34-36   86-91       15      38.5
S       36-38   91-96       15.5    39.5
M       38-40   96-101      16      41.5
L       40-42   101-106     17      43.5
XL      42-44   106-111     17.5    45.5
XXL     44-46   111-116     18.5    47.5
XXXL    46-48   116-121     19.5    49.5





*/

class Pdb {

    private $_skuLen = 9;

    private $_types = [
                    1 => 'Shirt',
                    2 => 'Belt',
                ];


    private $_params = [
                1 => [
                        [
                            'name'  =>  'Color',
                            'position' => 1,
                            'values' => [
                                    1 => 'White',
                                    2 => 'Blue',
                                ],
                        ],

                        [
                            'name'  =>  'Fabric',
                            'position' => 2,
                            'values' => [
                                    1 => 'Cotton',
                                    2 => 'Wool',
                                ],
                        ],

                        [
                            'name'  =>  'Placket',
                            'position' => 4,
                            'values' => [
                                    1 => 'Traditional',
                                    2 => '3/4',
                                    3 => 'French',
                                    4 => 'Fly',
                                ],
                        ],

                        [
                            'name'  =>  'Collar',
                            'position' => 5,
                            'values' => [
                                    1 => 'Spread',
                                    2 => 'Forward',
                                    3 => 'Tab',
                                    4 => 'Cutaway',
                                    5 => 'Button',
                                    6 => 'Club',
                                ],
                        ],

                        [
                            'name'  =>  'Fit',
                            'position' => 6,
                            'values' => [
                                    1 => 'Classic',
                                    2 => 'Slim',
                                    3 => 'Contemporary',
                                    4 => 'Skinny',
                                    5 => 'Button',
                                    6 => 'Club',
                                ],
                        ],

                        [
                            'name'  =>  'Chest size',
                            'position' => 7,
                            'values' => [
                                1 => ['name'    =>  'XXXS', 'inches'    =>  '30-32',    'cm'    =>  '76-81'],
                                2 => ['name'    =>  'XXS',  'inches'    =>  '32-34',    'cm'    =>  '81-86'],
                                3 => ['name'    =>  'XS',   'inches'    =>  '34-36',    'cm'    =>  '86-91'],
                                4 => ['name'    =>  'S',    'inches'    =>  '36-38',    'cm'    =>  '91-96'],
                                5 => ['name'    =>  'M',    'inches'    =>  '38-40',    'cm'    =>  '96-101'],
                                6 => ['name'    =>  'L',    'inches'    =>  '40-42',    'cm'    =>  '101-106'],
                                7 => ['name'    =>  'XL',   'inches'    =>  '42-44',    'cm'    =>  '106-111'],
                                8 => ['name'    =>  'XXL',  'inches'    =>  '44-46',    'cm'    =>  '111-116'],
                                9 => ['name'    =>  'XXXL', 'inches'    =>  '46-48',    'cm'    =>  '116-121'],
                            ],
                        ],

                        [
                            'name'  =>  'Neck size',
                            'position' => 8,
                            'values' => [
                                    1 => ['name'    =>  'XXXS', 'inches'    =>  '14',       'cm'    =>  '36'],
                                    2 => ['name'    =>  'XXS',  'inches'    =>  '14.5',     'cm'    =>  '37.5'],
                                    3 => ['name'    =>  'XS',   'inches'    =>  '15',       'cm'    =>  '38.5'],
                                    4 => ['name'    =>  'S',    'inches'    =>  '15.5',     'cm'    =>  '39.5'],
                                    5 => ['name'    =>  'M',    'inches'    =>  '16',       'cm'    =>  '41.5'],
                                    6 => ['name'    =>  'L',    'inches'    =>  '17',       'cm'    =>  '43.5'],
                                    7 => ['name'    =>  'XL',   'inches'    =>  '17.5',     'cm'    =>  '45.5'],
                                    8 => ['name'    =>  'XXL',  'inches'    =>  '18.5',     'cm'    =>  '47.5'],
                                    9 => ['name'    =>  'XXXL', 'inches'    =>  '19.5',     'cm'    =>  '49.5'],
                                ],
                        ],


                ],

                2 => [
                        [
                            'name'  =>  'Color',
                            'position' => 1,
                            'values' => [
                                    1 => 'White',
                                    2 => 'Blue',
                                    8 => 'Brown',
                                    9 => 'Black',
                                ],
                        ],

                        [
                            'name'  =>  'Length',
                            'position' => 2,
                            'values' => [
                                    1 => '80',
                                    2 => '90',
                                    3 => '100',
                                    4 => '110',
                                    5 => '120',
                                    6 => '130',
                                ],
                        ],

                ],

            ];


    public function __construct()
    {
        //echo '<pre>'; print_r($this->generateProduct(1)); die;
    }


    public function isSku($sku)
    {
        return (strlen($sku) == $this->_skuLen && strlen(preg_replace('/\D/','',$sku)) == $this->_skuLen);
    }


    public function generateProduct($type = 1, $sku = false)
    {
        if(!$sku)
        {
            $sku = str_pad('', $this->_skuLen, '0');
            $sku[0] = $type;

            foreach($this->_params[$type] as $p)
                $sku[$p['position']] = array_rand($p['values']);
        }

        $p = $this->resolveProduct($sku);

        $images  = glob('img/product*.png');
        foreach($images as $k => $v)
            $images[$k] = basename($v);
        shuffle($images);
        $p->images = array_slice($images, 0, 5);

        $p->price = number_format(mt_rand(1000,10000)/100, 2);
        $p->votes = mt_rand(10,100);
        $p->rating = mt_rand(100000,500000)/100000;
        $p->availability = mt_rand(0,100)%3 ? 'InStock' : 'OutOfStock';

        return $p;
    }




    public function resolveProduct($sku)
    {
        if(!$this->isSku($sku))
            throw new Exception("Invalid SKU {$sku}", 1);

        $p = (object)[
                    'sku'           => $sku,
                    'rating'        => 2.5,
                    'votes'         => 0,
                    'name'          => 'Product title',
                    'short'         => 'Product short description',
                    'description'   => 'Product long description',
                    'images'        => ['product1.png','product2.png','product3.png','product4.png','product5.png',],
                    'price'         => 0,
                    'currency'      => 'BGN',
                    'availability'  => 'InStock',
                    'parameters'    => (object)[],
                ];

        $type = $sku[0];

        foreach($this->_params[$type] as $param)
        {
            $v = empty($sku[$param['position']]) ? false : $sku[$param['position']];
            if($v)
                $p->parameters->$param['name'] = is_array($param['values'][$v]) ? $param['values'][$v]['name'] : $param['values'][$v];
        }

        if(1 == $type)
        {
            $p->name = $p->parameters->Color . ' ' .$p->parameters->Fabric . ' ' . $this->_types[$type];
        }

        return $p;
    }


}

$PDB = new Pdb;
