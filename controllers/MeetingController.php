<?php

namespace Controllers;

use MVC\Router;

class MeetingController{
    public static function index(Router $router){
        //session_start();

        isAuth();

        $router->render('meeting/index',[
            'name' => $_SESSION['name'],
            'id' => $_SESSION['id']
        ]);
    }
}