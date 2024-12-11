<?php
/** User: Aviet Lobo ...*/

namespace app\models;

use app\core\DbModel;
use app\core\Model;

/**
 * Class CandidateModel
 *
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\models
 */

class WGroupModel extends DbModel
{

    public string $GroupID= '';
    public string $GName= '';
    public string $EvngCordName= '';
    public string $EvngCordEmail= '';
    public string $GroupLeaderName= '';
    public string $GroupLeaderEmail= '';
    public string $GLAssistEmail= '';

    public function tableName(): string
    {
        return 'wgroup';
    }


    public function attributes(): array
    {
        return ['GroupID','GName','EvngCordName','EvngCordEmail',
            'GroupLeaderName','GroupLeaderEmail','GLAssistEmail'
        ];
    }

    public function rules(): array
    {
        return [
            'GroupID' => [self::RULE_REQUIRED],
            'GName' => [self::RULE_REQUIRED]

        ];

    }


    public function primaryKey(): string
    {
        return "";
    }

//    public function labels(): array
//    {
//        return [
//            'mobile' => 'Mobile',
//            'participantName' => 'Participant Name',
//            'country' => 'Country',
//            'language' => 'Language',
//            'evangelist' => 'Evangelist',
//            'source' => 'Source',
//            'allotedDays' => 'Alloted Days',
//            'mediaType' => 'Media Type',
//            'activeStatus' => 'Active Status',
//            'wgroup' => 'Work Group',
//            'userid' => 'User ID',
//            'remark' => 'Remark'
//
//
//        ];
//    }
}