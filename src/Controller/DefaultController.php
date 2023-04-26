<?php

declare(strict_types=1);

namespace App\Controller;

use App\DatabaseConnection;
use Laminas\Diactoros\Response;

abstract class DefaultController    
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new DatabaseConnection();
    }

    protected function renderTemplate(string $templatePath, $args = [], $baseTemplate = '') 
    {
        extract($args, EXTR_SKIP);

        ob_start();
        require sprintf(__DIR__ . '/../../assets/views/%s', $templatePath);
        $view = ob_get_clean();
        
        ob_start();

        if (! empty($baseTemplate)) {
            require sprintf(__DIR__ . '/../../assets/views/control-panel-template');
        }
        
        require __DIR__ . '/../../assets/views/main-template.php';
        $main = ob_get_clean();

        $response = new Response();
        $response->getBody()->write(str_replace('{{ content }}', $view, $main));
        
        return $response;
    }
}
