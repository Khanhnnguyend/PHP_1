<?php

class Product extends DB_Config
{
    public $tableName = "product";

    public $columns = [
        'id',
        'product_name',
        'sku',
        'price',
        'image',
        'gallery',
        'categories',
        'tags',
        'date'
    ];
}
