<?php
/**
 * User: Aviet
 * Date: 15/04/2023
 * Time: 10:54 AM 
 */

use app\controllers\SiteController;
use app\controllers\AuthController;
use app\core\Application;

 require_once __DIR__.'/../vendor/autoload.php';


 $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
 $dotenv->load();




 $config = [
     'userClass'=>  \app\models\RegisterModel::class,
    'db' =>  [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]

 ];

 $app = new Application(dirname(__DIR__), $config);

$app-> router->get('/', [AuthController::class, 'login']);
$app-> router->post('/', [AuthController::class, 'login']);
$app-> router->get('/v2', [AuthController::class, 'loginV2']);
$app-> router->post('/v2', [AuthController::class, 'loginV2']);
$app-> router->get('/login', [AuthController::class, 'loginEvangelist']);
$app-> router->post('/login', [AuthController::class, 'loginEvangelist']);
$app-> router->get('/viewAllCanAttendenceMarking', [AuthController::class, 'viewAllCanAttendenceMarking']);
$app-> router->get('/viewAllTelecallersList', [AuthController::class, 'viewAllTelecallersList']);
$app-> router->get('/viewAllSMList', [AuthController::class, 'viewAllSMList']);
$app-> router->get('/viewMyTasks', [AuthController::class, 'viewMyTasks']);
$app-> router->get('/addNewSathEvent', [AuthController::class, 'addNewSathEvent']);
$app-> router->post('/addNewSathEvent', [AuthController::class, 'addNewSathEvent']);
$app-> router->get('/organizeEvent', [AuthController::class, 'organizeEvent']);
$app-> router->post('/organizeEvent', [AuthController::class, 'organizeEvent']);
$app-> router->get('/allEvents', [AuthController::class, 'allEvents']);





$app-> router->get('/addNewHomeEvent', [AuthController::class, 'addNewHomeEvent']);
$app-> router->post('/addNewHomeEvent', [AuthController::class, 'addNewHomeEvent']);

$app-> router->get('/viewAppointmentsTabs', [AuthController::class, 'viewAppointmentsTabs']);
$app-> router->get('/viewAppointments', [AuthController::class, 'viewAppointments']);
$app-> router->get('/viewAppointment', [AuthController::class, 'viewAppointment']);

$app-> router->get('/viewAllAppointmentsPM', [AuthController::class, 'viewAllAppointmentsPM']);
$app-> router->get('/viewAllAppointmentsCT', [AuthController::class, 'viewAllAppointmentsCT']);
$app-> router->get('/viewAllAppointmentsLO', [AuthController::class, 'viewAllAppointmentsLO']);
$app-> router->get('/viewAllAppointmentsReadonly', [AuthController::class, 'viewAllAppointmentsReadonly']);
$app-> router->get('/viewAllAppointmentsSR', [AuthController::class, 'viewAllAppointmentsSR']);
$app-> router->get('/viewAllAppointmentsIF', [AuthController::class, 'viewAllAppointmentsIF']);

$app-> router->get('/mylangPref', [AuthController::class, 'mylangPref']);
$app-> router->post('/mylangPref', [AuthController::class, 'mylangPref']);


$app-> router->get('/myPref', [AuthController::class, 'myPref']);
$app-> router->post('/myPref', [AuthController::class, 'myPref']);
$app-> router->get('/viewCandidates', [AuthController::class, 'viewCandidates']);
$app->router->get('/getCandidatesByLanguage', [AuthController::class, 'getCandidatesByLanguage']);
$app->router->get('/getCandidatesByLangAndCountry', [AuthController::class, 'getCandidatesByLangAndCountry']);
$app->router->get('/getCandidatesByEvangelist', [AuthController::class, 'getCandidatesByEvangelist']);
$app->router->get('/getCandidateDetails', [AuthController::class, 'getCandidateDetails']);
$app->router->get('/addAppointment', [AuthController::class, 'addAppointment']);
$app->router->post('/saveAppointment', [AuthController::class, 'saveAppointment']);
$app->router->get('/editAppointment', [AuthController::class, 'editAppointment']);
$app->router->get('/editAppointmentPM', [AuthController::class, 'editAppointmentPM']);
$app->router->get('/editAppointmentCT', [AuthController::class, 'editAppointmentCT']);
$app->router->get('/editAppointmentLO', [AuthController::class, 'editAppointmentLO']);
$app->router->post('/updateAppointment', [AuthController::class, 'updateAppointment']);



