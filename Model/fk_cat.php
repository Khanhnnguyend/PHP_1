<?php

class fk_Cat extends DB_Config
{
    public $tableName = "product_fk_cat";

    public $columns = [
        'id',
        'id_product',
        'id_cat',
    ];

    public static function get_all_id_cat($connection, $id_product){
        $model = new static();
        $sql = "select * from product_fk_cat where id_product = $id_product";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS,get_class($model));
        return $result;
    }

    public static function delete_fk_cat($connection, $id_product, $id_cat){
        $model = new static();
        $sql = "delete from product_fk_cat where id_product = $id_product AND id_cat= $id_cat ";
        $stmt = $connection->prepare($sql);
            $stmt->execute();
        
    }
}
