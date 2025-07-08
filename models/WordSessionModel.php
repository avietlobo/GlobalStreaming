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

class WordSessionModel extends DbModel
{

    public string $mobile= '';
    public string $session_id= '';
    public string $session_date= '';
    public string $status= '';
    public string $evangelist= '';
    public string $participant= '';
    public string $wgroup= '';
    public string $language= '';
    public string $remark= '';
    public string $feedback= '';
    public string $created_at= '';
    public string $updated_at= '';


    public function tableName(): string
    {
        return 'word_session';
    }



    public function attributes(): array
    {
        return ['mobile','recordDate','participantName','country',
            'language','evangelist','source','allotedDays','mediaType',
            'activeStatus','wgroup','userid','remark'
        ];
    }

    public function rules(): array
    {
        return [
            'mobile' => [self::RULE_REQUIRED,[self::RULE_MIN, 'min' => 2],[self::RULE_UNIQUE, 'class' => self::class]],
            'participantName' => [self::RULE_REQUIRED],
            'country' => [self::RULE_REQUIRED]

        ];

//        return [
//            'mobile' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
//            'participantName' => [self::RULE_REQUIRED],
//            // Other validation rules...
//        ];
    }


    public function primaryKey(): string
    {
        return "id";
    }


    public function labels(): array
    {
        return [
            'mobile' => 'Mobile',
            'participantName' => 'Participant Name',
            'country' => 'Country',
            'language' => 'Language',
            'evangelist' => 'Evangelist',
            'source' => 'Source',
            'allotedDays' => 'Alloted Days',
            'mediaType' => 'Media Type',
            'activeStatus' => 'Active Status',
            'wgroup' => 'Work Group',
            'userid' => 'User ID',
            'remark' => 'Remark'


        ];
    }
}