<?php

class fk_Tags extends DB_Config
{
    public $tableName = "product_fk_tag";

    public $columns = [
        'id',
        'id_product',
        'id_tag',
    ];

    public static function get_all_id_tag($connection, $id_product){
        $model = new static();
        $sql = "select * from product_fk_tag where id_product = $id_product";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS,get_class($model));
        return $result;
    }

    public static function delete_fk_tag($connection, $id_product, $id_tag){
        $model = new static();
        $sql = "delete from product_fk_tag where id_product = $id_product AND id_tag= $id_tag ";
        $stmt = $connection->prepare($sql);
            $stmt->execute();
        
    }
}

