<?php

namespace app\core;

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers', Authorization, X-Request-With);


class ClassRequest
{

    function storeClass ($classRequest){

        $conn= \app\core\Application::$app->db->pdo;
        $recordDate = $classRequest['recordDate'];
        $mobile= $classRequest['mobile'];
        $participant = $classRequest['participant'];
        $evangelist = $classRequest['evangelist'];
        $wgroup = $classRequest['wgroup'];
        $language = $classRequest['language'];
        $expiryDate = $classRequest['expiryDate'];
        $classFrom = $classRequest['classFrom'];
        $classTo = $classRequest['classTo'];
        $status = $classRequest['status'];
        $mediaType = $classRequest['mediaType'];
        $remark = $classRequest['remark'];
        $classLink = $classRequest['classLink'];
        $feedback = $classRequest['feedback'];

        $statement = "INSERT INTO candidatedetails 
                (recordDate, mobile, participant, evangelist,wgroup,language,expiryDate,classFrom,
                 classTo, status, mediaType, remark, classLink,feedback)
            VALUES
                (:recordDate, :mobile, :participant, :evangelist, 
                 :wgroup,:language,:expiryDate,:classFrom,:classTo,:status,:mediaType,:remark,:classLink
                 :feedback);
        ";

        try {
            $statement = $conn->prepare($statement);
            $statement->execute(
                array(
                    'recordDate' => $classRequest['recordDate'],
                    'mobile'  => $classRequest['mobile'],
                    'participant' => $classRequest['participant'] ?? null,
                    'evangelist' => $classRequest['evangelist'] ?? null,
                    'wgroup' => $classRequest['wgroup'] ?? null,
                    'language' => $classRequest['language'] ?? null,
                    'expiryDate' => $classRequest['expiryDate'] ?? null,
                    'classFrom' => $classRequest['classFrom'] ?? null,
                    'classTo' => $classRequest['classTo'] ?? null,
                    'status' => $classRequest['status'] ?? null,
                    'mediaType' => $classRequest['mediaType'] ?? null,
                    'remark' => $classRequest['remark'] ?? null,
                    'classLink' => $classRequest['classLink'] ?? null,
                    'feedback' => $classRequest['feedback'] ?? null
                ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }


    }

}