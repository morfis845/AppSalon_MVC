<?php 
namespace Model;

class Meeting extends ActiveRecord{
    protected static $table = 'meeting';
    protected static $columnsDB = ['id','date','hour','userId'];

    public $id;
    public $date;
    public $hour;
    public $userId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->date = $args['date'] ?? '';
        $this->hour = $args['hour'] ?? '';
        $this->userId = $args['userId'] ?? '';
    }
}