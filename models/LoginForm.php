<?php
/** User: Aviet Lobo ...*/

namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;

/**
 * Class LoginForm
 *
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\models
 */

class LoginForm extends Model
{

    public string $username = '';
    public string $password = '';
    public string $loginAttempt = '';


    public function rules(): array
    {
       return [
           'username' => [self::RULE_REQUIRED],
           'password' => [self::RULE_REQUIRED]
       ];
    }

    public function labels(): array
    {
        return [
            'username' => 'User Name',
            'password' => 'Password'
        ];
    }

    public function login7D()
    {

        $username = RegisterModel::findOne7D(['participant'=> $this->username]);


        $record = RegisterModel::findOne7D(['participant'=> $this->username, 'password'=> $this->password]);

//            echo '<pre>';
//            var_dump($record->login_attempts);
//            echo '</pre>';

//        $attempt= $record->login_attempts;
//        echo '<pre>';
//        var_dump($attempt);
//        echo '</pre>';

        if(!$username){
            $this->addSingleError('username','Username is incorrect');
//            echo '<pre>';
//            var_dump($this->errors);
//            echo '</pre>';
            return false;
        }

        if(!$record){
            $this->addSingleError('password','password is incorrect');
            return false;
        }

        if($record->login_attempts==0)
        {
            $this->updateLastLoginTime7D($record);
        }

        if ($record->login_attempts >= 3) {
            if ($record->classFrom == 1) {
                $this->updateLastLoginTime7D($record);
            } else {
                echo "Login attempts exceeded!!";
                return false;
            }
        }

        $this->handleLoginAttempts7D($record->login_attempts, $record);
//        if(!($this->checkLoginValidity($record)))
//        {
//            exit;
//            //return false;
//        }
        if($this->checkLoginValidity7D($record))
        {
            return Application::$app->login($record);
        }
//        return (  && Application::$app->login($record));

    }

    public function login()
    {

        $username = RegisterModel::findOne(['participant'=> $this->username]);


        $record = RegisterModel::findOne(['participant'=> $this->username, 'password'=> $this->password]);

//            echo '<pre>';
//            var_dump($record->login_attempts);
//            echo '</pre>';

//        $attempt= $record->login_attempts;
//        echo '<pre>';
//        var_dump($attempt);
//        echo '</pre>';

        if(!$username){
            $this->addSingleError('username','Username is incorrect');
//            echo '<pre>';
//            var_dump($this->errors);
//            echo '</pre>';
            return false;
        }

        if(!$record){
            $this->addSingleError('password','password is incorrect');
            return false;
        }

        if($record->login_attempts==0)
        {
            $this->updateLastLoginTime($record);
        }

        if ($record->login_attempts >= 3) {
            if ($record->classFrom == 1) {
                $this->updateLastLoginTime($record);
            } else {
                echo "Login attempts exceeded!!";
                return false;
            }
        }

        $this->handleLoginAttempts($record->login_attempts, $record);
//        if(!($this->checkLoginValidity($record)))
//        {
//            exit;
//            //return false;
//        }
        if($this->checkLoginValidity($record))
        {
            return Application::$app->login($record);
        }
//        return (  && Application::$app->login($record));

    }


        public function loginEvangelist()
    {

        $username = EvangelistModel::findOne1(['email'=> $this->username]);


        $record = EvangelistModel::findOne1(['email'=> $this->username, 'password'=> $this->password]);
        if ($record) {
            $evngName = $record->evngName; // Access the email attribute
            $emailY = $record->email; // Access the email attribute
            Application::$app->session->set('nameFinal', $evngName);
            Application::$app->session->set('emailY', $emailY);
        }
        if(!$username){
            $this->addSingleError('username','Username is incorrect');
            error_log("Username is incorrect: " . $this->username);
            return false;
        }

        if(!$record){
            $this->addSingleError('password','password is incorrect');
            error_log("Password is incorrect for username: " . $this->password);

            return false;
        }


        //return true;

        return Application::$app->login1($record);
        //error_log("DB check successful");


    }

    public function updateLastLoginTime7D($record)
    {
        RegisterModel::updateLastLoginField7D($record);
    }

    public function updateLastLoginTime($record)
    {
        RegisterModel::updateLastLoginField($record);
    }

    public function handleLoginAttempts7D($loginAttempts, $completeRecord) {
//     if($loginAttempts >=3)
//     {
//         echo "User account disabled due to multiple failed login attempts.";
//         return false;
//     }
//     else
//     {
        RegisterModel::updateLoginAttempt7D($loginAttempts,$completeRecord);
        //return true;



    }

    public function handleLoginAttempts($loginAttempts, $completeRecord) {
//     if($loginAttempts >=3)
//     {
//         echo "User account disabled due to multiple failed login attempts.";
//         return false;
//     }
//     else
//     {
         RegisterModel::updateLoginAttempt($loginAttempts,$completeRecord);
         //return true;



    }

    public function checkLoginValidity7D($record) : bool
    {
        //echo "Hi";
        return RegisterModel::checkLoginValidity7D($record);
    }

    public function checkLoginValidity($record) : bool
    {
        //echo "Hi";
      return RegisterModel::checkLoginValidity($record);
    }



}