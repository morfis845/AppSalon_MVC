<?php

namespace Controllers;

use Model\User;
use MVC\Router;
use Classes\Email;

class LoginController
{
    public static function login(Router $router)
    {
        $alerts = [];
        $emailPlaceHolder = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);
            $emailPlaceHolder = $auth->email;

            $alerts = $auth->loginValidate();

            if (empty($alerts)) {
                $user = User::where('email', $auth->email);
                if ($user) {
                    if ($user->checkPasswordAndConfirmed($auth->password)) {
                        session_start();
                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name . " " . $user->lastName;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;

                        if ($user->admin === "1") {
                            $_SESSION['admin'] = $user->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /meeting');
                        }
                    }
                } else {
                    User::setAlert('error', 'Email o Contraseña Incorrecta');
                }
            }
        }
        $alerts = User::getAlerts();
        $router->render('auth/login', [
            'alerts' => $alerts,
            'emailPlaceHolder' => $emailPlaceHolder
        ]);
    }
    public static function logout()
    {
        //session_start();
        $_SESSION = [];
        header('Location: /');
    }
    public static function forget(Router $router)
    {
        $alerts = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);
            $alerts = $auth->emailValidate();
            if (empty($alerts)) {
                $user = User::where('email', $auth->email);
                if ($user && $user->confirmed === "1") {
                    $user->createToken();
                    $user->save();
                    $email = new Email($user->name, $user->email, $user->token);
                    $email->sendInstructions();
                    User::setAlert('success', 'Revisa tu email para cambiar la contraseña');
                } else {
                    User::setAlert('error', 'El usuario no existe o no está confirmado');
                }
            }
        }
        $alerts = User::getAlerts();
        $router->render('auth/forget', [
            'alerts' => $alerts
        ]);
    }
    public static function restore(Router $router)
    {
        $alerts = [];
        $error = false;
        $token = s($_GET['token']);
        $user = User::where('token', $token);
        if (empty($user)) {
            User::setAlert('error', 'Token no valido');
            $error = true;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password = new User($_POST);
            $alerts = $password->passwordValidate();
            if(empty($alerts)){
                $user->password = null;
                $user->password = $password->password;
                $user->hashPassword();
                $user->token = null;
                $result = $user->save();
                if($result){
                    header('Location: /');
                }
            }
        }
        $alerts = User::getAlerts();
        $router->render('auth/restore-password', [
            'alerts' => $alerts,
            'error' => $error
        ]);
    }
    public static function register(Router $router)
    {
        $user = new User;
        $alerts = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->syncUp($_POST);
            $alerts = $user->validateNewAccount();

            if (empty($alerts)) {
                $result = $user->userExist();
                if ($result->num_rows) {
                    $alerts = User::getAlerts();
                } else {
                    $user->hashPassword();

                    //TOKEN
                    $user->createToken();

                    //Send Email
                    $email = new Email($user->name, $user->email, $user->token);
                    $email->sendConfirmation();
                    $result = $user->save();
                    if ($result) {
                        //Redirect user
                        header('Location: /message');
                    }
                }
            }
        }
        $router->render('auth/register', [
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    public static function message(Router $router)
    {
        $router->render('auth/message');
    }
    public static function confirm(Router $router)
    {
        $alerts = [];
        $token = s($_GET['token']);
        $user = User::where('token', $token);
        if (empty($user)) {
            User::setAlert('error', 'Token no valido');
        } else {
            $user->confirmed = "1";
            $user->token = '';
            $user->save();
            User::setAlert('success', 'Cuenta Confirmada');
        }
        $alerts = User::getAlerts();
        $router->render('auth/confirm-account', [
            'alerts' => $alerts
        ]);
    }
}
