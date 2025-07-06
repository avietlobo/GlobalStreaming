<?php
/** User: Aviet Lobo ...*/

namespace app\models;

use app\core\DbModel;
use app\core\Model;

/**
 * Class UploadProcessLogModel
 *
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\models
 */

class TelecallerSMModel extends DbModel
{
    public string $mobile= '';
    public string $name = '';
    public string $record_date = '';
    public string $type = '';
    public string $email = '';
    public string $source = '';
    public string $country = '';
    public string $city = '';
    public string $referred_by = '';
    public string $group_name = '';
    public string $fellowship = '';
    public string $language = '';
    public ?string $status = null;
    public ?string $assignedTo = null;
    public ?string $callDate = null;


    public function tableName(): string
    {
        return 'telecaller_sm';
    }

    public function register()
    {
        return $this->save();
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



