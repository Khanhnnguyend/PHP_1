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
        'date',
        // 'tags',
        // 'cat'
    ];

    public function getLastID($connection){
        $obj = $connection->prepare("select id FROM $this->tableName ORDER BY id DESC LIMIT 1");
            $obj->execute();
            $obj1 = $obj->fetchAll(PDO::FETCH_CLASS, get_class($this));
           return $obj1[0]->id;
    }
}
