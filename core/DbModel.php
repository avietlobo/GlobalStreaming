<?php

namespace app\core;

use app\models\CandidateModel7D;
use app\models\DataBankModel;
use app\models\EvangelistModel;
use app\models\EvangelistReviewModel;
use app\models\RegisterModel;
use app\models\CandidateModel;
use app\models\TelecallerSMModel;
use app\models\UploadProcessLogModel;
use app\models\WordSessionModel;
use app\models\WordSharingApprovalModel;

abstract class DbModel extends Model
{

    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;

    // Define constants at the class level
    private const STATUS_WITHDRAWN = 'Withdrawn';
    private const STATUS_EXIT = 'Exit/Drop-out';
    private const STATUS_INACTIVE = 'InActive';
    private const STATUS_COMPLETED = 'Completed';
    private const STATUS_ACTIVE = 'Active';

    public static function saveAttendance($mobile, $participantName, $evangelist, $evngEmail, $isOnlineSathAttended, $location, $feedback, $attendedDate)
    {
        $tableName = 'online_sathvartha';
        $isOnlineSathAttended1 = $isOnlineSathAttended ? (int)$isOnlineSathAttended : 0;

        // Prepare and execute the SQL query
        $statement = self::prepare("INSERT INTO $tableName (mobile, participantName, evangelist, evngEmail, isOnlineSathAttended, location, feedback, attendedDate) 
            VALUES (:mobile, :participantName, :evangelist,:evngEmail,:isOnlineSathAttended,:location,:feedback,:attendedDate)");



         // Bind parameters
        $statement->bindParam(':mobile', $mobile);
        $statement->bindParam(':participantName', $participantName);
        $statement->bindParam(':evangelist', $evangelist);
        $statement->bindParam(':evngEmail', $evngEmail);
        $statement->bindParam(':isOnlineSathAttended', $isOnlineSathAttended1);
        $statement->bindParam(':location', $location);
        $statement->bindParam(':feedback', $feedback);
        $statement->bindParam(':attendedDate', $attendedDate);
        if ($statement->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => $statement->errorInfo()[2]]);
        }
        return true;
    }


    public static function saveAppointment(
        $candidate_mobile, $event_name,
        $appointment_datetime_ist, $appointment_datetime_candidate_zone,
        $candidate_country, $place, $class_status,
        $sathvartha_organizer_name, $panel_member_name, $caring_team_member_name, $local_organizer_name,
        $google_meet_status, $faith_status, $sathvartha_ready_status, $fellowship_status,
        $evangelist_feedback, $panel_feedback, $local_organizer_feedback, $final_feedback,
        $sathvartha_attendance_status, $sathvartha_feedback,
        $caring_google_meet_status, $caring_status, $travel_status, $transportStatus,$caringistDateTime
    ) {
        $tableName = 'appointments';

        $stmt = self::prepare("INSERT INTO $tableName (
        candidate_mobile, event_name,
        appointment_datetime_ist, appointment_datetime_candidate_zone,
        candidate_country, place, class_status,
        sathvartha_organizer_name, panel_member_name, caring_team_member_name, local_organizer_name,
        google_meet_status, faith_status, sathvartha_ready_status, fellowship_status,
        evangelist_feedback, panel_feedback, local_organizer_feedback, final_feedback,
        sathvartha_attendance_status, sathvartha_feedback,
        caring_google_meet_status, caring_status, travel_status,transport_required,caring_google_meet_date
    ) VALUES (
        :candidate_mobile, :event_name,
        :appointment_datetime_ist, :appointment_datetime_candidate_zone,
        :candidate_country, :place, :class_status,
        :sathvartha_organizer_name, :panel_member_name, :caring_team_member_name, :local_organizer_name,
        :google_meet_status, :faith_status, :sathvartha_ready_status, :fellowship_status,
        :evangelist_feedback, :panel_feedback, :local_organizer_feedback, :final_feedback,
        :sathvartha_attendance_status, :sathvartha_feedback,
        :caring_google_meet_status, :caring_status, :travel_status, :transport_required, :caring_google_meet_date
    )");

        // Bind parameters
        $stmt->bindParam(':candidate_mobile', $candidate_mobile);
        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':appointment_datetime_ist', $appointment_datetime_ist);
        $stmt->bindParam(':appointment_datetime_candidate_zone', $appointment_datetime_candidate_zone);
        $stmt->bindParam(':candidate_country', $candidate_country);
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':class_status', $class_status);

        $stmt->bindParam(':sathvartha_organizer_name', $sathvartha_organizer_name);
        $stmt->bindParam(':panel_member_name', $panel_member_name);
        $stmt->bindParam(':caring_team_member_name', $caring_team_member_name);
        $stmt->bindParam(':local_organizer_name', $local_organizer_name);

        $stmt->bindParam(':google_meet_status', $google_meet_status);
        $stmt->bindParam(':faith_status', $faith_status);
        $stmt->bindParam(':sathvartha_ready_status', $sathvartha_ready_status);
        $stmt->bindParam(':fellowship_status', $fellowship_status);

        $stmt->bindParam(':evangelist_feedback', $evangelist_feedback);
        $stmt->bindParam(':panel_feedback', $panel_feedback);
        $stmt->bindParam(':local_organizer_feedback', $local_organizer_feedback);
        $stmt->bindParam(':final_feedback', $final_feedback);

        $stmt->bindParam(':sathvartha_attendance_status', $sathvartha_attendance_status);
        $stmt->bindParam(':sathvartha_feedback', $sathvartha_feedback);
        $stmt->bindParam(':caring_google_meet_status', $caring_google_meet_status);
        $stmt->bindParam(':caring_status', $caring_status);
        $stmt->bindParam(':travel_status', $travel_status);
        $stmt->bindParam(':transport_required', $transportStatus);
        $stmt->bindParam(':caring_google_meet_date', $caringistDateTime);

        echo $candidate_mobile;

        echo '<pre>';
        var_dump($stmt->queryString);
        echo '</pre>';


        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode([
                "success" => false,
                "error" => $stmt->errorInfo()[2] // detailed DB error
            ]);
        }

        return true;
    }

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();


        $params = array_map(fn($attr) => ":$attr", $attributes);


        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") 
        VALUES(" . implode(',', $params) . ")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

