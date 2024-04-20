<?php
class DB_Config
{
    // public $connection;
    // public $severName = "localhost";
    // public $database = "db_khanh";
    // public function __construct()
    // {

    //     $this->connection = new PDO("mysql:host=$this->severName; dbname=$this->database;charset=utf8", 'root', '');
    // }
    // public static function connect()
    // {
    //     $connection = new PDO("mysql:host=$this->severName; dbname=$this->database;charset=utf8", 'root', '');
    // }

    public static function all($connection)
    {

        $model = new static();
        $sql = "select * from $model->tableName";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $result;
    }

    public static function allLimit($connection,$num, $page)
    {
        $model = new static();
        $page = (int)$num * ((int)$page - 1);

        $sql = "select * from $model->tableName order by date asc limit $num offset $page ";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $result;
    }

    public static function condition($connection,$sql)
    {
        $model = new static();
        $stmt = $model->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $result;
    }

    public function insert($connection)
    {

        $this->sql = "
        insert into $this->tableName (";
        foreach ($this->columns as $col) {
            if ($this->{$col} == null) {

                continue;
            }
            $this->sql .= "$col, ";
        }

        $this->sql = rtrim($this->sql, ", ");
        $this->sql .= ") values ( ";

        foreach ($this->columns as $col) {
            if ($this->{$col} == null) {
                continue;
            }
            $this->sql .= "'" . $this->{$col} . "', ";
        }

        $this->sql = rtrim($this->sql, ", ");
        $this->sql .= ")";

        $stmt = $connection->prepare($this->sql);
        try {

            $stmt->execute();
            
            return $this;
        } catch (Exception $ex) {

            var_dump($ex->getMessage());
            die;
        }
    }

    public function update($connection)
    {
        $this->sql = "update $this->tableName set ";
        foreach ($this->columns as $col) {
            if ($this->{$col} == null) {

                continue;
            }
            $this->sql .= "$col = '" . $this->{$col} . "', ";
        }

        $this->sql = rtrim($this->sql, ", ");
        $this->sql .= " where id = $this->id";

        $stmt = $connection->prepare($this->sql);
        try {

            $stmt->execute();
            $this->id = $connection->lastInsertId();
            return $this;
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
            die;
        }
    }


    public static function delete($connection, $id)
    {
        $model = new static();
        $model->sql = "delete from $model->tableName
        where id= $id";
        $stmt = $connection->prepare($model->sql);
        $stmt->execute();
    }

    public static function findName($connection, $f)
    {
        $model = new static();
        $model->sql = "select * from $model->tableName where 
        product_name LIKE '%$f%'";
        $stmt = $connection->prepare($model->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $result;
    }

    public static function findID($connection, $id)
    {
        $model = new static();
        $idNum = (int) $id;
        $model->sql = "select * from $model->tableName where 
        id = $idNum  ";
        $stmt = $connection->prepare($model->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        if (count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function filter($connection,$object,$page)
    {
        $page = ($page-1)*5;
        $obj = json_decode($object, false);
        $model = new static();
        $model->sql = '';
        $arrSql = [];

        if ($obj->search != null) {
            $arrSql[] = " product_name like '%$obj->search%' ";
        }
        if ($obj->category != null) {
            $arrSql[] =    " ";
        }
        if ($obj->tagFind != null) {
            $arrSql[] =    " ";
        }
        if ($obj->day_from != null && $obj->day_to != null) {
            $arrSql[] = "date between '$obj->day_from' and '$obj->day_to' ";
        }
        if ($obj->day_from != null && $obj->day_to == null) {
            $arrSql[] = " date >= '$obj->day_from' ";
        }
        if ($obj->day_to != null && $obj->day_from == null) {
            $arrSql[] = " date <= '$obj->day_to' ";
        }
        if ($obj->price_from != null && $obj->price_to != null) {
            $arrSql[] = " price between '$obj->price_from' and '$obj->price_to' ";
        }
        if ($obj->price_from != null && $obj->price_to == null) {
            $arrSql[] = " price > '$obj->price_from' ";
        }
        if ($obj->price_to != null && $obj->price_from == null) {
            $arrSql[] = " price < '$obj->price_to' ";
        }

        $model->sql = implode(" and ", $arrSql);

        if ($model->sql != '') {
            $model->sql = "select * from $model->tableName  where" . $model->sql;
        } else {
            $model->sql = "select * from $model->tableName  ";
        }

        $model->sql .= " order by  $obj->sortBy " . "$obj->sort limit 5 offset $page";



        $stmt = $connection->prepare($model->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        if (count($result) == 0) {
        }
        return $result;
    }
}
