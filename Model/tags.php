<?php

class Tags extends DB_Config
{
    public $tableName = "tags";

    public $columns = [
        'id',
        'tag_name',
        'description',
    ];
}