$app-> router->get('/event-details', [AuthController::class, 'viewEvent']);
$app-> router->get('/event-details1', [AuthController::class, 'viewEvent1']);
$app-> router->get('/edit-event', [AuthController::class, 'editEvent']);
$app-> router->post('/edit-event', [AuthController::class, 'editEvent']);

$app-> router->get('/edit-event1', [AuthController::class, 'editEvent1']);
$app-> router->post('/edit-event1', [AuthController::class, 'editEvent1']);


$app-> router->get('/viewTaskDetails', [AuthController::class, 'viewTaskDetails']);
$app-> router->post('/updateTaskDetails', [AuthController::class, 'updateTaskDetails']);



$app-> router->post('/bulkAssignTelecaller', [AuthController::class, 'bulkAssignTelecaller']);
$app-> router->post('/bulkAssignSm', [AuthController::class, 'bulkAssignSm']);

$app-> router->post('/saveAttendance', [AuthController::class, 'saveAttendance']);
$app-> router->get('/searchAttendancePage', [AuthController::class, 'searchAttendancePage']);


$app-> router->get('/csvFileUpload', [AuthController::class, 'csvFileUpload']);
$app-> router->post('/process_upload', [AuthController::class, 'process_upload']);




$app-> router->get('/view7DCan', [AuthController::class, 'view7DCan']);
$app-> router->get('/view7DApproval', [AuthController::class, 'view7DApproval']);
$app-> router->get('/view7DApproved', [AuthController::class, 'view7DApproved']);
$app-> router->post('/approve7DCandidate', [AuthController::class, 'approve7DCandidate']);
$app-> router->get('/forgotPassword', [AuthController::class, 'forgotPassword']);
$app-> router->post('/sendOtp', [AuthController::class, 'sendOtp']);
$app-> router->post('/sendOtpAgain', [AuthController::class, 'sendOtpAgain']);
$app-> router->post('/verifyOtp', [AuthController::class, 'verifyOtp']);
$app-> router->get('/verifyOtp', [AuthController::class, 'verifyOtp']);
$app-> router->get('/resetPassword', [AuthController::class, 'resetPassword']);
$app-> router->post('/resetPassword', [AuthController::class, 'resetPassword']);

$app-> router->get('/evngRegistration', [AuthController::class, 'evngRegistration']);
$app-> router->get('/appRegistration', [AuthController::class, 'appRegistration']);
$app-> router->get('/viewRegistration', [AuthController::class, 'viewRegistration']);
$app-> router->get('/viewAllRegistrations', [AuthController::class, 'viewAllRegistrations']);


$app-> router->post('/rejectRegistration', [AuthController::class, 'rejectRegistration']);
$app-> router->post('/approveRegistration', [AuthController::class, 'approveRegistration']);


$app-> router->post('/submitRegistration', [AuthController::class, 'submitRegistration']);

$app-> router->get('/reportManagement', [SiteController::class, 'reportManagement']);
$app-> router->get('/reportManagementGroupLeader', [SiteController::class, 'reportManagementGroupLeader']);
$app-> router->get('/allEvangelistsForGroupLeader', [SiteController::class, 'allEvangelistsForGroupLeader']);
$app-> router->get('/allEvangelistsForGroupLeaderCountryWise', [SiteController::class, 'allEvangelistsForGroupLeaderCountryWise']);
$app-> router->get('/allEvangelistsForGroupLeaderCountryWiseDetailedRecords', [SiteController::class, 'allEvangelistsForGroupLeaderCountryWiseDetailedRecords']);

$app-> router->get('/allEvangelistsClassRequestsForGroupLeader', [SiteController::class, 'allEvangelistsClassRequestsForGroupLeader']);
$app-> router->get('/languageGroupingForGroupLeader', [SiteController::class, 'languageGroupingForGroupLeader']);

