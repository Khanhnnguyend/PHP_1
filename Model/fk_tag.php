<?php

class fk_Tags extends DB_Config
{
    public $tableName = "product_fk_tag";

    public $columns = [
        'id',
        'id_product',
        'id_tag',
    ];
}
