<?php

namespace App\Class;

class SessionCheck 
{
    public function checkProfile()
    {
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

    public function checkAdmin()
    {
        if (!isset($_SESSION['user'])) {
            return new \Laminas\Diactoros\Response\RedirectResponse('/login');
        }

        if ($_SESSION['user']['isAdmin'] != 1) {
            return new \Laminas\Diactoros\Response\RedirectResponse('/profile');
        }
    }
}