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

class CandidateModel extends DbModel
{

    public string $mobile= '';
    public string $recordDate= '';
    public string $participantName= '';
    public string $country= '';
    public string $language= '';
    public string $evangelist= '';
    public string $source= '';
    public string $allotedDays= '';
    public string $mediaType= '';
    public string $activeStatus= '';
    public string $userid= '';
    public string $remark= '';

    public string $wgroup= '';

    public function tableName(): string
    {
        return 'candidate';
    }

    public function registerCandidate($params)
    {
        return $this->saveRecordViaApi3($params);
    }

    public function updateCandidate($params)
    {
        return $this->saveRecordViaApi4($params);
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
            'participantName' => [self::RULE_REQUIRED]

        ];

//        return [
//            'mobile' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
//            'participantName' => [self::RULE_REQUIRED],
//            // Other validation rules...
//        ];
    }

    // Implement the unique check
    public static function isMobileUnique($mobile)
    {
        $tableName = static::tableName();
        $sql = "SELECT * FROM $tableName WHERE mobile = :mobile";
        $statement = self::prepare($sql);
        $statement->bindValue(':mobile', $mobile);
        $statement->execute();
        return $statement->fetchObject() === false;
    }

    public function primaryKey(): string
    {
        return "id";
    }

    public function getMediaType($username,$candidate, $mobile)
    {
        return $this->getMediaTypeCandidate($username,$candidate,$mobile);
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