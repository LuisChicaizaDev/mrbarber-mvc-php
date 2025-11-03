<?php

define('BASE_URL', $_ENV['BASE_URL']);

function debuguear($variable) : string {
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

// Para saber si el ultimo elemento del arreglo 
function isLast(string $actual, string $siguiente): bool {

    if($actual !== $siguiente) {
        return true;
    }

    return false;
}

// Funcion para revisar si el usuario está autenticado
function isAuth () : void {
    if(!isset($_SESSION['login'])){
        header('Location: ' . BASE_URL);
    }
}

// Funcion para revisar si el admin está autenticado
function isAdmin () : void {
    if(!isset($_SESSION['admin'])){
        header('Location: ' . BASE_URL);
    }
}