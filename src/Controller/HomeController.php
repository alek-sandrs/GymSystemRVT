<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use App\Class\LoginClass;
use App\Class\RegisterClass;
use App\Class\ProfileClass;
use App\Class\SessionCheck;
use App\Class\SessionStart;

class HomeController extends DefaultController
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {   
        $obj = new ProfileClass();

        return $this->renderTemplate('home-template.php', 
        [
            'workouts' => $obj->getWorkouts()
        ]);
    }

    public function error(ServerRequestInterface $request): ResponseInterface
    {
        return $this->renderTemplate('404.php');
    }

    public function contact(ServerRequestInterface $request): ResponseInterface
    {
        return $this->renderTemplate('contact-template.php');
    }

    public function about(ServerRequestInterface $request): ResponseInterface
    {
        return $this->renderTemplate('about-template.php');
    }

    public function schedule(ServerRequestInterface $request): ResponseInterface
    {
        return $this->renderTemplate('schedule-template.php');
    }
    
    public function login(ServerRequestInterface $request): ResponseInterface
    {   
        $obj = new SessionCheck();
        $redirectResponse = $obj->checkLogin();
        
        if ($redirectResponse instanceof \Laminas\Diactoros\Response\RedirectResponse) {
            return $redirectResponse;
        }

        if (!empty($_POST)) {
            $obj = new LoginClass();
            $obj->login();

            $redirectResponse = $obj->login();
            
            if ($redirectResponse instanceof \Laminas\Diactoros\Response\RedirectResponse) {
                return $redirectResponse;
            }

            return new \Laminas\Diactoros\Response\RedirectResponse('/profile');
        }

        return $this->renderTemplate('login-template.php');
    }

    public function registration(ServerRequestInterface $request): ResponseInterface
    {
        $obj = new SessionCheck();
        $redirectResponse = $obj->checkLogin();
        
        if ($redirectResponse instanceof \Laminas\Diactoros\Response\RedirectResponse) {
            return $redirectResponse;
        }

        if (!empty($_POST)) {
            $obj = new RegisterClass();
            $obj->register();

            $obj = new LoginClass();
            $obj->login();

            return new \Laminas\Diactoros\Response\RedirectResponse('/profile');
            exit();
        }

        return $this->renderTemplate('registration-template.php');
    }

    public function profile(ServerRequestInterface $request): ResponseInterface
    {
        $obj = new SessionCheck();
        $redirectResponse = $obj->checkProfile();

        if ($redirectResponse instanceof \Laminas\Diactoros\Response\RedirectResponse) {
            return $redirectResponse;
        }

        return $this->renderTemplate('profile-template.php', 
        [
            'user' => SessionStart::get(),
            'workout' => ProfileClass::getWorkout()
        ]);
    }

    public function resetPassword(ServerRequestInterface $request): ResponseInterface
    {
        if (!empty($_POST)) {
            $obj = new ProfileClass();
            $response = $obj->resetPassword();
            
            if ($response instanceof \Laminas\Diactoros\Response\RedirectResponse) {
                return $response;
            }
        }

        return $this->renderTemplate('reset-password-template.php');
    }

    public function purchase(ServerRequestInterface $request): ResponseInterface
    {
        if (!empty($_GET)) {
            $obj = new ProfileClass();
            $response = $obj->purchase();

            if ($response instanceof \Laminas\Diactoros\Response\RedirectResponse) {
                return $response;
            }
        }
    }

    public function logout(ServerRequestInterface $request): ResponseInterface
    {
        session_destroy();

        return new \Laminas\Diactoros\Response\RedirectResponse('/');
    }
}