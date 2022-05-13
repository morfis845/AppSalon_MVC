<?php 
namespace Model;


class User extends ActiveRecord{
    protected static $table = 'users';
    protected static $columnsDB = ['id','name','lastName','email','password','phone','admin','confirmed','token'];

    public $id;
    public $name;
    public $lastName;
    public $email;
    public $password;
    public $phone;
    public $admin;
    public $confirmed;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->lastName = $args['lastName'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->confirmed = $args['confirmed'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    public function validateNewAccount(){
        if(!$this->name){
            self::$alerts['error']['name'] = "El nombre es obligatorio";
        }
        if(!$this->lastName){
            self::$alerts['error']['lastName'] = "El apellido es obligatorio";
        }
        if(!$this->email){
            self::$alerts['error']['email'] = "El email es obligatorio";
        }
        if(!$this->password){
            self::$alerts['error']['password'] = "La contraseña es obligatoria";
        }
        elseif(strlen($this->password) < 6){
            self::$alerts['error']['passwordLenght'] = "La contraseña debe contener al menos 6 caracteres";
        }
        return self::$alerts;
    }
    public function userExist(){
        $query = "SELECT * FROM " . self::$table ." WHERE email = '". $this->email . "' LIMIT 1";
        $result = self::$db->query($query);
        if($result->num_rows){
            self::$alerts['error']['exist'] = "El usuario ya está registrado";
        }
        return $result;
    }
    public function hashPassword(){
        $this->password  = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function createToken(){
        $this->token = uniqid();
    }
    public function loginValidate(){
        if(!$this->email){
            self::$alerts['error']['email'] = 'El email es Obligatorio';
        }
        if(!$this->password){
            self::$alerts['error']['password'] = 'La contraseña es Obligatoria';
        }
        return self::$alerts;
    }
    public function emailValidate(){
        if(!$this->email){
            self::$alerts['error']['error'] = 'El email es Obligatorio';
        }
        return self::$alerts;
    }
    public function passwordValidate(){
        if(!$this->password){
            self::$alerts['error']['error'] = "La contraseña es obligatoria";
        }
        elseif(strlen($this->password) < 6){
            self::$alerts['error']['error'] = "La contraseña debe contener al menos 6 caracteres";
        }
        return self::$alerts;
    }
    public function checkPasswordAndConfirmed($password){
        $result = password_verify($password, $this->password);
        if(!$result){
            self::$alerts['error']['error'] = 'Email o Contraseña Incorrecta';
        }
        elseif(!$this->confirmed){
            self::$alerts['error']['error'] = 'Email o Contraseña Incorrecta';
        }
        else{
            return true;
        }
    }
    

}