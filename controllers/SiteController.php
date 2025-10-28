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
use app\models\WordSessionModel;
use app\models\WordSharingApprovalModel;
use DateTime;

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

     public function editCandidate7D(Request $request)
     {
         // Fetch data from session or request
         $data = $_SESSION['storedData7D'] ?? null;
         $candidateModel = new CandidateModel();

         if ($request->isPost()) {
             $candidateModel->loadData($request->getBody());
             $inputData = json_decode(file_get_contents("php://input"), true);
             if (empty($inputData)) {
                 exit();
             }
         }

         $this->setLayout('main1');
         return $this->render('editCandidate7D', ['data' => $data]);

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



     public function updateCandidate7D(Request $request)
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
                 $candidateModel->updateCandidate7D($_POST);
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


     public function updateCandidate(Request $request)
     {

         // Fetch data from session or request
         $data = $_SESSION['storedData'] ?? null;
         $candidateModel = new CandidateModel();


         if ($request->isPost()) {


             $candidateModel->loadData($request->getBody());
             error_log($candidateModel->participantName);

             // 🔐 FETCH existing candidate record to check status
             $existingCandidate = CandidateModel::getCandidateByMobile($candidateModel->mobile); // <-- Add this method to your model

             if ($existingCandidate && $existingCandidate['activeStatus'] === "Ready for 7D Sathvartha") {
                 // ⛔️ Block modifications
                 $data1['error_active_status'] = "Cannot modify data. Status is already 'Ready for 7D Sathvartha'.";
                 $this->setLayout('main1');
                 return $this->render('editCandidate', ['data' => $data, 'data1' => $data1]);
             }


             $inputData = json_decode(file_get_contents("php://input"), true);
             if (empty($inputData)) {

                 // Load language mappings
                 $languageMappings = include __DIR__ . '/../views/language_class_mappings.php';

                 // Check if status is "Ready for 7D Sathvartha"
                 if ($candidateModel->activeStatus === "Ready for 7D Sathvartha") {
                     // Get the required number of classes for the candidate's language
                     $requiredClasses = $languageMappings[$candidateModel->language] ?? 0;
                     $mobileData =CandidateModel::verifyOnlineSathvarthaStatus($candidateModel->mobile);

                     if ($mobileData) {
                         $candidateModel->updateCandidate($_POST);
                     } else {
                         if ($requiredClasses > 0) {
                             // Fetch all classFrom values for this candidate
                             $existingClasses = CandidateModel::getClassNumbersForCandidate($candidateModel->mobile);

                             // Generate the expected class numbers (from 2 to required number)
                             $expectedClasses = range(2, $requiredClasses);


                             // Check if all expected classes exist
                             if (array_diff($expectedClasses, $existingClasses)) {

                                 // Fetch data from session or request
                                 $data = $_SESSION['storedData'] ?? null;

                                 $data1['error_active_status'] = "Cannot update status. All required classes are not completed by candidate or online Sathvartha not attended.";
                                 $this->setLayout('main1');
                                 return $this->render('editCandidate', ['data' => $data,'data1'=>$data1]); // Stay on the same page
                             }
                             else
                             {
                                 $candidateModel->updateCandidate($_POST);
                             }
                         }
                     }




                 }

                 else
                 {
                     $candidateModel->updateCandidate($_POST);
                 }


             }
             //$data = CandidateModel::findAllCandidatesForEvangelist(['evangelist' => $_SESSION['loginForm']->username], $_SESSION['loginForm']->username);
             $data = CandidateModel::findAllCandidatesForEvangelist(['evangelist' => Application::$app->session->get('nameFinal')], Application::$app->session->get('nameFinal'));


             Application::$app->session->set('evngDashboardData', $data);
             $this->setLayout('main1');
             return $this->render('evngDashboard1');

         }


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





     public function saveCandidateDataDist(Request $request)
     {
         $candidateModel = new CandidateModel();

         if ($request->isPost()) {
             $mobile = $_POST['mobile'] ?? '';
             $name = $_POST['participantName'] ?? '';
             $country = $_POST['country'] ?? '';
             $city = $_POST['city'] ?? '';
             $language = $_POST['language'] ?? '';
             $evangelist = $_POST['evangelist'] ?? '';
             $source = $_POST['source'] ?? '';
             $allotedDays = $_POST['allotedDays'] ?? '';
             $mediaType = $_POST['mediaType'] ?? '';
             $activeStatus = $_POST['activeStatus'] ?? '';
             $workGroup = $_POST['workGroup'] ?? '';
             $userId = $_POST['userId'] ?? '';
             $remark = $_POST['remark'] ?? '';

             $candidateModel->loadData($request->getBody());

             $candidateModel->saveRecordViaApi45($mobile,$country,$language);

             $candidateModel->saveCandidateViaDataDistribution($mobile,$name,$country,$language,$evangelist,$source,$allotedDays,$mediaType,$activeStatus,$workGroup,$userId,$remark);

             $data = CandidateModel::findAllCandidatesForEvangelist(['evangelist' => Application::$app->session->get('nameFinal')], Application::$app->session->get('nameFinal'));


             Application::$app->session->set('evngDashboardData', $data);
             $this->setLayout('main1');


             return $this->render('evngDashboard3');
         }
     }


     public function getApprovals(Request $request)
     {
         $wordSharingApprovalModel = new WordSharingApprovalModel();
         header('Content-Type: application/json');
         $mobile = $_GET['mobile'] ?? '';
         if (!$mobile) {
             echo json_encode(['success' => false, 'message' => 'Mobile is required']);
             return;
         }
         $approvals = WordSharingApprovalModel::getWordSessionsByMobileApproval($mobile);
         echo json_encode(['success' => true, 'approvals' => $approvals]);



     }

     public function approveWordSession(Request $request)
     {
         $wordModel = new WordSharingApprovalModel();
         $evangelist = Application::$app->session->get('nameFinal');

         if ($request->isPost()) {
             $mobile = $request->getBody()['mobile'] ?? null;
             $action = $request->getBody()['action'] ?? null;



             if ($mobile && in_array($action, ['Approved', 'Rejected'])) {
                 $wordModel::updateStatus($mobile, $evangelist, $action);
                 // If Approved, also update telecaller_sm
                 if ($action === 'Approved') {
                     $wordModel::updateTelecallerReassigned($mobile, $evangelist);
                 }


                 Application::$app->response->redirect('/viewAssignedWordSessions');
                 exit;
             }
         }

         $sessions = $wordModel::getSessionsByEvangelist($evangelist);

         return $this->render('word_sessions', [
             'sessions' => $sessions
         ]);
     }


     public function viewAssignedWordSessions(Request $request)
     {
         // Assume evangelist's name is stored in session
         $evangelist =  Application::$app->session->get('nameFinal');

         $wordModel = new WordSharingApprovalModel();
         $sessions = $wordModel::getSessionsByEvangelist($evangelist);
         $this->setLayout('main1');
         return $this->render('word_sessions', [
             'sessions' => $sessions
         ]);
     }


     public function getOnlineSathvartha(Request $request)
     {
         $mobile = $_GET['mobile'] ?? '';

         $homeMission = CandidateModel::getOnlineSathvarthaForCandidate($mobile);
// Return JSON response
         header('Content-Type: application/json');
         echo json_encode([
             'success' => true,
             'homeMission' => $homeMission
         ]);

     }



     public function getHomeMission(Request $request)
     {
         $mobile = $_GET['mobile'] ?? '';

         $homeMission = CandidateModel::getHomeMissionDetailForCandidate($mobile);
// Return JSON response
         header('Content-Type: application/json');
         echo json_encode([
             'success' => true,
             'homeMission' => $homeMission
         ]);


     }

     public function wordSessionDetail(Request $request)
     {
         $mobile = $_GET['mobile'] ?? '';
//         echo $mobile;
         $language = $_GET['language'] ?? '';
         $participant = $_GET['participant'] ?? '';
         //echo $participant;

         if (empty($mobile)) {
             echo "Mobile number missing!";
             return;
         }
         $evangelist =  Application::$app->session->get('nameFinal');

         //$candidate = CandidateModel::getCandidateByMobile($mobile);
         //$wordSessions = WordSessionModel::getWordSessionsByMobile($mobile);// reuse from earlier
         //$wordSessions = WordSessionModel::getWordSessionsByEvangelist($mobile,$evangelist);
         $wordSessions = WordSessionModel::getWordSessionsByEvangelist1($mobile);

         $this->setLayout('main1');
         return $this->render('word_session_detail', [
             'mobile' => $mobile,
             'language'=> $language,
             'participant'=> $participant,
             'wordSessions' => $wordSessions,
             'evangelist' => $evangelist
         ]);
     }


     public function getWordSessionsApprovedBKP(Request $request)
     {
         $evangelist = Application::$app->session->get('nameFinal');

         $sessions  = WordSessionModel::getWordSessionsAssigned($evangelist);
         $sessions2 = WordSessionModel::getWordSessionsAssignedWithoutCSV($evangelist);

         $distinctMobiles = array_unique(array_map(function($session2) {
             return $session2->mobile;
         }, $sessions2));

         $sessions3 = WordSessionModel::getWordSessionsCandidatesWithoutCSV($distinctMobiles);

         // Map sessions by mobile
         $sessionsMap = [];
         foreach ($sessions as $session) {
             $sessionsMap[$session->mobile] = $session;
         }

         // Merge into a unified array with source sticker
         $mergedSessions = [];
         foreach ($sessions3 as $candidate) {
             if (isset($sessionsMap[$candidate['mobile']])) {
                 $session = $sessionsMap[$candidate['mobile']];
                 $session->participantName    = $candidate['participantName'];
                 $session->candidateCountry   = $candidate['country'];
                 $session->candidateLanguage  = $candidate['language'];
                 $session->source             = 'CSV';
                 $mergedSessions[] = $session;
             } else {
                 $dummySession = new \stdClass();
                 $dummySession->mobile             = $candidate['mobile'];
                 $dummySession->name               = $candidate['participantName'];
                 $dummySession->city               = 'N/A';
                 $dummySession->country            = $candidate['country'];
                 $dummySession->language           = $candidate['language'];
                 $dummySession->callDate           = null;
                 $dummySession->status             = $candidate['activeStatus'];
                 $dummySession->remark            = $candidate['remark'];
                 $dummySession->source             = 'Non CSV';
                 $mergedSessions[] = $dummySession;
             }
         }

         $this->setLayout('main1');
         return $this->render('mywordsessions', [
             'sessions' => $mergedSessions
         ]);
     }



     public function getWordSessionsApproved(Request $request)
     {
         $evangelist = Application::$app->session->get('nameFinal');

         $sessions  = WordSessionModel::getWordSessionsAssigned($evangelist);
         $sessions2 = WordSessionModel::getWordSessionsAssignedWithoutCSV($evangelist);

         $distinctMobiles = array_unique(array_map(function($session2) {
             return $session2->mobile;
         }, $sessions2));

         $sessions3 = WordSessionModel::getWordSessionsCandidatesWithoutCSV($distinctMobiles);

         // Map sessions by mobile
         $sessionsMap = [];
         foreach ($sessions as $session) {
             $sessionsMap[$session->mobile] = $session;
         }

         // Map word_sharing_approval sessions by mobile
         $sessions2Map = [];
         foreach ($sessions2 as $s2) {
             $sessions2Map[$s2->mobile] = $s2;
         }

         $mergedSessions = [];
         foreach ($sessions3 as $candidate) {
             $mobile = $candidate['mobile'];
             $candRemark = trim((string)($candidate['remark'] ?? ''));
             $wsaRemark  = isset($sessions2Map[$mobile]) ? trim((string)($sessions2Map[$mobile]->remark ?? '')) : '';
             $teleRemark = isset($sessionsMap[$mobile]) ? trim((string)($sessionsMap[$mobile]->remark ?? '')) : '';

             // pick first non-empty
             //$finalRemark = $candRemark !== '' ? $candRemark : ($wsaRemark !== '' ? $wsaRemark : $teleRemark);
             $finalRemark = isset($sessions2Map[$mobile]) ? trim((string)($sessions2Map[$mobile]->remark ?? '')) : '';

             if (isset($sessionsMap[$mobile])) {
                 $session = $sessionsMap[$mobile];
                 $session->participantName   = $candidate['participantName'];
                 $session->candidateCountry  = $candidate['country'];
                 $session->candidateLanguage = $candidate['language'];
                 $session->remark            = $finalRemark;
                 $session->source            = 'CSV';
                 $mergedSessions[] = $session;
             } else {
                 $dummySession = new \stdClass();
                 $dummySession->mobile   = $mobile;
                 $dummySession->name     = $candidate['participantName'];
                 $dummySession->city     = 'N/A';
                 $dummySession->country  = $candidate['country'];
                 $dummySession->language = $candidate['language'];
                 $dummySession->callDate = null;
                 $dummySession->status   = $candidate['activeStatus'];
                 $dummySession->remark   = $finalRemark;
                 $dummySession->source   = isset($sessions2Map[$mobile]) ? 'Non CSV' : 'Non CSV';
                 $mergedSessions[] = $dummySession;
             }
         }

         $this->setLayout('main1');
         return $this->render('mywordsessions', [
             'sessions' => $mergedSessions
         ]);
     }




     public function getWordSessionsOfAssignedEvng(Request $request)
     {
         $mobile = $_GET['mobile'] ?? '';
         if (empty($mobile)) {
             echo json_encode(['success' => false, 'message' => 'Mobile number missing']);
             return;
         }
         $evangelist = Application::$app->session->get('nameFinal');
         //echo $evangelist;
         //$sessions = CandidateModel::getWordSessionsByMobileAndAssignedTo($mobile,$evangelist);
         $sessions = CandidateModel::getWordSessionsByMobileAndAssignedTo1($mobile);

         echo json_encode(['success' => true, 'sessions' => $sessions]);
     }

     public function updateSession(Request $request)
     {
         if ($request->isPost()) {
             $body = $request->getBody();


             $id         = $body['sessionId'] ?? null; // this is 26
             $date       = $body['sessionDate'] ?? null;
             $status     = $body['status'] ?? null;
             $remark     = $body['remark'] ?? null;
             $evangelist = $body['evangelist'] ?? null;

             // Clean remark: decode HTML entities and normalize newlines
             if ($remark !== null) {
                 $remark = html_entity_decode($remark, ENT_QUOTES | ENT_HTML5);
                 $remark = str_replace("\r\n", "\n", $remark); // normalize Windows newlines
             }


             CandidateModel::updateSession($date,$status,$evangelist,$remark,$id);

             // For debugging: check what came from frontend
             // return as JSON (not echo)
             header('Content-Type: application/json');
             echo json_encode([
                 'success'    => true,
                 'sessionId'  => $id,
                 'sessionDate'=> $date,
                 'status'     => $status,
                 'remark'     => $remark,
                 'evangelist' => $evangelist
             ]);
             exit;
         }

         header('Content-Type: application/json');
         echo json_encode(['success' => false, 'message' => 'Invalid request']);
         exit;
     }



     public function getWordSessions(Request $request)
     {
         $mobile = $_GET['mobile'] ?? '';
         if (empty($mobile)) {
             echo json_encode(['success' => false, 'message' => 'Mobile number missing']);
             return;
         }

         $sessions = CandidateModel::getWordSessionsByMobile($mobile);

         echo json_encode(['success' => true, 'sessions' => $sessions]);
     }


     public function reassignWordSharing(Request $request)
     {
         header('Content-Type: application/json'); // ✅ tell browser this is JSON
         $candidateModel = new CandidateModel();
         if ($request->isPost()) {
             $mobile = $_POST['mobile'] ?? '';
             $candidate = $_POST['candidate_name'] ?? '';
             $assignedBy = $_POST['assigned_by'] ?? '';
             $assignedTo = $_POST['assigned_to'] ?? '';
             $remarks = $_POST['remarks'] ?? '';
             $language = $_POST['language'] ?? '';
             $status = 'Pending';

             //echo $remarks;

             $success = CandidateModel::reassignWordSession($mobile,$candidate,$assignedBy,$assignedTo,$status,$remarks,$language);
             if ($success) {
                 echo json_encode(['success' => true]);
                 exit;  // ✅ stop here
             } else {
                 echo json_encode(['success' => false, 'message' => 'Database insert failed']);
                 exit;  // ✅ stop here
             }
         }

         echo json_encode(['success' => false, 'message' => 'Invalid request']);
         exit; // ✅ stop here too

     }



     public function saveWordSessionByReassignedEvangelist(Request $request)
     {

         if ($request->isPost()) {
             $mobile = $_POST['mobile'] ?? '';
             $sessionId = $_POST['sessionName'] ?? '';
             $sessionDate = $_POST['sessionDate'] ?? '';
             $evangelist = Application::$app->session->get('nameFinal');
             $participant = $_POST['participant'] ?? '';
             $wgroup = $_SESSION['evngDashboardData2'][0]->wgroupId ?? '';
             $language = $_POST['language'] ?? '';

             if (empty($mobile) || empty($sessionId) || empty($sessionDate)) {
                 echo json_encode(['success' => false, 'message' => 'Missing required fields']);
                 return;
             }

             $status = 'Scheduled';
             $remark = '';
             $feedback = '';
             $now = (new DateTime())->format('Y-m-d H:i:s');

             try {
                 CandidateModel::saveWordSession(
                     $mobile,
                     $sessionId,
                     $sessionDate,
                     $status,
                     $evangelist,
                     $participant,
                     $wgroup,
                     $language,
                     $remark,
                     $feedback,
                     $now,
                     $now
                 );

                 echo json_encode(['success' => true, 'message' => 'Session saved successfully']);
             } catch (\Throwable $e) {
                 echo json_encode(['success' => false, 'message' => 'DB Error: ' . $e->getMessage()]);
             }
         }

     }



     public function saveWordSession(Request $request)
     {
         $candidateModel = new CandidateModel();
         if ($request->isPost()) {

             $mobile = $_POST['mobile'] ?? '';
             $sessionId = $_POST['sessionName'] ?? '';
             $sessionDate = $_POST['sessionDate'] ?? '';
             $evangelist = Application::$app->session->get('nameFinal');
             $participant = $_POST['participant'] ?? '';
             $wgroup = $_SESSION['evngDashboardData2'][0]->wgroupId ?? '';
             $language = $_POST['language'] ?? '';

             if (empty($mobile) || empty($sessionId) || empty($sessionDate)) {
                 echo json_encode(['success' => false, 'message' => 'Missing required fields']);
                 return;
             }

             $status = 'Scheduled';
             $remark = '';
             $feedback = '';
             $now = (new DateTime())->format('Y-m-d H:i:s');
try {
    CandidateModel::saveWordSession(
        $mobile,
        $sessionId,
        $sessionDate,
        $status,
        $evangelist,
        $participant,
        $wgroup,
        $language,
        $remark,
        $feedback
    );

    echo json_encode(['success' => true, 'message' => 'Session saved successfully']);
} catch (\Throwable $e) {
    echo json_encode(['success' => false, 'message' => 'DB Error: ' . $e->getMessage()]);
}


         }


     }

     public function candidate(Request $request)
     {

         $candidateModel = new CandidateModel();
         if ($request->isPost()) {
             $candidateModel->loadData($request->getBody());
//             echo '<pre>';
//             print_r($candidateModel);
//             echo '</pre>';
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



     public function storeSessionData7D(Request $request)
     {
         // Check if the request is a POST request
         if ($request->isPost()) {
             $data = $request->getBody();

             // Store session data
             $_SESSION['storedData7D'] = $data;

             // Respond with success
             echo json_encode(['status' => 'success']);
             return;
         }

         // Handle non-POST requests or return an error
         echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
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


    public function saveClassDetails7D() {
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
        $userDetails = $registerModel->saveClassDetails7D($candidate);
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
        header("Location: /getClassNumber7D?$queryParams");
        exit(); // Ensure no further code is executed after the redirect


        //return $this->render('classNumberDetailsForCandidate1',  ['data' => $queryParams]);




    }

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


    public function getEditClassDetails7D() {
        $this->setLayout('main1');
        return $this->render('editClassDetails7D');
    }

    public function getEditClassDetails() {

        $this->setLayout('main1');
        return $this->render('editClassDetails');
    }



    public function getClassNumberDetailsForCandidate7D()
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
        return $this->render('classNumberDetailsForCandidate7D',  ['data' => $data]);


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


    public function getClassDetailsForCandidate7D() {

        $registerModel = new RegisterModel();
        // Extract parameters from the URL
        $username = $_GET['username'] ?? null;
        $candidate = $_GET['candidate'] ?? null;
        $mobile = isset($_GET['mobile']) ? rawurldecode($_GET['mobile']) : null;
        $index = $_GET['index'] ?? null;
        Application::$app->session->set('index7D', $index);

        // Validate and sanitize parameters as needed




        // Example: Fetch details based on $username and $candidate
        $userDetails = $registerModel->getUserDetailsByUsername7D($username,$candidate,$mobile);
//        Application::$app->session->set('userDetails', $userDetails);
//        echo '<pre>';
//        var_dump(Application::$app->session->get('userDetails'));
//        echo '</pre>';

        // Render the view with the user details
        $this->setLayout('main1');
        return $this->render('classDetailsForCandidate7D', ['userDetails' => $userDetails]);

    }





    public function getClassDetailsForCandidateTab() {

        $registerModel = new RegisterModel();
        // Extract parameters from the URL
        $username = $_GET['username'] ?? null;
        $candidate = $_GET['candidate'] ?? null;
        $language = $_GET['language'] ?? null;
        $country = $_GET['country'] ?? null;
        $mobile = isset($_GET['mobile']) ? rawurldecode($_GET['mobile']) : null;
        //echo $username;
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
        $this->setLayout('mainT');
        return $this->render('classDetailsForCandidateTabView', ['userDetails' => $userDetails,'mobile' => $mobile, 'candidate' => $candidate, 'username'=> $username,'language'=> $language,'country'=>$country]);
    }


    public function getClassDetailsForCandidate() {

        $registerModel = new RegisterModel();
        // Extract parameters from the URL
        $username = $_GET['username'] ?? null;
        $candidate = $_GET['candidate'] ?? null;
        //$mobile = isset($_GET['mobile']) ? rawurldecode($_GET['mobile']) : null;
        $mobile = $_GET['mobile'] ?? null;
        $mobile = rawurldecode($mobile);
        //$mobile = urldecode($mobile);
        //echo $mobile;

        $index = $_GET['index'] ?? null;
        Application::$app->session->set('index', $index);

        // Validate and sanitize parameters as needed




        // Example: Fetch details based on $username and $candidate
        $userDetails = $registerModel->getUserDetailsByUsername($username,$candidate,$mobile);
        $language= $registerModel->getLanguage($mobile);
        //echo $language;

//        Application::$app->session->set('userDetails', $userDetails);
//        echo '<pre>';
//        var_dump(Application::$app->session->get('userDetails'));
//        echo '</pre>';

        $evangelists = CandidateModel::getLanguageEvangelists($language);
        $appointments = CandidateModel::getAppointmentsByParticipant($mobile); // 👈 Add this line
        $remark = CandidateModel::getCandidateRemarkByMobile($mobile);
        // <-- Add this method to your model

        $evangelist1 = CandidateModel::getCandidateEvangelistByMobile($mobile);

        // Render the view with the user details
        $this->setLayout('main1');
        return $this->render('classDetailsForCandidate', ['userDetails' => $userDetails, 'evangelists' => $evangelists, 'mobile' => $mobile, 'language' => $language, 'candidate' => $candidate,  'appointments' => $appointments, 'remark' => $remark,'evangelist1' => $evangelist1]);
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
