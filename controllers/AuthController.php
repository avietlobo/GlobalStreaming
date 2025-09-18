<?php
/** User: Aviet Lobo ...*/



namespace app\controllers;



use app\core\Application;
use app\core\Controller;
use app\core\DbModel;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\gateway\CanDetailsGateway;
use app\models\CandidateModel;
use app\models\DataBankModel;
use app\models\EvangelistModel;
use app\models\EvangelistReviewModel;
use app\models\LoginForm;
use app\models\RegisterModel;
use app\models\SathvarthaEventModel;
use app\models\TelecallerSMModel;
use app\models\UploadProcessLogModel;
use app\models\VideoWatchHistoryModel;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Class AuthController
 *
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\controllers
 */

class AuthController extends Controller
{

    private $userId;
    public $mobile;
    public $language;
    public $evangelist;
    public $participantName;
    public $country;


    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile', 'video']));
    }

    public function loginV2(Request $request, Response $response)
    {
        $loginForm = new LoginForm();

        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            $hiddenField = $_POST["hidden_field"];
            if (!empty($username) || !empty($password) || !empty($hiddenField)) {
                return;
            }
            if ($loginForm->validate() && $loginForm->login7D()) {
                $id = Application::$app->session->get('user');
                $data = RegisterModel::findCandidateClassDetails7D(['id' => $id]);
                $mediaType = $data->mediaType;

                if ($mediaType == 'Web Video') {
                    $this->setLayout('main3');
                    return $this->render('video7D', [
                        'model' => $data
                    ]);
                }

                if ($mediaType == 'Web Audio') {
                    $this->setLayout('main3');
                    return $this->render('audio7D', [
                        'model' => $data
                    ]);
                }
            }
        }

        $this->setLayout('main3');
        return $this->render('login', [
            'model' => $loginForm
        ]);


    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            $hiddenField = $_POST["hidden_field"];
            if (!empty($username) || !empty($password) || !empty($hiddenField)) {
                return;
            }
            if ($loginForm->validate() && $loginForm->login()) {
                // echo "hello22";
                $id = Application::$app->session->get('user');
                $data = RegisterModel::findCandidateClassDetails(['id' => $id]);
                $mediaType = $data->mediaType;
                //   echo '</pre>';
                //   var_dump($mediaType);
                //   echo '</pre>';


                //$response->redirect('/video');
                if ($mediaType == 'Web Video') {
                    return $this->render('video', [
                        'model' => $data
                    ]);
                }

                if ($mediaType == 'Web Audio') {
                    return $this->render('audio', [
                        'model' => $data
                    ]);
                }


////             Application::$app->login()
                //return;
            }
        }

        $this->setLayout('main');
        return $this->render('login', [
            'model' => $loginForm
        ]);

    }




    public function submitRegistration1(Request $request, Response $response)
    {

        $evangelistReviewModel = new EvangelistReviewModel();
        $errorMessage = ''; // Initialize error message
        $errorMessage2 = ''; // Initialize error message
        if ($request->isPost()) {
            // Get POST data
            $zion_id = $_POST['memberID'];
            $evngName = $_POST['memberName'];
            $mobile = $_POST['memberContact'];
            $fellowship = $_POST['fellowship'];
            $email = $_POST['memberEmail'];
            $designation = $_POST['designation'];
            $updatedBy = $_POST['updatedBy'];
            // Handle photo upload
            $photoName = '';
            $wgroup = $_POST['workGroup'];

            // Check if mobile or email already exists in the `evangelist_in_review` table
            $existingRecord = $evangelistReviewModel->findEvangelist($mobile,$email);

            // Check if mobile or email already exists in the `evangelist` table
            $existingRecord2 = $evangelistReviewModel->findEvangelistMain($mobile,$email);

            if ($existingRecord) {
                // If record exists, set the error message
                $errorMessage = 'Error: Mobile or email already exists in the system.';
                $this->setLayout('main1');
                return $this->render('memberRegistration', ['errorMessage' => $errorMessage,'errorMessage2' => $errorMessage2]);

            }

            if ($existingRecord2) {
                // If record exists, set the error message
                $errorMessage2 = 'Evangelist already registered.';
                $this->setLayout('main1');
                return $this->render('memberRegistration', ['errorMessage' => $errorMessage,'errorMessage2' => $errorMessage2]);

            }



            //Check if mobile or email already present in evangelist table


            if (isset($_FILES['uploadPhoto']) && $_FILES['uploadPhoto']['error'] === UPLOAD_ERR_OK) {
                // Validate file type
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $imageInfo = getimagesize($_FILES['uploadPhoto']['tmp_name']);

                if ($imageInfo !== false && in_array($imageInfo['mime'], $allowedTypes)) {
                    // Ensure the file size is under 1MB
                    if ($_FILES['uploadPhoto']['size'] <= 1048576) { // 1MB = 1048576 bytes
                        // Generate a unique file name
                        $photoName = uniqid('photo_', true) . '.' . pathinfo($_FILES['uploadPhoto']['name'], PATHINFO_EXTENSION);

                        // Define the upload directory
                        $uploadDir = 'uploads/photos/';

                        // Create directory if it doesn't exist
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true); // Create the directory with restricted permissions
                        }

                        // Define the full upload file path
                        $uploadFilePath = $uploadDir . $photoName;


                        $evangelistReviewModel->memberRegister($zion_id, $evngName, $mobile, $photoName, $fellowship, $email,$designation,$wgroup);
                        $_SESSION['successMessage'] = 'Registration successful! Lets wait for approval.';

                        // Move the uploaded file to the uploads directory
                        if (!move_uploaded_file($_FILES['uploadPhoto']['tmp_name'], $uploadFilePath)) {
                            die('Error uploading the photo.');
                        }




                    } else {
                        die('Photo size exceeds 1MB.');
                    }
                } else {
                    die('Invalid photo type. Only JPEG, PNG, and GIF are allowed.');
                }
            } else {
                die('No photo uploaded or there was an upload error.');
            }



        }

        $this->setLayout('main1');
        return $this->render('memberRegistration', ['errorMessage' => $errorMessage,'errorMessage2' => $errorMessage2]);

    }

    public function submitRegistration(Request $request, Response $response)
    {
        $evangelistReviewModel = new EvangelistReviewModel();
        $errorMessage = ''; // Initialize error message
        $errorMessage2 = ''; // Initialize error message

        if ($request->isPost()) {
            // Get POST data
            $zion_id = $_POST['memberID'];
            $evngName = $_POST['memberName'];
            $mobile = $_POST['memberContact'];
            $fellowship = $_POST['fellowship'];
            $email = $_POST['memberEmail'];
            $designation = $_POST['designation'];
            $updatedBy = $_POST['updatedBy'];
            $wgroup = $_POST['workGroup'];
            $photoName = ''; // Initialize

            // Check if mobile or email already exists in the `evangelist_in_review` table
            $existingRecord = $evangelistReviewModel->findEvangelist($mobile, $email);

            // Check if mobile or email already exists in the `evangelist` table
            $existingRecord2 = $evangelistReviewModel->findEvangelistMain($mobile, $email);

            if ($existingRecord) {
                $errorMessage = 'Error: Mobile or email already exists in the system.';
                $this->setLayout('main1');
                return $this->render('memberRegistration', [
                    'errorMessage' => $errorMessage,
                    'errorMessage2' => $errorMessage2
                ]);
            }

            if ($existingRecord2) {
                $errorMessage2 = 'Evangelist already registered.';
                $this->setLayout('main1');
                return $this->render('memberRegistration', [
                    'errorMessage' => $errorMessage,
                    'errorMessage2' => $errorMessage2
                ]);
            }

            // Define upload directory
            $uploadDir = 'uploads/photos/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Handle capturedPhoto first (base64)
            if (!empty($_POST['capturedPhoto'])) {
                $base64Image = $_POST['capturedPhoto'];
                $imageData = explode(',', $base64Image)[1];
                $decodedImage = base64_decode($imageData);

                $photoName = 'captured_' . time() . '.jpg';
                $uploadFilePath = $uploadDir . $photoName;

                if (file_put_contents($uploadFilePath, $decodedImage)) {
                    $evangelistReviewModel->memberRegister($zion_id, $evngName, $mobile, $photoName, $fellowship, $email, $designation, $wgroup);
                    $_SESSION['successMessage'] = 'Registration successful! Let’s wait for approval.';
                } else {
                    die('Failed to save captured image.');
                }

            } elseif (isset($_FILES['uploadPhoto']) && $_FILES['uploadPhoto']['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $imageInfo = getimagesize($_FILES['uploadPhoto']['tmp_name']);

                if ($imageInfo !== false && in_array($imageInfo['mime'], $allowedTypes)) {
                    if ($_FILES['uploadPhoto']['size'] <= 1048576) {
                        $photoName = uniqid('photo_', true) . '.' . pathinfo($_FILES['uploadPhoto']['name'], PATHINFO_EXTENSION);
                        $uploadFilePath = $uploadDir . $photoName;

                        if (move_uploaded_file($_FILES['uploadPhoto']['tmp_name'], $uploadFilePath)) {
                            $evangelistReviewModel->memberRegister($zion_id, $evngName, $mobile, $photoName, $fellowship, $email, $designation, $wgroup);
                            $_SESSION['successMessage'] = 'Registration successful! Let’s wait for approval.';
                        } else {
                            die('Error uploading the photo.');
                        }
                    } else {
                        die('Photo size exceeds 1MB.');
                    }
                } else {
                    die('Invalid photo type. Only JPEG, PNG, and GIF are allowed.');
                }

            } else {
                $errorMessage = 'Please upload or capture a photo.';
                $this->setLayout('main1');
                return $this->render('memberRegistration', [
                    'errorMessage' => $errorMessage,
                    'errorMessage2' => $errorMessage2
                ]);
            }
        }

        $this->setLayout('main1');
        return $this->render('memberRegistration', [
            'errorMessage' => $errorMessage,
            'errorMessage2' => $errorMessage2,
            'photoErrorMessage' => $photoErrorMessage ?? ''
        ]);
    }


    public function evngRegistration(Request $request, Response $response)
    {
        $this->setLayout('main1');
        return $this->render('memberRegistration');

    }




    public function approveRegistration(Request $request, Response $response)
    {
        $evangelistReviewModel = new EvangelistReviewModel();
        if ($request->isPost()) {

            $body = $request->getBody();
            error_log(print_r($body, true)); // This will log the entire body array
            // Step 3: Extract the necessary data (e.g., member_id, rejection reason, status)
            $zion_id = $body['member_id'] ?? null;
            $mobile = $body['mobile'] ?? null;
            $email= $body['emailID'] ?? null;
            $evngName= $body['evangelist'] ?? null;
            $status = 'Approved';
            $designation= $body['designation'] ?? null;
            $workgroup= $body['workgroup'] ?? null;
            $updatedBy= Application::$app->session->get('loginForm')->username;

            echo '<pre>';
            var_dump($workgroup);
            echo '</pre>';

            // Prepare data array for adding a new evangelist
            $data = [
                'email' => $email,
                'mobile' => $mobile,
                'evangelist' => $evngName,
                'designation' => $designation,
                'workgroup' => $workgroup
            ];

                        echo '<pre>';
            var_dump($data);
            echo '</pre>';

            $result = $evangelistReviewModel->updateMember($status,'',$zion_id);
            $evangelistReviewModel->addNewEvangelist($data);

            // Return a JSON response to the client
            $result2=$evangelistReviewModel->getMembers();
            return $this->render('appRegistration1', ['members' => $result2]);

        }


        $result=$evangelistReviewModel->getMembers();
        return $this->render('appRegistration1', ['members' => $result]);
    }

    public function rejectRegistration(Request $request, Response $response)
    {

        $evangelistReviewModel = new EvangelistReviewModel();
        if ($request->isPost()) {

            $body = $request->getBody();
            error_log(print_r($body, true)); // This will log the entire body array
            // Step 3: Extract the necessary data (e.g., member_id, rejection reason, status)
            $zion_id = $body['member_id'] ?? null;
            $rejectedReason = $body['rejected_reason'] ?? null;
            $status = 'Rejected';

            error_log(print_r($rejectedReason, true)); // This will log the entire body array

//            echo '<pre>';
//            var_dump($zion_id);
//            echo '</pre>';


            $result = $evangelistReviewModel->updateMember($status,$rejectedReason,$zion_id);
            // Return a JSON response to the client
            $result2=$evangelistReviewModel->getMembers();
            return $this->render('appRegistration1', ['members' => $result2]);

        }


        $result=$evangelistReviewModel->getMembers();
        return $this->render('appRegistration1', ['members' => $result]);
    }


    public function viewAllRegistrations(Request $request, Response $response)
    {
        $this->setLayout('main1');
        $evangelistReviewModel = new EvangelistReviewModel();
        $result=$evangelistReviewModel->viewAllRegMembers();

        return $this->render('viewAppRegistrations', ['members' => $result]);

    }


    public function viewRegistration(Request $request, Response $response)
    {
        $this->setLayout('main1');
        $evangelistReviewModel = new EvangelistReviewModel();
        $result=$evangelistReviewModel->viewRegMembers();

        return $this->render('viewAppRegistrations', ['members' => $result]);
    }


    public function appRegistration(Request $request, Response $response)
    {
        $this->setLayout('main1');
        $evangelistReviewModel = new EvangelistReviewModel();
        $result=$evangelistReviewModel->getMembers();

        // Pass the result to the view for dynamic rendering
        return $this->render('appRegistration', ['members' => $result]);



    }

    public function forgotPassword()
    {
        $this->setLayout('main2');
        return $this->render('forgotPassword', [
            'model' => ''
        ]);

    }



    public function resetPassword(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $email = Application::$app->session->get('otp_email');
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            // Validate input
            if (!$email || !$password || !$confirmPassword) {
                return $this->render('resetPassword', [
                    'error' => 'All fields are required.'
                ]);
            }

            if ($password !== $confirmPassword) {
                return $this->render('resetPassword', [
                    'error' => 'Passwords do not match.'
                ]);
            }



            $evangelistModel = new EvangelistModel();
            $evangelistModel->resetPwd1($email,$password);

            $this->setLayout('main1');

//            return $this->render('resetPassword1', [
//                'success' => 'Your password has been successfully reset.'
//            ]);
            return $this->render('resetPassword1', [
                'successMessage' => "Your password has been reset successfully. Redirecting to login..."
            ]);



        }
        $this->setLayout('main1');
        return $this->render('resetPassword', [
            'model' => ''
        ]);


    }

    public function verifyOtp(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $enteredOtp = $_POST['otp'];
            $storedOtp = Application::$app->session->get('otp');
            $otpEmail = Application::$app->session->get('otp_email');
            $otpExpires = Application::$app->session->get('otp_expires');
            if (time() > $otpExpires) {

                $errorMessage = "Your OTP has expired. Please request a new one.";
                $this->setLayout('main2');
                return $this->render('verifyOtp', [
                    'errorMessage' => $errorMessage
                ]);

            }
            if ($enteredOtp == $storedOtp) {
                Application::$app->session->remove('otp'); // Remove OTP from session
                Application::$app->session->remove('otp_expires');
                header("Location: /resetPassword?email=$otpEmail");
            } else {

                $errorMessage = "Invalid OTP.";
                $this->setLayout('main2');
                return $this->render('verifyOtp', [
                    'errorMessage' => $errorMessage
                ]);
            }


        }
        $this->setLayout('main1');
        return $this->render('verifyOtp', [
            'model' => ''
        ]);


    }

    public function sendOtpAgain(Request $request, Response $response)
    {
        $email = Application::$app->session->get('otp_email');

        // Generate a random OTP
        $otp = random_int(100000, 999999);

        // Save OTP in the session or database (with expiration time)
        Application::$app->session->set('otp', $otp);
        Application::$app->session->set('otp_email', $email);
        Application::$app->session->set('otp_expires', time() + 300); // Expires in 5 minutes

        // Send OTP via email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.hostinger.com';
            //$mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_ID'];; // Your Hostinger address
            //$mail->Username = 'avietlobo@gmail.com'; // Your Gmail address
            $mail->Password =$_ENV['MAIL_PASSWORD'];;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($_ENV['MAIL_ID'], 'Gods Own Wisdom');
            //$mail->setFrom('avietlobo@gmail.com', 'Your App Name');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Password Reset OTP';
            $mail->Body = "Your OTP is <strong>$otp</strong>. It is valid for 5 minutes.";

            $mail->send();
            //echo 'OTP sent successfully.';
            // Redirect to the OTP verification page
            $this->setLayout('main2');
            return $this->render('verifyOtp', [
                'regEmail' => $email
            ]);
//            header("Location: /verifyOtp");
//            exit();

        } catch (Exception $e) {
            echo "Error in sending email: {$mail->ErrorInfo}";
        }




    }

    public function sendOtp(Request $request, Response $response)
    {
        $email = $_POST['email'];
        //echo 'MAIL_PASSWORD: ' . $_ENV['MAIL_PASSWORD'];
        // Check if email exists in the database
        $user = EvangelistModel::findEvangelistUsingEmailId($email);



        if (!$user) {
            // Display the same view with an error message
            $errorMessage = "No account found for this email address. Please try again";
            $this->setLayout('main2');
            return $this->render('forgotPassword', [
                'errorMessage' => $errorMessage
            ]);
        }

        // Generate a random OTP
        $otp = random_int(100000, 999999);

        // Save OTP in the session or database (with expiration time)
        Application::$app->session->set('otp', $otp);
        Application::$app->session->set('otp_email', $email);
        Application::$app->session->set('otp_expires', time() + 300); // Expires in 5 minutes

        // Send OTP via email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.hostinger.com';
            //$mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_ID'];; // Your Hostinger address
            //$mail->Username = 'avietlobo@gmail.com'; // Your Gmail address
            $mail->Password =$_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            //$mail->Port = 465;

            // Recipients
            $mail->setFrom($_ENV['MAIL_ID'], 'Gods Own Wisdom');
            //$mail->setFrom('avietlobo@gmail.com', 'Your App Name');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Password Reset OTP';
            $mail->Body = "Your OTP is <strong>$otp</strong>. It is valid for 5 minutes.";

            $mail->send();
            //echo 'OTP sent successfully.';
            // Redirect to the OTP verification page
            $this->setLayout('main2');
            return $this->render('verifyOtp', [
                'regEmail' => $email
            ]);
//            header("Location: /verifyOtp");
//            exit();

        } catch (Exception $e) {
            echo "Error in sending email: {$mail->ErrorInfo}";
        }


    }




    public function approve7DCandidate(Request $request, Response $response)
    {
        $data = $request->getBody();

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
        $caretakerEmail = $data['caretaker_email'] ?? null;


        CandidateModel::saveRecordIn7DCandidate($data);
        return $this->render('evngDashboard1');




    }



    public function view7DApproved(Request $request, Response $response)
    {
        $candidates = CandidateModel::findAllApprovedCandidatesFor7D();
        $this->setLayout('main1');
        return $this->render('7DApprovedCandidates', [
            'models' => $candidates]);
    }

    public function view7DApproval(Request $request, Response $response)
    {
        $candidates = CandidateModel::findAllCandidatesFor7D();
        $this->setLayout('main1');
        return $this->render('7DApprovalScreen', [
            'models' => $candidates]);
    }

    function isValidCSVHeader($header): bool
    {
        $expected = ['mobile','name','record_date','email','source','country','city','referredBy','group_name','fellowship','language'];
        return $header === $expected;
    }


    function generateProcessId(): string
    {
        return uniqid('PID-') . '-' . bin2hex(random_bytes(4));
    }


