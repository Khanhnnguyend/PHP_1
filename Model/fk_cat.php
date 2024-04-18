<?php

class fk_Cat extends DB_Config
{
    public $tableName = "product_fk_cat";

    public $columns = [
        'id',
        'product_id',
        'id_cat',
    ];

    public function get_all_id_cat($connection, $id_product){
        $stmt = $connection->prepare('select * from product_fk_cat where product_id = '. $id_product);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_CLASS,get_class($this));
        return $result;
    }
}