//        echo '<pre>';
//        var_dump($statement);
//        echo '</pre>';

        $statement->execute();
        return true;

    }


    public function saveClass7D($candidate)
    {
        // Extract individual fields from the $candidate array
        $evangelist = $candidate['evangelist'] ?? null;
        $participantName = $candidate['participantName'] ?? null;
        $classNo = $candidate['classNo'] ?? null;
        $status = $candidate['status'] ?? null;
        $mediaType = $candidate['mediaType'] ?? null;
        $remark = $candidate['remark'] ?? null;
        $mobile = $candidate['mobile'] ?? null;
        $password = $candidate['password'] ?? null;

        $tableName = '7dcandetails';
        $statement = self::prepare("UPDATE $tableName SET status = '$status',mediaType= '$mediaType',remark ='$remark',password= '$password' WHERE evangelist = '$evangelist' AND participant = '$participantName' AND mobile = '$mobile' AND classFrom= '$classNo'");
        $statement->execute();
    }

    public function saveClass($candidate)
    {
        // Extract individual fields from the $candidate array
        $evangelist = $candidate['evangelist'] ?? null;
        $participantName = $candidate['participantName'] ?? null;
        $classNo = $candidate['classNo'] ?? null;
        $status = $candidate['status'] ?? null;
        $mediaType = $candidate['mediaType'] ?? null;
        $remark = $candidate['remark'] ?? null;
        $mobile = $candidate['mobile'] ?? null;
        $password = $candidate['password'] ?? null;

        $tableName = $this->tableName();
        $statement = self::prepare("UPDATE $tableName SET status = '$status',mediaType= '$mediaType',remark ='$remark',password= '$password' WHERE evangelist = '$evangelist' AND participant = '$participantName' AND mobile = '$mobile' AND classFrom= '$classNo'");
        $statement->execute();

    }

    public function getMediaTypeCandidate7D($name, $candidate, $mobile)
    {
        $tableName = '7dcandidate';
        $statement = self::prepare("SELECT * FROM $tableName WHERE evangelist = :name AND participantName = :candidate AND mobile = :mobile");

        // Bind parameters
        $statement->bindParam(':name', $name);
        $statement->bindParam(':candidate', $candidate);
        $statement->bindParam(':mobile', $mobile);

        $statement->execute();

        // Fetch one candidate as an instance of CandidateModel
        //$candidateModel = $statement->fetch(\PDO::FETCH_CLASS, CandidateModel::class);

        $candidateModel = $statement->fetch(Application::$app->db->pdo::FETCH_ASSOC);

        if ($candidateModel === false) {
            // Handle case where no candidate was found
            return null; // or throw an exception, or return an empty model
        }

//        echo '<pre>';
//        var_dump($candidateModel);
//        echo '</pre>';

        return $candidateModel;
    }

    public function getMediaTypeCandidate($name, $candidate, $mobile)
    {
        $tableName = 'candidate';
        $statement = self::prepare("SELECT * FROM $tableName WHERE evangelist = :name AND participantName = :candidate AND mobile = :mobile");

        // Bind parameters
        $statement->bindParam(':name', $name);
        $statement->bindParam(':candidate', $candidate);
        $statement->bindParam(':mobile', $mobile);

        $statement->execute();

        // Fetch one candidate as an instance of CandidateModel
        //$candidateModel = $statement->fetch(\PDO::FETCH_CLASS, CandidateModel::class);

        $candidateModel = $statement->fetch(Application::$app->db->pdo::FETCH_ASSOC);

        if ($candidateModel === false) {
            // Handle case where no candidate was found
            return null; // or throw an exception, or return an empty model
        }

//        echo '<pre>';
//        var_dump($candidateModel);
//        echo '</pre>';

        return $candidateModel;
    }

    public function getAllClassRequests7D($name, $candidate, $mobile)
    {

        $tableName = '7dcandetails';
        //$statement = self::prepare("SELECT * FROM $tableName WHERE evangelist = '$name' AND participant = '$candidate' AND mobile = '$mobile'");
        $statement = self::prepare("SELECT * FROM $tableName WHERE  participant = '$candidate' AND mobile = '$mobile'");

        $statement->execute();
        // Fetch all rows instead of just one
        $classes = $statement->fetchAll(\PDO::FETCH_CLASS, RegisterModel::class);
//        echo '<pre>';
//        var_dump($mobile);
//        echo '</pre>';

        return $classes;
    }

    public function getAllClassRequests($name, $candidate, $mobile)
    {
        $tableName = $this->tableName();
        $statement = self::prepare("SELECT * FROM $tableName WHERE evangelist = '$name' AND participant = '$candidate' AND mobile = '$mobile'");
        $statement->execute();
        // Fetch all rows instead of just one
        $classes = $statement->fetchAll(\PDO::FETCH_CLASS, RegisterModel::class);
//        echo '<pre>';
//        var_dump($mobile);
//        echo '</pre>';

        return $classes;
    }

    public static function updateLoginAttempt7D($loginAttempt, $record)
    {
        //echo "correct";
        $tableName = "7dcandetails";
        $statement = self::prepare("UPDATE $tableName SET login_attempts = :loginAttempt WHERE participant = :participant AND password = :password");
        $statement->bindValue(":loginAttempt", $loginAttempt + 1);
        $statement->bindValue(":participant", $record->participant);
        $statement->bindValue(":password", $record->password);
        $statement->execute();
    }

    public static function updateLoginAttempt($loginAttempt, $record)
    {
        //echo "correct";
        $tableName = "candidatedetails";
        $statement = self::prepare("UPDATE $tableName SET login_attempts = :loginAttempt WHERE participant = :participant AND password = :password");
        $statement->bindValue(":loginAttempt", $loginAttempt + 1);
        $statement->bindValue(":participant", $record->participant);
        $statement->bindValue(":password", $record->password);
        $statement->execute();
    }

    public static function checkLoginValidity7D($record): bool
    {
        $tableName = "7dcandetails";
        $statement = self::prepare("SELECT last_login,classFrom FROM $tableName WHERE participant = :participant AND password = :password");
        $statement->bindValue(":participant", $record->participant);
        $statement->bindValue(":password", $record->password);
        $statement->execute();
        $result = $statement->fetch(Application::$app->db->pdo::FETCH_ASSOC);
//        if ($result) {
        // Now you can access the last_login value in the $lastLogin variable
        $lastLoginTime = strtotime($result['last_login']);
//            echo $result['last_login'];
//            echo '<pre>';
//            var_dump($result['last_login']);
//            echo '</pre>';
        $currentTime = strtotime(self::getCurrentUTCDateTime());
//            echo self::getCurrentUTCDateTime();
//            echo '<pre>';
//            var_dump(self::getCurrentUTCDateTime());
//            echo '</pre>';
        $diffInSeconds = $currentTime - $lastLoginTime;
//            echo '<pre>';
//            var_dump($diffInSeconds);
//            echo '</pre>';

        if ($result['classFrom'] == 1) {
            return true;
        }


        if ($diffInSeconds <= 172800) {
            //echo "Session is expired.";
            return true;
        } else {
            echo "Session is expired.";
            return false;
            //return false;
        }
//        }
    }

    public static function checkLoginValidity($record): bool
    {
        $tableName = "candidatedetails";
        $statement = self::prepare("SELECT last_login,classFrom FROM $tableName WHERE participant = :participant AND password = :password");
        $statement->bindValue(":participant", $record->participant);
        $statement->bindValue(":password", $record->password);
        $statement->execute();
        $result = $statement->fetch(Application::$app->db->pdo::FETCH_ASSOC);
//        if ($result) {
        // Now you can access the last_login value in the $lastLogin variable
        $lastLoginTime = strtotime($result['last_login']);
//            echo $result['last_login'];
//            echo '<pre>';
//            var_dump($result['last_login']);
//            echo '</pre>';
        $currentTime = strtotime(self::getCurrentUTCDateTime());
//            echo self::getCurrentUTCDateTime();
//            echo '<pre>';
//            var_dump(self::getCurrentUTCDateTime());
//            echo '</pre>';
        $diffInSeconds = $currentTime - $lastLoginTime;
//            echo '<pre>';
//            var_dump($diffInSeconds);
//            echo '</pre>';

        if ($result['classFrom'] == 1) {
            return true;
        }


        if ($diffInSeconds <= 172800) {
            //echo "Session is expired.";
            return true;
        } else {
            echo "Session is expired.";
            return false;
            //return false;
        }
//        }
    }

    public static function updateLastLoginField7D($record)
    {
        $tableName = "7dcandetails";
        $utcDateTime = self::getCurrentUTCDateTime();
        $statement = self::prepare("UPDATE $tableName SET last_login = :last_login WHERE participant = :participant AND password = :password");
        $statement->bindValue(":last_login", $utcDateTime);
        $statement->bindValue(":participant", $record->participant);
        $statement->bindValue(":password", $record->password);
        $statement->execute();
    }

    public static function updateLastLoginField($record)
    {
        $tableName = "candidatedetails";
        $utcDateTime = self::getCurrentUTCDateTime();
        $statement = self::prepare("UPDATE $tableName SET last_login = :last_login WHERE participant = :participant AND password = :password");
        $statement->bindValue(":last_login", $utcDateTime);
        $statement->bindValue(":participant", $record->participant);
        $statement->bindValue(":password", $record->password);
        $statement->execute();
    }

    static function getCurrentUTCDateTime()
    {
        return gmdate('Y-m-d H:i:s');
    }



    public function addNewEvangelistRecord($data)
    {

        // Accessing the data passed to this function
        $email = $data['email'] ?? null;
        $mobile = $data['mobile'] ?? null;
        $evngName = $data['evangelist'] ?? null;
        $designation = $data['designation'] ?? null;
        $wgroupId = $data['workgroup'] ?? null;

        error_log(print_r($data, true)); // This will log the entire body array




        $tableName = $this->tableName();

        // SQL query to insert the data into the `evangelist_in_review` table
        $statement = self::prepare("INSERT INTO evangelist (evngName, mobile,email,password,designation,wgroupId) 
                  VALUES (:evngName, :mobile, :email, :password, :designation,:wgroupId)");

        $password = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);

        $statement->bindValue(":email", $email);
        $statement->bindValue(":evngName", $evngName);
        $statement->bindValue(":mobile", $mobile);

        $statement->bindValue(":password", $password);
        $statement->bindValue(":designation", $designation);
        $statement->bindValue(":wgroupId", $wgroupId);
        error_log(print_r($statement, true)); // This will log the entire body array
        $statement->execute();


    }


    public function updateMemberRecord($status,$rejectedReason,$zion_id)
    {
        $tableName = $this->tableName();
        $updatedBy=Application::$app->session->get('loginForm')->username;
        error_log(print_r($tableName, true)); // This will log the entire body array
        $statement = self::prepare("UPDATE $tableName SET status = :status, reject_reason = :reject_reason, updatedBy = :updatedBy, updated_date = NOW() WHERE zion_id = :zion_id");
        //$statement = self::prepare("UPDATE $tableName SET last_login = :last_login WHERE participant = :participant AND password = :password");


        error_log(print_r($status, true));
        $statement->bindValue(":status", $status);
        $statement->bindValue(":reject_reason", $rejectedReason);
        $statement->bindValue(":zion_id", $zion_id);
        $statement->bindValue(":updatedBy", $updatedBy);

        $statement->execute();
    }

    public function findEvangelistMain1($mobile,$email)
    {
        $tableName = 'evangelist';

        // SQL query to insert the data into the `evangelist_in_review` table
        $statement = self::prepare("SELECT * FROM $tableName WHERE mobile = :mobile OR email = :email");
        $statement->bindValue(":mobile", $mobile);
        $statement->bindValue(":email", $email);

        $result=$statement->execute();
        return $statement->fetchObject(EvangelistModel::class);

    }

    public function findEvangelistTemp($mobile,$email)
    {
        $tableName = $this->tableName();

        // SQL query to insert the data into the `evangelist_in_review` table
        $statement = self::prepare("SELECT * FROM $tableName WHERE mobile = :mobile OR email = :email");
        $statement->bindValue(":mobile", $mobile);
        $statement->bindValue(":email", $email);

        $result=$statement->execute();
        return $statement->fetchObject(EvangelistReviewModel::class);

    }



    public function viewAllRegMembersSoFar()
    {
        $tableName = $this->tableName();

        // SQL query to insert the data into the `evangelist_in_review` table
        $statement = self::prepare("SELECT * FROM $tableName ");
        $referredBy=Application::$app->session->get('loginForm')->username;
        //$statement->bindValue(":referredBy", $referredBy);
        $result=$statement->execute();


        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function viewRegMembersSoFar()
    {
        $tableName = $this->tableName();

        // SQL query to insert the data into the `evangelist_in_review` table
        $statement = self::prepare("SELECT * FROM $tableName where referredBy= :referredBy");
        $referredBy=Application::$app->session->get('loginForm')->username;
        $statement->bindValue(":referredBy", $referredBy);
        $result=$statement->execute();


        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function getRegMembers()
    {
        $tableName = $this->tableName();

        // SQL query to insert the data into the `evangelist_in_review` table
        $statement = self::prepare("SELECT * FROM $tableName");

        $result=$statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
//        return $statement->fetchObject(EvangelistReviewModel::class);


    }

    public function saveMemberRecordViaApi($zion_id, $evngName, $mobile, $photoName, $fellowship, $email,$designation,$wgroup)
    {
        $tableName = $this->tableName();

        $referredBy=Application::$app->session->get('loginForm')->username;

        // SQL query to insert the data into the `evangelist_in_review` table
        $statement = self::prepare("INSERT INTO evangelist_in_review (zion_id, evngName, mobile, photo, fellowship, email,designation,status,referredBy,wgroupId) 
                  VALUES (:zion_id, :evngName, :mobile, :photoName, :fellowship, :email, :designation, :status, :referredBy, :wgroup)");

        $statement->bindValue(":zion_id", $zion_id);
        $statement->bindValue(":evngName", $evngName);
        $statement->bindValue(":mobile", $mobile);

        $statement->bindValue(":photoName", $photoName);
        $statement->bindValue(":fellowship", $fellowship);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":designation", $designation);
        $statement->bindValue(":status", "Pending");
        $statement->bindValue(":referredBy", $referredBy);
        $statement->bindValue(":wgroup", $wgroup);

        $statement->execute();
    }

    public function resetPwd($email, $password)
    {
        $tableName = 'evangelist';
        $statement = self::prepare("UPDATE $tableName SET password = :password WHERE email = :email");
        $statement->bindValue(":email", $email);
        $statement->bindValue(":password", $password);
        $statement->execute();


    }

    public function saveRecordViaApi7D($record, $password)
    {

        $tableName = '7dcandetails';
        $attributes = $this->attributes();


        $params = array_map(fn($attr) => ":$attr", $attributes);


        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") 
        VALUES(" . implode(',', $params) . ")");
//        echo '<pre>';
//        var_dump($statement);
//        echo '</pre>';
//
//        echo '<pre>';
//        var_dump($params);
//        echo '</pre>';


        $index = 0;
        foreach ($record as $key => $value) {
//            echo $key;
//            echo $value;

            // newly added code on line 129-131
            if ($key === 'recordDate') {
                // Check if $value is not empty and a valid date
                if (!empty($value) && strtotime($value) !== false) {
                    $value = date('Y-m-d H:i:s', strtotime($value));
                } else {
                    // If $value is empty or not a valid date, set current UTC date-time
                    $value = gmdate('Y-m-d H:i:s');
                }
            }

            if ($key === 'entryDate') {
                $value = date('Y-m-d H:i:s', strtotime($value));
            }


            $statement->bindValue(":$attributes[$index]", $value);
            $index++;
        }
        $classFromInt = (int)$record['classFrom'];
        $statement->bindValue(":classFrom", $classFromInt);
        $statement->bindValue(":password", $password);
//        echo $password;
        $statement->execute();
    }

    public function saveRecordViaApi($record, $password)
    {

        $tableName = $this->tableName();
        $attributes = $this->attributes();


        $params = array_map(fn($attr) => ":$attr", $attributes);


        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") 
        VALUES(" . implode(',', $params) . ")");
//        echo '<pre>';
//        var_dump($statement);
//        echo '</pre>';
//
//        echo '<pre>';
//        var_dump($params);
//        echo '</pre>';


        $index = 0;
        foreach ($record as $key => $value) {
//            echo $key;
//            echo $value;

            // newly added code on line 129-131
            if ($key === 'recordDate') {
                // Check if $value is not empty and a valid date
                if (!empty($value) && strtotime($value) !== false) {
                    $value = date('Y-m-d H:i:s', strtotime($value));
                } else {
                    // If $value is empty or not a valid date, set current UTC date-time
                    $value = gmdate('Y-m-d H:i:s');
                }
            }

            if ($key === 'entryDate') {
                $value = date('Y-m-d H:i:s', strtotime($value));
            }


            $statement->bindValue(":$attributes[$index]", $value);
            $index++;
        }
        $classFromInt = (int)$record['classFrom'];
        $statement->bindValue(":classFrom", $classFromInt);
        $statement->bindValue(":password", $password);
//        echo $password;
        $statement->execute();
    }

    public function saveCandidateViaDataDistribution($mobile,$name, $country, $language, $evangelist, $source, $allotedDays, $mediaType, $activeStatus, $wgroup, $userid, $remark)
    {
        $stmt = self::prepare("
        INSERT INTO candidate (
            mobile, recordDate, participantName, country, language,
            evangelist, source, allotedDays, mediaType, activeStatus,
            userid, remark, wgroup
        ) VALUES (
            :mobile, NOW(), :name, :country, :language,
            :evangelist, :source, :allotedDays, :mediaType, :activeStatus,
            :userid, :remark, :wgroup
        )
    ");

        $stmt->bindValue(":mobile", $mobile);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":country", $country);
        $stmt->bindValue(":language", $language);
        $stmt->bindValue(":evangelist", $evangelist);
        $stmt->bindValue(":source", $source);
        $stmt->bindValue(":allotedDays", $allotedDays);
        $stmt->bindValue(":mediaType", $mediaType);
        $stmt->bindValue(":activeStatus", $activeStatus);
        $stmt->bindValue(":userid", $userid);
        $stmt->bindValue(":remark", $remark);
        $stmt->bindValue(":wgroup", $wgroup);

        if ($stmt->execute()) {
            //echo json_encode(["success" => true]);
        } else {
            //echo json_encode(["success" => false, "message" => "DB insert failed"]);
        }
    }

    public function saveRecordViaApi3($record,$candidateModel)
    {
        try {
            $tableName = $this->tableName();
            $attributes = $this->attributes();

            error_log("Entered");


            $params = array_map(fn($attr) => ":$attr", $attributes);

            // Always set the 'recordDate' to the current date and time in UTC format
            $record['recordDate'] = gmdate('Y-m-d H:i:s');


            $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") 
        VALUES(" . implode(',', $params) . ")");
//        echo '<pre>';
//        var_dump($statement);
//        echo '</pre>';


            $index = 0;
            foreach ($record as $key => $value) {
                //echo $key;
                //echo $value;

                // uncomment this code if you want record date to be stored based on input
//            if ($key === 'recordDate') {
//                $value = date('Y-m-d H:i:s', strtotime($value));
//            }

                $statement->bindValue(":$attributes[$index]", $value);
                $index++;
            }
            $statement->execute();

        }
        catch (\Exception $e) {
            // Check for duplicate entry error (MySQL error code 1062)
            if ($e->getCode() == 23000) { // 23000 is the generic SQL state code for constraint violations
                //echo "Validation error: Mobile number already exists.";
                error_log("Entered2");
                $duplicateField = 'mobileNumber'; // Change this to the actual attribute causing the error
                $candidateModel->addError($duplicateField, self::RULE_UNIQUE, ['field' => $duplicateField]);
                error_log("Entered3");
                //return;
            } else {
                // Log or handle other database errors
                error_log("Entered4");
                echo "Database error: " . $e->getMessage();
            }
        }
    }

    public function saveRecordViaApi47D($record)
    {


        $tableName = "7dcandidate";
        //$utcDateTime = self::getCurrentUTCDateTime();
        //$statement = self::prepare("UPDATE $tableName SET last_login = :last_login WHERE participant = :participant AND password = :password");
        $statement = self::prepare("UPDATE $tableName SET country = :country, language = :language, source = :source, mediaType = :mediaType, activeStatus = :activeStatus WHERE participantName = :participantName AND evangelist = :evangelist AND mobile = :mobile");

        $statement->bindValue(":country", $record['country']);
        $statement->bindValue(":language", $record['language']);
        $statement->bindValue(":source", $record['source']);
        $statement->bindValue(":mediaType", $record['mediaType']);
        $statement->bindValue(":activeStatus", $record['activeStatus']);

        $statement->bindValue(":participantName", $record['participantName']);
        $statement->bindValue(":evangelist", $record['evangelist']);
        $statement->bindValue(":mobile", $record['mobile']);

        $statement->execute();

        error_log($record['country']);
        error_log($record['language']);
        error_log($record['source']);
        error_log($record['mediaType']);


    }



    public function saveRecordViaApi4($record)
    {


        $tableName = "candidate";
        //$utcDateTime = self::getCurrentUTCDateTime();
        //$statement = self::prepare("UPDATE $tableName SET last_login = :last_login WHERE participant = :participant AND password = :password");
        $statement = self::prepare("UPDATE $tableName SET country = :country, language = :language, source = :source, mediaType = :mediaType, activeStatus = :activeStatus WHERE participantName = :participantName AND evangelist = :evangelist AND mobile = :mobile");

        $statement->bindValue(":country", $record['country']);
        $statement->bindValue(":language", $record['language']);
        $statement->bindValue(":source", $record['source']);
        $statement->bindValue(":mediaType", $record['mediaType']);
        $statement->bindValue(":activeStatus", $record['activeStatus']);

        $statement->bindValue(":participantName", $record['participantName']);
        $statement->bindValue(":evangelist", $record['evangelist']);
        $statement->bindValue(":mobile", $record['mobile']);

        $statement->execute();

        error_log($record['country']);
        error_log($record['language']);
        error_log($record['source']);
        error_log($record['mediaType']);


    }


    public function saveRecordViaApi2($record, $password)
    {
        try {
            $tableName = $this->tableName();
            $attributes = $this->attributes();


            $params = array_map(fn($attr) => ":$attr", $attributes);


            $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") 
        VALUES(" . implode(',', $params) . ")");
//        echo '<pre>';
//        var_dump($statement);
//        echo '</pre>';

            // Log the prepared statement
            error_log("Prepared Statement: " . $statement->queryString);


            $index = 0;
            foreach ($record as $key => $value) {
                echo $key;
                echo $value;
                error_log("Key: $key, Value: $value");

                $statement->bindValue(":$attributes[$index]", $value);
                $index++;
            }
            // Log the password
            error_log("Password: $password");

            $statement->execute();
            return true;
        } catch (\Exception $e) {
            // Handle the exception and set the appropriate HTTP response code
            error_log("Database insertion error: " . $e->getMessage());
            return false; // Return a failure indicator if there's an error
        }
    }


    public static function generateRandomNumber($length = 8)
    {
        $random = "";
        srand((double)microtime() * 1000000);

        $data = "123456123456789071234567890890";
        // $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; // if you need alphabatic also

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;

    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);

    }

    public static function findOne7D($where)
    {
        $tableName = '7dcandetails';
        //$tableName = static::tableName();


//            echo '<pre>';
//            var_dump($tableName);
//            echo '</pre>';

        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {

            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        //return $statement->fetchAll();
        return $statement->fetchObject(static::class);
    }

    public static function getLanguage($mobile)
    {
        $stmt = self::prepare("SELECT language FROM candidate WHERE mobile = :mobile");
        $stmt->bindValue(":mobile", $mobile);
        $stmt->execute();
        return $stmt->fetchColumn() ?: null; // returns language string or null
    }



    public static function isMobileRegistered($mobile)
    {
        $stmt = self::prepare("SELECT COUNT(*) FROM candidate WHERE mobile = :mobile");
        $stmt->bindValue(":mobile", $mobile);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public static function updateStatusTask($mobile, $name, $country, $city, $language, $callDate, $status, $remarks)
    {
        $tableName = 'telecaller_sm';
        $stmt = self::prepare(" UPDATE telecaller_sm 
        SET 
            name = :name,
            country = :country,
            city = :city,
            language = :language,
            callDate = :callDate,
            status = :status,
            remarks = :remarks
        WHERE mobile = :mobile");
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":country", $country);
        $stmt->bindValue(":city", $city);
        $stmt->bindValue(":language", $language);
        $stmt->bindValue(":callDate", $callDate);
        $stmt->bindValue(":status", $status);
        $stmt->bindValue(":remarks", $remarks);
        $stmt->bindValue(":mobile", $mobile);
        return $stmt->execute(); // ✅ Must return to let controller know if it succeeded
    }


    public static function findMob($where)
    {
        $tableName = 'telecaller_sm';
        $conditions = [];
        $params = [];

        foreach ($where as $key => $value) {
            $conditions[] = "$key = :$key";
            $params[":$key"] = $value;
        }

        $whereClause = implode(" AND ", $conditions);
        $sql = "SELECT * FROM $tableName WHERE $whereClause LIMIT 1";

        $stmt = self::prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        $stmt->execute();
        return $stmt->fetchObject(static::class);
    }


    public static function findOne($where)
    {
        $tableName = (new \app\models\RegisterModel)->tableName();
        //$tableName = static::tableName();


//            echo '<pre>';
//            var_dump($tableName);
//            echo '</pre>';

        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {

            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        //return $statement->fetchAll();
        return $statement->fetchObject(static::class);
    }

    public static function findOne1($where)
    {
        $tableName = (new \app\models\EvangelistModel())->tableName();
        //$tableName = static::tableName();


//            echo '<pre>';
//            var_dump($tableName);
//            echo '</pre>';

        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {

            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        //return $statement->fetchAll();
        return $statement->fetchObject(static::class);
    }
    public static function findCandidateClassDetails7D($where)
    {
        $tableName = '7dcandetails';
        //$tableName = static::tableName();


//            echo '<pre>';
//            var_dump($tableName);
//            echo '</pre>';

        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        //return $statement->fetchAll();
        return $statement->fetchObject(RegisterModel::class);
    }

    public static function findCandidateClassDetails($where)
    {
        $tableName = (new \app\models\RegisterModel)->tableName();
        //$tableName = static::tableName();


//            echo '<pre>';
//            var_dump($tableName);
//            echo '</pre>';

        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        //return $statement->fetchAll();
        return $statement->fetchObject(RegisterModel::class);
    }

    public static function findCandidateClassDetails1($where)
    {
        $tableName = (new \app\models\EvangelistModel())->tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(EvangelistModel::class);
    }

    public static function findWGroupCount($date,$language)
    {
        $date1 = $date;
        $language1 = $language;

        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "
        SELECT 
    wgroup,
    COUNT(*) AS candidate_count
  
FROM    
    candidate
WHERE 
    DATE(recordDate) = :date  
    AND language = :language  
GROUP BY 
    wgroup;
    ";

        $statement = self::prepare($query);

        $statement->bindParam(':date', $date1, \PDO::PARAM_STR);
        $statement->bindParam(':language', $language1, \PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $data;

    }

    public static function findlanguageCount($date)
    {
        $date1 = $date;
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
        SELECT language, COUNT(*) AS total_classes
        FROM $tableName
        WHERE DATE(recordDate) = :date
        GROUP BY language;
    ";

        $statement = self::prepare($query);

        $statement->bindParam(':date', $date1, \PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $data;



    }

    public static function findDetailedCandidateRecord($activeStatus)
    {

        $tableName = (new \app\models\RegisterModel())->tableName();
        $tableName2 = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
//        $query = "
//      SELECT
//    *
//FROM
//    $tableName2
//WHERE
//    mobile IN (
//        SELECT mobile
//        FROM $tableName
//        WHERE DATE(recordDate) = :recordDate
//        AND language = :language
//        AND wgroup = :wgroup
//    );
//    ";

        $query = "
      SELECT 
    * 
FROM 
    $tableName2  

        WHERE DATE(recordDate) = :recordDate
        AND language = :language 
        AND wgroup = :wgroup
      AND activeStatus = :activeStatus
    ";

        $statement = self::prepare($query);
        $recDate= Application::$app->session->get('date2');
        $language= Application::$app->session->get('language2');
        $wgroup= Application::$app->session->get('wgroup2');

        $statement->bindParam(':recordDate',  $recDate, \PDO::PARAM_STR);
        $statement->bindParam(':language', $language, \PDO::PARAM_STR);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        $statement->bindParam(':activeStatus', $activeStatus, \PDO::PARAM_STR);


        // Execute the statement
        $statement->execute();

//        echo '<pre>';
//        var_dump($recDate);
//        var_dump($language);
//        var_dump($wgroup);
//        echo '<pre>';


        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;


    }

    public static function findStatusWiseGrouping($date,$language,$wgroup)
    {
        $tableName = (new \app\models\RegisterModel())->tableName();
        $tableName2 = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
//        $query = "
//      SELECT c.activeStatus, COUNT(*)
//          AS candidate_count
//      FROM $tableName cd
//          JOIN $tableName2 c ON cd.mobile = c.mobile
//      WHERE DATE(cd.recordDate) = :recordDate
//      AND cd.language = :language
//       AND cd.wgroup = :wgroup
//      GROUP BY c.activeStatus;
//    ";
        $query = "
      SELECT activeStatus, COUNT(*) 
          AS candidate_count 
      FROM $tableName2
      WHERE DATE(recordDate) = :recordDate
      AND language = :language 
       AND wgroup = :wgroup 
      GROUP BY activeStatus;
    ";

        $statement = self::prepare($query);

        $statement->bindParam(':recordDate', $date, \PDO::PARAM_STR);
        $statement->bindParam(':language', $language, \PDO::PARAM_STR);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }

    public static function findCountryWiseStatusGrouping($country)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
      SELECT 
    activeStatus, 
    COUNT(*) AS total
FROM 
    $tableName
WHERE 
    country = :country
GROUP BY 
    activeStatus;
    ";

        $statement = self::prepare($query);
        $statement->bindParam(':country', $country, \PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }
    public static function findTotalCandidatesForEvngCoord($EvngCordName)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "SELECT GName from $tableName WHERE 
       EvngCordName = :EvngCordName
        ";

    }

    public static function findAllEvangelistsDetailedCandidatesForGroupLeader($wgroup,$evangelist)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
//        $query1 = "
//      SELECT
//   *
//FROM
//    $tableName
//WHERE
//    wgroup = :wgroup
//      AND evangelist = :evangelist
//      ;
//    ";

        $query = "

SELECT 
    c.mobile, 
    c.participantName, 
    c.country, 
    c.language, 
    cd.classFrom, 
    cd.classTo, 
    cd.evangelist, 
    cd.feedback,
    c.wgroup  -- Added a comma before this line
FROM 
    candidate c
JOIN 
    candidatedetails cd 
ON 
    c.mobile = cd.mobile 
WHERE 
    c.wgroup = :wgroup 
    AND c.evangelist = :evangelist ;
    ";


        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        $statement->bindParam(':evangelist', $evangelist, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }

    public static function findAllEvangelistsClassRequestsForGroupLeader($wgroup)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query

        $query = "

SELECT 
    c.mobile, 
    c.participantName, 
    c.country, 
    c.language, 
    cd.classFrom, 
    cd.classTo, 
    cd.evangelist, 
    cd.feedback,
    c.wgroup  -- Added a comma before this line
FROM 
    candidate c
JOIN 
    candidatedetails cd 
ON 
    c.mobile = cd.mobile 
WHERE 
    c.wgroup = :wgroup 
    ";


        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }


    public static function findAllCountrywiseEvangelistsDataForGroupLeaderGroupDetailed($wgroup,$country)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
      SELECT 
   *
FROM 
    $tableName
WHERE 
    wgroup = :wgroup
AND country = :country
      ;
    ";

        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        $statement->bindParam(':country', $country, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }
    public static function findAllCountrywiseEvangelistsDataForGroupLeaderGroup($wgroup)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
      SELECT 
    country, 
    COUNT(*) AS total
FROM 
    $tableName
WHERE 
    wgroup = :wgroup
      GROUP BY 
    country
      ;
    ";

        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;


    }

    public static function findAllEvangelistsForGroupLeader($wgroup)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
      SELECT 
   distinct evangelist
FROM 
    $tableName
WHERE 
    wgroup = :wgroup
      ;
    ";

        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }

    public static function findEvangelistCandidateDetailsForWgroupEvngCoord($wgroup,$evangelist)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
      SELECT 
   *
FROM 
    $tableName
WHERE 
    wgroup = :wgroup
AND evangelist = :evangelist
      ;
    ";

        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        $statement->bindParam(':evangelist', $evangelist, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;
    }

    public static function findEvangelistCandidatesForWgroupEvngCoord($wgroup)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
      SELECT 
    evangelist, 
    COUNT(*) AS total
FROM 
    $tableName
WHERE 
    wgroup = :wgroup
GROUP BY 
    evangelist;
    ";

        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }

    public static function findEvangelistCandidatesForEvngCoord($wgroup, $country,$evangelist)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "
      SELECT
        *
      FROM
        $tableName
      WHERE
      wgroup = :wgroup
      AND country = :country
      AND evangelist = :evangelist
    ";

        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        $statement->bindParam(':country', $country, \PDO::PARAM_STR);
        $statement->bindParam(':evangelist', $evangelist, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }

    public static function findEvangelistGroupingCountForEvngCoord($wgroup, $country)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "
      SELECT
        evangelist,
        COUNT(*) AS total
      FROM
        $tableName
      WHERE
       wgroup = :wgroup
      AND country = :country
      GROUP BY
        evangelist;
    ";

        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        $statement->bindParam(':country', $country, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;
    }


    public static function findLanguageGroupingCountForEvngCoord($wgroup)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "
      SELECT
        country,
        COUNT(*) AS total
      FROM
        $tableName
      WHERE
       wgroup = :wgroup
      GROUP BY
        country;
    ";

        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;
    }

    public static function findWGroupWiseCountsForEvngCoord($wgroups)
    {
        // Extract the group names from the array
        $groupNames = array_map(fn($group) => $group['GName'], $wgroups);


        // Prepare placeholders for the SQL query
        $placeholders = implode(',', array_fill(0, count($groupNames), '?'));

        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "
      SELECT
        wgroup,
        COUNT(*) AS total
      FROM
        $tableName
      WHERE
       wgroup IN ($placeholders)
      GROUP BY
        wgroup;
    ";



//        // Log the query for debugging
//        error_log("Generated SQL Query: $query");
//        error_log("Bound Parameters: " . implode(', ', $groupNames));

        $statement = self::prepare($query);
        //$statement->bindParam(':wgroup', $placeholders, \PDO::PARAM_STR);

        $statement->execute($groupNames);

        // Fetch and return the results
        $groups = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $groups;

    }
    public static function findWGroupForGroupLeader($groupLeaderName)
    {
        $tableName = (new \app\models\EvangelistModel())->tableName();
        $query = "SELECT wgroup from $tableName WHERE 
       evngName = :evngName
        ";
        $statement = self::prepare($query);
        $statement->bindParam(':evngName', $groupLeaderName, \PDO::PARAM_STR);


        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $group = $statement->fetch(\PDO::FETCH_ASSOC);
        echo '<pre>';
        var_dump($group);
        echo '</pre>';
        return $group;

    }

    public static function findTotalWGroupForEvngCoord($EvngCordName)
    {
        $tableName = (new \app\models\WGroupModel())->tableName();
        $query = "SELECT GName from $tableName WHERE 
       EvngCordName = :EvngCordName
        ";

        $statement = self::prepare($query);
        $statement->bindParam(':EvngCordName', $EvngCordName, \PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $groups = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $groups;
    }

    public static function getAllAppointmentsSR()
    {
        $pdo = Application::$app->db->pdo;
        $stmt = $pdo->prepare("SELECT * FROM appointments where sathvartha_ready_status = 'Ready' ORDER BY appointment_datetime_ist DESC");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getAllAppointmentsIF()
    {
        $pdo = Application::$app->db->pdo;
        $stmt = $pdo->prepare("SELECT * FROM appointments where fellowship_status = 'In Fellowship' ORDER BY appointment_datetime_ist DESC");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function getAllAppointments()
    {
        $pdo = Application::$app->db->pdo;
        $stmt = $pdo->prepare("SELECT * FROM appointments ORDER BY appointment_datetime_ist DESC");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getAppointmentsById($id)
    {
        $pdo = Application::$app->db->pdo;
        $stmt = $pdo->prepare("SELECT * FROM appointments WHERE id = :id ORDER BY appointment_datetime_ist DESC");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function getAppointmentsByParticipant($mobile)
    {
        $pdo = Application::$app->db->pdo;
        $stmt = $pdo->prepare("SELECT * FROM appointments WHERE candidate_mobile = :mobile ORDER BY appointment_datetime_ist DESC");
        $stmt->bindParam(':mobile', $mobile);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function getEvangelistDetails($lang, $country, $participantName, $evangelist)
    {
        $tableName = 'candidate'; // Updated table name

        $query = "SELECT 
                mobile,
                recordDate,
                participantName,
                country,
                language,
                evangelist,
                source,
                allotedDays,
                mediaType,
                activeStatus,
                userid,
                remark,
                wgroup
              FROM $tableName
              WHERE language = :lang 
                AND country = :country 
                AND evangelist = :evangelist
                AND participantName = :participantName";

        $statement = self::prepare($query);
        $statement->bindValue(':lang', $lang);
        $statement->bindValue(':country', $country);
        $statement->bindValue(':participantName', $participantName);
        $statement->bindValue(':evangelist', $evangelist);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getCandidatesByEvangelist($lang, $country, $evangelist)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();

        $query = "SELECT participantName FROM $tableName 
              WHERE language = :lang AND country = :country AND evangelist = :evangelist";

        $statement = self::prepare($query);
        $statement->bindValue(':lang', $lang);
        $statement->bindValue(':country', $country);
        $statement->bindValue(':evangelist', $evangelist);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }



    public static function getEvangelistsByLangAndCountry($lang, $country)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "SELECT evangelist, COUNT(*) as count 
              FROM $tableName 
              WHERE language = :lang AND country = :country 
              GROUP BY evangelist";

        $statement = self::prepare($query);
        $statement->bindValue(':lang', $lang);
        $statement->bindValue(':country', $country);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }



    public static function getCountriesByLanguage($lang)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "SELECT country, COUNT(*) as count FROM $tableName WHERE language = :lang GROUP BY country";
        $statement = self::prepare($query);
        $statement->bindValue(':lang', $lang);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function updateChangedAppointmentFields($candidateMobile, $filteredData,$debug = false)
    {
        $pdo = Application::$app->db->pdo;

        // Build the SET clause dynamically
        $fieldsToUpdate = [];
        $params = [];

        foreach ($filteredData as $column => $value) {
            $fieldsToUpdate[] = "$column = ?";
            $params[] = $value;
        }

        // If nothing to update, exit
        if (empty($fieldsToUpdate)) {
            return false;
        }

        // Always update the updated_at timestamp
        $fieldsToUpdate[] = "updated_at = NOW()";

        // Add candidate mobile for WHERE clause
        $params[] = $candidateMobile;

        // Final SQL
        $sql = "UPDATE appointments SET " . implode(', ', $fieldsToUpdate) . " WHERE candidate_mobile = ?";

        if ($debug) {
            error_log("DEBUG SQL: $sql");
            error_log("DEBUG PARAMS: " . print_r($params, true));
        }

        $stmt = self::prepare($sql);

        return $stmt->execute($params);
    }


    public static function findCandidatesCountLanguageWise()
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "SELECT language, COUNT(*) as count
FROM $tableName
GROUP BY language;";
        $statement = self::prepare($query);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }

    public static function findAllCandidates($offset = 0, $limit = 10)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $tableName2 = 'online_sathvartha';

        $query = "SELECT
                c.mobile, c.recordDate, c.participantName, c.country,
                c.language, c.evangelist, c.source, c.allotedDays,
                c.mediaType, c.activeStatus, c.userid, c.wgroup,
                os.location, os.attendedDate, os.feedback
              FROM $tableName AS c
              LEFT JOIN $tableName2 AS os ON c.mobile = os.mobile
              ORDER BY c.recordDate DESC  -- Ensure consistent ordering
              LIMIT :limit OFFSET :offset";

        $statement = self::prepare($query);
        $statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function searchCandidates($search, $offset, $limit)
    {
        $offset = (int)$offset;
        $limit = (int)$limit;

        $sql = "SELECT
            c.mobile, c.recordDate, c.participantName, c.country,
            c.language, c.evangelist, c.source, c.allotedDays,
            c.mediaType, c.activeStatus, c.userid, c.wgroup,
            os.location, os.attendedDate, os.feedback
        FROM candidate AS c
        LEFT JOIN online_sathvartha AS os ON c.mobile = os.mobile
        WHERE (c.participantName LIKE :search OR c.mobile LIKE :search)
        ORDER BY c.participantName ASC
        LIMIT :limit OFFSET :offset";

        $stmt = self::prepare($sql);
        $searchTerm = '%' . $search . '%';

        $stmt->bindValue(':search', $searchTerm, \PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countSearchCandidates($search)
    {
        $sql = "SELECT COUNT(*) as count FROM candidate 
            WHERE (participantName LIKE :search OR mobile LIKE :search)";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC)['count'] ?? 0;
    }


    // Add a method to get total count
    public static function countAllCandidates()
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "SELECT COUNT(*) as total FROM $tableName";

        $statement = self::prepare($query);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return $result['total'];
    }



    public static function bulkReassignDataBankRecords($selectedMobiles, $assignedTo)
    {
        $stmt = self::prepare("UPDATE telecaller_sm SET assignedTo = :assignedTo, status = 'Unassigned' WHERE mobile = :mobile");

        foreach ($selectedMobiles as $mobile) {
            $stmt->execute([
                ':mobile' => $mobile,
                ':assignedTo' => $assignedTo
            ]);

            if ($stmt->rowCount() === 0) {
                error_log("⚠️ No record found to reassign for mobile: $mobile");
            } else {
                error_log("✅ Reassigned $mobile to $assignedTo");
            }
        }
    }


    public static function bulkAssignDataBankRecords($selectedMobiles,$contacts,$assignedTo)
    {

        $tableName = (new \app\models\DataBankModel())->tableName();
        foreach ($selectedMobiles as $mobile) {
            // Skip if mobile data is missing
            if (!isset($contacts[$mobile])) {
                continue;
            }

            $c = $contacts[$mobile];

            $stmt = self::prepare("
            INSERT IGNORE INTO telecaller_sm (
                mobile, name, record_date, type, email, source, country,
                city, referred_by, group_name, fellowship, language,
                assignedTo, status
            ) VALUES (
                :mobile, :name, :record_date, :type, :email, :source, :country,
                :city, :referred_by, :group_name, :fellowship, :language,
                :assignedTo, :status
            )
        ");

            $stmt->execute([
                ':mobile' => $mobile,
                ':name' => $c['name'],
                ':record_date' => $c['record_date'],
                ':type' => $c['type'],
                ':email' => $c['email'],
                ':source' => $c['source'],
                ':country' => $c['country'],
                ':city' => $c['city'],
                ':referred_by' => $c['referred_by'],
                ':group_name' => $c['group_name'],
                ':fellowship' => $c['fellowship'],
                ':language' => $c['language'],
                ':assignedTo' => $assignedTo,
                ':status' => 'Unassigned'
            ]);
        }


    }

    public static function getAllSMDataBankRecordsAfterAssignment()
    {
        $tableName = (new \app\models\TelecallerSMModel())->tableName();
        $query = "SELECT * FROM $tableName where type = 'SM'";

        $statement = self::prepare($query);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, TelecallerSMModel::class);
    }



    public static function getMyTasks($assignedToName)
    {
        $telecallerTable = (new \app\models\TelecallerSMModel())->tableName();
        $query = "SELECT * FROM $telecallerTable WHERE assignedTo = :assignedTo ORDER BY callDate DESC
        ";
        $statement = self::prepare($query);
        $statement->bindValue(':assignedTo', $assignedToName);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getAllSMDataBankRecords()
    {
        $dataBankTable = (new \app\models\DataBankModel())->tableName();
        $telecallerTable = (new \app\models\TelecallerSMModel())->tableName();

        $query = "
        SELECT 
            d.*, 
            t.assignedTo, 
            t.status, 
            t.callDate
        FROM $dataBankTable d
        LEFT JOIN $telecallerTable t ON d.mobile = t.mobile
        WHERE d.type = 'SM'
    ";

        $statement = self::prepare($query);
        $statement->execute();


        return $statement->fetchAll(\PDO::FETCH_CLASS, TelecallerSMModel::class);
    }

    public static function getAllPHONEDataBankRecordsAfterAssignment()
    {
        $tableName = (new \app\models\TelecallerSMModel())->tableName();
        $query = "SELECT * FROM $tableName where type = 'PHONE'";

        $statement = self::prepare($query);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, TelecallerSMModel::class);
    }

    public static function getFilteredSMData($filters = [], $limit = 50, $offset = 0)
    {
        $dataBankTable = (new \app\models\DataBankModel())->tableName();
        $telecallerTable = (new \app\models\TelecallerSMModel())->tableName();

        $where = ["d.type = 'SM'"];
        $params = [];

        // Build dynamic WHERE clauses
        if (!empty($filters['source'])) {
            $where[] = "d.source LIKE ?";
            $params[] = "%" . $filters['source'] . "%";
        }
        if (!empty($filters['country'])) {
            $where[] = "d.country LIKE ?";
            $params[] = "%" . $filters['country'] . "%";
        }
        if (!empty($filters['city'])) {
            $where[] = "d.city LIKE ?";
            $params[] = "%" . $filters['city'] . "%";
        }
        if (!empty($filters['group_name'])) {
            $where[] = "d.group_name LIKE ?";
            $params[] = "%" . $filters['group_name'] . "%";
        }
        if (!empty($filters['fellowship'])) {
            $where[] = "d.fellowship LIKE ?";
            $params[] = "%" . $filters['fellowship'] . "%";
        }
        if (!empty($filters['language'])) {
            $where[] = "d.language LIKE ?";
            $params[] = "%" . $filters['language'] . "%";
        }
        if (!empty($filters['assignedTo'])) {
            $where[] = "t.assignedTo LIKE ?";
            $params[] = "%" . $filters['assignedTo'] . "%";
        }

        if (!empty($filters['status'])) {
            $where[] = "t.status LIKE ?";
            $params[] = "%" . $filters['status'] . "%";
        }


        $whereSql = implode(' AND ', $where);

        // Count total records for pagination
        $countQuery = "SELECT COUNT(*) FROM $dataBankTable d LEFT JOIN $telecallerTable t ON d.mobile = t.mobile WHERE $whereSql";
        $countStmt = self::prepare($countQuery);
        $countStmt->execute($params);
        $totalRecords = $countStmt->fetchColumn();

        // Main data query
        $query = "
        SELECT 
            d.*, 
            t.assignedTo, 
            t.status, 
            t.callDate
        FROM $dataBankTable d
        LEFT JOIN $telecallerTable t ON d.mobile = t.mobile
        WHERE $whereSql
        LIMIT $limit OFFSET $offset
    ";

        $stmt = self::prepare($query);
        $stmt->execute($params);
        $records = $stmt->fetchAll(\PDO::FETCH_CLASS, TelecallerSMModel::class);

        return [
            'records' => $records,
            'totalRecords' => $totalRecords
        ];
    }




    public static function getFilteredTelecallerData($filters = [], $limit = 50, $offset = 0)
    {
        $dataBankTable = (new \app\models\DataBankModel())->tableName();
        $telecallerTable = (new \app\models\TelecallerSMModel())->tableName();

        $where = ["d.type = 'PHONE'"];
        $params = [];

        // Build dynamic WHERE clauses
        if (!empty($filters['source'])) {
            $where[] = "d.source LIKE ?";
            $params[] = "%" . $filters['source'] . "%";
        }
        if (!empty($filters['country'])) {
            $where[] = "d.country LIKE ?";
            $params[] = "%" . $filters['country'] . "%";
        }
        if (!empty($filters['city'])) {
            $where[] = "d.city LIKE ?";
            $params[] = "%" . $filters['city'] . "%";
        }
        if (!empty($filters['group_name'])) {
            $where[] = "d.group_name LIKE ?";
            $params[] = "%" . $filters['group_name'] . "%";
        }
        if (!empty($filters['fellowship'])) {
            $where[] = "d.fellowship LIKE ?";
            $params[] = "%" . $filters['fellowship'] . "%";
        }
        if (!empty($filters['language'])) {
            $where[] = "d.language LIKE ?";
            $params[] = "%" . $filters['language'] . "%";
        }
        if (!empty($filters['assignedTo'])) {
            $where[] = "t.assignedTo LIKE ?";
            $params[] = "%" . $filters['assignedTo'] . "%";
        }

        if (!empty($filters['status'])) {
            $where[] = "t.status LIKE ?";
            $params[] = "%" . $filters['status'] . "%";
        }


        $whereSql = implode(' AND ', $where);

        // Count total records for pagination
        $countQuery = "SELECT COUNT(*) FROM $dataBankTable d LEFT JOIN $telecallerTable t ON d.mobile = t.mobile WHERE $whereSql";
        $countStmt = self::prepare($countQuery);
        $countStmt->execute($params);
        $totalRecords = $countStmt->fetchColumn();

        // Main data query
        $query = "
        SELECT 
            d.*, 
            t.assignedTo, 
            t.status, 
            t.callDate
        FROM $dataBankTable d
        LEFT JOIN $telecallerTable t ON d.mobile = t.mobile
        WHERE $whereSql
        LIMIT $limit OFFSET $offset
    ";

        $stmt = self::prepare($query);
        $stmt->execute($params);
        $records = $stmt->fetchAll(\PDO::FETCH_CLASS, TelecallerSMModel::class);

        return [
            'records' => $records,
            'totalRecords' => $totalRecords
        ];
    }


    public static function getAllPHONEDataBankRecords()
    {
//        $tableName = (new \app\models\DataBankModel())->tableName();
//        $query = "SELECT * FROM $tableName where type = 'PHONE'";
//
//        $statement = self::prepare($query);
//        $statement->execute();

        $dataBankTable = (new \app\models\DataBankModel())->tableName();
        $telecallerTable = (new \app\models\TelecallerSMModel())->tableName();

        $query = "
        SELECT 
            d.*, 
            t.assignedTo, 
            t.status, 
            t.callDate
        FROM $dataBankTable d
        LEFT JOIN $telecallerTable t ON d.mobile = t.mobile
        WHERE d.type = 'PHONE'
    ";

        $statement = self::prepare($query);
        $statement->execute();


        return $statement->fetchAll(\PDO::FETCH_CLASS, TelecallerSMModel::class);
    }



    public static function findcountrywiseCandidateDetails($country,$activeStatus,$language)
    {

        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "SELECT * from $tableName WHERE 
        country = :country
        AND 
        activeStatus = :activeStatus     
        AND language = :language
        ";

        $statement = self::prepare($query);
        $statement->bindParam(':language', $language, \PDO::PARAM_STR);
        $statement->bindParam(':country', $country, \PDO::PARAM_STR);
        $statement->bindParam(':activeStatus', $activeStatus, \PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;





    }

    public static function findCountrywiseLanguageGrouping($country,$activeStatus)
    {

        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
        SELECT 
    language AS Language,
    COUNT(*) AS languageCount
FROM 
    $tableName
WHERE 
    country = :country
AND 
    activeStatus = :activeStatus
GROUP BY 
    language
ORDER BY 
    language;
    ";




        $statement = self::prepare($query);
        $statement->bindParam(':country', $country, \PDO::PARAM_STR);
        $statement->bindParam(':activeStatus', $activeStatus, \PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;


    }

    public static function findCountryGrouping()
    {

        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
        SELECT 
    country AS Country,
    COUNT(*) AS countryCount
FROM 
    $tableName
GROUP BY 
    country
ORDER BY 
    country;
    ";

        $statement = self::prepare($query);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }

    public static function findtotalStatusWiseDetailedRecords($activeStatus)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "
        SELECT 
   *
FROM 
    $tableName
WHERE
    activeStatus = :activeStatus

    ";
        $statement = self::prepare($query);
        $statement->bindParam(':activeStatus', $activeStatus, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }


    public static function findtotalStatusWiseGrouping()
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $query = "
        SELECT 
    activeStatus AS activeStatus,
    COUNT(*) AS activeStatusCount
FROM 
    $tableName
GROUP BY 
    activeStatus
ORDER BY 
    activeStatus;
    ";
        $statement = self::prepare($query);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $data;

    }

    public static function findtotalGTCWiseStatusWiseDetailedRecords($activeStatus,$wgroup)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
        SELECT 
   *
        
FROM 
    $tableName
where wgroup = :wgroup
and activeStatus = :activeStatus
    ";
        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        $statement->bindParam(':activeStatus', $activeStatus, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $data;


    }


    public static function findGTCWiseStatusCounts($wgroup)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
        SELECT 
    activeStatus AS activeStatus,
    COUNT(*) AS activeStatusCount
FROM 
    $tableName
where wgroup = :wgroup
GROUP BY 
    activeStatus
ORDER BY 
    activeStatus;
    ";

        $statement = self::prepare($query);
        $statement->bindParam(':wgroup', $wgroup, \PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }

    public static function findGTCWiseGrouping()
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
        SELECT 
    wgroup AS wgroup,
    COUNT(*) AS wgroupCount
FROM 
    $tableName
GROUP BY 
    wgroup
ORDER BY 
    wgroup;
    ";
        $statement = self::prepare($query);
        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }

    public static function findTotalLanguageGroupingWiseCandidateDetails($language)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "SELECT * from $tableName WHERE language = :language";
        $statement = self::prepare($query);
        $statement->bindParam(':language', $language, \PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;
    }
    public static function findTotalLanguageGrouping()
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
        SELECT 
    language AS Language,
    COUNT(*) AS languageCount
FROM 
    $tableName
GROUP BY 
    language
ORDER BY 
    language;
    ";

        $statement = self::prepare($query);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;


    }

    public static function findlanguageGrouping()
    {

        $tableName = (new \app\models\CandidateModel())->tableName();
        // Build the SQL query
        $query = "
        SELECT 
    DATE(recordDate) AS Date,
    COUNT(*) AS classCount
FROM 
    candidate
GROUP BY 
    DATE(recordDate)
ORDER BY 
    DATE(recordDate);
    ";

        $statement = self::prepare($query);

        // Execute the statement
        $statement->execute();

        // Fetch and return the results
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);



        return $data;

    }


    public static function findtotalReportingCount()
    {
        $tableName = (new \app\models\CandidateModel())->tableName();

        // Define status constants to avoid magic strings

        // Build the SQL query
        $query = "
        SELECT 
            (SELECT COUNT(DISTINCT country) FROM $tableName) AS total_countries,
            (SELECT COUNT(*) FROM $tableName) AS total_participants,
            (SELECT COUNT(*) FROM $tableName WHERE activeStatus IN (:status_withdrawn, :status_exit, :status_inactive)) AS total_part_withdrawn_exit_inactive,
            (SELECT COUNT(*) FROM $tableName WHERE activeStatus = :status_completed) AS completed,
            (SELECT COUNT(*) FROM $tableName WHERE activeStatus = :status_active) AS active,
            (SELECT COUNT(*) FROM $tableName WHERE activeStatus = :status_inactive) AS inactive,
            (SELECT COUNT(*) FROM $tableName WHERE activeStatus = :status_withdrawn) AS withdrawn,
            (SELECT COUNT(*) FROM $tableName WHERE activeStatus = :status_exit) AS exit_drop_out
    ";

        try {
            // Prepare the statement
            $statement = self::prepare($query);
            if ($statement === false) {
                throw new \Exception('Statement preparation failed.');
            }

            // Bind parameters to avoid SQL injection
            $statement->bindValue(':status_withdrawn', self::STATUS_WITHDRAWN);
            $statement->bindValue(':status_exit', self::STATUS_EXIT);
            $statement->bindValue(':status_inactive', self::STATUS_INACTIVE);
            $statement->bindValue(':status_completed', self::STATUS_COMPLETED);
            $statement->bindValue(':status_active', self::STATUS_ACTIVE);

            // Execute the statement
            $statement->execute();

            // Fetch and return the results
            $counts = $statement->fetch(\PDO::FETCH_ASSOC);

            return $counts;
        } catch (\PDOException $e) {
            // Log SQL errors
            error_log('SQL Error: ' . $e->getMessage());
            return null;
        } catch (\Exception $e) {
            // Log other errors
            error_log('Error: ' . $e->getMessage());
            return null;
        }
     }

    public static function saveRecordIn7DCandidate($data)
    {
        $tableName = '7dcandidate';

        // Prepare and execute the SQL query
        $statement = self::prepare("INSERT INTO $tableName (mobile, recordDate, participantName, country, language, evangelist, source, allotedDays,mediaType,activeStatus,userid,remark,wgroup,caretaker_email,updatedBy) 
            VALUES (:mobile, :recordDate, :participantName,:country,:language,:evangelist,:source,:allotedDays,:mediaType,:activeStatus,:userid,:remark,:wgroup,:caretaker_email,:updatedBy)");


        //echo $data['mobile'];
// Example: Accessing individual fields
        $mobile = $data['mobile'] ?? null;
        $recordDate = $data['recordDate'] ?? null;
        $participantName = $data['participantName'] ?? null;
        $country = $data['country'] ?? null;
        $language = $data['language'] ?? null;
        $evangelist = $data['evangelist'] ?? null;
        $source = $data['source'] ?? null;
        $allotedDays = $data['allotedDays'] ?? null;
        $mediaType = $data['mediaType'] ?? null;
        $activeStatus = $data['activeStatus'] ?? null;
        $userid = $data['userid'] ?? null;
        $remark = $data['remark'] ?? null;
        $wgroup = $data['wgroup'] ?? null;
        $updatedBy =Application::$app->session->get('nameFinal');
        $caretakerEmail = $data['caretaker_email'] ?? null;
        $statement->bindValue(':mobile', $mobile);
        $statement->bindValue(':recordDate', $recordDate);
        $statement->bindValue(':participantName', $participantName);
        $statement->bindValue(':country', $country);
        $statement->bindValue(':language', $language);
        $statement->bindValue(':evangelist', $evangelist);
        $statement->bindValue(':source', $source);
        $statement->bindValue(':allotedDays', $allotedDays);
        $statement->bindValue(':mediaType', $mediaType);
        $statement->bindValue(':activeStatus', 'Active');
        $statement->bindValue(':userid', $userid);
        $statement->bindValue(':remark', $remark);
        $statement->bindValue(':wgroup', $wgroup);
        $statement->bindValue(':caretaker_email', $caretakerEmail);
        $statement->bindValue(':updatedBy', $updatedBy);

        if ($statement->execute()) {
            //echo json_encode(["success" => true]);
        } else {
            //echo json_encode(["success" => false, "error" => $statement->errorInfo()[2]]);
        }
        return true;
    }

    public static function findAllApprovedCandidatesFor7D()
    {
        $tableName = '7dcandidate';
        $statement = self::prepare("SELECT * FROM $tableName");        //$statement->bindValue(':activeStatus', 'Ready for 7D Sathvartha');
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, CandidateModel::class);
    }

    public static function findAllCandidatesFor7D()
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $statement = self::prepare("SELECT * FROM $tableName WHERE activeStatus = 'Ready for 7D Sathvartha' AND mobile NOT IN (
    SELECT mobile FROM 7dcandidate
)");        //$statement->bindValue(':activeStatus', 'Ready for 7D Sathvartha');
        $statement->execute();
       return $statement->fetchAll(\PDO::FETCH_CLASS, CandidateModel::class);
    }



    public static function loadDataBank($rows,$header,$errorFile,$outputFile,$processId)
    {

        $mobileSet = [];
        $inserted = 0;
        $skipped = 0;

        foreach ($rows as $index => $row) {
            $row = array_map('trim', $row);
            $assoc = array_combine($header, $row);
            $mobile = $assoc['mobile'];
            $name = $assoc['name'];
            $record_date = $assoc['record_date'];
            if (empty($record_date)) {
                $record_date = date('Y-m-d H:i:s'); // Or 'Y-m-d' if only date is needed
            }
            $telecallerInput = $assoc['mobile'];
            if (
                // Matches +91 98765 43210 or 98765-43210 or similar
                preg_match('/^\+?\d[\d\s\-]{5,}$/', $telecallerInput)
                ||
                // Accept plain digit-only mobile numbers like 123460 (min 6 digits)
                preg_match('/^\d{6,}$/', $telecallerInput)
            ) {
                $type = 'PHONE';
            } elseif (filter_var($telecallerInput, FILTER_VALIDATE_URL)) {
                $type = 'SM';
            } else {
                $type = 'NA'; // fallback if neither
            }
            $email = $assoc['email'];
            $source = $assoc['source'];
            $country = $assoc['country'];
            $city = $assoc['city'];
            $referredBy = $assoc['referredBy'];
            $group_name = $assoc['group_name'];
            $fellowship = $assoc['fellowship'];
            $language = $assoc['language'];

            if (empty($mobile) || isset($mobileSet[$mobile])) {
                $skipped++;
                file_put_contents($errorFile, implode(",", $row) . ",Duplicate or empty mobile\n", FILE_APPEND);
                continue;
            }


            // Check DB uniqueness
            $stmt = self::prepare("SELECT COUNT(*) FROM data_bank WHERE mobile = :mobile");
            $stmt->bindValue(':mobile', $mobile);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) {
                $skipped++;
                file_put_contents($errorFile, implode(",", $row) . ",Mobile exists in DB\n", FILE_APPEND);
                continue;
            }

            try {
                $statement = self::prepare("INSERT INTO data_bank (
    mobile, name, record_date, type, email, source, country, city, 
    referred_by, group_name, fellowship, language
) VALUES (
    :mobile, :name, :record_date, :type, :email, :source, :country, :city,
    :referred_by, :group_name, :fellowship, :language
)");

            $statement->bindValue(':mobile', $mobile);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':record_date', $record_date);
            $statement->bindValue(':type', $type);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':source', $source);
            $statement->bindValue(':country', $country);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':referred_by', $referredBy);
            $statement->bindValue(':group_name', $group_name);
            $statement->bindValue(':fellowship', $fellowship);
            $statement->bindValue(':language', $language);
            $success = $statement->execute();

                $inserted++;
                $mobileSet[$mobile] = true;
                file_put_contents($outputFile, implode(",", $row) . "\n", FILE_APPEND);
            } catch (\PDOException $e) {
                // ✅ Log any insert error to error file, don't crash app
                $skipped++;
                file_put_contents($errorFile, implode(",", $row) . ",DB insert error: " . $e->getMessage() . "\n", FILE_APPEND);
                continue;
            }


        }

        // Set status based on result
        $statusFinal = ($inserted > 0) ? 'Completed' : 'Failed';

        // Update process log

        $total = count($rows);
        $statement3 = self::prepare("UPDATE upload_process_log SET status = :status,inserted_rows= :inserted_rows,skipped_rows =:skipped_rows,total_rows= :total_rows WHERE process_id  = :process_id ");

        $statement3->bindValue(':status', ($inserted > 0) ? 'Completed' : 'Failed');
        $statement3->bindParam(':inserted_rows', $inserted);
        $statement3->bindParam(':skipped_rows', $skipped);
        $statement3->bindParam(':total_rows', $total);
        $statement3->bindParam(':process_id', $processId);


        $statement3->execute();


    }


    public static function getUploadsByUser($evngName)
    {

        $tableName = 'upload_process_log';
        $statement = self::prepare("SELECT * FROM $tableName WHERE uploadedBy = :username ORDER BY upload_time DESC");
        $statement->bindValue(':username', $evngName);
        $statement->execute();
        //return $statement->fetchAll(\PDO::FETCH_ASSOC);
        $uploadedFiles = $statement->fetchAll(\PDO::FETCH_CLASS, UploadProcessLogModel::class);
        return $uploadedFiles;
    }

    public static function uploadProcessId($processId, $evngName,$uploadTime, $status, $errorFile, $outputFile)
    {
        $tableName = 'upload_process_log';

        // Prepare and execute the SQL query
        $statement = self::prepare("INSERT INTO $tableName (process_id, uploadedBy, upload_time, status, total_rows, inserted_rows, skipped_rows, error_file, output_file) 
            VALUES (:process_id, :uploadedBy,:upload_time, :status, :total_rows, :inserted_rows, :skipped_rows, :error_file, :output_file)");

        $statement->bindValue(':process_id', $processId);
        $statement->bindValue(':uploadedBy', $evngName);
        $statement->bindValue(':upload_time', $uploadTime);
        $statement->bindValue(':status', $status);
        $statement->bindValue(':total_rows', 0, \PDO::PARAM_INT);
        $statement->bindValue(':inserted_rows', 0, \PDO::PARAM_INT);
        $statement->bindValue(':skipped_rows', 0, \PDO::PARAM_INT);
        $statement->bindValue(':error_file', $errorFile);
        $statement->bindValue(':output_file', $outputFile);

       $statement->execute();


    }

    public static function findAllCandidatesForEvangelist7D($where,$name)
    {
        $tableName = '7dcandidate';
        //s$attributes = array_keys($where);
        $statement = self::prepare("
    SELECT * 
    FROM $tableName 
    WHERE caretaker_email = '$name' 
    ORDER BY 
        CASE activeStatus
            WHEN 'Completed' THEN 1
            WHEN 'Withdrawn' THEN 2
            WHEN 'Active' THEN 3
            WHEN 'Inactive' THEN 4
           WHEN 'Exit/Drop-out' THEN 5
            ELSE 6  -- To handle any other statuses, if needed
        END ASC
");




        $statement->execute();
        // Fetch all rows instead of just one
        $candidates = $statement->fetchAll(\PDO::FETCH_CLASS, CandidateModel7D::class);

//        echo '<pre>';
//        var_dump($candidates);
//        echo '</pre>';
        return $candidates;
    }


    public static function getCandidateByMobile($mobile)
    {
        $tableName = 'candidate';
        $statement = self::prepare("SELECT * FROM $tableName WHERE mobile = :mobile LIMIT 1"); // Ensure single record
        $statement->bindValue(':mobile', $mobile);
        // Execute the statement
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }


    public static function verifyOnlineSathvarthaStatus($mobile)
    {
        $tableName = 'online_sathvartha';
        $statement = self::prepare("SELECT mobile FROM $tableName WHERE mobile = :mobile LIMIT 1"); // Ensure single record
        $statement->bindValue(':mobile', $mobile);
        // Execute the statement
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_COLUMN) ?: null; // Return null if not found

    }

    public static function getMaxClassFromForCandidate($mobile)
    {
        $tableName = (new \app\models\RegisterModel())->tableName();
        error_log("Getting max classFrom for mobile: " . $mobile);
        error_log("Using table: " . $tableName);

        $statement = self::prepare("SELECT MAX(classFrom) FROM $tableName WHERE mobile = :mobile");
        $statement->bindValue(':mobile', $mobile);

        $executed = $statement->execute();
        error_log("Statement executed: " . ($executed ? 'true' : 'false'));

        $result = $statement->fetchColumn();
        error_log("Fetched max classFrom: " . var_export($result, true));

        return $result;
    }


    public static function getClassNumbersForCandidate($mobile)
{
    $tableName = (new \app\models\RegisterModel())->tableName();
    $statement = self::prepare("SELECT classFrom FROM $tableName WHERE mobile = :mobile");
    $statement->bindValue(':mobile', $mobile);
    // Execute the statement
    $statement->execute();
    return $statement->fetchAll(\PDO::FETCH_COLUMN); // Fetch all values as an array
}


    public static function getWordSessionsByMobileApproval($mobile)
    {
        $stmt = self::prepare("
        SELECT assigned_to, status, created_at FROM word_sharing_approval WHERE mobile = :mobile ORDER BY created_at DESC
    ");
        $stmt->bindValue(':mobile', $mobile);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, WordSharingApprovalModel::class);
    }



    public static function updateTelecallerReassigned($mobile, $assignedTo)
    {
        $table = 'telecaller_sm';
        $stmt = self::prepare("UPDATE $table SET reassignedTo = :assignedTo WHERE mobile = :mobile");
        $stmt->bindValue(':assignedTo', $assignedTo);
        $stmt->bindValue(':mobile', $mobile);
        $stmt->execute();
    }

    public static function updateStatus($mobile, $assignedTo, $status)
    {
        $table = 'word_sharing_approval';
        $stmt = self::prepare("UPDATE $table SET status = :status, updated_at = NOW() WHERE mobile = :mobile AND assigned_to = :assignedTo");
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':mobile', $mobile);
        $stmt->bindValue(':assignedTo', $assignedTo);
        $stmt->execute();
    }

    public static function getSessionsByEvangelist($evangelist)
    {
        $table = 'word_sharing_approval';
        $stmt = self::prepare("SELECT * FROM $table WHERE assigned_to = :evangelist ORDER BY created_at DESC");
        $stmt->bindValue(':evangelist', $evangelist);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, WordSharingApprovalModel::class);
    }

    public static function getWordSessionsAssigned($name)
    {

        $stmt = self::prepare("
        SELECT mobile, name, city, country, language, status, callDate, remarks
        FROM telecaller_sm
        WHERE reassignedTo = :name
        ORDER BY callDate DESC
    ");
        $stmt->bindParam(':name', $name);
        $stmt->execute();


        return $stmt->fetchAll(\PDO::FETCH_CLASS, WordSessionModel::class);
    }


    public static function getWordSessionsByEvangelist($mobile,$evangelist)
    {
        $stmt = self::prepare("
        SELECT mobile, session_id,session_date,evangelist,participant,wgroup,language,remark,feedback
        FROM word_session
        WHERE evangelist = :name and mobile = :mobile
    
    ");
        $stmt->bindParam(':name', $evangelist);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->execute();


        return $stmt->fetchAll(\PDO::FETCH_CLASS, WordSessionModel::class);

    }

    public static function getWordSessionsByMobileAndAssignedTo($mobile,$assignedTo)
    {
        $stmt = self::prepare("
        SELECT 
            session_id, 
            session_date, 
            status,
            participant,
            language,
            CASE session_id
                WHEN 1 THEN 'Session 1: SALVATION'
                WHEN 2 THEN 'Session 2: 2ND COMING'
                WHEN 3 THEN 'Session 3: Appa'
                WHEN 4 THEN 'Session 4: Church'
                WHEN 5 THEN 'Session 5: Amma'
                ELSE CONCAT('Session ', session_id)
            END AS session_name
        FROM word_session 
        WHERE mobile = :mobile 
                and evangelist = :evangelist
        ORDER BY session_date DESC
    ");

        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':evangelist', $assignedTo);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, WordSessionModel::class);
    }

    public static function updateSession($date,$status,$evangelist,$remark,$id)
    {
        $stmt = self::prepare("
                UPDATE word_session
                SET session_date = :date,
                    status       = :status,
                    evangelist   = :evangelist,
                    remark       = :remark,
                    updated_at   = NOW()
                WHERE id = :id
            ");

        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':evangelist', $evangelist);
        $stmt->bindParam(':remark', $remark);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        $stmt->execute();
    }

    public static function getWordSessionsByMobile($mobile)
    {
        $stmt = self::prepare("
        SELECT id,
            session_id, 
            session_date, 
            status,
            participant,
            language,
            evangelist,
            remark,
            CASE session_id
                WHEN 1 THEN 'Session 1: SALVATION'
                WHEN 2 THEN 'Session 2: 2ND COMING'
                WHEN 3 THEN 'Session 3: Appa'
                WHEN 4 THEN 'Session 4: Church'
                WHEN 5 THEN 'Session 5: Amma'
                ELSE CONCAT('Session ', session_id)
            END AS session_name
        FROM word_session 
        WHERE mobile = :mobile 
        ORDER BY session_date DESC
    ");

        $stmt->bindParam(':mobile', $mobile);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, WordSessionModel::class);
    }

    public static function reassignWordSession($mobile,$candidate,$assignedBy,$assignedTo,$status,$remarks,$language)
    {

        $stmt = self::prepare("
                INSERT INTO word_sharing_approval 
                (mobile,candidateName,assigned_by, assigned_to,status, remarks, language, created_at, updated_at)
                VALUES 
                (:mobile, :candidateName,:assigned_by, :assigned_to, :status,:remarks, :language, :created_at, :updated_at)
            ");

        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':candidateName', $candidate);
        $stmt->bindParam(':assigned_by', $assignedBy);
        $stmt->bindParam(':assigned_to', $assignedTo);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':remarks', $remarks);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':created_at', $now);
        $stmt->bindParam(':updated_at', $now);


        $result = $stmt->execute();

        if (!$result) {
            $errorInfo = $stmt->errorInfo();
            file_put_contents('log_error.txt', "DB ERROR: " . json_encode($errorInfo) . "\n", FILE_APPEND);
        }

        return $result;


    }



    public static function saveWordSession($mobile,$session_id,$sessionDate, $status,$evangelist,$participant,$wgroup,$language,$remark,$feedback)
    {

            $stmt = self::prepare("
                INSERT INTO word_session 
                (mobile, session_id, session_date, status, evangelist, participant, wgroup, language, remark, feedback, created_at, updated_at)
                VALUES 
                (:mobile, :session_id, :session_date, :status, :evangelist, :participant, :wgroup, :language, :remark, :feedback, :created_at, :updated_at)
            ");

        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':session_id', $session_id);
        $stmt->bindParam(':session_date', $sessionDate);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':evangelist', $evangelist);
        $stmt->bindParam(':participant', $participant);
        $stmt->bindParam(':wgroup', $wgroup);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':remark', $remark);
        $stmt->bindParam(':feedback', $feedback);
        $stmt->bindParam(':created_at', $now);
        $stmt->bindParam(':updated_at', $now);


        $stmt->execute();


    }

    public static function findAllEvangelistForSM1()
    {
        $evangelistTable = (new \app\models\EvangelistModel())->tableName();
        $telecallerTable = "telecaller_sm"; // change if your table name prefixing is different

        $sql = "
        SELECT e.evngName, 
               COALESCE(tc.unassigned_count, 0) AS unassigned_count
        FROM $evangelistTable e
        LEFT JOIN (
            SELECT assignedTo, COUNT(*) AS unassigned_count
            FROM $telecallerTable
            WHERE status = 'Unassigned'
            GROUP BY assignedTo
        ) tc 
        ON e.evngName = tc.assignedTo
        WHERE e.preference IN ('SM', 'ALL')
        ORDER BY e.evngName
    ";

        $statement = self::prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC); // return as array with count
    }

    public static function findAllEvangelistForSM()
    {
        $tableName = (new \app\models\EvangelistModel())->tableName();
        $statement = self::prepare("SELECT evngName FROM $tableName WHERE preference in ('SM','ALL')");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, EvangelistModel::class);
    }

    public static function findAllEvangelistForTelecalling1()
    {
        $evangelistTable = (new \app\models\EvangelistModel())->tableName();
        $telecallerTable = "telecaller_sm"; // change if your table name prefixing is different

        $sql = "
        SELECT e.evngName, 
               COALESCE(tc.unassigned_count, 0) AS unassigned_count
        FROM $evangelistTable e
        LEFT JOIN (
            SELECT assignedTo, COUNT(*) AS unassigned_count
            FROM $telecallerTable
            WHERE status = 'Unassigned'
            GROUP BY assignedTo
        ) tc 
        ON e.evngName = tc.assignedTo
        WHERE e.preference IN ('PHONE', 'ALL')
        ORDER BY e.evngName
    ";

        $statement = self::prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC); // return as array with count
    }


    public static function findAllEvangelistForTelecalling()
    {
        $tableName = (new \app\models\EvangelistModel())->tableName();
        $statement = self::prepare("SELECT evngName FROM $tableName WHERE preference in ('PHONE','ALL')");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, EvangelistModel::class);
    }

    public static function findAllCandidatesForEvangelist($where,$name)
    {
        $tableName = (new \app\models\CandidateModel())->tableName();
        $attributes = array_keys($where);
        //$sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        //$sql = "SELECT * FROM candidate WHERE evangelist = '$name'";

        //$statement = self::prepare("SELECT * FROM $tableName WHERE evangelist = '$name' order by activeStatus asc");
        $statement = self::prepare("
    SELECT * 
    FROM $tableName 
    WHERE evangelist = '$name' 
    ORDER BY 
        CASE activeStatus
            WHEN 'Completed' THEN 1
            WHEN 'Withdrawn' THEN 2
            WHEN 'Active' THEN 3
            WHEN 'Inactive' THEN 4
           WHEN 'Exit/Drop-out' THEN 5
           WHEN 'Ready for 7D Sathvartha' THEN 6
            ELSE 7  -- To handle any other statuses, if needed
        END ASC
");
        //$statement = self::prepare("SELECT * FROM $tableName WHERE evangelist = '$name'");
//        foreach ($where as $key => $item)
//        {
//            $statement->bindValue(":$key", $item);
//        }
//            echo '<pre>';
//            var_dump($statement);
//            echo '</pre>';

        $statement->execute();
        // Fetch all rows instead of just one
        $candidates = $statement->fetchAll(\PDO::FETCH_CLASS, CandidateModel::class);
//        echo '<pre>';
//        var_dump($candidates);
//        echo '</pre>';

        return $candidates;
    }


    public static function findlocalOrganizers()
    {
        $tableName = (new \app\models\EvangelistModel())->tableName();
        $statement = self::prepare("SELECT evngName FROM evangelist WHERE designation = 'localOrganizer'");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, EvangelistModel::class);
    }

    public static function getEventById1($id)
    {
        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT * FROM home_mission_events WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getEventById($id)
    {
        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT * FROM sathvartha_events WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function updateEvent1($id, $data,$totalAttended,$positiveCount,$attendanceReportPath)
    {
        $db = Application::$app->db;
        $stmt = $db->prepare("UPDATE home_mission_events SET
        event_name = :event_name,
        start_date = :start_date,
        end_date = :end_date,
        event_organizer = :event_organizer,
        local_organizer = :local_organizer,
        main_language = :main_language,
        translation_language = :translation_language,
        total_attended = :total_attended,
        positive_count = :positive_count,
          attendance_report = :attendance_report
        WHERE id = :id
    ");

        $stmt->bindValue(':event_name', $data['event_name']);
        $stmt->bindValue(':start_date', $data['start_date']);
        $stmt->bindValue(':end_date', $data['end_date']);
        $stmt->bindValue(':event_organizer', $data['event_organizer']);
        $stmt->bindValue(':local_organizer', $data['local_organizer']);
        $stmt->bindValue(':main_language', $data['main_language']);
        $stmt->bindValue(':translation_language', $data['translation_language']);
        $stmt->bindValue(':attendance_report', $attendanceReportPath);
        $stmt->bindValue(':total_attended', $totalAttended, \PDO::PARAM_INT);
        $stmt->bindValue(':positive_count', $positiveCount, \PDO::PARAM_INT);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public static function updateEvent($id, $data,$totalAttended,$positiveCount,$attendanceReportPath)
    {
        $db = Application::$app->db;
        $stmt = $db->prepare("UPDATE sathvartha_events SET
        event_name = :event_name,
        start_date = :start_date,
        end_date = :end_date,
        event_organizer = :event_organizer,
        local_organizer = :local_organizer,
        main_language = :main_language,
        translation_language = :translation_language,
        total_attended = :total_attended,
        positive_count = :positive_count,
          attendance_report = :attendance_report
        WHERE id = :id
    ");

        $stmt->bindValue(':event_name', $data['event_name']);
        $stmt->bindValue(':start_date', $data['start_date']);
        $stmt->bindValue(':end_date', $data['end_date']);
        $stmt->bindValue(':event_organizer', $data['event_organizer']);
        $stmt->bindValue(':local_organizer', $data['local_organizer']);
        $stmt->bindValue(':main_language', $data['main_language']);
        $stmt->bindValue(':translation_language', $data['translation_language']);
        $stmt->bindValue(':attendance_report', $attendanceReportPath);
        $stmt->bindValue(':total_attended', $totalAttended, \PDO::PARAM_INT);
        $stmt->bindValue(':positive_count', $positiveCount, \PDO::PARAM_INT);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public static function getAllEventNames1()
    {
        $table = 'home_mission_events';
        $stmt = self::prepare("SELECT event_name FROM $table ORDER BY created_at DESC");
        $stmt->execute();
        // Fetch only the event_name column values as a simple array
        $results = $stmt->fetchAll(\PDO::FETCH_COLUMN); // returns array of event names

        // Optional: Log the result
        error_log(print_r($results, true));

        return $results;

    }

    public static function getAllEventNames()
    {
        $table = (new \app\models\SathvarthaEventModel())->tableName();
        $stmt = self::prepare("SELECT event_name FROM $table ORDER BY created_at DESC");
        $stmt->execute();
        // Fetch only the event_name column values as a simple array
        $results = $stmt->fetchAll(\PDO::FETCH_COLUMN); // returns array of event names

        // Optional: Log the result
        error_log(print_r($results, true));

        return $results;

    }

    public static function getAllEvents()
    {
        $table = (new \app\models\SathvarthaEventModel())->tableName();
        $stmt = self::prepare("SELECT * FROM $table ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    public static function saveOrgEvent($eventName, $speakerName, $vmixOperator, $keyboardOperator, $monitor, $choirMembers, $foodCoupons)
    {
        $table = 'event_extra_details';
        $sql = "INSERT INTO $table 
                (event_name, speaker_name, vmix_operator, keyboard_operator, monitor, choir_members, food_coupons, created_at, updated_at)
            VALUES 
                (:event_name, :speaker_name, :vmix_operator, :keyboard_operator, :monitor, :choir_members, :food_coupons, NOW(), NOW())
            ON DUPLICATE KEY UPDATE
                speaker_name = VALUES(speaker_name),
                vmix_operator = VALUES(vmix_operator),
                keyboard_operator = VALUES(keyboard_operator),
                monitor = VALUES(monitor),
                choir_members = VALUES(choir_members),
                food_coupons = VALUES(food_coupons),
                updated_at = NOW()";

        $stmt = self::prepare($sql);

        try {
            $stmt->execute([
                ':event_name'        => $eventName,
                ':speaker_name'      => $speakerName,
                ':vmix_operator'     => $vmixOperator,
                ':keyboard_operator' => $keyboardOperator,
                ':monitor'           => $monitor,
                ':choir_members'     => $choirMembers,
                ':food_coupons'      => $foodCoupons,
            ]);
        } catch (\PDOException $e) {
            die("DB Error: " . $e->getMessage());
        }
    }


    public static function getOrgEventDetails($event_name)
    {
        $table = 'event_extra_details';
        $stmt = self::prepare("SELECT * FROM $table where event_name = :event_name ORDER BY created_at DESC");
        $stmt->bindParam(':event_name', $event_name);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    public static function getAllEvents1()
    {
        $table = 'home_mission_events';
        $stmt = self::prepare("SELECT * FROM $table ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    public static function getPreference($email)
    {
        $table = (new \app\models\EvangelistModel())->tableName();
        $stmt = self::prepare("select  preference from $table WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn(); // will return PHONE, SM, ALL, or null
    }


    public static function setPreference($preference,$email)
    {
        $table = (new \app\models\EvangelistModel())->tableName();
        $stmt = self::prepare("UPDATE $table SET preference = :preference WHERE email = :email");
        $stmt->bindParam(':preference', $preference);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    public static function findallTypesOfOrganizers()
    {
        $table = (new \app\models\EvangelistModel())->tableName();
        $stmt = self::prepare("SELECT evngName, designation FROM $table WHERE designation IN ('SathvarthaOrganizer', 'PanelMember', 'LocalOrganizer', 'Caretaker')");
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Group only evngName by designation
        $grouped = [];
        foreach ($results as $row) {
            $designation = $row['designation'];
            if (!isset($grouped[$designation])) {
                $grouped[$designation] = [];
            }
            $grouped[$designation][] = $row['evngName']; // Only name
        }

        return $grouped;
    }



    public static function findSathvarthaOrganizers()
    {
        $tableName = (new \app\models\EvangelistModel())->tableName();
        $statement = self::prepare("SELECT evngName FROM evangelist WHERE designation = 'sathvarthaOrganizer'");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, EvangelistModel::class);

    }
    public static function saveSathvarthaEvent($data)
    {
        $table = (new \app\models\SathvarthaEventModel())->tableName();
        // Prepare and execute the SQL query
        $statement = self::prepare("INSERT INTO $table (
        event_name, start_date, end_date,
        main_language, translation_language,
        event_organizer, local_organizer,
        event_link, notes,
        created_by, updated_by,
        created_at, updated_at) 
        VALUES (
        :event_name, :start_date, :end_date,
        :main_language, :translation_language,
        :event_organizer, :local_organizer,
        :event_link, :notes,
        :created_by, :updated_by,
        :created_at, :updated_at
    )");

        return $statement->execute([
            ':event_name' => $data['event_name'],
            ':start_date' => $data['start_date'],
            ':end_date' => $data['end_date'],
            ':main_language' => $data['main_language'],
            ':translation_language' => $data['translation_language'],
            ':event_organizer' => $data['event_organizer'],
            ':local_organizer' => $data['local_organizer'],
            ':event_link' => $data['event_link'],
            ':notes' => $data['notes'],
            ':created_by' => $data['created_by'],
            ':updated_by' => $data['updated_by'],
            ':created_at' => $data['created_at'],
            ':updated_at' => $data['updated_at'],
        ]);



    }

    public static function saveHomeMissionEvent($data)
    {
        $table = 'home_mission_events';
        // Prepare and execute the SQL query
        $statement = self::prepare("INSERT INTO $table (
        event_name, start_date, end_date,
        main_language, translation_language,
        event_organizer, local_organizer,
        event_link, notes,
        created_by, updated_by,
        created_at, updated_at) 
        VALUES (
        :event_name, :start_date, :end_date,
        :main_language, :translation_language,
        :event_organizer, :local_organizer,
        :event_link, :notes,
        :created_by, :updated_by,
        :created_at, :updated_at
    )");

        return $statement->execute([
            ':event_name' => $data['event_name'],
            ':start_date' => $data['start_date'],
            ':end_date' => $data['end_date'],
            ':main_language' => $data['main_language'],
            ':translation_language' => $data['translation_language'],
            ':event_organizer' => $data['event_organizer'],
            ':local_organizer' => $data['local_organizer'],
            ':event_link' => $data['event_link'],
            ':notes' => $data['notes'],
            ':created_by' => $data['created_by'],
            ':updated_by' => $data['updated_by'],
            ':created_at' => $data['created_at'],
            ':updated_at' => $data['updated_at'],
        ]);



    }





    public static function findEvangelistUsingEmailId($email)
    {
        $tableName = (new \app\models\EvangelistModel())->tableName();
        $statement = self::prepare("SELECT * FROM $tableName WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        $evangelistDetail = $statement->fetchAll(\PDO::FETCH_CLASS, EvangelistModel::class);
        return $evangelistDetail;
    }

    public static function findworkGroupForEvangelist7D($where,$name)
    {

        $tableName = (new \app\models\EvangelistModel())->tableName();
        $statement = self::prepare("SELECT * FROM $tableName WHERE evngName = '$name'");
        $statement->execute();
        // Fetch all rows instead of just one
        $evangelistDetails = $statement->fetchAll(\PDO::FETCH_CLASS, EvangelistModel::class);
//        echo '<pre>';
//        var_dump($evangelistDetails);
//        echo '</pre>';
        return $evangelistDetails;
    }


    public static function findworkGroupForEvangelist($where,$name)
    {

        $tableName = (new \app\models\EvangelistModel())->tableName();
//        error_log("evngDashboardData: " . print_r($tableName, true));
        //$attributes = array_keys($where);
        //$sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        //$sql = "SELECT * FROM candidate WHERE evangelist = '$name'";

        $statement = self::prepare("SELECT * FROM $tableName WHERE evngName = '$name'");
//        error_log("evngDashboardData: " . print_r($statement, true));
//        foreach ($where as $key => $item)
//        {
//            $statement->bindValue(":$key", $item);
//        }
//            echo '<pre>';
//            var_dump($statement);
//            echo '</pre>';

        $statement->execute();
        // Fetch all rows instead of just one
        $evangelistDetails = $statement->fetchAll(\PDO::FETCH_CLASS, EvangelistModel::class);
//        echo '<pre>';
//        var_dump($evangelistDetails);
//        echo '</pre>';

        return $evangelistDetails;
    }

}