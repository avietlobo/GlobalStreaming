<?php
/** User: Aviet Lobo ...*/

namespace app\core; 

use app\models\RegisterModel;

/**
 * Class Application
 * 
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\core
 */

 class Application
 {

      public static string $ROOT_DIR;
      public string $layout = 'main';
      public string $userClass;
      public Router $router;
      public Request $request;
      public Response $response;
      public Session $session;
      public Database $db;
      public static Application $app;
      public ?DbModel $user;

      public ?Controller $controller = null;

     /**
      * @return Controller
      */
     public function getController(): Controller
     {
         return $this->controller;
     }

     /**
      * @param Controller $controller
      */
     public function setController(Controller $controller): void
     {
         $this->controller = $controller;
     }

      public function __construct($rootPath, array $config)
      {
        $this->userClass= $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $primaryValue = $this->session->get('user');
        if($primaryValue) {
            $primaryKey = $this->userClass::primaryKey1();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
        else
        {
            $this->user = null;
        }

      }

      public function run()
      {
          try {
              echo $this->router->resolve();
          }
          catch (\Exception $e){
              $this->response->setStatusCode($e->getCode());
              echo $this->router->renderView('_error', [
                  'exception' => $e
              ]);
          }


      }

      public function login(DbModel $user): bool
      {
          $this->user = $user;
          $primaryKey = $user->primaryKey();
          //var_dump($user);
          //var_dump($primaryKey); // Should print the primary key name
          $primaryValue = $user->{$primaryKey};
          // Debugging before line 88

          //var_dump($primaryValue); // Should print the primary value

          $this->session->set('user',$primaryValue);
          //var_dump($this->session->get('user'));
          // Regenerate the session ID to enhance security
          session_regenerate_id(true);

          return true;
      }

     public function login1(DbModel $user): bool
     {
         $this->user = $user;
         //var_dump($user); // Should print the primary key name
         $primaryKey = 'mobile';
        // var_dump($primaryKey); // Should print the primary key name
         $primaryValue = $user->{$primaryKey};
         // Debugging before line 88




         //var_dump($primaryValue); // Should print the primary value

//         if (session_status() === PHP_SESSION_NONE) {
//             session_start();
//         }


         // Ensure the session is started
         if (session_status() === PHP_SESSION_NONE) {
             session_start();
         }
         $this->session->set('user1',$primaryValue);
         //var_dump($this->session->get('user1'));

         //var_dump($user);

         // Set session data
         //$_SESSION['user'] = '123'; // Example value

         // Regenerate the session ID to enhance security
         //session_regenerate_id(true);

         return true;
     }

      public function logout()
      {
          $this->user = null;
          $this->session->remove('user');
      }

      public static function isGuest(){

         return !self::$app->user;
      }

     public static function isGuest1(){
         if (session_status() === PHP_SESSION_NONE) {
             session_start();
         }
         return empty($_SESSION['user1']);
     }


 }