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

class EvangelistModel extends UserModel
{
    public string $entryDate= '';
    public string $email = '';
    public string $mobile = '';
    public string $evngName = '';
    public string $designation = '';
    public string $gLeaderEmail = '';
    public string $wgroupId = '';
    public string $password = '';


    public function tableName(): string
    {
        return 'evangelist';
    }

    public function register()
    {
        return $this->save();
    }

    public function register1($params,$password)
    {
        return $this->saveRecordViaApi($params,$password);
    }

    public function resetPwd1($email,$password)
    {
        return $this->resetPwd($email,$password);
    }

    public function rules(): array
    {
        return [
            'recordDate' => [self::RULE_REQUIRED]

        ];
    }

    public function attributes(): array
    {
        return ['entryDate','email','mobile','evngName',
            'designation','gLeaderEmail','wgroupId','password'
            ];
    }


    public function primaryKey(): string
    {
//        return "";
        return "";
    }

    public  function primaryKey1(): string
    {
//        return "";
        return "mobile";
    }


    public function getDisplayName(): string
    {
        return $this->evngName;
    }
}



