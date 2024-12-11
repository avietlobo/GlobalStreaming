<?php
/** User: Aviet Lobo ...*/

namespace app\core\middlewares;


use app\core\Application;
use app\core\exception\ForbiddenException;

/**
 * Class AuthMiddleware
 * 
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\core\middlewares
 */

 class AuthMiddleware extends BaseMiddleware
 {
    public array $actions = [];

    public function __construct(array $actions = [])
    {
        $this->actions  = $actions;
    }

     /**
      * @throws ForbiddenException
      */
     public function execute()
     {
         if(Application::isGuest()){
             if(empty($this->actions) || in_array(Application::$app->controller->action,$this->actions)){
            throw new ForbiddenException();
             }

         }
     }
 }
