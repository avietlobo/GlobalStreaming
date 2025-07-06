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

class UploadProcessLogModel extends DbModel
{
    public string $process_id= '';
    public string $uploadedBy = '';
    public string $upload_time = '';
    public string $status = '';
    public string $total_rows = '';
    public string $inserted_rows = '';
    public string $skipped_rows = '';
    public string $error_file = '';
    public string $output_file = '';


    public function tableName(): string
    {
        return 'upload_process_log';
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



