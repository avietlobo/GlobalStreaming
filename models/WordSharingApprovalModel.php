<?php
/** User: Aviet Lobo ...*/

namespace app\models;

use app\core\DbModel;
use app\core\Model;

/**
 * Class WordSharingApprovalModel
 *
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\models
 */

class WordSharingApprovalModel extends DbModel
{

    public string $mobile= '';
    public string $candidateName= '';
    public string $assigned_by= '';
    public string $assigned_to= '';
    public string $status= '';
    public string $remarks= '';
    public string $language= '';
    public string $created_at= '';
    public string $updated_at= '';


    public function tableName(): string
    {
        return 'word_sharing_approval';
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


    }


    public function primaryKey(): string
    {
        return "id";
    }



}