<?php
/** User: Aviet Lobo ...*/

namespace app\core;
use app\core\exception\NotFoundException;

/**
 * Class Router
 * 
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\core
 */

/**
 * Router constructor
 * 
 * @param \app\core\Request $request
 * @param \app\core\Response $response
 */


 class Router
 {
     protected array $routes = [];
     public Request $request;
     public Response $response;

     public function __construct(Request $request, Response $response)
      {
        $this->request = $request;
        $this->response = $response;
      }

      public function get($path,$callback){
          $this->routes['get'][$path] = $callback;

      }

      public function post($path,$callback){
          $this->routes['post'][$path] = $callback;

      }

     /**
      * @throws NotFoundException
      */
     public function resolve()
      {
         $path = $this->request->getPath();
         $method = $this->request->getMethod();
         $callback = $this->routes[$method][$path] ?? false;
         if($callback === false){
//             $this->response->setStatusCode(404);
             throw new NotFoundException();
               //return $this->renderView("_404");
         }

         if(is_string($callback)){
              return $this->renderView($callback);

         }
         if(is_array($callback))
         {
             //Application::$app->controller = new $callback[0](Application::$app->db, $method);
             /** @var  \app\core\Controller $controller */
             $controller = new $callback[0]();
             Application::$app->controller = $controller;
             $controller->action = $callback[1];
             $callback[0] = $controller;

             foreach ($controller->getMiddlewares() as $middleware){
                 $middleware->execute();
             }

         }
         return call_user_func($callback, $this->request, $this->response);
      }

      public function renderView($view, $params = [])
      {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view,$params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
        //include_once Application::$ROOT_DIR."/views/$view.php"; 

      }

      public function renderContent($viewContent)
      {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
        //include_once Application::$ROOT_DIR."/views/$view.php"; 

      }

      protected function layoutContent()
      {
          $layout = Application::$app->layout;
          if(Application::$app->controller)
          {
              $layout = Application::$app->controller->layout;
          }
          ob_start();
          include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
          return ob_get_clean();
      }

      protected function renderOnlyView($view,$params){


          foreach ($params as $key => $value){
              $$key = $value;
          }

//          echo '<pre>';
//          var_dump($name);
//          echo '</pre>';
//          exit;

         ob_start();
          include_once Application::$ROOT_DIR."/views/$view.php"; 
          return ob_get_clean();

      }

 }