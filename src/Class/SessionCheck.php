<?php

namespace App\Class;

class SessionCheck 
{
    public function checkProfile()
    {
        // var_dump($_SESSION['user']);
        if (!isset($_SESSION['user'])) {
            return new \Laminas\Diactoros\Response\RedirectResponse('/registration');

        }
    }

    public function checkLogIn()
    {
        if (isset($_SESSION['user'])) {
            return new \Laminas\Diactoros\Response\RedirectResponse('/profile');
        }
    }
}