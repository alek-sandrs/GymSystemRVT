<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

use App\Class\ControlPanel;
use App\Class\SessionCheck;
use App\DatabaseConnection;

class AdminPanelController extends DefaultController
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {   
        $obj = new SessionCheck();
        $redirectResponse = $obj->checkAdmin();
        
        if ($redirectResponse instanceof \Laminas\Diactoros\Response\RedirectResponse) {
            return $redirectResponse;
        }

        $obj = new ControlPanel();

        return $this->renderTemplate('admin-page-template.php', [
            'users' => $obj->getUserCount(),
            'subscriptions' => $obj->getSubscriptionCount(),
            'earnedMoney' => $obj->getEarnedMoney()
        ]);
    }

    public function users(ServerRequestInterface $request): ResponseInterface
    {   
        $obj = new SessionCheck();
        $redirectResponse = $obj->checkAdmin();
        
        if ($redirectResponse instanceof \Laminas\Diactoros\Response\RedirectResponse) {
            return $redirectResponse;
        }

        $obj = new ControlPanel();

        return $this->renderTemplate('users-template.php', [
            'users' => $obj->getUsers()
        ]);
    }

    public function deleteUser(ServerRequestInterface $request): ResponseInterface
    {   
        $obj = new SessionCheck();
        $redirectResponse = $obj->checkAdmin();
        
        if ($redirectResponse instanceof \Laminas\Diactoros\Response\RedirectResponse) {
            return $redirectResponse;
        }

        $obj = new ControlPanel();
        $obj->deleteUser();

        return new \Laminas\Diactoros\Response\RedirectResponse('/admin-panel/users');
    }

    public function showEditedUser(ServerRequestInterface $request) : ResponseInterface
    {
        $obj = new SessionCheck();
        $redirectResponse = $obj->checkAdmin();
        
        if ($redirectResponse instanceof \Laminas\Diactoros\Response\RedirectResponse) {
            return $redirectResponse;
        }

        $obj = new ControlPanel();

        return $this->renderTemplate('edit-user-template.php', [
            'user' => $obj->getUser()
        ]);
    }

    public function editUser(ServerRequestInterface $request): ResponseInterface
    {
        $obj = new SessionCheck();
        $redirectResponse = $obj->checkAdmin();
        
        if ($redirectResponse instanceof \Laminas\Diactoros\Response\RedirectResponse) {
            return $redirectResponse;
        }

        $obj = new ControlPanel();
        $obj->editUser();

        return new \Laminas\Diactoros\Response\RedirectResponse('/admin-panel/users');
    }

    public function searchUsers(ServerRequestInterface $request): ResponseInterface
    {
        $search = $request->getQueryParams()['search'];

        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('SELECT 
            users.uID, 
            users.Username, 
            users.LastName, 
            users.isAdmin, 
            users.isTrainer, 
            IFNULL(workouts.WorkoutName, "NONE") AS WorkoutName
        FROM users
            LEFT JOIN purchases
        ON users.uID = purchases.uID
            LEFT JOIN workouts
        ON purchases.WorkoutID = workouts.WorkoutID
        WHERE users.Username LIKE :search OR users.LastName LIKE :search');
        $stmt->bindValue(':search', '%' . $search . '%');
        $stmt->execute();
        $users = $stmt->fetchAll();

        return new JsonResponse($users);
    }

    public function workouts(ServerRequestInterface $request): ResponseInterface
    {   
        $obj = new SessionCheck();
        $obj->checkAdmin();

        $obj = new ControlPanel();

        return $this->renderTemplate('workout-page-template.php', [
            'workouts' => $obj->getWorkouts()
        ]);
    }

    public function addWorkout(ServerRequestInterface $request): ResponseInterface
    {   
        $obj = new SessionCheck();
        $obj->checkAdmin();

        if (!empty($_GET)) {
            $obj = new ControlPanel();
            $obj->addWorkout();

            return new \Laminas\Diactoros\Response\RedirectResponse('/admin-panel/workouts');
        }


        return $this->renderTemplate('workout-add-page-template.php', [
        ]);
    }

    public function deleteWorkout(ServerRequestInterface $request): ResponseInterface
    {   
        $obj = new SessionCheck();
        $obj->checkAdmin();

        $obj = new ControlPanel();
        $obj->deleteWorkout();

        return new \Laminas\Diactoros\Response\RedirectResponse('/admin-panel/workouts');
    }
    public function showEditedWorkout(ServerRequestInterface $request): ResponseInterface
    {
        $obj = new SessionCheck();
        $obj->checkAdmin();

        $obj = new ControlPanel();

        return $this->renderTemplate('workout-edit-page-template.php', [
            'workout' => $obj->getWorkout()
        ]);
    }
    
    public function editWorkout(ServerRequestInterface $request): ResponseInterface
    {
        $obj = new SessionCheck();
        $obj->checkAdmin();

        if (!empty($_POST)) {
            $obj = new ControlPanel();
            $obj->editWorkout();

            return new \Laminas\Diactoros\Response\RedirectResponse('/admin-panel/workouts');
        }
    }

    public function searchWorkouts(ServerRequestInterface $request): ResponseInterface
    {
        $search = $request->getQueryParams()['search'];

        $obj = new DatabaseConnection();
        $conn = $obj->getConnection();
        $stmt = $conn->prepare('SELECT * FROM workouts WHERE WorkoutName LIKE :search');
        $stmt->bindValue(':search', '%' . $search . '%');
        $stmt->execute();
        $workouts = $stmt->fetchAll();

        return new JsonResponse($workouts);
    }

    public function trainers(ServerRequestInterface $request): ResponseInterface
    {   
        $obj = new SessionCheck();
        $redirectResponse = $obj->checkAdmin();
        
        if ($redirectResponse instanceof \Laminas\Diactoros\Response\RedirectResponse) {
            return $redirectResponse;
        }

        $obj = new ControlPanel();

        return $this->renderTemplate('trainers-template.php', [
            'trainers' => $obj->getTrainers()
        ]);
    }

    // public function purchases(ServerRequestInterface $request): ResponseInterface
    // {   
    //     $obj = new SessionCheck();
    //     $redirectResponse = $obj->checkAdmin();
        
    //     if ($redirectResponse instanceof \Laminas\Diactoros\Response\RedirectResponse) {
    //         return $redirectResponse;
    //     }

    //     $obj = new ControlPanel();

    //     return $this->renderTemplate('purchases-template.php', [
    //         'purchases' => $obj->getPurchases()
    //     ]);
    // }
}