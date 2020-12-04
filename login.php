<?php

function login($login, $password) {
    session_start();

    $userLogin = 'admin';
    $userPass = '1234';

    if ($login === $userLogin && $password === $userPass) {
        $_SESSION['auth'] = true;
        return true;
    }

    return false;
}