<?php
/** User: Aviet Lobo ...*/

namespace app\core; 

use app\core\middlewares\BaseMiddleware;

/**
 * Class Application
 * 
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\core
 */

 class Controller
 {
     public string $layout = 'main';
     /**
      * @var \app\core\middlewares\BaseMiddleware[]
      *
      */
     public array $middlewares = [];
     public string $action = '';
    public function render($view, $params =[])
    {

        return Application::$app->router->renderView($view,$params);

    }

    public function setLayout($layout)
    {
     $this->layout = $layout;
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;

    }

     /**
      * @return array
      */
     public function getMiddlewares(): array
     {
         return $this->middlewares;
     }


 }
