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

class VideoWatchHistoryModel extends UserModel
{
    public string $recordDate= '';
    public string $mobile = '';
    public string $participant = '';
    public string $evangelist = '';
    public string $wgroup = '';
    public string $language = '';
    public string $expiryDate = '';
    public string $classFrom = '';
    public string $classTo = '';
    public string $status = '';
    public string $mediaType = '';
    public string $remark = '';
    public string $classLink ='';
    public string $feedback = '';
    public string $password = '';

    public string $duration_watched = '';
    public string $video_watch_status = '';
    public string $device_info = '';
    public string $location = '';

    public function tableName(): string
    {
        return 'video_watch_history';
    }

    public function register()
    {
        return $this->save();
    }

    public function register1($params,$password)
    {
        return $this->saveRecordViaApi($params,$password);
    }


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
            'status','mediaType','remark','classLink','feedback','password','duration_watched',
            'video_watch_status','device_info','location'
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
}



