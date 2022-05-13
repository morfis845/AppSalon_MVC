<?php

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function isLast(string $current, string $next) : bool{
    if($current !== $next){
        return true;
    }
    return false;
}

function isAuth() : void {
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}
function isAdmin(){
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}