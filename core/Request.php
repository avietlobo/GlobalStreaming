<?php
/** User: Aviet Lobo ...*/

namespace app\core; 

/**
 * Class Request
 * 
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\core
 */

 class Request
 {

    public function getPath(){
      $path = $_SERVER['REQUEST_URI'] ?? '/';
      $position = strpos($path, '?');
      if($position === false){
          return $path;
      }

       return substr($path, 0, $position);
        
    

    }
    
    public function hasHeader($headerName): bool
    {
        $headers = $this->getallTheHeaders();

        foreach ($headers as $name => $value) {
            if (strcasecmp($name, $headerName) === 0) {
                return true;
            }
        }

        return false;
    }

    function getallTheHeaders(): array
    {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
                $headers[$name] = $value;
            }
        }
        return $headers;
    }

    function getHeader($headerKey)
    {
        $allHeaders = $this->getallTheHeaders();
        echo '<pre>';
        var_dump($allHeaders);
        echo '</pre>';
        if (isset($allHeaders[$headerKey])) {
            echo '<pre>';
            var_dump($allHeaders[$headerKey]);
            echo '</pre>';
            return $allHeaders[$headerKey];
        } else {
            return null; // Return null or handle the case where the header key is not found.
        }
    }
    

    public function getMethod()
    {

        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->getMethod() === 'get';
    }

     public function isPost()
     {
         return $this->getMethod() === 'post';
     }

    public function getBody()
    {

        $body =  [];

        // Read raw input stream for POST requests with JSON payload
        $rawInput = file_get_contents('php://input');
        $postData = json_decode($rawInput, true);

        if ($this->getMethod() === 'get'){
        foreach ($_GET as $key => $value) {
        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        }

        if ($this->getMethod() === 'post'){

            // Use data from the raw input stream for JSON payloads
            if ($postData !== null) {
                return $postData;
            }

            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }


 }