//    public function process_upload(Request $request, Response $response)
//    {
//
//
//
//        $fileTmpPath = $_FILES['csv_file']['tmp_name'];
//        $rows = array_map('str_getcsv', file($fileTmpPath));
//        $header = array_map('trim', array_shift($rows));
//        if (!$this->isValidCSVHeader($header)) {
//            die("Invalid CSV header format.");
//        }
//
//        if ($_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
//            die("Error uploading file.");
//        }
//
//        $fileTmpPath = $_FILES['csv_file']['tmp_name'];
//        $rows = array_map('str_getcsv', file($fileTmpPath));
//        $header = array_map('trim', array_shift($rows));
//
//        if (!$this->isValidCSVHeader($header)) {
//            die("Invalid CSV header format.");
//        }
//
//        if (count($rows) < 1) {
//            die("CSV file cannot have less than 1 row.");
//        }
//
//        if (count($rows) > 1000) {
//            die("CSV file cannot have more than 1000 rows.");
//        }
//
//        $processId = $this->generateProcessId();
//        $uploadTime = date('Y-m-d H:i:s');
//        $status = 'Processing';
//        $errorFile = "logs/{$processId}_errors.csv";
//        $outputFile = "logs/{$processId}_output.csv";
//
//        if (!is_dir('logs')) {
//            mkdir('logs', 0777, true);
//        }
//
//        file_put_contents($errorFile, implode(",", $header) . ",error\n");
//        file_put_contents($outputFile, implode(",", $header) . "\n");
//
//        $evngName = Application::$app->session->get('nameFinal');
//        UploadProcessLogModel::uploadProcessId($processId, $evngName,$uploadTime, $status, $errorFile, $outputFile);
//        DataBankModel::loadDataBank($rows,$header,$errorFile,$outputFile,$processId);
//
//        $allUploads = UploadProcessLogModel::getUploadsByUser($evngName);
//        $this->setLayout('main1');
//        return $this->render('process_upload', [
//            'errorFilePath' => "logs/{$processId}_errors.csv",
//            'outputFilePath' => "logs/{$processId}_output.csv",
//            'processId' => $processId,
//            'allUploads' => $allUploads
//        ]);
//    }


        //recently commented
