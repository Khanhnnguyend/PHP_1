<?php

class Categories extends DB_Config
{
    public $tableName = "category";

    public $columns = [
        'id',
        'cat_name',
        'description',
    ];
}