$app-> router->get('/EvangelistDetailedCandidatesForGroupLeader', [SiteController::class, 'EvangelistDetailedCandidatesForGroupLeader']);






$app-> router->get('/wgroupsWiseCountsForEvngCoord', [SiteController::class, 'wgroupsWiseCountsForEvngCoord']);

$app-> router->get('/countryGroupingEvngCoord', [SiteController::class, 'countryGroupingEvngCoord']);

$app-> router->get('/evangelistGroupingEvngCoord', [SiteController::class, 'evangelistGroupingEvngCoord']);

$app-> router->get('/evangelistCandidatesEvngCoord', [SiteController::class, 'evangelistCandidatesEvngCoord']);

$app-> router->get('/evangelistCandidatesGTCGroupWiseEvngCoord', [SiteController::class, 'evangelistCandidatesGTCGroupWiseEvngCoord']);

$app-> router->get('/evangelistCandidatesDetailedGTCGroupWiseEvngCoord', [SiteController::class, 'evangelistCandidatesDetailedGTCGroupWiseEvngCoord']);

$app-> router->get('/totalReportCountManagement', [SiteController::class, 'totalReportCountManagement']);
$app-> router->get('/languageGrouping', [SiteController::class, 'languageGrouping']);
$app-> router->get('/totalLanguageGrouping', [SiteController::class, 'totalLanguageGrouping']);
$app-> router->get('/totalLanguageWiseCandidateDetails', [SiteController::class, 'totalLanguageWiseCandidateDetails']);
$app-> router->get('/totalGTCWiseCounts', [SiteController::class, 'totalGTCWiseCounts']);
$app-> router->get('/totalGTCWiseStatusCounts', [SiteController::class, 'totalGTCWiseStatusCounts']);
$app-> router->get('/totalGTCWiseStatusWiseDetailedRecords', [SiteController::class, 'totalGTCWiseStatusWiseDetailedRecords']);
$app-> router->get('/statusWiseGrouping', [SiteController::class, 'totalStatusWiseGrouping']);
$app-> router->get('/totalStatusWiseDetailedRecords', [SiteController::class, 'totalStatusWiseDetailedRecords']);
$app-> router->get('/countryGrouping', [SiteController::class, 'countryGrouping']);
$app-> router->get('/countrywiseStatusGrouping', [SiteController::class, 'countrywiseStatusGrouping']);
$app-> router->get('/countrywiseLanguageGrouping', [SiteController::class, 'countrywiseLanguageGrouping']);
$app-> router->get('/countrywiseCandidateDetails', [SiteController::class, 'countrywiseCandidateDetails']);
$app-> router->get('/languageCounts', [SiteController::class, 'languageCounts']);
$app-> router->get('/wGroupCounts', [SiteController::class, 'wGroupCounts']);
$app-> router->get('/statusCounts', [SiteController::class, 'statusCounts']);
$app-> router->get('/canDetails', [SiteController::class, 'candidateDetailedRecord']);
$app->router->post('/storeSessionData', [SiteController::class, 'storeSessionData']);
$app->router->post('/storeSessionData7D', [SiteController::class, 'storeSessionData7D']);
// Add this line to your existing routing configuration
$app->router->get('/editCandidate', [SiteController::class, 'editCandidate']);
$app->router->get('/editCandidate7D', [SiteController::class, 'editCandidate7D']);
$app->router->post('/updateCandidate', [SiteController::class, 'updateCandidate']);
$app->router->post('/updateCandidate7D', [SiteController::class, 'updateCandidate7D']);
$app-> router->get('/video', [AuthController::class, 'video']);
$app-> router->get('/logout', [AuthController::class, 'logout']);
$app-> router->post('/logout', [AuthController::class, 'logout']);
$app-> router->get('/logoutEv', [AuthController::class, 'logoutEvangelistPortal']);
$app-> router->post('/logoutEv', [AuthController::class, 'logoutEvangelistPortal']);

