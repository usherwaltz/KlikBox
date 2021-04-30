<?php

use Itstructure\GridView\DataProviders\EloquentDataProvider;

/** @var EloquentDataProvider $dataProvider */
?>

@extends('layouts.app')

@section('content')

<div class="container">
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
    @endif

    <?= @grid_view([
        'dataProvider' => $dataProvider,
        'title' => 'Proizvodi',
        'useFilters' => false,
        'tableSmall' => false,
        'columnFields' => [
            [
                'label' => 'ID',
                'value' => function ($product) {
                    return $product->id;
                },
                'sort' => 'id'
            ],
            [
                'label' => 'Naziv Proizvoda',
                'value' => function ($product) {
                    return $product->name;
                },
                'sort' => 'id'
            ],
            [
                'label' => 'Slika', // Column label.
                'value' => function ($row) { // You can set 'value' as a callback function to get a row data value dynamically.
                    return $row->photo;
                },
                'filter' => false, // If false, then column will be without a search filter form field.
                'format' => [ // Set special formatter. If $row->icon value is a url to image, it will be inserted in to 'src' attribute of <img> tag.
                    'class' => Itstructure\GridView\Formatters\ImageFormatter::class, // REQUIRED. For this case it is necessary to set 'class'.
                    'htmlAttributes' => [ // Html attributes for <img> tag.
                        'width' => '100'
                    ]
                ]
            ],
            [
                'label' => 'Kreirano',
                'value' => function ($product) {
                    return date("d.m.Y H:i", strtotime($product->created_at));
                },
                'sort' => 'created_at'
            ],
            [
                'label' => '', // Optional
                'class' => \Itstructure\GridView\Columns\ActionColumn::class, // Required
                'actionTypes' => [ // Required
                    [
                        'class' => \Itstructure\GridView\Actions\Edit::class,
                        'url' => function ($product) {
                            return '/admin/products/' . $product->slug . '/edit';
                        },
                        'htmlAttributes' => [
                            'style' => 'color: white'
                        ]
                    ],
                    [
                        'class' => \Itstructure\GridView\Actions\Delete::class, // Required
                        'url' => function ($product) { // Optional
                            return 'products/delete?id=' . $product->id;
                        },
                        'htmlAttributes' => [ // Optional
                            'style' => 'color: white; font-size: 16px;'
                        ]
                    ]
                ]
            ],

        ],
    ]); ?>

    <a href="{{route('products.create')}}" class="btn btn-success mt-3">{{__('Dodaj proizvod')}}</a>
</div>
@endsection
