<?php
/** User: Aviet Lobo ...*/

namespace app\models;

use app\core\DbModel;
use app\core\Model;
use app\core\UserModel;

/**
 * Class RegisterModel
 *
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\models
 */

class RegisterModel extends UserModel
{
    public string $recordDate= '';
    public string $mobile = '';
    public string $participant = '';
    public string $evangelist = '';
    public string $wgroup = '';
    public string $language = '';
    public string $classFrom = '';
    public string $expiryDate = '';

    public string $classTo = '';
    public string $status = '';
    public string $mediaType = '';
    public string $remark = '';
    public string $classLink ='';
    public string $feedback = '';
    public ?string $password = null; // Allow null values


    public function tableName(): string
    {
        return 'candidatedetails';
    }

    public function register()
    {
        return $this->save();
    }

    public function saveClassDetails7D($candidate)
    {
        return $this->saveClass7D($candidate);
    }

    public function saveClassDetails($candidate)
    {
        return $this->saveClass($candidate);
    }

    public function getUserDetailsByUsername7D($username,$candidate, $mobile)
    {
        return $this->getAllClassRequests7D($username,$candidate,$mobile);
    }


    public function getUserDetailsByUsername($username,$candidate, $mobile)
    {
        return $this->getAllClassRequests($username,$candidate,$mobile);
    }

    public function register17D($params,$password)
    {
        return $this->saveRecordViaApi7D($params,$password);
    }

    public function register1($params,$password)
    {
        return $this->saveRecordViaApi($params,$password);
    }

//    public  function incrementLoginAttempt($loginAttempt,$record)
//    {
//        return $this->updateLoginAttempt($loginAttempt,$record);
//    }

    public function rules(): array
    {
        return [
            'recordDate' => [self::RULE_REQUIRED]

        ];
    }

    public function attributes(): array
    {
        return ['recordDate','mobile','participant','evangelist',
            'wgroup','language','expiryDate','classFrom','classTo',
            'status','mediaType','remark','classLink','feedback','password'
            ];
    }


    public function primaryKey(): string
    {
        return 'id';
    }

//    public static function mediaType(): string
//    {
//        return this->$mediaType;
//    }

    public static function primaryKey1(): string
    {
        return 'id';
    }

    public function getDisplayName(): string
    {
        return $this->participant;
    }

    public function labels(): array
    {
        return [
            'mobile' => 'Mobile',
            'participant' => 'Participant Name',
            'language' => 'Language',
            'evangelist' => 'Evangelist',
            'mediaType' => 'Media Type',
            'status' => 'Status',
            'wgroup' => 'Work Group',
            'classFrom' => 'Class From',
            'remark' => 'Remark',
            'classLink' => 'Class Link',
            'feedback' => 'Feedback'


        ];
    }

}