$app-> router->get('/profile', [AuthController::class, 'profile']);
$app-> router->get('/evngDashboard', [AuthController::class, 'evngDashboard']);
$app-> router->get('/evngDashboard7', [AuthController::class, 'evngDashboard7']);
$app-> router->get('/evngDashboard1', [AuthController::class, 'evngDashboard1']);
$app-> router->get('/candidate', [SiteController::class, 'candidate']);
$app-> router->get('/getAllCan', [SiteController::class, 'getAllCandidate']);
$app-> router->post('/getClassDetails', [SiteController::class, 'getClassDetailsForCandidate']);
$app-> router->get('/getClassDetailsTab', [SiteController::class, 'getClassDetailsForCandidateTab']);

$app-> router->post('/getClassDetails7D', [SiteController::class, 'getClassDetailsForCandidate7D']);
$app-> router->get('/getClassNumber', [SiteController::class, 'getClassNumberDetailsForCandidate']);
$app-> router->get('/getClassNumber7D', [SiteController::class, 'getClassNumberDetailsForCandidate7D']);
$app-> router->get('/editClassDetails', [SiteController::class, 'getEditClassDetails']);
$app-> router->get('/editClassDetails7D', [SiteController::class, 'getEditClassDetails7D']);
$app-> router->post('/saveClassDetails', [SiteController::class, 'saveClassDetails']);
$app-> router->post('/saveClassDetails7D', [SiteController::class, 'saveClassDetails7D']);



$app-> router->post('/getClassDetails1', [SiteController::class, 'getClassDetailsForCandidate1']);
$app-> router->get('/getClassDetails', [SiteController::class, 'getClassDetailsForCandidate']);
$app-> router->get('/getClassDetails7D', [SiteController::class, 'getClassDetailsForCandidate7D']);
$app-> router->post('/candidate', [SiteController::class, 'candidate']);
$app-> router->post('/saveWordSession', [SiteController::class, 'saveWordSession']);
$app-> router->post('/reassignWordSharing', [SiteController::class, 'reassignWordSharing']);

$app-> router->post('/saveWordSessionByReassignedEvangelist', [SiteController::class, 'saveWordSessionByReassignedEvangelist']);


$app-> router->get('/getApprovals', [SiteController::class, 'getApprovals']);
$app-> router->get('/getWordSessions', [SiteController::class, 'getWordSessions']);
$app-> router->post('/updateSession', [SiteController::class, 'updateSession']);
$app-> router->get('/getWordSessionsOfAssignedEvng', [SiteController::class, 'getWordSessionsOfAssignedEvng']);
$app->router->get('/wordSessionDetail', [SiteController::class, 'wordSessionDetail']);
$app->router->get('/getHomeMission', [SiteController::class, 'getHomeMission']);

$app-> router->get('/getWordSessionsApproved', [SiteController::class, 'getWordSessionsApproved']);
$app-> router->get('/viewAssignedWordSessions', [SiteController::class, 'viewAssignedWordSessions']);
$app-> router->post('/viewAssignedWordSessions', [SiteController::class, 'viewAssignedWordSessions']);
$app-> router->get('/approveWordSession', [SiteController::class, 'approveWordSession']);
$app-> router->post('/approveWordSession', [SiteController::class, 'approveWordSession']);




$app-> router->post('/saveCandidate', [SiteController::class, 'saveCandidateDataDist']);
$app-> router->get('/register', [\app\controllers\AuthController::class, 'register1']);
$app-> router->post('/register', [\app\controllers\AuthController::class, 'register1']);
$app-> router->get('/register7D', [\app\controllers\AuthController::class, 'register17D']);
$app-> router->post('/register7D', [\app\controllers\AuthController::class, 'register17D']);
$app-> router->get('/registerEv', [\app\controllers\AuthController::class, 'registerEvangelist']);
$app-> router->post('/registerEv', [\app\controllers\AuthController::class, 'registerEvangelist']);
$app-> router->post('/update_session', [\app\controllers\AuthController::class, 'update_session']);
$app-> router->post('/swt', [\app\controllers\AuthController::class, 'swt']);

$app-> run();



