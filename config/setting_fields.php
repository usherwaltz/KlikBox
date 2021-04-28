<?php

return [
    'app' => [
        'title' => 'General',
        'desc' => 'Sva Generalna podesavanja aplikacije',
        'icon' => 'fas fa-cogs',

        'elements' => [
            [
                'type' => 'select', // input fields type
                'data' => 'boolean', // data type, string, int, boolean
                'name' => 'show_categories', // unique name for field
                'label' => 'Prikazuj kategorije', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'w-auto px-2', // any class for input
                'value' => '1', // default value if you want
                'options'=>[
                    '1'=>'Prikazuj',
                    '0'=>'Sakrij'
                ]
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'boolean', // data type, string, int, boolean
                'name' => 'show_productbtn', // unique name for field
                'label' => 'Prikazuj dugme svi proizvodi', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'w-auto px-2', // any class for input
                'value' => '1', // default value if you want
                'options'=>[
                    '1'=>'Prikazuj',
                    '0'=>'Sakrij'
                ]
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'boolean', // data type, string, int, boolean
                'name' => 'show_upsell', // unique name for field
                'label' => 'Prikazuj upsell', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'w-auto px-2', // any class for input
                'value' => '1', // default value if you want
                'options'=>[
                    '1'=>'Prikazuj',
                    '0'=>'Sakrij'
                ]
            ]
        ]
    ],
//    'email' => [
//
//        'title' => 'Email',
//        'desc' => 'Email settings for app',
//        'icon' => 'glyphicon glyphicon-envelope',
//
//        'elements' => [
//            [
//                //'type' => 'email',
//                'type' => 'text', // input fields type
//                'data' => 'string', // data type, string, int, boolean
//                'name' => 'app_name', // unique name for field
//                'label' => 'App Name', // you know what label it is
//                'rules' => 'required|min:2|max:50', // validation rule of laravel
//                'class' => 'w-auto px-2', // any class for input
//                'value' => 'CoolApp' // default value if you want
//
//            ],
//
//        ]
//    ],
];