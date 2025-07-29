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

class SathvarthaEventModel extends DbModel
{
    public string $event_name = '';
    public string $start_date = '';
    public string $end_date = '';
    public string $main_language = '';
    public string $translation_language = '';
    public string $event_organizer = '';
    public string $local_organizer = '';
    public string $event_link = '';
    public string $notes = '';
    public string $created_by = '';
    public string $updated_by = '';
    public string $created_at = '';
    public string $updated_at = '';


    public function tableName(): string
    {
        return 'sathvartha_events';
    }

    public function attributes(): array
    {
        return [
            'event_name',
            'start_date',
            'end_date',
            'main_language',
            'translation_language',
            'event_organizer',
            'local_organizer',
            'event_link',
            'notes',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at'
        ];
    }

    public function rules(): array
    {
        return []; // Add validation rules if needed
    }

    public function primaryKey(): string
    {
//        return "";
        return "";
    }
}



