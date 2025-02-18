<?php
/** User: Aviet Lobo ...*/

namespace app\controllers; 

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\CandidateModel;
use app\models\EvangelistModel;
use app\models\LoginForm;
use app\models\RegisterModel;
use app\core\middlewares\AuthMiddleware;
use app\models\WGroupModel;

/**
 * Class SitController
 * 
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\controllers
 */

 class SiteController extends Controller
 {

     public function __construct()
     {
         $this->registerMiddleware(new AuthMiddleware(['profile', 'video']));
     }

     public function editCandidate(Request $request)
     {
         // Fetch data from session or request
         $data = $_SESSION['storedData'] ?? null;
         $candidateModel = new CandidateModel();
         //$this->session->set('user1','123');
         //Application::$app->session->set('user1','123');


         if ($request->isPost()) {


             $candidateModel->loadData($request->getBody());
             $inputData = json_decode(file_get_contents("php://input"), true);
             if (empty($inputData)) {
//                echo '<pre>';
//                var_dump($data);
//                echo '</pre>';
                 exit();
             }
         }

         $this->setLayout('main1');
         // Load view with the data
         return $this->render('editCandidate', ['data' => $data]);
     }

     public function updateCandidate(Request $request)
     {

         // Fetch data from session or request
         $data = $_SESSION['storedData'] ?? null;
         $candidateModel = new CandidateModel();


         if ($request->isPost()) {


             $candidateModel->loadData($request->getBody());
             error_log($candidateModel->participantName);


//            echo '<pre>';
//            var_dump($candidateModel);
//            echo '</pre>';
             $inputData = json_decode(file_get_contents("php://input"), true);
             if (empty($inputData)) {

                 error_log($candidateModel->evangelist);
                 error_log($candidateModel->mobile);
                 error_log($_POST['country']);
                 $candidateModel->updateCandidate($_POST);
             }
             //$data = CandidateModel::findAllCandidatesForEvangelist(['evangelist' => $_SESSION['loginForm']->username], $_SESSION['loginForm']->username);
             $data = CandidateModel::findAllCandidatesForEvangelist(['evangelist' => Application::$app->session->get('nameFinal')], Application::$app->session->get('nameFinal'));


             Application::$app->session->set('evngDashboardData', $data);
             $this->setLayout('main1');
             return $this->render('evngDashboard1');

         }


         // Redirect or show success message
//        header('Location: /evngDashboard');
//        exit();
     }


     public function EvangelistDetailedCandidatesForGroupLeader(Request $request)
     {
         $candidateModel = new CandidateModel();
         $wgroup = Application::$app->session->get('GLWG');
         $evangelist = $_GET['evangelist'] ?? null;
         $data = WGroupModel::findAllEvangelistsDetailedCandidatesForGroupLeader($wgroup, $evangelist);
         return $this->render('EvangelistDetailedCandidatesForGroupLeader', ['data' => $data]);
     }


     public function allEvangelistsClassRequestsForGroupLeader(Request $request)
     {
         $candidateModel = new CandidateModel();
         $wgroup = $_GET['wgroup'] ?? null;
         $data = WGroupModel::findAllEvangelistsClassRequestsForGroupLeader($wgroup);
         return $this->render('EvangelistDetailedClassRequestsForGroupLeader', ['data' => $data]);

     }


     public function allEvangelistsForGroupLeaderCountryWiseDetailedRecords(Request $request)
     {
         $candidateModel = new CandidateModel();
         $country = $_GET['country'] ?? null;
         $wgroup = Application::$app->session->get('wgroupsgrpLeader');
         $data = WGroupModel::findAllCountrywiseEvangelistsDataForGroupLeaderGroupDetailed($wgroup, $country);
         return $this->render('allEvangelistsForGroupLeaderCountryWiseDetailedRecords', ['data' => $data]);


     }


     public function allEvangelistsForGroupLeaderCountryWise(Request $request)
     {
         $candidateModel = new CandidateModel();
         $wgroup = $_GET['wgroup'] ?? null;
         Application::$app->session->set('wgroupsgrpLeader', $wgroup);
         $data = WGroupModel::findAllCountrywiseEvangelistsDataForGroupLeaderGroup($wgroup);
         return $this->render('allEvangelistsForGroupLeaderCountryWise', ['data' => $data]);

     }


     public function allEvangelistsForGroupLeader(Request $request)
     {
         $candidateModel = new CandidateModel();
         $wgroup = $_GET['wgroup'] ?? null;
         Application::$app->session->set('GLWG', $wgroup);
         $data = WGroupModel::findAllEvangelistsForGroupLeader($wgroup);
         return $this->render('allEvangelistsForGroupLeader', ['data' => $data]);


     }

     public function reportManagement(Request $request)
     {

         $evangelistData = \app\core\Application::$app->session->get('evngDashboardData2');
         $designation = $evangelistData[0]->designation;
         $wgroup = $evangelistData[0]->wgroupId;
         $evngName = $evangelistData[0]->evngName;

         if ($designation === 'Management') {
             return $this->render('reportManagement');
         }

         if ($designation === 'Evng Coordinator') {
             $data = WGroupModel::findTotalWGroupForEvngCoord($evngName);
             $length = count($data); // Get the length of the array
//             return $this->render('reportManagementEvngCoordinator');
             Application::$app->session->set('wgroupsEvgCord', $data);
             Application::$app->session->set('evngNameCoord', $evngName);
             return $this->render('reportManagementEvngCoordinator', ['length' => $length,
                 'evngName' => $evngName,


             ]);
         }

         if ($designation === 'Group Leader') {

             return $this->render('reportManagementGroupLeader', ['wgroup' => $wgroup]);

         }

         return null;
     }


     public function evangelistCandidatesDetailedGTCGroupWiseEvngCoord(Request $request)
     {
         $candidateModel = new CandidateModel();
         $evangelist = $_GET['evangelist'] ?? null;
         $wgroup = Application::$app->session->get('wgroupEvngCoordinator');
         $data = WGroupModel::findEvangelistCandidateDetailsForWgroupEvngCoord($wgroup, $evangelist);
         return $this->render('evangelistCandidatesDetailedGTCGroupWiseEvngCoord', ['data' => $data]);
     }

     public function evangelistCandidatesGTCGroupWiseEvngCoord(Request $request)
     {
         $candidateModel = new CandidateModel();
         $wgroup = Application::$app->session->get('wgroupEvngCoordinator');
         $data = WGroupModel::findEvangelistCandidatesForWgroupEvngCoord($wgroup);
         return $this->render('evangelistCandidatesGTCGroupWiseEvngCoord', ['data' => $data]);
     }

     public function evangelistCandidatesEvngCoord(Request $request)
     {
         $candidateModel = new CandidateModel();
         $evangelist = $_GET['evangelist'] ?? null;
         $wgroup = Application::$app->session->get('wgroupEvngCoordinator');
         $country = Application::$app->session->get('countryEvngCoord');
         $data = WGroupModel::findEvangelistCandidatesForEvngCoord($wgroup, $country, $evangelist);
         return $this->render('evangelistCandidatesEvngCoord', ['data' => $data]);

     }

     public function evangelistGroupingEvngCoord(Request $request)
     {
         $candidateModel = new CandidateModel();
         $country = $_GET['country'] ?? null;
         $wgroup = Application::$app->session->get('wgroupEvngCoordinator');
         Application::$app->session->set('countryEvngCoord', $country);
         $data = WGroupModel::findEvangelistGroupingCountForEvngCoord($wgroup, $country);
         return $this->render('evangelistGroupingEvngCoord', ['data' => $data]);
     }

     public function countryGroupingEvngCoord(Request $request)
     {

         $candidateModel = new CandidateModel();
         $wgroup = $_GET['wgroup'] ?? null;
         Application::$app->session->set('wgroupEvngCoordinator', $wgroup);
         $data = WGroupModel::findLanguageGroupingCountForEvngCoord($wgroup);
         return $this->render('countryGroupingEvngCoord', ['data' => $data]);

     }

     public function wgroupsWiseCountsForEvngCoord(Request $request)
     {
         $wgroups = \app\core\Application::$app->session->get('wgroupsEvgCord');
         $data = WGroupModel::findWGroupWiseCountsForEvngCoord($wgroups);
         return $this->render('wgroupsWiseCountsForEvngCoord', ['data' => $data]);
     }

     public function totalReportCountManagement(Request $request)
     {
         $candidateModel = new CandidateModel();
         $data = CandidateModel::findtotalReportingCount();
         // Pass the data to the view
         return $this->render('totalReportCountManagement', ['data' => $data]);
     }

     public function countryGrouping(Request $request)
     {
         $candidateModel = new CandidateModel();
         $data = CandidateModel::findCountryGrouping();
         // Pass the data to the view
         return $this->render('countryGrouping', ['data' => $data]);

     }


     public function countrywiseCandidateDetails(Request $request)
     {
         $candidateModel = new CandidateModel();
         $language = $_GET['language'] ?? null;
         $activeStatus = Application::$app->session->get('status2');
         $country = Application::$app->session->get('country2');
         $data = CandidateModel::findcountrywiseCandidateDetails($country, $activeStatus, $language);
         // Pass the data to the view
         return $this->render('countrywiseCandidateDetails', ['data' => $data]);
     }

     public function countrywiseLanguageGrouping(Request $request)
     {
         $candidateModel = new CandidateModel();
         $activeStatus = $_GET['status'] ?? null;
         Application::$app->session->set('status2', $activeStatus);
         $country = Application::$app->session->get('country2');
         $data = CandidateModel::findCountrywiseLanguageGrouping($country, $activeStatus);
         // Pass the data to the view
         return $this->render('countrywiseLanguageGrouping', ['data' => $data]);


     }

     public function countrywiseStatusGrouping(Request $request)
     {
         $candidateModel = new CandidateModel();
         $country = $_GET['country'] ?? null;
         Application::$app->session->set('country2', $country);
         $data = CandidateModel::findCountryWiseStatusGrouping($country);
         // Pass the data to the view
         return $this->render('countryWiseStatusGrouping', ['data' => $data]);

     }


     public function totalStatusWiseDetailedRecords(Request $request)
     {
         $candidateModel = new CandidateModel();
         $activeStatus = $_GET['activeStatus'] ?? null;
         $data = CandidateModel::findtotalStatusWiseDetailedRecords($activeStatus);
         // Pass the data to the view
         return $this->render('totalStatusWiseDetailedRecords', ['data' => $data]);
     }

     public function totalStatusWiseGrouping(Request $request)
     {
         $candidateModel = new CandidateModel();
         $data = CandidateModel::findtotalStatusWiseGrouping();
         // Pass the data to the view
         return $this->render('totalStatusWiseGrouping', ['data' => $data]);
     }

     public function totalGTCWiseStatusWiseDetailedRecords(Request $request)
     {
         $candidateModel = new CandidateModel();
         $activeStatus = $_GET['activeStatus'] ?? null;
         $wgroup = Application::$app->session->get('wgroup3');
         $data = CandidateModel::findtotalGTCWiseStatusWiseDetailedRecords($activeStatus, $wgroup);
         // Pass the data to the view
         return $this->render('totalGTCWiseStatusWiseDetailedRecords', ['data' => $data]);
     }

     public function totalGTCWiseStatusCounts(Request $request)
     {
         $candidateModel = new CandidateModel();
         $wgroup = $_GET['wgroup'] ?? null;
         $data = CandidateModel::findGTCWiseStatusCounts($wgroup);
         Application::$app->session->set('wgroup3', $wgroup);
         // Pass the data to the view
         return $this->render('totalGTCWiseStatusCounts', ['data' => $data]);

     }

     public function totalGTCWiseCounts(Request $request)
     {
         $candidateModel = new CandidateModel();
         $data = CandidateModel::findGTCWiseGrouping();
         // Pass the data to the view
         return $this->render('totalGTCWiseCounts', ['data' => $data]);
     }

     public function totalLanguageWiseCandidateDetails(Request $request)
     {
         $candidateModel = new CandidateModel();
         $language = $_GET['language'] ?? null;
         $data = CandidateModel::findTotalLanguageGroupingWiseCandidateDetails($language);
         // Pass the data to the view
         return $this->render('totalLanguageGroupingWiseCandidateDetails', ['data' => $data]);

     }

     public function totalLanguageGrouping(Request $request)
     {
         $candidateModel = new CandidateModel();
         $data = CandidateModel::findTotalLanguageGrouping();
         // Pass the data to the view
         return $this->render('totalLanguageGrouping', ['data' => $data]);
     }


     public function languageGroupingForGroupLeader(Request $request)
     {
         $candidateModel = new CandidateModel();
         $data = CandidateModel::findlanguageGrouping();
     }

     public function languageGrouping(Request $request)
     {
         $candidateModel = new CandidateModel();
         $data = CandidateModel::findlanguageGrouping();
         // Pass the data to the view
         return $this->render('languageGrouping', ['data' => $data]);
     }


     public function candidateDetailedRecord(Request $request)
     {
         $candidateModel = new CandidateModel();
         $activeStatus = $_GET['activeStatus'] ?? null;
         $data = CandidateModel::findDetailedCandidateRecord($activeStatus);
//         echo '<pre>';
//         var_dump($data);
//         echo '<pre>';

         return $this->render('candidateDetailedRecord', ['data' => $data]);

     }

     public function statusCounts(Request $request)
     {
         $candidateModel = new CandidateModel();
         $date = $_GET['date'] ?? null;
         $language = $_GET['language'] ?? null;
         $wgroup = $_GET['wgroup'] ?? null;
         Application::$app->session->set('wgroup2', $wgroup);
         $data = CandidateModel::findStatusWiseGrouping($date, $language, $wgroup);

//                echo '<pre>';
//                var_dump($data);
//                echo '<pre>';

         // Pass the data to the view
         return $this->render('statusWiseCounts', ['data' => $data]);
     }


     public function wGroupCounts(Request $request)
     {
         $candidateModel = new CandidateModel();
         $date = $_GET['date'] ?? null;
         $language = $_GET['language'] ?? null;
         Application::$app->session->set('language2', $language);
         $data = CandidateModel::findWGroupCount($date, $language);

//                echo '<pre>';
//                var_dump($data);
//                echo '<pre>';


         // Pass the data to the view
         return $this->render('wgroupCounts', ['data' => $data]);
     }


     public function languageCounts(Request $request)
     {
         $candidateModel = new CandidateModel();
         $date = $_GET['date'] ?? null;
         $data = CandidateModel::findlanguageCount($date);


         Application::$app->session->set('date2', $date);


         // Pass the data to the view
         return $this->render('languageCounts', ['data' => $data]);
     }


     public function candidate(Request $request)
     {
         $candidateModel = new CandidateModel();
         if ($request->isPost()) {
             $candidateModel->loadData($request->getBody());
             $inputData = json_decode(file_get_contents("php://input"), true);
             if (empty($inputData)) {


                 if ($candidateModel->validate()) {
                     $candidateModel->registerCandidate($_POST,$candidateModel);
                     if (!empty($candidateModel->errors)) {
                         // Add the specific error for the 'mobile' field if it doesn't already exist
                         if (!isset($candidateModel->errors['mobile'])) {
                             $candidateModel->errors['mobile'][] = "Mobile number already registered.";
                         }

                         $this->setLayout('auth');
                         return $this->render('candidate', [
                             'model' => $candidateModel
                         ]);
                     }
                     //$data = CandidateModel::findAllCandidatesForEvangelist(['evangelist' => $_SESSION['loginForm']->username], $_SESSION['loginForm']->username);
                     $data = CandidateModel::findAllCandidatesForEvangelist(['evangelist' => Application::$app->session->get('nameFinal')], Application::$app->session->get('nameFinal'));


                     Application::$app->session->set('evngDashboardData', $data);
                     $this->setLayout('main1');

                     return $this->render('evngDashboard3');
                     //return 'New candidate added successully';

                 }


//                echo '<pre>';
//                var_dump($candidateModel->errors);
//                echo '<pre>';
//                exit;


//                $candidateModel->registerCandidate($_POST);
//                return $this->render('candidate',['model' => $candidateModel]);
                 //$storeClassRequest = storeClassRequest($_POST);


             } else {


                 if (!empty($inputData)) {
                     var_dump($inputData);
                     try {
                         $candidateModel->registerCandidate($inputData);
                         return 'Record inserted successfully';
                     } catch (Exception $e) {
                         error_log($e->getMessage());
                         var_dump('ERRORRRRR');
                         return 'Error inserting record';
                     }
                 } else {
                     return 'No input data provided';
                 }
             }
//            $body = $request->getBody();
//
//            return $this->render('candidate',[
//                'model'=> $candidateModel
//            ]);
//
//            return 'Recorded inserted successfully';
         } else {
             $data = [
                 'status' => 405,
                 'message' => $request->getMethod() . ' Method Not Allowed',

             ];
             header("HTTP/1.0 405 Method Mot Allowed");

         }
         $this->setLayout('auth');
         return $this->render('candidate', [
             'model' => $candidateModel
         ]);

     }

     public function storeSessionData(Request $request)
     {
         // Check if the request is a POST request
         if ($request->isPost()) {
             $data = $request->getBody();

             // Store session data
             $_SESSION['storedData'] = $data;

             // Respond with success
             echo json_encode(['status' => 'success']);
             return;
         }

         // Handle non-POST requests or return an error
         echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
     }

     public function getAllCandidate()
     {

     }

//     public function getClassDetailsForCandidate(Request $request)
//     {
//
//         $registerModel = new RegisterModel();
//         if($request->isPost())
//         {
//
//             $body = $request->getBody();
//             $username = $body['username'] ?? null;
//             $candidate = $body['candidate'] ?? null;
//
//
//
//             // Validate and sanitize $username as needed
//
//             // Example: Fetch details based on $username
//             $userDetails = $registerModel->getUserDetailsByUsername($username,$candidate);
//
//             // Render the view with the user details
//             $this->setLayout('auth');
//             return $this->render('classDetailsForCandidate', ['userDetails' => $userDetails]);
//         }
//
//
//     }




    public function saveClassDetails() {

        // Generate a 6-digit random numeric password
        $password = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        // Extract form data from the $_POST array
        $candidate = [
            'evangelist' => $_POST['evangelist'] ?? null,
            'participantName' => $_POST['participant'] ?? null,
            'classNo' => $_POST['classFrom'] ?? null,
            'status' => $_POST['status'] ?? null,
            'password' => $password,
            'mediaType' => $_POST['mediaType'] ?? null,
            'remark' => $_POST['remark'] ?? null,
            'mobile' => $_POST['mobile'] ?? null,
        ];



        $registerModel = new RegisterModel();
        $userDetails = $registerModel->saveClassDetails($candidate);
        // Prepare query parameters for redirection
        $queryParams = http_build_query([
            'classFrom' => $candidate['classNo'],
            'status' => $candidate['status'],
            'username' => $candidate['participantName'],
            'password' => $password, // Use appropriate password (replace if needed)
            'remark' => $candidate['remark'],
            'mobile' => urlencode($candidate['mobile']),
            'mediaType' => $candidate['mediaType'],
        ]);

         //Redirect to the target view with query parameters
        header("Location: /getClassNumber?$queryParams");
        exit(); // Ensure no further code is executed after the redirect


        //return $this->render('classNumberDetailsForCandidate1',  ['data' => $queryParams]);




    }


    public function getEditClassDetails() {

        $this->setLayout('main1');
        return $this->render('editClassDetails');
    }

public function getClassNumberDetailsForCandidate()
{
    $classFrom = $_GET['classFrom'] ?? null;
    $status = $_GET['status'] ?? null;
    // Prepare the data to be passed to the view
    $userDetails =   Application::$app->session->get('userDetails');

    $data = [
        'classFrom' => $classFrom,
        'status' => $status,
        'password' => '',
        'message' => "Details for Class $classFrom with status $status",  // Optional message for demonstration
    ];
    $this->setLayout('main1');
    return $this->render('classNumberDetailsForCandidate',  ['data' => $data]);
}



    public function getClassDetailsForCandidate() {

        $registerModel = new RegisterModel();
        // Extract parameters from the URL
        $username = $_GET['username'] ?? null;
        $candidate = $_GET['candidate'] ?? null;
        $mobile = isset($_GET['mobile']) ? rawurldecode($_GET['mobile']) : null;
        $index = $_GET['index'] ?? null;
        Application::$app->session->set('index', $index);

        // Validate and sanitize parameters as needed




        // Example: Fetch details based on $username and $candidate
        $userDetails = $registerModel->getUserDetailsByUsername($username,$candidate,$mobile);
//        Application::$app->session->set('userDetails', $userDetails);
//        echo '<pre>';
//        var_dump(Application::$app->session->get('userDetails'));
//        echo '</pre>';

        // Render the view with the user details
        $this->setLayout('main1');
        return $this->render('classDetailsForCandidate', ['userDetails' => $userDetails]);
    }






    public function getClassDetailsForCandidate1(Request $request)
    {
        $registerModel = new RegisterModel();
        $userDetails=null;
        if ($request->isPost()) {
            // Retrieve data from the request body
             $body = $request->getBody();
             $username = $body['username'] ?? null;
             $candidate = $body['candidate'] ?? null;

            // Validate and sanitize $username and $candidate as needed

            // Example: Fetch details based on $username and $candidate
            $userDetails = $registerModel->getUserDetailsByUsername($username, $candidate);

            // Return a JSON response
            header('Content-Type: application/json');
            echo json_encode(['userDetails' => $userDetails]);
            exit;

        }
        // Render the view with the user details
        $this->setLayout('auth');
        return $this->render('classDetailsForCandidate', ['userDetails' => $userDetails]);


    }




}
