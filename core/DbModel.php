<?php

namespace app\core;

use app\models\EvangelistModel;
use app\models\EvangelistReviewModel;
use app\models\RegisterModel;
use app\models\CandidateModel;

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

    public function saveRecordViaApi3($record)
    {

        $tableName = $this->tableName();
        $attributes = $this->attributes();


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

//        echo '<pre>';
//        var_dump($statement);
//        echo '</pre>';

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
            WHEN 'Exit' THEN 5
            ELSE 6  -- To handle any other statuses, if needed
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