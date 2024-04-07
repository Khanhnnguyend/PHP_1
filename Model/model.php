<?php 
    class DB_Config{
         public $connection;


        public function __construct(){
            $this->connection = new PDO("mysql:host=localhost; dbname=PHP_1;charset=utf8", 'root', '');

    }

    public static function all(){
        $model = new static();
        $sql = "select * from $model->tableName";
        $stmt = $model->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $result;
    }

    public static function allLimit($num,$page){
        $model = new static();
        
        
            $page = (int)$num* ((int)$page -1);
       
        $sql = "select * from $model->tableName limit $num offset $page";
        $stmt = $model->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $result;
    }

    public static function condition($sql){
       
        $stmt = $model->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $result;
    }

    public function insert(){ 
        
        $this->sql = "insert into $this->tableName (";
        foreach ($this->columns as $col) {
            if($this->{$col} ==null ){
                
                continue;
            }
            $this->sql .= "$col, ";
        }

        $this->sql = rtrim($this->sql, ", ");
        $this->sql .= ") values ( ";

        foreach ($this->columns as $col) {
            if($this->{$col} == null){
                continue;
            }
            $this->sql .= "'" . $this->{$col} ."', ";
        }

        $this->sql = rtrim($this->sql, ", ");
        $this->sql .=")";

        $stmt = $this->connection->prepare($this->sql);
        try{

            $stmt->execute();
           // $this->id = $this->connect->lastInsertId();
            return $this;
        }catch(Exception $ex){
            
            var_dump($ex->getMessage());die;
        }

    }   

    public function update(){
        $this->sql = "update $this->tableName set ";
        foreach ($this->columns as $col) {
            if($this->{$col} ==null ){
               
                continue;
            }
            $this->sql .= "$col = '".$this->{$col}."', ";
        }

        $this->sql = rtrim($this->sql, ", ");
        $this->sql .= " where id = $this->id";
     
        $stmt = $this->connection->prepare($this->sql);
        try{

            $stmt->execute();
           // $this->id = $this->connect->lastInsertId();
            return $this;
        }catch(Exception $ex){
            var_dump($ex->getMessage());die;
        }
    }


    public static function delete($id){
        $model = new static();
        $model->sql = "delete from $model->tableName
        where id= $id";
        $stmt = $model->connection->prepare($model->sql);
        $stmt->execute();
        
    }

    public static function findName($f){
        $model = new static();
        $model->sql = "select * from $model->tableName where 
        product_name LIKE '%$f%'";
        $stmt = $model->connection->prepare($model->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $result;
    }
    
    public static function findID($id){
        $model = new static();
        $idNum = (int) $id;
        $model->sql = "select * from $model->tableName where 
        id = $idNum  ";
        $stmt = $model->connection->prepare($model->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        if (count($result) > 0) {
            return $result[0];
        } else {
            return null;  
        }
    }

    public static function filter($object){
        $obj = json_decode($object,false);
        $model = new static();
        $model->sql = "select * from $model->tableName  ";
        if($obj->category != "" ||
            $obj->tagFind != ""||
            $obj->day_from != ""||
            $obj->day_to != ""||
            $obj->price_from != ""||
            $obj->price_to != ""
        ){
            $model->sql .= " where ";
        }

        if($obj->category != null){
            $model->sql .= " categories like '%$obj->category%' ". "and";
        }

        if($obj->tagFind != null){
            $model->sql .= " tags like '%$obj->tagFind%' ". "and";
        }

        if($obj->day_from != null && $obj->day_to != null){
            $model->sql .= " date between '$obj->day_from' and '$obj->day_to' ". "and";
        }

        if($obj->day_from != null && $obj->day_to == null){
            $model->sql .= " date > '$obj->day_from' ". "and";
        }

        if($obj->day_to != null && $obj->day_from == null){
            $model->sql .= " date < '$obj->day_to' ". "and";
        }

        if($obj->price_from != null && $obj->price_to != null){
            $model->sql .= " price between '$obj->price_from'
             and '$obj->price_to' ". "and";
        }

        if($obj->price_from != null && $obj->price_to == null){
            $model->sql .= " price > '$obj->price_from' ". "and";
        }

        if($obj->price_to != null && $obj->price_from != null){
            $model->sql .= " price < '$obj->price_to' ". "and";
        }
        
        
        $model->sql = substr($model->sql , 0, -strlen(strrchr($model->sql , ' ')));

        $model->sql .=" order by  $obj->sortBy " ."$obj->sort";
        

         $stmt = $model->connection->prepare($model->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        if (count($result) == 0) {
            echo"khong co";
        }
        return $result;
    }
}

?>