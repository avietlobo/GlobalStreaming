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

class EvangelistReviewModel extends UserModel
{
    public string $entryDate= '';
    public string $zion_id= '';
    public string $evngName = '';
    public string $mobile = '';
    public string $fellowship = '';
    public string $email = '';
    public string $wgroupId = '';
    public string $gLeaderEmail = '';
    public string $referredBy = '';
    public string $status = '';
    public string $reject_reason = '';
    public string $designation = '';
    public string $updated_date = '';
    public string $photo= '';

    public function tableName(): string
    {
        return 'evangelist_in_review';
    }

    public function register()
    {
        return $this->save();
    }

    public function register1($params,$password)
    {
        return $this->saveRecordViaApi($params,$password);
    }

    public function findEvangelist($mobile,$email)
    {
        return $this->findEvangelistTemp($mobile, $email);
    }

    public function findEvangelistMain($mobile,$email)
    {
        return $this->findEvangelistMain1($mobile, $email);
    }

    public function memberRegister($zion_id, $evngName, $mobile, $photoName, $fellowship, $email,$designation,$wgroup)
    {
        return $this->saveMemberRecordViaApi($zion_id, $evngName, $mobile, $photoName, $fellowship, $email,$designation,$wgroup);
    }

    public function getMembers()
    {
        return $this->getRegMembers();
    }

    public function viewAllRegMembers()
    {
        return $this->viewAllRegMembersSoFar();
    }

    public function viewRegMembers()
    {
        return $this->viewRegMembersSoFar();
    }

    public function updateMember($status,$rejectedReason,$zion_id)
    {
        return $this->updateMemberRecord($status,$rejectedReason,$zion_id);
    }

    public function addNewEvangelist($data)
    {
        return $this->addNewEvangelistRecord($data);
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



