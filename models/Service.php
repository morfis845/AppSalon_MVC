<?php
namespace Model;

class Service extends ActiveRecord{
    protected static $table = 'services';
    protected static $columnsDB = ['id', 'name', 'price'];

    public $id;
    public $name;
    public $price;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->price = $args['price'] ?? '';
    }
    public function validate(){
        if(!$this->name){
            self::$alerts['error']['name'] = 'El Nombre del Servicion es Obligatorio';
        }
        if(!$this->price){
            self::$alerts['error']['error'] = 'El Precio del Servicio es Obligatorio';
        }
        else if(!is_numeric($this->price)){
            self::$alerts['error']['error'] = 'El Precio no es valido';
        }
        return self::$alerts;
    }
}