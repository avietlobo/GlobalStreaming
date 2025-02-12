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
 $app-> router->get('/login', [AuthController::class, 'loginEvangelist']);
$app-> router->post('/login', [AuthController::class, 'loginEvangelist']);
$app-> router->get('/forgotPassword', [AuthController::class, 'forgotPassword']);
$app-> router->post('/sendOtp', [AuthController::class, 'sendOtp']);
$app-> router->post('/verifyOtp', [AuthController::class, 'verifyOtp']);
$app-> router->get('/verifyOtp', [AuthController::class, 'verifyOtp']);
$app-> router->get('/resetPassword', [AuthController::class, 'resetPassword']);
$app-> router->post('/resetPassword', [AuthController::class, 'resetPassword']);

$app-> router->get('/evngRegistration', [AuthController::class, 'evngRegistration']);
$app-> router->get('/appRegistration', [AuthController::class, 'appRegistration']);
$app-> router->get('/viewRegistration', [AuthController::class, 'viewRegistration']);

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
// Add this line to your existing routing configuration
$app->router->get('/editCandidate', [SiteController::class, 'editCandidate']);
$app->router->post('/updateCandidate', [SiteController::class, 'updateCandidate']);

$app-> router->get('/video', [AuthController::class, 'video']);
$app-> router->get('/logout', [AuthController::class, 'logout']);
$app-> router->post('/logout', [AuthController::class, 'logout']);
$app-> router->get('/logoutEv', [AuthController::class, 'logoutEvangelistPortal']);
$app-> router->post('/logoutEv', [AuthController::class, 'logoutEvangelistPortal']);

$app-> router->get('/profile', [AuthController::class, 'profile']);
$app-> router->get('/evngDashboard', [AuthController::class, 'evngDashboard']);
$app-> router->get('/evngDashboard1', [AuthController::class, 'evngDashboard1']);
$app-> router->get('/candidate', [SiteController::class, 'candidate']);
$app-> router->get('/getAllCan', [SiteController::class, 'getAllCandidate']);
$app-> router->post('/getClassDetails', [SiteController::class, 'getClassDetailsForCandidate']);
$app-> router->get('/getClassNumber', [SiteController::class, 'getClassNumberDetailsForCandidate']);
$app-> router->get('/editClassDetails', [SiteController::class, 'getEditClassDetails']);
$app-> router->post('/saveClassDetails', [SiteController::class, 'saveClassDetails']);



$app-> router->post('/getClassDetails1', [SiteController::class, 'getClassDetailsForCandidate1']);
$app-> router->get('/getClassDetails', [SiteController::class, 'getClassDetailsForCandidate']);
$app-> router->post('/candidate', [SiteController::class, 'candidate']);
$app-> router->get('/register', [\app\controllers\AuthController::class, 'register1']);
$app-> router->post('/register', [\app\controllers\AuthController::class, 'register1']);
$app-> router->get('/registerEv', [\app\controllers\AuthController::class, 'registerEvangelist']);
$app-> router->post('/registerEv', [\app\controllers\AuthController::class, 'registerEvangelist']);
$app-> router->post('/update_session', [\app\controllers\AuthController::class, 'update_session']);
$app-> router->post('/swt', [\app\controllers\AuthController::class, 'swt']);

$app-> run();



