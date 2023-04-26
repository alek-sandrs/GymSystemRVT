<?php

namespace App\Class;

use App\DatabaseConnection;

class SessionStart {
    public function set($row) 
    {
        $_SESSION['user'] = [
            'uID' => $row['uID'],
            'username' => $row['username'],
            'isAdmin' => $row['isAdmin'],
            'isTrainer' => $row['isTrainer']
        ];
    }

    public function get() 
    {
        return $_SESSION['user'];
    }

    public function destroy()
    {
        unset($_SESSION['user']);
    }
}