//        public function process_upload(Request $request, Response $response)
//        {
//            $errorMessage = null;
//
//            if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
//                $errorMessage = "Error uploading file.";
//            } else {
//                $fileTmpPath = $_FILES['csv_file']['tmp_name'];
//                $rows = array_map('str_getcsv', file($fileTmpPath));
//                $header = array_map('trim', array_shift($rows));
//
//                if (!$this->isValidCSVHeader($header)) {
//                    $errorMessage = "Invalid CSV header format.";
//                } elseif (count($rows) < 1) {
//                    $errorMessage = "CSV file must have at least 1 data row.";
//                } elseif (count($rows) > 1000) {
//                    $errorMessage = "CSV file cannot have more than 1000 rows.";
//                } else {
//                    $processId = $this->generateProcessId();
//                    $uploadTime = date('Y-m-d H:i:s');
//                    $status = 'Processing';
//                    $errorFile = "logs/{$processId}_errors.csv";
//                    $outputFile = "logs/{$processId}_output.csv";
//
//                    if (!is_dir('logs')) {
//                        mkdir('logs', 0777, true);
//                    }
//
//                    file_put_contents($errorFile, implode(",", $header) . ",error\n");
//                    file_put_contents($outputFile, implode(",", $header) . "\n");
//
//                    $evngName = Application::$app->session->get('nameFinal');
//                    UploadProcessLogModel::uploadProcessId($processId, $evngName, $uploadTime, $status, $errorFile, $outputFile);
//                    DataBankModel::loadDataBank($rows, $header, $errorFile, $outputFile, $processId);
//
//                    $allUploads = UploadProcessLogModel::getUploadsByUser($evngName);
//                    $this->setLayout('main1');
//
//                    return $this->render('process_upload', [
//                        'errorMessage' => null,
//                        'processId' => $processId,
//                        'errorFilePath' => $errorFile,
//                        'outputFilePath' => $outputFile,
//                        'allUploads' => $allUploads
//                    ]);
//                }
//            }
//
//            // In case of an error, show the form again with the error message
//            $this->setLayout('main1');
//            return $this->render('process_upload', [
//                'errorMessage' => $errorMessage,
//                'allUploads' => UploadProcessLogModel::getUploadsByUser(Application::$app->session->get('nameFinal'))
//            ]);
//        }


        public function process_upload(Request $request, Response $response)
        {
            $errorMessage = null;

            if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
                $errorMessage = "Error uploading file.";
            } else {
                $fileTmpPath = $_FILES['csv_file']['tmp_name'];
                $fileName = $_FILES['csv_file']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Validate file extension
                if ($fileExtension !== 'csv') {
                    $errorMessage = "Invalid file type. Please upload a CSV file.";
                } else {
                    $rows = array_map('str_getcsv', file($fileTmpPath));

                   //$header = array_map('trim', array_shift($rows));

                    // Get header row and fix BOM if present
                    $header = array_shift($rows);
                    $header = array_map(function($h) {
                        $h = preg_replace('/^\xEF\xBB\xBF/', '', $h); // strip UTF-8 BOM
                        return trim($h);
                    }, $header);

                    if (!$this->isValidCSVHeader($header)) {
                        $errorMessage = "Invalid CSV header format.";
                    } elseif (count($rows) < 1) {
                        $errorMessage = "CSV file must have at least 1 data row.";
                    } elseif (count($rows) > 1000) {
                        $errorMessage = "CSV file cannot have more than 1000 rows.";
                    } else {
                        $processId = $this->generateProcessId();
                        $uploadTime = date('Y-m-d H:i:s');
                        $status = 'Processing';
                        $errorFile = "logs/{$processId}_errors.csv";
                        $outputFile = "logs/{$processId}_output.csv";

                        if (!is_dir('logs')) {
                            mkdir('logs', 0777, true);
                        }

                        file_put_contents($errorFile, implode(",", $header) . ",error\n");
                        file_put_contents($outputFile, implode(",", $header) . "\n");

                        $evngName = Application::$app->session->get('nameFinal');
                        UploadProcessLogModel::uploadProcessId($processId, $evngName, $uploadTime, $status, $errorFile, $outputFile);
                        DataBankModel::loadDataBank($rows, $header, $errorFile, $outputFile, $processId);

                        $allUploads = UploadProcessLogModel::getUploadsByUser($evngName);
                        $this->setLayout('main1');

                        return $this->render('process_upload', [
                            'errorMessage' => null,
                            'processId' => $processId,
                            'errorFilePath' => $errorFile,
                            'outputFilePath' => $outputFile,
                            'allUploads' => $allUploads
                        ]);
                    }
                }
            }

            // In case of an error, show the form again with the error message
            $this->setLayout('main1');
            return $this->render('process_upload', [
                'errorMessage' => $errorMessage,
                'allUploads' => UploadProcessLogModel::getUploadsByUser(Application::$app->session->get('nameFinal'))
            ]);
        }






    public function csvFileUpload(Request $request, Response $response)
    {

        $evngName = Application::$app->session->get('nameFinal'); // assuming session has uploader's name
        $allUploads = UploadProcessLogModel::getUploadsByUser($evngName);
        $this->setLayout('main1');
        //return $this->render('csvUploadForm');
        return $this->render('csvUploadForm', [
            'allUploads' => $allUploads
        ]);


//        return $this->render('csvUploadForm', [
//            'models' => $data
//        ]);

    }


    public function view7DCan(Request $request, Response $response)
    {
        $evangelistName= Application::$app->session->get('nameFinal');

        $emailCaretaker=Application::$app->session->get('emailY');

        $data3 = CandidateModel::findAllCandidatesForEvangelist7D(['evangelist' => $evangelistName], $emailCaretaker);
        $data4 = EvangelistModel::findworkGroupForEvangelist7D(['evangelist' => $evangelistName], $evangelistName);

        Application::$app->session->set('evngDashboardData7', $data3);
        Application::$app->session->set('evngDashboardData72', $data4);
        //Application::$app->session->set('evngName', $loginForm->username);
        Application::$app->session->set('evngName', $evangelistName);
        //Application::$app->session->set('loginForm', $loginForm);
        $this->setLayout('main1');
        return $this->render('evngDashboard7', [
                'models' => $data3, 'modes' => Application::$app->session->get('loginForm')
            ]);

    }



    public function saveAttendance(Request $request, Response $response)
    {

        if ($request->isPost()) {
            $mobile = $_POST["mobile"];
            $participantName = $_POST["participantName"];
            $evangelist = $_POST["evangelist"];
            $evangelistEmail = $_POST["evangelistEmail"];
            $location = $_POST["location"];
            $attendanceDate = $_POST["attendanceDate"];
            $feedback = $_POST["feedback"];
            $isOnlineSathAttended = $_POST["isOnlineSathAttended"];
            CandidateModel::saveAttendance($mobile,$participantName,$evangelist,$evangelistEmail,$isOnlineSathAttended,$location,$feedback,$attendanceDate);
        }
    }


    public function searchAttendancePage(Request $request, Response $response)
    {
        $candidateModel = new CandidateModel();

        $perPage = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $perPage;

        $search = $_GET['search'] ?? '';


        if (!empty($search)) {
            // Search logic
            $totalRecords = $candidateModel->countSearchCandidates($search);
            $data = $candidateModel->searchCandidates($search, $offset, $perPage);
        } else {
            // Normal logic
            $totalRecords = $candidateModel::countAllCandidates();
            $data = $candidateModel::findAllCandidates($offset, $perPage);
        }

        $totalPages = ceil($totalRecords / $perPage);

        return $this->render('viewAllCanAttendenceMarking', [
            'data' => $data,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'search' => $search
        ]);
    }






    public function bulkAssignSm(Request $request, Response $response)
    {
        $dataBankModel = new DataBankModel();
        $telecallerSMModel = new TelecallerSMModel();


        if ($request->isPost()) {

            $selectedMobiles = $_POST['selected_contacts'];
            $contacts = $_POST['contacts'] ?? [];
            $assignedTo = $_POST['assignedTo']; // Replace with current logged-in user if available
            $assignMode = $_POST['assignMode'] ?? 'assign';  // default
            $status = 'Pending';     // Default status
            $callDate = date('Y-m-d');

            error_log("Entered block 1");
            if ($assignMode === 'assign') {
                error_log("Entered block 2");
                $allRecords= DataBankModel::bulkAssignDataBankRecords($selectedMobiles,$contacts,$assignedTo);
            } elseif ($assignMode === 'reassign') {
                error_log("Entered block 3");
                $allRecords= DataBankModel::bulkReassignDataBankRecords($selectedMobiles, $assignedTo);
            }

            // ✅ Redirect back to filtered/paginated view with success flag
            header("Location: /viewAllSMList?assigned=1");
            exit;

        }

        $allRecords2= DataBankModel::getAllSMDataBankRecords();

        return $this->render('sm_list', [
            'records' => $allRecords2
        ]);


    }

    public function bulkAssignTelecaller(Request $request, Response $response)
    {
        $dataBankModel = new DataBankModel();
        $telecallerSMModel = new TelecallerSMModel();



        if ($request->isPost()) {

            $selectedMobiles = $_POST['selected_contacts'];
            $contacts = $_POST['contacts'] ?? [];
            $assignedTo = $_POST['assignedTo']; // Replace with current logged-in user if available
            $assignMode = $_POST['assignMode'] ?? 'assign';  // default
            $status = 'Pending';     // Default status
            $callDate = date('Y-m-d');

            error_log("Entered block 1");
            if ($assignMode === 'assign') {
                error_log("Entered block 2");
                $allRecords= DataBankModel::bulkAssignDataBankRecords($selectedMobiles,$contacts,$assignedTo);
            } elseif ($assignMode === 'reassign') {
                error_log("Entered block 3");
                $allRecords= DataBankModel::bulkReassignDataBankRecords($selectedMobiles, $assignedTo);
            }

            // ✅ Redirect back to filtered/paginated view with success flag
            header("Location: /viewAllTelecallersList?assigned=1");
            exit;

        }


        $allRecords= DataBankModel::getAllPHONEDataBankRecords();


        return $this->render('telecallers_list', [
            'records' => $allRecords
        ]);

    }


    public function viewAllSMList1(Request $request, Response $response)
    {
        $dataBankModel = new DataBankModel();
        $allRecords= DataBankModel::getAllSMDataBankRecords();


        return $this->render('sm_list', [
            'records' => $allRecords
        ]);
    }


    public function updateTaskDetails(Request $request, Response $response)
    {

        $mobile = $_POST['mobile'] ?? '';
        $callDate = $_POST['call_date'] ?? '';
        $status = $_POST['status'] ?? '';
        $remark = $_POST['remark'] ?? '';
        $name     = $_POST['name']     ?? '';
        $country  = $_POST['country']  ?? '';
        $city     = $_POST['city']     ?? '';
        $language = $_POST['language'] ?? '';

        if (!$mobile || !$callDate || !$status || !$remark) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            return;
        }

        $result = TelecallerSMModel::updateStatusTask(  $mobile, $name, $country, $city, $language, $callDate, $status, $remark);
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update record.']);
        }

    }

    public function viewTaskDetails(Request $request, Response $response)
    {
        $mobile = $_GET['mobile'] ?? null;
        //echo $mobile;

        if (!$mobile) {
           echo("Mobile number is missing.");

        }

        $alreadyRegistered = CandidateModel::isMobileRegistered($mobile);
        $details = CandidateModel::getLanguageAndCountry($mobile);
        $language = $details['language'] ?? null;


        $country  = $details['country'] ?? null;

        $task = TelecallerSMModel::findMob(['mobile' => $mobile]);

        $evangelists = CandidateModel::getLanguageEvangelists($language);

        if (!$task) {
            echo("No data found for this mobile.");

        }

$sessionNames = [
    1 => "Session 1: Salvation, incl plan and 1st coming",
    2 => "Session 2: God the Father",
    3 => "Session 3: Second coming incl Signs of Times",
    4 => "Session 4: He has come, new name",
    5 => "Session 5: Messenger sent by God",
    6 => "Session 6: Righteousness",
    7 => "Session 7: Zion, true Zion",
    8 => "Session 8: Holy Mother",
    9 => "Session 9: Church",
    10 => "Session 10: Good News Retreat"
];

        $this->setLayout('main1');
        // Render the view and pass the $task
        return $this->render('viewTaskDetails', [
            'task' => $task,
            'alreadyRegistered' => $alreadyRegistered,
            'language' => $language,
            'mobile' => $mobile,
            'country' => $country,
            'evangelists' => $evangelists, // ✅ Pass here
            'sessionNames' => json_encode($sessionNames) // Pass as JSON string
        ]);

    }

    public function viewEvent1(Request $request)
    {
        $id = $_GET['id'] ?? null;
        $event = SathvarthaEventModel::getEventById1($id);

        if (!$event) {
            Application::$app->response->redirect('/addNewHomeEvent');
            return;
        }

        return $this->render('viewEvent1', ['event' => $event]);
    }


    public function viewEvent(Request $request)
    {
        $id = $_GET['id'] ?? null;
        $event = SathvarthaEventModel::getEventById($id);

        if (!$event) {
            Application::$app->response->redirect('/addNewSathEvent');
            return;
        }

        return $this->render('viewEvent', ['event' => $event]);
    }


    public function editEvent1(Request $request)
    {
        $id = $_GET['id'] ?? null;
        $event = SathvarthaEventModel::getEventById1($id);
        $evangelistModel = new EvangelistModel();

        $sathvarthaOrganizers = EvangelistModel::findSathvarthaOrganizers();
        $localOrganizers = EvangelistModel::findlocalOrganizers();

        if (!$event) {
            Application::$app->response->redirect('/sathvartha-event');
            return;
        }

        if ($request->isPost()) {
            $data = $request->getBody();
            $totalAttended = $_POST['total_attended'] ?? 0;
            $positiveCount = $_POST['positive_count'] ?? 0;

            // ✅ Handle file upload
            $uploadDir = Application::$ROOT_DIR . '/public/uploads/hsReports/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $attendanceFile = $_FILES['attendance_report'] ?? null;
            $uploadedPath = $event['attendance_report']; // Default to existing

            if ($attendanceFile && $attendanceFile['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($attendanceFile['name'], PATHINFO_EXTENSION);
                $allowed = ['xlsx', 'xls', 'csv', 'txt', 'zip'];
                if (in_array(strtolower($ext), $allowed)) {
                    $filename = 'attendance_' . uniqid() . '.' . $ext;
                    $targetPath = $uploadDir . $filename;

                    if (move_uploaded_file($attendanceFile['tmp_name'], $targetPath)) {
                        $uploadedPath = '/uploads/hsReports/' . $filename;
                    }
                }
            }
            $data['attendance_report'] = $uploadedPath;



            SathvarthaEventModel::updateEvent1($id, $data,$totalAttended,$positiveCount,$uploadedPath);

            Application::$app->session->setFlash('success', 'Event updated successfully!');
            Application::$app->response->redirect('/addNewHomeEvent');
            return;
        }

        return $this->render('editEvent1', [
            'event' => $event,
            'localOrganizers' => $localOrganizers,
            'sathvarthaOrganizers' => $sathvarthaOrganizers
        ]);
    }

    public function editEvent(Request $request)
    {
        $id = $_GET['id'] ?? null;
        $event = SathvarthaEventModel::getEventById($id);
        $evangelistModel = new EvangelistModel();

        $sathvarthaOrganizers = EvangelistModel::findSathvarthaOrganizers();
        $localOrganizers = EvangelistModel::findlocalOrganizers();

        if (!$event) {
            Application::$app->response->redirect('/sathvartha-event');
            return;
        }

        if ($request->isPost()) {
            $data = $request->getBody();
            $totalAttended = $_POST['total_attended'] ?? 0;
            $positiveCount = $_POST['positive_count'] ?? 0;

            // ✅ Handle file upload
            $uploadDir = Application::$ROOT_DIR . '/public/uploads/zoomReports/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $attendanceFile = $_FILES['attendance_report'] ?? null;
            $uploadedPath = $event['attendance_report']; // Default to existing

            if ($attendanceFile && $attendanceFile['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($attendanceFile['name'], PATHINFO_EXTENSION);
                $allowed = ['xlsx', 'xls', 'csv', 'txt', 'zip'];
                if (in_array(strtolower($ext), $allowed)) {
                    $filename = 'attendance_' . uniqid() . '.' . $ext;
                    $targetPath = $uploadDir . $filename;

                    if (move_uploaded_file($attendanceFile['tmp_name'], $targetPath)) {
                        $uploadedPath = '/uploads/zoomReports/' . $filename;
                    }
                }
            }
            $data['attendance_report'] = $uploadedPath;



            SathvarthaEventModel::updateEvent($id, $data,$totalAttended,$positiveCount,$uploadedPath);

            Application::$app->session->setFlash('success', 'Event updated successfully!');
            Application::$app->response->redirect('/addNewSathEvent');
            return;
        }

        return $this->render('editEvent', [
            'event' => $event,
            'localOrganizers' => $localOrganizers,
            'sathvarthaOrganizers' => $sathvarthaOrganizers
        ]);
    }


    public function getCandidatesByLangAndCountry(Request $request, Response $response)
    {
        $lang = $_GET['lang'] ?? '';
        $country = $_GET['country'] ?? '';

        $data = CandidateModel::getEvangelistsByLangAndCountry($lang, $country);

        $this->setLayout('main1');
        return $this->render('evangelistsByCountry', [
            'language' => $lang,
            'country' => $country,
            'evangelists' => $data
        ]);
    }




    public function getCandidatesByEvangelist(Request $request, Response $response)
    {
        $lang = $_GET['lang'] ?? '';
        $country = $_GET['country'] ?? '';
        $evangelist = $_GET['evangelist'] ?? '';
        $mobile = $_GET['mobile'] ?? '';
        echo $mobile;

        $candidates = CandidateModel::getCandidatesByEvangelist($lang, $country, $evangelist);
        $this->setLayout('main1');

        return $this->render('candidatesByEvangelist', [
            'language' => $lang,
            'country' => $country,
            'evangelist' => $evangelist,
            'candidates' => $candidates,
            'mobile' => $mobile
        ]);
    }


    public function saveAppointment(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $data = [
                $_POST['candidateMobile'] ?? null,
                $_POST['event_name'] ?? null,
                $_POST['istDateTimeZ'] ?? null,
                $_POST['istDateTime'] ?? $_POST['istDateTimeZ'], // fallback if no candidate time provided
                $_POST['country'] ?? null,
                $_POST['place'] ?? null,
                $_POST['classFrom'] ?? null,
                $_POST['sathvartha_organizer'] ?? null,
                $_POST['panel_member'] ?? null,
                $_POST['caring_team_member'] ?? null,
                $_POST['local_organizer'] ?? null,
                $_POST['googleMeetStatus'] ?? null,
                $_POST['faithStatus'] ?? null,
                $_POST['sathvarthaReadyStatus'] ?? null,
                $_POST['fellowshipStatus'] ?? null,
                $_POST['evangelistFeedback'] ?? null,
                $_POST['panelFeedback'] ?? null,
                $_POST['localOrganizerFeedback'] ?? null,
                $_POST['finalFeedback'] ?? null,
                $_POST['sathvarthaAttendance'] ?? null,
                $_POST['sathvarthaFeedback'] ?? null,
                $_POST['googleMeetCaringTeam'] ?? null,
                $_POST['caringStatus'] ?? null,
                $_POST['travelStatus'] ?? null,
                $_POST['transportStatus'] ?? null,
                $_POST['caringistDateTime'] ?? null,




            ];

             //echo  $_POST['candidateMobile'];
            $saved = SathvarthaEventModel::saveAppointment(...$data);


            if ($saved) {


                error_log("Language: " . $this->language);
                error_log("Country: " . $this->country);
                error_log("Participant: " . $this->participantName);
                error_log("Evangelist: " . $this->evangelist);

                // ✅ Redirect with query params to /getCandidateDetails
                $redirectUrl = "/getCandidateDetails?lang=" . urlencode(Application::$app->session->get('tt1')) .
                    "&country=" . urlencode(Application::$app->session->get('tt2')) .
                    "&participantName=" . urlencode(Application::$app->session->get('tt3')) .
                    "&evangelist=" . urlencode(Application::$app->session->get('tt4'));

                $response->redirect($redirectUrl);

            } else {

                // ✅ Perform the redirect

                echo json_encode(["success" => false, "message" => "Failed to save appointment"]);
            }
        }
    }


    public function addAppointment(Request $request, Response $response)
    {
        $this->setLayout('main1');


            $participantName = $_GET['participantName'] ?? '';
            $recordDate = $_GET['recordDate'] ?? '';
            $mobile = $_GET['mobile'] ?? '';
            $evangelist = $_GET['evangelist'] ?? '';
            $country = $_GET['country'] ?? '';
            $source = $_GET['source'] ?? '';
            $allotedDays = $_GET['allotedDays'] ?? '';
            $mediaType = $_GET['mediaType'] ?? '';
            $activeStatus = $_GET['activeStatus'] ?? '';
            $userid = $_GET['userid'] ?? '';
            $remark = $_GET['remark'] ?? '';
            $wgroup = $_GET['wgroup'] ?? '';

            // Get Event IDS
            $eventNames = SathvarthaEventModel::getAllEventNames();

            $eventNames1 = SathvarthaEventModel::getAllEventNames1();

            // Get max class Status

            // Get Sathvartha organizer
            $organizersByDesignation = EvangelistModel::findallTypesOfOrganizers();
            $highesClassNumberAttended = RegisterModel::getMaxClassFromForCandidate($mobile);
            //echo $mobile;


            // Get panel member

            // Get local organizer

            // Get caring Team member

            // Pass them to view
        return $this->render('addAppointment', [
            'participantName' => $participantName,
            'mobile' => $mobile,
            'evangelist' => $evangelist,
            'country' => $country,
            'eventNames' => $eventNames,
            'eventNames1' => $eventNames1,
            'organizers' => $organizersByDesignation,  // key point
            'highesClassNumberAttended' => $highesClassNumberAttended // 👈 Pass it here
        ]);
        }


//        return $this->render('addAppointment', [
//            'language' => ''
//        ]);








    public function getCandidateDetails(Request $request, Response $response)
    {
        $lang = $_GET['lang'] ?? '';
        $country = $_GET['country'] ?? '';
        $participantName = $_GET['participantName'] ?? '';
        $evangelist = $_GET['evangelist'] ?? '';


        Application::$app->session->set('tt1', $lang);
        Application::$app->session->set('tt2', $country);
        Application::$app->session->set('tt3', $participantName);
        Application::$app->session->set('tt4', $evangelist);


        $details = CandidateModel::getEvangelistDetails($lang, $country, $participantName,$evangelist);


        $mobile = $details[0]['mobile'];
        //this->mobile=$mobile;
        $appointments = CandidateModel::getAppointmentsByParticipant($mobile); // 👈 Add this line

        $this->setLayout('main1');
        return $this->render('candidateDetails', [
            'language' => $lang,
            'country' => $country,
            'participantName' => $participantName,
            'evangelist' => $details,
            'mobile' => $mobile,
            'appointments' => $appointments // 👈 Pass to view
        ]);
    }



    public function getCandidatesByLanguage(Request $request, Response $response)
    {
        $lang = $_GET['lang'] ?? '';

        $data = CandidateModel::getCountriesByLanguage($lang);
        $this->setLayout('main1');
        return $this->render('countriesByLanguage', [
            'language' => $lang,
            'countries' => $data
        ]);
    }




    public function mylangPref(Request $request, Response $response)
    {
        $email = Application::$app->session->get('xtr');

        // Fetch currently active languages (can be empty array)
        $currentLanguages = EvangelistModel::getActiveLanguages($email);

        if ($request->isPost()) {
            $body = $request->getBody();
            $languages = $_POST['languages']; // This will be an array

            // Server-side validation: require at least one language
            if (empty($languages)) {
                $this->setLayout('main1');
                return $this->render('mylangPref', [
                    'success' => '',
                    'error' => 'Please select at least one language before saving.',
                    'currentLanguages' => $currentLanguages
                ]);
            }

            // Soft update + upsert (no deletes)
            EvangelistModel::softUpsertLanguages($email, $languages);

            // Re-fetch to reflect latest state
            $currentLanguages = EvangelistModel::getActiveLanguages($email);

            $this->setLayout('main1');
            return $this->render('mylangPref', [
                'success' => 'Language preferences updated successfully!',
                'error' => '',
                'currentLanguages' => $currentLanguages
            ]);
        }

        // GET: render the view with current languages (may be empty)
        $this->setLayout('main1');
        return $this->render('mylangPref', [
            'success' => '',
            'error' => '',
            'currentLanguages' => $currentLanguages
        ]);
    }


    public function myPref(Request $request, Response $response)
    {
        $email= Application::$app->session->get('xtr');
        $currentPreference = EvangelistModel::getPreference($email);
        if ($request->isPost()) {
            $preference = $request->getBody()['preference'] ?? null;

            EvangelistModel::setPreference($preference,$email);
            $currentPreference = EvangelistModel::getPreference($email);

            // Render the preference selection view
            $this->setLayout('main1');
            return $this->render('myPref', [
                'success' => 'Preference updated successfully!',
                'currentPreference' => $currentPreference
            ]);
        }
        // Render the preference selection view
        $this->setLayout('main1');
        return $this->render('myPref', [
            'success' => '',
            'currentPreference' => $currentPreference
        ]);

    }


    public function viewCandidates(Request $request, Response $response)
    {
        $candidateModel = new CandidateModel();

         $data = CandidateModel::findCandidatesCountLanguageWise();
        $this->setLayout('main1');
        //echo $data;

        return $this->render('viewCandidates', [
            'languages' => $data // <-- PASS THIS TO THE VIEW
        ]);

    }


    public function updateAppointment(Request $request, Response $response)
    {
        // Read raw JSON from fetch()
        $rawInput = file_get_contents('php://input');
        $postData = json_decode($rawInput, true);

        // Validate JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            $response->setStatusCode(400);
            echo 'Invalid JSON data.';
            return;
        }

        // Extract candidate mobile number
        $candidateMobile = $postData['candidateMobile'] ?? null;
        if (!$candidateMobile) {
            $response->setStatusCode(400);
            echo 'Candidate mobile is required.';
            return;
        }

        // Map incoming form keys to DB columns
        $fieldMap = [
            'event_name'                     => 'event_name',
            'istDateTime'                    => 'appointment_datetime_ist',
            'appointment_datetime_candidate_zone' => 'appointment_datetime_candidate_zone',
            'place'                          => 'place',
            'sathvartha_organizer'           => 'sathvartha_organizer_name',
            'panel_member'                   => 'panel_member_name',
            'caring_team_member'             => 'caring_team_member_name',
            'local_organizer'                 => 'local_organizer_name',
            'googleMeetStatus'               => 'google_meet_status',
            'faithStatus'                    => 'faith_status',
            'sathvarthaReadyStatus'          => 'sathvartha_ready_status',
            'fellowshipStatus'               => 'fellowship_status',
            'evangelistFeedback'             => 'evangelist_feedback',
            'panelFeedback'                  => 'panel_feedback',
            'localOrganizerFeedback'         => 'local_organizer_feedback',
            'finalFeedback'                  => 'final_feedback',
            'sathvarthaAttendanceStatus'     => 'sathvartha_attendance_status',
            'sathvarthaFeedback'             => 'sathvartha_feedback',
            'googleMeetCaringTeam'           => 'caring_google_meet_status',
            'caringStatus'                   => 'caring_status',
            'travelStatus'                   => 'travel_status',
            'transportRequired'              => 'transport_required',
            'caringistDateTime'              => 'caring_google_meet_date',
            'event_name1'                  => 'event_name_hs'

        ];

        // Filter only the allowed fields with mapped DB column names
        $filteredData = [];
        foreach ($fieldMap as $formKey => $dbColumn) {
            if (isset($postData[$formKey])) {
                $filteredData[$dbColumn] = $postData[$formKey];
            }
        }

        // If no fields are being updated
        if (empty($filteredData)) {
            $response->setStatusCode(400);
            echo 'No valid fields provided for update.';
            return;
        }

        $id1= Application::$app->session->get('idxtx');

        // Perform the DB update
        $updated = CandidateModel::updateChangedAppointmentFields($candidateMobile, $filteredData, true, $id1);

        // Send response
        if ($updated) {
            header('Location: /viewAppointment?id=16');
            exit;
        } else {
            $response->setStatusCode(500);
            echo 'No changes made or update failed.';
        }
    }


    public function editAppointmentLO(Request $request, Response $response)
    {
        $id = $_GET['id'] ?? null;
        $appointments = CandidateModel::getAppointmentsById($id);


        if (!$appointments || empty($appointments)) {
            die("No appointment found.");
        }

        $appointment = $appointments[0];

        // Get event names and organizers
        $eventNames = SathvarthaEventModel::getAllEventNames();
        $eventNames1 = SathvarthaEventModel::getAllEventNames1();
        $organizersByDesignation = EvangelistModel::findallTypesOfOrganizers();
        $highesClassNumberAttended = RegisterModel::getMaxClassFromForCandidate($appointment['candidate_mobile']);

        $participantName= Application::$app->session->get('tt3');
        $evangelist=Application::$app->session->get('tt4');



        return $this->render('appointmentFormLO', [
            'appointment' => $appointment,
            'participantName' =>$participantName ?? '',
            'evangelist' =>$evangelist ?? '',
            'mobile' => $appointment['candidate_mobile'] ?? '',
            'country' => $appointment['candidate_country'] ?? '',
            'place' => $appointment['place'] ?? '',
            'appointment_datetime_ist' => $appointment['appointment_datetime_ist'] ?? '',
            'appointment_datetime_candidate_zone ' => $appointment['appointment_datetime_candidate_zone'] ?? '',
            'eventNames' => $eventNames,
            'eventNames1' => $eventNames1,
            'faithStatus' => $appointment['faith_status'] ?? '',
            'googleMeetStatus' => $appointment['google_meet_status'] ?? '',
            'caringStatus' => $appointment['caring_status'] ?? '',
            'travelStatus' => $appointment['travel_status'] ?? '',
            'caringGoogleMeetStatus' => $appointment['caring_google_meet_status'] ?? '',
            'fellowshipStatus' => $appointment['fellowship_status'] ?? '',
            'sathvarthaAttendanceStatus' => $appointment['sathvartha_attendance_status'] ?? '',
            'caringTeamMember' => $appointment['caring_team_member_name'] ?? '',
            'localOrganizer' => $appointment['local_organizer_name'] ?? '',
            'panelMember' => $appointment['panel_member_name'] ?? '',
            'sathvarthaOrganizer' => $appointment['sathvartha_organizer_name'] ?? '',
            'organizers' => $organizersByDesignation,
            'highesClassNumberAttended' => $highesClassNumberAttended,
            'sathvarthaFeedback' => $appointment['sathvartha_feedback'] ?? '',
            'finalFeedback' => $appointment['final_feedback'] ?? '',
            'localOrganizerFeedback' => $appointment['local_organizer_feedback'] ?? '',
            'panelFeedback' => $appointment['panel_feedback'] ?? '',
            'sathvarthaReadyStatus' => $appointment['sathvartha_ready_status'] ?? '',
            'evangelistFeedback' => $appointment['evangelist_feedback'] ?? '',
            'transportRequired' => $appointment['transport_required'] ?? '',
            'caringGoogleMeetDate' => $appointment['caring_google_meet_date'] ?? ''
        ]);
    }


    public function editAppointmentCT(Request $request, Response $response)
    {
        $id = $_GET['id'] ?? null;
        $appointments = CandidateModel::getAppointmentsById($id);


        if (!$appointments || empty($appointments)) {
            die("No appointment found.");
        }

        $appointment = $appointments[0];

        // Get event names and organizers
        $eventNames = SathvarthaEventModel::getAllEventNames();
        $eventNames1 = SathvarthaEventModel::getAllEventNames1();
        $organizersByDesignation = EvangelistModel::findallTypesOfOrganizers();
        $highesClassNumberAttended = RegisterModel::getMaxClassFromForCandidate($appointment['candidate_mobile']);

        $participantName= Application::$app->session->get('tt3');
        $evangelist=Application::$app->session->get('tt4');


        return $this->render('appointmentFormCT', [
            'appointment' => $appointment,
            'participantName' =>$participantName ?? '',
            'evangelist' =>$evangelist ?? '',
            'mobile' => $appointment['candidate_mobile'] ?? '',
            'country' => $appointment['candidate_country'] ?? '',
            'place' => $appointment['place'] ?? '',
            'appointment_datetime_ist' => $appointment['appointment_datetime_ist'] ?? '',
            'appointment_datetime_candidate_zone ' => $appointment['appointment_datetime_candidate_zone'] ?? '',
            'eventNames' => $eventNames,
            'eventNames1' => $eventNames1,
            'faithStatus' => $appointment['faith_status'] ?? '',
            'googleMeetStatus' => $appointment['google_meet_status'] ?? '',
            'caringStatus' => $appointment['caring_status'] ?? '',
            'travelStatus' => $appointment['travel_status'] ?? '',
            'caringGoogleMeetStatus' => $appointment['caring_google_meet_status'] ?? '',
            'fellowshipStatus' => $appointment['fellowship_status'] ?? '',
            'sathvarthaAttendanceStatus' => $appointment['sathvartha_attendance_status'] ?? '',
            'caringTeamMember' => $appointment['caring_team_member_name'] ?? '',
            'localOrganizer' => $appointment['local_organizer_name'] ?? '',
            'panelMember' => $appointment['panel_member_name'] ?? '',
            'sathvarthaOrganizer' => $appointment['sathvartha_organizer_name'] ?? '',
            'organizers' => $organizersByDesignation,
            'highesClassNumberAttended' => $highesClassNumberAttended,
            'sathvarthaFeedback' => $appointment['sathvartha_feedback'] ?? '',
            'finalFeedback' => $appointment['final_feedback'] ?? '',
            'localOrganizerFeedback' => $appointment['local_organizer_feedback'] ?? '',
            'panelFeedback' => $appointment['panel_feedback'] ?? '',
            'sathvarthaReadyStatus' => $appointment['sathvartha_ready_status'] ?? '',
            'evangelistFeedback' => $appointment['evangelist_feedback'] ?? '',
            'transportRequired' => $appointment['transport_required'] ?? '',
            'caringGoogleMeetDate' => $appointment['caring_google_meet_date'] ?? ''
        ]);


    }

    public function editAppointmentPM(Request $request, Response $response)
    {
        $id = $_GET['id'] ?? null;




        $appointments = CandidateModel::getAppointmentsById($id);


        if (!$appointments || empty($appointments)) {
            die("No appointment found.");
        }

        $appointment = $appointments[0];

        // Get event names and organizers
        $eventNames = SathvarthaEventModel::getAllEventNames();
        $eventNames1 = SathvarthaEventModel::getAllEventNames1();
        $organizersByDesignation = EvangelistModel::findallTypesOfOrganizers();
        $highesClassNumberAttended = RegisterModel::getMaxClassFromForCandidate($appointment['candidate_mobile']);

        $participantName= Application::$app->session->get('tt3');
        $evangelist=Application::$app->session->get('tt4');
        $this->setLayout('main1');

        return $this->render('appointmentFormPM', [
            'appointment' => $appointment,
            'participantName' =>$participantName ?? '',
            'evangelist' =>$evangelist ?? '',
            'mobile' => $appointment['candidate_mobile'] ?? '',
            'country' => $appointment['candidate_country'] ?? '',
            'place' => $appointment['place'] ?? '',
            'appointment_datetime_ist' => $appointment['appointment_datetime_ist'] ?? '',
            'appointment_datetime_candidate_zone ' => $appointment['appointment_datetime_candidate_zone'] ?? '',
            'eventNames' => $eventNames,
            'eventNames1' => $eventNames1,
            'faithStatus' => $appointment['faith_status'] ?? '',
            'googleMeetStatus' => $appointment['google_meet_status'] ?? '',
            'caringStatus' => $appointment['caring_status'] ?? '',
            'travelStatus' => $appointment['travel_status'] ?? '',
            'caringGoogleMeetStatus' => $appointment['caring_google_meet_status'] ?? '',
            'fellowshipStatus' => $appointment['fellowship_status'] ?? '',
            'sathvarthaAttendanceStatus' => $appointment['sathvartha_attendance_status'] ?? '',
            'caringTeamMember' => $appointment['caring_team_member_name'] ?? '',
            'localOrganizer' => $appointment['local_organizer_name'] ?? '',
            'panelMember' => $appointment['panel_member_name'] ?? '',
            'sathvarthaOrganizer' => $appointment['sathvartha_organizer_name'] ?? '',
            'organizers' => $organizersByDesignation,
            'highesClassNumberAttended' => $highesClassNumberAttended,
            'sathvarthaFeedback' => $appointment['sathvartha_feedback'] ?? '',
            'finalFeedback' => $appointment['final_feedback'] ?? '',
            'localOrganizerFeedback' => $appointment['local_organizer_feedback'] ?? '',
            'panelFeedback' => $appointment['panel_feedback'] ?? '',
            'sathvarthaReadyStatus' => $appointment['sathvartha_ready_status'] ?? '',
            'evangelistFeedback' => $appointment['evangelist_feedback'] ?? '',
            'transportRequired' => $appointment['transport_required'] ?? '',
            'caringGoogleMeetDate' => $appointment['caring_google_meet_date'] ?? ''
        ]);

    }

    public function editAppointment(Request $request, Response $response)
    {
        $id = $_GET['id'] ?? null;
        $appointments = CandidateModel::getAppointmentsById($id);
        Application::$app->session->set('idxtx', $id);

        if (!$appointments || empty($appointments)) {
            die("No appointment found.");
        }

        $appointment = $appointments[0];

        // Get event names and organizers
        $eventNames = SathvarthaEventModel::getAllEventNames();
        $eventNames1 = SathvarthaEventModel::getAllEventNames1();
        $organizersByDesignation = EvangelistModel::findallTypesOfOrganizers();
        $highesClassNumberAttended = RegisterModel::getMaxClassFromForCandidate($appointment['candidate_mobile']);

        $participantName= Application::$app->session->get('tt3');
        $evangelist=Application::$app->session->get('tt4');

        $this->setLayout('main1');

        return $this->render('appointmentForm1', [
            'appointment' => $appointment,
            'participantName' =>$participantName ?? '',
            'evangelist' =>$evangelist ?? '',
            'mobile' => $appointment['candidate_mobile'] ?? '',
            'country' => $appointment['candidate_country'] ?? '',
            'place' => $appointment['place'] ?? '',
            'appointment_datetime_ist' => $appointment['appointment_datetime_ist'] ?? '',
            'appointment_datetime_candidate_zone ' => $appointment['appointment_datetime_candidate_zone'] ?? '',
            'eventNames' => $eventNames,
            'eventNames1' => $eventNames1,
            'faithStatus' => $appointment['faith_status'] ?? '',
            'googleMeetStatus' => $appointment['google_meet_status'] ?? '',
            'caringStatus' => $appointment['caring_status'] ?? '',
            'travelStatus' => $appointment['travel_status'] ?? '',
            'caringGoogleMeetStatus' => $appointment['caring_google_meet_status'] ?? '',
            'fellowshipStatus' => $appointment['fellowship_status'] ?? '',
            'sathvarthaAttendanceStatus' => $appointment['sathvartha_attendance_status'] ?? '',
            'caringTeamMember' => $appointment['caring_team_member_name'] ?? '',
            'localOrganizer' => $appointment['local_organizer_name'] ?? '',
            'panelMember' => $appointment['panel_member_name'] ?? '',
            'sathvarthaOrganizer' => $appointment['sathvartha_organizer_name'] ?? '',
            'organizers' => $organizersByDesignation,
            'highesClassNumberAttended' => $highesClassNumberAttended,
            'sathvarthaFeedback' => $appointment['sathvartha_feedback'] ?? '',
            'finalFeedback' => $appointment['final_feedback'] ?? '',
            'localOrganizerFeedback' => $appointment['local_organizer_feedback'] ?? '',
            'panelFeedback' => $appointment['panel_feedback'] ?? '',
            'sathvarthaReadyStatus' => $appointment['sathvartha_ready_status'] ?? '',
            'evangelistFeedback' => $appointment['evangelist_feedback'] ?? '',
            'transportRequired' => $appointment['transport_required'] ?? '',
            'caringGoogleMeetDate' => $appointment['caring_google_meet_date'] ?? ''
        ]);
    }



    public function viewAllAppointmentsSR(Request $request, Response $response)
    {
        $appointments = CandidateModel::getAllAppointmentsSR();
        $this->setLayout('main1');
        return $this->render('viewAllAppointmentsReadOnly', [
            'appointments' => $appointments
        ]);
    }

    public function viewAllAppointmentsIF(Request $request, Response $response)
    {
        $appointments = CandidateModel::getAllAppointmentsIF();
        $this->setLayout('main1');
        return $this->render('viewAllAppointmentsReadOnly', [
            'appointments' => $appointments
        ]);
    }


    public function viewAllAppointmentsReadonly(Request $request, Response $response)
    {
        $appointments = CandidateModel::getAllAppointments();
        $this->setLayout('main1');
        return $this->render('viewAllAppointmentsReadOnly', [
            'appointments' => $appointments
        ]);
    }


    public function viewAllAppointmentsLO(Request $request, Response $response)
    {
        $appointments = CandidateModel::getAllAppointments();
        return $this->render('viewAllAppointmentsLO', [
            'appointments' => $appointments
        ]);
    }

    public function viewAllAppointmentsCT(Request $request, Response $response)
    {
        $appointments = CandidateModel::getAllAppointments();
        return $this->render('viewAllAppointmentsCT', [
            'appointments' => $appointments
        ]);
    }


    public function viewAllAppointmentsPM(Request $request, Response $response)
    {
        $appointments = CandidateModel::getAllAppointments();
        return $this->render('viewAllAppointmentsPM', [
            'appointments' => $appointments
        ]);

    }


        public function viewAppointment(Request $request, Response $response)
    {
        $id = $_GET['id'] ?? null;
        $appointments = CandidateModel::getAppointmentsById($id);
        $participantName=Application::$app->session->get('tt3');
        $evangelist=Application::$app->session->get('tt4');

        $this->setLayout('main1');
        return $this->render('viewAppointment', [
            'appointments' => $appointments,
            'participantName' => $participantName,
            'evangelist' => $evangelist
        ]);
    }



    public function viewAppointments(Request $request, Response $response)
    {

        return $this->render('viewAppointments', [
            'tasks' => ''
        ]);

    }

    public function viewAppointmentsTabs(Request $request, Response $response)
    {
        $tab = $_GET['tab'] ?? 'candidates'; // default tab

        return $this->render('viewAppointmentsTabs', [
            'activeTab' => $tab
        ]);
    }




    public function addNewHomeEvent(Request $request, Response $response)
    {
        $evangelistModel = new EvangelistModel();
        $assignedTo = Application::$app->session->get('nameFinal'); // Logged-in user
        $tasks = TelecallerSMModel::getMyTasks($assignedTo);
        // Fetch organizers from evangelist table
        $localOrganizers = EvangelistModel::findlocalOrganizers();
        $sathvarthaOrganizers = EvangelistModel::findSathvarthaOrganizers();
        $existingEvents = SathvarthaEventModel::getAllEvents1(); // Create this method to fetch events

        $errorMessage = '';

        if ($request->isPost()) {
            $body = $request->getBody();
            $eventData = [
                'event_name' => $body['event_name'],
                'start_date' => $body['start_date'],
                'end_date' => $body['end_date'],
                'main_language' => $body['main_language'],
                'translation_language' => $body['translation_language'],
                'event_organizer' => $body['event_organizer'],
                'local_organizer' => $body['local_organizer'],
                'event_link' => $body['event_link'],
                'notes' => $body['notes'],
                'created_by' => $assignedTo,
                'updated_by' => $assignedTo,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $saved = SathvarthaEventModel::saveHomeMissionEvent($eventData);
                if ($saved) {
                    Application::$app->response->redirect('/evngDashboard1');
                } else {
                    $errorMessage = "❌ Something went wrong. Please try again.";
                }
            } catch (\PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    // Duplicate entry MySQL error code
                    $errorMessage = "⚠️ Event name already exists. Please use a different name.";
                } else {
                    $errorMessage = "❌ Database error: " . $e->getMessage();
                }
            }
        }

        $this->setLayout('main1');
        return $this->render('homeMissionEvent', [
            'tasks' => $tasks,
            'sathvarthaOrganizers' => $sathvarthaOrganizers,
            'localOrganizers' => $localOrganizers,
            'errorMessage' => $errorMessage,
            'formData' => $eventData ?? [],
            'existingEvents' => $existingEvents
        ]);

    }




    public function allEvents(Request $request, Response $response)
    {
        $existingEvents = SathvarthaEventModel::getAllEvents();
        return $this->render('all_events', [
            'events' => $existingEvents
        ]);

    }

    public function organizeEvent(Request $request, Response $response)
    {
        $eventId   = $_GET['id'] ?? null;
        $eventName = $_GET['event_name'] ?? null;

        if (!$eventId) {
            Application::$app->session->setFlash('error', 'Invalid event selected.');
            return $response->redirect('/allEvents');
        }

        if ($request->isPost()) {
            //echo 'hello';
            $body = $request->getBody();
            $speakerName = $_POST['speaker_name'];
            //error_log($speakerName);
            //echo $speakerName;

            //$speakerName      = $body['speaker_name'] ?? null;
            $vmixOperator     = $body['vmix_operator'] ?? null;
            //echo $vmixOperator;
            //error_log($vmixOperator);
            $keyboardOperator = $body['keyboard_operator'] ?? null;
            $monitor          = $body['monitor'] ?? null;
            $choirMembers     = $body['choir_members'] ?? null;
            $foodCoupons      = $body['food_coupons'] ?? null;

            //echo $speakerName;

            // Save or update
            SathvarthaEventModel::saveOrgEvent(
                $eventName,
                $speakerName,
                $vmixOperator,
                $keyboardOperator,
                $monitor,
                $choirMembers,
                $foodCoupons
            );

            Application::$app->session->setFlash('success', 'Event details saved successfully.');

            // 🔑 Redirect back to GET (PRG pattern)
            //return $response->redirect('/organizeEvent?id=' . $eventId . '&event_name=' . urlencode($eventName));
        }

        // On GET, load extra details for this event
        $extraData = SathvarthaEventModel::getOrgEventDetails($eventName);
        $extra = $extraData[0] ?? [];



        return $this->render('organize_event1', [
            'eventId'   => $eventId,
            'eventName' => $eventName,
            'extra'     => $extra ?? []
        ]);
    }


    public function addNewSathEvent(Request $request, Response $response)
    {
        $evangelistModel = new EvangelistModel();
        $assignedTo = Application::$app->session->get('nameFinal'); // Logged-in user
        $tasks = TelecallerSMModel::getMyTasks($assignedTo);
        // Fetch organizers from evangelist table
        $localOrganizers = EvangelistModel::findlocalOrganizers();
        $sathvarthaOrganizers = EvangelistModel::findSathvarthaOrganizers();
        $existingEvents = SathvarthaEventModel::getAllEvents(); // Create this method to fetch events

        $errorMessage = '';

        if ($request->isPost()) {
            $body = $request->getBody();
            $eventData = [
                'event_name' => $body['event_name'],
                'start_date' => $body['start_date'],
                'end_date' => $body['end_date'],
                'main_language' => $body['main_language'],
                'translation_language' => $body['translation_language'],
                'event_organizer' => $body['event_organizer'],
                'local_organizer' => $body['local_organizer'],
                'event_link' => $body['event_link'],
                'notes' => $body['notes'],
                'created_by' => $assignedTo,
                'updated_by' => $assignedTo,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $saved = SathvarthaEventModel::saveSathvarthaEvent($eventData);
                if ($saved) {
                    Application::$app->response->redirect('/evngDashboard1');
                } else {
                    $errorMessage = "❌ Something went wrong. Please try again.";
                }
            } catch (\PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    // Duplicate entry MySQL error code
                    $errorMessage = "⚠️ Event name already exists. Please use a different name.";
                } else {
                    $errorMessage = "❌ Database error: " . $e->getMessage();
                }
            }
        }

        $this->setLayout('main1');
        return $this->render('sathvarthaEvent', [
            'tasks' => $tasks,
            'sathvarthaOrganizers' => $sathvarthaOrganizers,
            'localOrganizers' => $localOrganizers,
            'errorMessage' => $errorMessage,
            'formData' => $eventData ?? [],
            'existingEvents' => $existingEvents
        ]);
    }


    public function viewMyTasks(Request $request, Response $response)
    {
        $assignedTo = Application::$app->session->get('nameFinal'); // Logged-in user
        $tasks = TelecallerSMModel::getMyTasks($assignedTo);
        $this->setLayout('main1');
        return $this->render('myTasksView', [
            'tasks' => $tasks
        ]);
    }

    public function viewAllSMList(Request $request, Response $response)
    {
        $filters = $_GET['filter'] ?? [];
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

        // Step 3: Set pagination limit and offset
        $limit = 20;
        $offset = ($page - 1) * $limit;

        // Step 4: Fetch filtered & paginated records
        $data = DataBankModel::getFilteredSMData($filters, $limit, $offset);
        $data1 = CandidateModel::findAllEvangelistForSM1();

        $this->setLayout('main1');
        // Step 5: Return to view with additional data
        return $this->render('sm_list', [
            'records' => $data['records'],
            'totalRecords' => $data['totalRecords'],
            'filters' => $filters,
            'currentPage' => $page,
            'limit' => $limit,
            'telecallers'   => $data1 // ✅ passing to view
        ]);
    }

    public function viewAllTelecallersList1(Request $request, Response $response)
    {
//        // Get filter values
//        $filters = $request->getQueryParam('filter') ?? [];
//
//        // Get current page number
//        $page = max(1, (int)$request->getQueryParam('page', 1));
//
//        // Limit per page
//        $limit = 50;
//        $offset = ($page - 1) * $limit;


        $dataBankModel = new DataBankModel();
        $allRecords= DataBankModel::getAllPHONEDataBankRecords();
        //$data= DataBankModel::getFilteredTelecallerData($filters, $limit, $offset);

//        return $this->render('telecallers_list', [
//            'records' => $data['records'],
//            'totalRecords' => $data['totalRecords'],
//            'filters' => $filters,
//            'currentPage' => $page,
//            'limit' => $limit
//        ]);


        return $this->render('telecallers_list', [
            'records' => $allRecords
        ]);
    }

    public function viewAllTelecallersList(Request $request, Response $response)
    {
        $filters = $_GET['filter'] ?? [];
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

        // Step 3: Set pagination limit and offset
        $limit = 20;
        $offset = ($page - 1) * $limit;

        // Step 4: Fetch filtered & paginated records
        $data = DataBankModel::getFilteredTelecallerData($filters, $limit, $offset);

        $data1 = CandidateModel::findAllEvangelistForTelecalling1();

        $this->setLayout('main1');
        // Step 5: Return to view with additional data
        return $this->render('telecallers_list', [
            'records'       => $data['records'],
            'totalRecords'  => $data['totalRecords'],
            'filters'       => $filters,
            'currentPage'   => $page,
            'limit'         => $limit,
            'telecallers'   => $data1 // ✅ passing to view
        ]);
    }

    public function viewAllCanAttendenceMarking(Request $request, Response $response)
    {

        $candidateModel = new CandidateModel();

        // Pagination variables
        $perPage = 10; // Number of records per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $perPage;

        // Get total records count
        $totalRecords = CandidateModel::countAllCandidates();
        $totalPages = ceil($totalRecords / $perPage);

        // Fetch paginated data
        $data = CandidateModel::findAllCandidates($offset, $perPage);
        $this->setLayout('main1');
        return $this->render('viewAllCanAttendenceMarking', [
            'data' => $data,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
    }


    public function loginEvangelist(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        Application::$app->session->set('UI', 'evg');
        if ($request->isPost()) {

            $loginForm->loadData($request->getBody());

            $hiddenField = $_POST["hidden_field"];
            if (!empty($username) || !empty($password) || !empty($hiddenField)) {
                return;
            }
//            if ($loginForm->validate() && $loginForm->loginEvangelist()) {
//                error_log("Hello world");
//
////                $id = Application::$app->session->get('user');
////                $data = EvangelistModel::findCandidateClassDetails1(['id'=> $id]);
//                //error_log("Entered this function");
//                echo "Entered this function";
//                return $this->render('profile');
//            }
            if ($loginForm->validate()) {
                error_log("Validation successful");
            } else {
                error_log("Validation failed");
            }

            if ($loginForm->loginEvangelist()) {
                $evangelistName= Application::$app->session->get('nameFinal');
//                $id = Application::$app->session->get('user');
                //$data = CandidateModel::findAllCandidatesForEvangelist(['evangelist'=> $loginForm->username],$loginForm->username);
                //$data1 = EvangelistModel::findworkGroupForEvangelist(['evangelist'=> $loginForm->username],$loginForm->username);

                $data = CandidateModel::findAllCandidatesForEvangelist(['evangelist'=> $evangelistName],$evangelistName);
                $data1 = EvangelistModel::findworkGroupForEvangelist(['evangelist'=> $evangelistName],$evangelistName);


//                error_log("evngDashboardData: " . print_r($data1, true));
//                error_log("evngDashboardData: " . print_r($data, true));

// In the loginEvangelist method of your AuthController
// Assuming $data is the array of candidates

Application::$app->session->set('evngDashboardData', $data);
Application::$app->session->set('evngDashboardData2', $data1);
Application::$app->session->set('xtr', $loginForm->username);
Application::$app->session->set('evngName', $evangelistName);
Application::$app->session->set('loginForm', $loginForm);
                $this->setLayout('main1');



                return $this->render('evngDashboard', [
                    'models' => $data,'modes' => $loginForm
                ]);

            } else {
                error_log("Login failed1");
            }



        }

        $this->setLayout('main1');
        return $this->render('loginEv', [
            'model' => $loginForm
        ]);

    }

    public function register(Request $request)
    {
        $registerModel = new RegisterModel();
        if($request->isPost())
        {
            $body = $request->getBody();

            $registerModel->loadData($request->getBody());
            if($registerModel->validate() && $registerModel->register()){
                return 'Success';
            }

            return $this->render('register',[
                'model'=> $registerModel
            ]);

            return 'Handle submitted data';
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model'=> $registerModel
        ]);
    }

    public function swt(Request $request)
    {
        $watchTime = Application::$app->session->get('watch_time');
        $participant = Application::$app->session->get('participant');

        error_log("Watch time: " . $watchTime);
        error_log("participant: " . $participant);

        // Create an instance of the model representing the video_watch_history table
        $videoWatchHistoryModel = new VideoWatchHistoryModel(); // Replace with your actual model class

        // Prepare the data to insert into the table
        $data = [
            'recordDate' => null,
            'mobile' => null,
            'participant' => Application::$app->session->get('participant'), // Replace with actual fields
            'evangelist' => Application::$app->session->get('evangelist'),
            'wgroup' => null,
            'language' => Application::$app->session->get('language'),
            'expiryDate' => null,
            'classFrom' => Application::$app->session->get('classFrom'),
            'classTo' => null,
            'status' =>  null,
            'mediaType'=> null,
            'remark' => null,
            'classLink' => null,
            'feedback' => null,
            'password' => Application::$app->session->get('password'),
            'duration_watched' => Application::$app->session->get('watch_time'), // Store the watch time
            'video_watch_status' => null,
            'device_info' => null,
            'location' => null
        ];
//        print_r($data);
        error_log("Request payload: " . print_r($data, true));

        // Insert the data into the database
        $result = $videoWatchHistoryModel->saveRecordViaApi2($data,' '); // Call your saveRecordViaApi method



    }


    public function jsonResponse($data, $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
    
    
    public function update_session(Request $request)
    {
//        $watchTime = $request->input('watch_time');
        $formData = $request->getBody();

        // Access the "watch_time" field from the form data
        $watchTime = $formData['watch_time'] ?? null;
        error_log("Watch time: " . $watchTime);
        if ($watchTime !== null) {
            // Do something with $watchTime, for example, store it in a session variable
            Application::$app->session->set('watch_time', $watchTime);
            error_log("Watch time set: " . $watchTime);
            return $this->jsonResponse(['message' => 'Video watch time stored successfully']);
        } else {
            // Handle the case where "watch_time" is not found in the form data
            return $this->jsonResponse(['error' => 'Watch time not provided'], 400);
        }


    }



    public function register17D(Request $request)
    {
        $registerModel = new RegisterModel();


        if($request->isPost())
        {


            $registerModel->loadData($request->getBody());
            $password=self::generateRandomNumber(8);

            $inputData = json_decode(file_get_contents("php://input"),true);
            if(empty($inputData)){
                $registerModel->register17D($_POST,$password);

                //$storeClassRequest = storeClassRequest($_POST);
                // Call Site Controller and render on UI
//                $controller = new AuthController();
//                $controller->getClassDetailsForCandidateUI($registerModel->evangelist, $registerModel->participant,$registerModel);


                $userDetails = $registerModel->getUserDetailsByUsername7D($registerModel->evangelist,$registerModel->participant,$registerModel->mobile);





                // Render the view with the user details
                //$this->setLayout('auth');
                $this->setLayout('main1');
                return $this->render('classDetailsForCandidate7D', ['userDetails' => $userDetails]);
            }
            else{
                $expectedHeaderValue = '4567';
                if (!$request->hasHeader('X-API')) {
                    header('HTTP/1.1 401 Unauthorized');
                    return 'Unauthorized';
                }
                if ($request->hasHeader('X-Api')) {
                    $actualHeaderValue = $request->getHeader('X-Api');
                    error_log('Actual Header Value: ' . $actualHeaderValue);
                    error_log('Expected Header Value: ' . $expectedHeaderValue);

                    if( $actualHeaderValue === $expectedHeaderValue)
                    {

                    }
                    else{
                        header('HTTP/1.1 401 Unauthorizedj');
                        return 'Unauthorized';
                    }

                }
                $passwordFromJson = $inputData['password'];
                if(!empty($passwordFromJson))
                {
                    echo '<pre>';
                    var_dump($inputData);
                    echo '</pre>';
                    $registerModel->register17D($inputData,$passwordFromJson);
                }
                else
                {
                    echo '<pre>';
                    var_dump($inputData);
                    echo '</pre>';
                    $registerModel->register17D($inputData,$password);
                }

                //$storeClassRequest = storeClassRequest($inputData);
                return 'Recorded inserted successfully';
            }
            $body = $request->getBody();


//            if($registerModel->validate() && $registerModel->register()){
//                return 'Success';
//            }

            echo '<pre>';
            var_dump("Hi");
            echo '</pre>';
            return $this->render('register7D', [
                'model' => $registerModel,
                'mediaType' => $mediaType, // Pass the global variable
            ]);

            return 'Recorded inserted successfully';
        }
        else
        {
            $data = [
                'status' => 405,
                'message' => $request->getMethod(). ' Method Not Allowed',

            ];
            header("HTTP/1.0 405 Method Mot Allowed");

        }
        $this->setLayout('auth');
        $candidateModel = new CandidateModel();

        $data=Application::$app->session->get('evngDashboardData7');
        $ind=Application::$app->session->get('index7D');
        $mobile = $data[$ind]->mobile;
        $evangelist = $data[$ind]->evangelist;
        echo '<pre>';
        var_dump($evangelist);
        echo '</pre>';
        $participantName = $data[$ind]->participantName;


        $candidateDetails = $candidateModel->getMediaType7D($evangelist,$participantName,$mobile);
        $mediaType = $candidateDetails['mediaType'];


        return $this->render('register7D', [
            'model' => $registerModel,'mediaType'=> $mediaType, 'evangelist'=> $evangelist// Pass the global variable
        ]);
    }



    public function register1(Request $request)
    {
         $botSecret = $_ENV['BOT_SECRET'];
         $chatId = $_ENV['CHAT_ID'];

        $registerModel = new RegisterModel();


        if($request->isPost())
        {


            $registerModel->loadData($request->getBody());
            $password=self::generateRandomNumber(8);

            $inputData = json_decode(file_get_contents("php://input"),true);
            if(empty($inputData)){
                $registerModel->register1($_POST,$password);

                //$storeClassRequest = storeClassRequest($_POST);
                // Call Site Controller and render on UI
//                $controller = new AuthController();
//                $controller->getClassDetailsForCandidateUI($registerModel->evangelist, $registerModel->participant,$registerModel);


                $userDetails = $registerModel->getUserDetailsByUsername($registerModel->evangelist,$registerModel->participant,$registerModel->mobile);





                // Render the view with the user details
                //$this->setLayout('auth');
                $this->setLayout('main1');
                        $this->sendTelegramNotification(
                         $botSecret,
                         $chatId,
                         'New',
                            $registerModel->evangelist,
                            $registerModel->participant,
                            $registerModel->classFrom,
                            $registerModel->classTo,
                            $registerModel->recordDate,
                            $registerModel->language,
                            $registerModel->mobile,
                            $registerModel->status,
                            $registerModel->remark,
                            $registerModel->wgroup,
                            $registerModel->mediaType,
                            $registerModel->feedback
                     );
//                echo '<pre>';
//                var_dump($registerModel);
//                echo '<pre>';

                return $this->render('classDetailsForCandidate', ['userDetails' => $userDetails]);
            }
            else{
                $expectedHeaderValue = '4567';
                if (!$request->hasHeader('X-API')) {
                    header('HTTP/1.1 401 Unauthorized');
                    return 'Unauthorized';
                }
                if ($request->hasHeader('X-Api')) {
                    $actualHeaderValue = $request->getHeader('X-Api');
                    error_log('Actual Header Value: ' . $actualHeaderValue);
                    error_log('Expected Header Value: ' . $expectedHeaderValue);

                    if( $actualHeaderValue === $expectedHeaderValue)
                    {

                    }
                    else{
                        header('HTTP/1.1 401 Unauthorizedj');
                        return 'Unauthorized';
                    }

                }
                 $passwordFromJson = $inputData['password'];
                if(!empty($passwordFromJson))
                {
                    echo '<pre>';
                    var_dump($inputData);
                    echo '</pre>';
                    $registerModel->register1($inputData,$passwordFromJson);
                }
                else
                {
                    echo '<pre>';
                    var_dump($inputData);
                    echo '</pre>';
                    $registerModel->register1($inputData,$password);
                }

                //$storeClassRequest = storeClassRequest($inputData);
                return 'Recorded inserted successfully';
            }
            $body = $request->getBody();


//            if($registerModel->validate() && $registerModel->register()){
//                return 'Success';
//            }

            echo '<pre>';
            var_dump("Hi");
            echo '</pre>';
            return $this->render('register', [
                'model' => $registerModel,
                'mediaType' => $mediaType, // Pass the global variable
            ]);

            return 'Recorded inserted successfully';
        }
        else
        {
            $data = [
                'status' => 405,
                'message' => $request->getMethod(). ' Method Not Allowed',

            ];
            header("HTTP/1.0 405 Method Mot Allowed");

        }
        $this->setLayout('auth');
        $candidateModel = new CandidateModel();

        $data=Application::$app->session->get('evngDashboardData');
        $ind=Application::$app->session->get('index');
        $mobile = $data[$ind]->mobile;
        $evangelist = $data[$ind]->evangelist;
        $participantName = $data[$ind]->participantName;


        $candidateDetails = $candidateModel->getMediaType($evangelist,$participantName,$mobile);
        $mediaType = $candidateDetails['mediaType'];


        return $this->render('register', [
            'model' => $registerModel,'mediaType'=> $mediaType// Pass the global variable
        ]);
    }

    private function sendTelegramNotification($botSecret, $chatId, $isUpdateRequest, $evangelist, $partName, $classFrom, $classTo, $classDate, $language, $mobile, $status, $remark, $groupName, $mediaType, $feedback) {
        $classDate = gmdate("Y-m-d");
        $message = <<<TEXT
👑 ĒL-YASHƎEV 👑
🌷 ĒL HAEMUNAH 🌷

   NEW CLASS REQUEST

🔹 Name : $evangelist
🔹 Participant Name: $partName
🔹 Class No: $classFrom
🔹 Class Date(UTC) : $classDate
🔹 Language : $language
🔹 Participant Mobile : $mobile
🔹 Request Type : $status
🔹 Remark : $remark
🔹 Fellowship : $groupName
🔹 Media Type : $mediaType
🔹 Feedback : $feedback 

Nanni Appa. Nanni Amma.🙏🏻 

Please keep in your prayers 🙏🏻
🔥  HAHAYEEM EL YESU 🔥
TEXT;

        $url = "https://api.telegram.org/bot" . $botSecret . "/sendMessage";

        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML'
        ];

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }



    public function getClassDetailsForCandidateUI($evangelist,$participantName,$registerModel) {

        //$registerModel = new RegisterModel();

        // Validate and sanitize parameters as needed

        // Example: Fetch details based on $username and $candidate
        $userDetails = $registerModel->getUserDetailsByUsername($evangelist,$participantName);

        // Render the view with the user details
        $this->setLayout('auth');
        return $this->render('classDetailsForCandidate', ['userDetails' => $userDetails]);
    }

    public function registerEvangelist(Request $request)
    {
        $evangelistModel = new EvangelistModel();
        if($request->isPost())
        {






            $evangelistModel->loadData($request->getBody());
            echo '<pre>';
            var_dump($evangelistModel);
            echo '</pre>';
            $password=self::generateRandomNumber(8);

            $inputData = json_decode(file_get_contents("php://input"),true);
            if(empty($inputData)){
                error_log('Password is: ' . $password);
                $evangelistModel->register1($_POST,$password);
                return 'Handle submitted data';

            }
            else{
                $expectedHeaderValue = '4567';
                if (!$request->hasHeader('X-API')) {
                    header('HTTP/1.1 401 Unauthorized');
                    return 'Unauthorized';
                }
                if ($request->hasHeader('X-Api')) {
                    $actualHeaderValue = $request->getHeader('X-Api');
                    error_log('Actual Header Value: ' . $actualHeaderValue);
                    error_log('Expected Header Value: ' . $expectedHeaderValue);

                    if( $actualHeaderValue === $expectedHeaderValue)
                    {

                    }
                    else{
                        header('HTTP/1.1 401 Unauthorizedj');
                        return 'Unauthorized';
                    }

                }
                $passwordFromJson = $inputData['password'];
                //$passwordFromJson = $inputData['password'] ?? null;
                error_log('APassword is: ' . $password);
                if(!empty($passwordFromJson))
                {
                    $evangelistModel->register1($inputData,$passwordFromJson);
                }
                else
                {
                    $evangelistModel->register1($inputData,$password);
                }

                return 'Recorded inserted successfully';
            }
            $body = $request->getBody();


            return $this->render('registerEv',[
                'model'=> $evangelistModel
            ]);

            return 'Recorded inserted successfully';
        }
//        else
//        {
//            $data = [
//                'status' => 405,
//                'message' => $request->getMethod(). ' Method Not Allowed',
//
//            ];
//            header("HTTP/1.0 405 Method Mot Allowed");
//
//        }
        $this->setLayout('auth');
        return $this->render('registerEv', [
            'model'=> $evangelistModel
        ]);
    }

    public static function generateRandomNumber($length = 8)
    {
        $random = "";
        srand((double) microtime() * 1000000);

        $data = "123456123456789071234567890890";
        // $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; // if you need alphabatic also

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;

    }


    public function logout(Request $request, Response $response)
    {
        
    // Assuming you have saved the watch time in the session
        // $watchTime = Application::$app->session->get('watch_time');
        // $participant = Application::$app->session->get('participant');

        // error_log("Watch time from session: " . $watchTime);
        // error_log("participant from session: " . $participant);

        // // Prepare the data to send in the POST request
        // $postData = [
        //     'watch_time' => $watchTime
        // ];

        // error_log("POST Data: " . print_r($postData, true));

        // // Initialize cURL session
        // $ch = curl_init();

        // // Set cURL options
        // curl_setopt($ch, CURLOPT_URL, 'https://testqhe.site/swt'); // Replace with your API URL
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // // Set the Content-Type header to application/x-www-form-urlencoded
        // curl_setopt($ch, CURLOPT_HTTPHEADER, [
        //     'Content-Type: application/x-www-form-urlencoded',
        //     'Cookie: PHPSESSID=' . session_id(), // Include the session ID if needed
        // ]);




        // // Before cURL request
        // error_log("Before cURL request");

        // curl_setopt($ch, CURLOPT_TIMEOUT, 2);

        // // Execute the cURL request
        // $apiResponse = curl_exec($ch);

        // if ($apiResponse === false) {
        //     echo 'Curl error: ' . curl_error($ch);
        // }
        // else {
        //     // Output the response for debugging
        //     echo 'API Response: ' . $apiResponse;
        // }

        // // Before cURL request
        // error_log("After cURL request");

        // // Check for errors
        // if (curl_errno($ch)) {
        //     // Handle error here
        //     // You might want to log the error or perform other actions
        //     echo 'Curl error: ' . curl_error($ch);
        // }

        // // Close cURL session
        // curl_close($ch);
    
        
    Application::$app->logout();
    $response->redirect('/');
    }

    public function logoutEvangelistPortal(Request $request, Response $response)
    {

        Application::$app->logout();
        //$response->redirect('/login');
    }

    public function profile()
    {
        return $this->render('profile');

    }


    public function evngDashboard7()
    {
        return $this->render('evngDashboard7');

    }


    public function evngDashboard()
    {
        return $this->render('evngDashboard');

    }

    public function evngDashboard1()
    {
        $this->setLayout('main1');
        return $this->render('evngDashboard1');

    }
    public function video()
    {
        return $this->render('video');

    }



}