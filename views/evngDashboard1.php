<?php
use app\core\Application;
use app\models\CandidateModel;
use app\models\LoginForm;
use app\models\EvangelistModel;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evangelist Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        .primary {
            background-color: #007BFF; /* Primary color */
            color: white; /* White text */
            border: none; /* No border */
            padding: 10px 20px; /* Padding for larger clickable area */
            font-size: 16px; /* Slightly larger font for readability */
            cursor: pointer; /* Pointer cursor on hover */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            transition: background-color 0.3s, transform 0.2s; /* Smooth transition for hover */
            margin: 5px; /* Space between buttons */
        }

        .primary:hover {
            background-color: #0056b3; /* Darker shade on hover */
            transform: translateY(-2px); /* Slight lift effect */
        }

        .primary:active {
            background-color: #003d80; /* Even darker when active */
            transform: translateY(0); /* Reset position when clicked */
        }

        .primary:focus {
            outline: none; /* Remove default focus outline */
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.5); /* Custom focus outline */
        }

        .icon-button-group {
            display: flex;
            gap: 6px; /* less gap between buttons */
            flex-wrap: wrap;
        }

        .icon-button {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 4px 8px; /* reduced padding for compact size */
            font-size: 13px; /* smaller text */
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .icon-button i {
            font-size: 14px; /* smaller icon */
        }

        .icon-button:hover {
            background-color: #45a049;
            transform: translateY(-1px);
        }

        .icon-button:active {
            transform: translateY(0);
        }


        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f5;
        }
        .search-container {
            display: flex;
            justify-content: space-between; /* Distributes space between items */
            align-items: center; /* Aligns items vertically */
            margin: 20px 0;
            flex-wrap: nowrap; /* Prevent wrapping */
        }

        .search-input {
            flex: 1; /* Allow the input to grow and take available space */
            min-width: 200px; /* Minimum width to prevent it from being too small */
            max-width: 70%; /* Allow the input to be a percentage of the container */
            padding: 2px;
            font-size: 1em;
            /*border-radius: 8px;*/
            border-radius: 0; /* Remove rounded borders */
            border: 1px solid #ccc;
            margin-right: 10px; /* Space between input and select */
        }

        .status-filter {
            padding: 2px;
            /*border-radius: 8px;*/
            border-radius: 0; /* Remove rounded borders */
            border: 1px solid #ccc;
            max-width: 25%; /* Set a reasonable maximum width */
        }

        /* Optional: Adjust the layout for smaller screens */
        @media (max-width: 600px) {
            .search-container {
                flex-wrap: nowrap; /* Ensure no wrapping on smaller screens */
            }

            .search-input {
                margin-right: 10px; /* Maintain spacing */
                max-width: 70%; /* Maintain flexibility */
            }

            .status-filter {
                max-width: 25%; /* Keep the status filter responsive */
            }
        }
        .card, .status-section {
            background-color: #f1f1f1;
            color: #333;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .status-section {
            display: flex;
            flex-direction: column;
            gap: 10px;
            text-align: center;
            font-weight: bold;
        }

        .status-title {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
            /*background-color: #e0e0e0;*/
            background-color: #74eaf7; /
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            max-width: 100%;
            margin-bottom: 8px;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .card-content {
            text-align: left;
            flex-grow: 1;
            font-size: 14px;
            line-height: 1.2;
        }

        .card-icons {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 8px;
        }

        .card-icons i {
            cursor: pointer;
        }

        .plus-icon, .edit-icon {
            font-size: 1.5em;
            cursor: pointer;
        }

        .plus-icon { color: #007BFF; }
        .edit-icon { color: #28a745; }

        .hidden {
            display: none;
        }

        .button-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .floating-button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #007BFF;
            color: white;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 1.5em;
            transition: background-color 0.3s;
        }

        .floating-button i {
            color: white; /* Ensure the icon color is white */
        }

        .floating-button:hover {
            background-color: #0056b3;
        }

        .seven-day-badge {
            background-color: #007BFF; /* Match other blue buttons */
            color: white;
            font-weight: bold;
            font-size: 14px;
            padding: 0; /* Remove extra padding */
            border-radius: 50%; /* Make it fully circular */
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
            margin: 5px; /* Ensure spacing is consistent */
            width: 40px; /* Ensure perfect circle */
            height: 47px; /* Ensure perfect circle */
            text-align: center;
        }

        .seven-day-badge:hover {
            background-color: #0056b3;
        }

        .icon-button-group {
            display: flex; /* Ensure buttons are on the same row */
            align-items: center;
            gap: 8px; /* Adjust spacing between buttons */
        }


        .attendance-link img {
            width: 32px;
            height: 32px;
        }

        .attendance-link i {
            font-size: 18px;
        }

        .attendance-link:hover {
            background-color: #45a049; /* Darker Green */
            text-decoration: none;
        }

        .attendance-link:active {
            background-color: #3e8e41; /* Pressed Effect */
        }

        .hamburger-menu {
            position: relative;
            display: inline-block;
        }

        .hamburger-icon {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background-color: #fff;
            min-width: 220px;
            max-width: 300px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            border-radius: 4px;
            padding: 8px 0;
            z-index: 1000;
            word-wrap: break-word;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            width: 100%;
            text-align: left;
            border: none;
            background: none;
            cursor: pointer;
            white-space: normal; /* Allows text wrap */
            overflow-wrap: break-word;
        }

        .dropdown-item i {
            margin-right: 10px;
            min-width: 20px;
            text-align: center;
        }


        .dropdown-item:hover {
            background-color: #f5f5f5;
        }

        /* Responsive tweaks */
        @media (max-width: 600px) {
            .dropdown-item {
                font-size: 0.9rem;
                padding: 8px;
            }
        }

        .hamburger-menu {
            position: relative;
            display: inline-block;
        }

        .hamburger-icon {
            font-size: 1.5rem;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: #333;
            border-radius: 4px;
            transition: background 0.2s ease;
        }

        .hamburger-icon:hover {
            background-color: rgba(0,0,0,0.1);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 40px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            border-radius: 6px;
            min-width: 180px;
            z-index: 100;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 10px;
            border: none;
            background: none;
            font-size: 0.95rem;
            color: #333;
            cursor: pointer;
            text-align: left;
            transition: background 0.15s ease;
        }

        .dropdown-item:hover {
            background-color: #f5f5f5;
        }

        /* Responsive tweaks */
        @media (max-width: 600px) {
            .dropdown-item {
                font-size: 0.9rem;
                padding: 8px;
            }
        }



    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f4f4f5; border-0;">
    <div class="container">

        <ul class="navbar-nav ml-auto">
            <a class="navbar-brand" href="#">
                <img src="images/logo.jpg" alt="Logo" width="70" id="logo-image">
            </a>
            <li class="nav-item d-flex align-items-center">
                <a class="nav-link" href="#" id="logout-link">
                    <button type="button" class="btn btn-primary">Logout</button>
                </a>
            </li>
        </ul>
    </div>
</nav>
<?php
// Retrieve the session data
$dashboardData = Application::$app->session->get('evngDashboardData2');
$designation = $dashboardData[0]->designation;

?>

<?php if ($designation == 'Evangelist'): ?>
    <div class="hamburger-menu">
        <button class="hamburger-icon" onclick="toggleMenu()" aria-label="Menu">
            <i class="fas fa-bars"></i>
        </button>

        <div class="dropdown-menu" id="menuDropdown">
            <button class="dropdown-item" onclick="window.location.href='viewMyTasks';">
                <i class="fas fa-tasks"></i> My Task
            </button>

            <button class="dropdown-item" onclick="window.location.href='myPref';">
                <i class="fas fa-sliders-h"></i> Evangelization Preference
            </button>

            <button class="dropdown-item" onclick="window.location.href='getWordSessionsApproved';">
                <i class="fas fa-book-open"></i> Word Sessions
            </button>

            <button class="dropdown-item" onclick="window.location.href='viewAssignedWordSessions';">
                <i class="fas fa-check-circle"></i> Approve Sessions
            </button>

            <button class="dropdown-item" onclick="window.location.href='mylangPref';">
                <i class="fas fa-language"></i> Word Session Language Preference
            </button>

            <button class="dropdown-item" onclick="window.location.href='mycountryPref';">
                <i class="fas fa-globe-americas"></i> Word Session Country Preference
            </button>

        </div>
    </div>
<?php endif; ?>

<div class="icon-button-group">
    <?php if ($designation == 'Caretaker'): ?>

        <button class="icon-button seven-day-badge" title="View Candidates" onclick="window.location.href='view7DCan';">
            7D
        </button>

        <a href="#" class="attendance-link" title="View Appointments" onclick="window.location.href='viewAllAppointmentsCT';">
            <img src="home.png" alt="Attendance Icon">
        </a>

    <?php endif; ?>
</div>


<?php if ($designation == 'LocalOrganizer'): ?>

    <a href="#" class="attendance-link" title="View Appointments" onclick="window.location.href='viewAllAppointmentsLO';">
        <img src="home.png" alt="Attendance Icon">
    </a>


<?php endif; ?>


<?php if ($designation == 'PanelMember'): ?>

    <a href="#" class="attendance-link" title="View Appointments" onclick="window.location.href='viewAllAppointmentsPM';">
        <img src="home.png" alt="Attendance Icon">
    </a>


<?php endif; ?>


<div class="icon-button-group">
    <?php if ($designation == 'Event Leader'): ?>
        <!--    <button class="icon-button" title="Evangelist Registration" onclick="window.location.href='/evngRegistration';">-->
        <!--        <i class="fas fa-user-plus"></i>-->
        <!--    </button>-->
        <!--    <button class="icon-button" title="View Submitted Registrations" onclick="window.location.href='/viewRegistration';">-->
        <!--        <i class="fas fa-list"></i>-->
        <!--    </button>-->
        <!--    <button class="icon-button seven-day-badge" title="View Candidates" onclick="window.location.href='view7DCan';">-->
        <!--        7D-->
        <!--    </button>-->
        <!--    <button class="icon-button seven-day-badge" title="Attendance Marking System" onclick="window.location.href='view7DCan';">-->
        <!--        <i class="fa-solid fa-clipboard-user"></i> Online-->
        <!--    </button>-->

        <a href="#" class="attendance-link" title="Attendance Marking System" onclick="window.location.href='viewAllCanAttendenceMarking';">
            <img src="check.png" alt="Attendance Icon">
        </a>

        <a href="#" class="attendance-link" title="Add New Sathvartha Event" onclick="window.location.href='addNewSathEvent';">
            <img src="event.png" alt="Attendance Icon">
        </a>

        <a href="#" class="attendance-link" title="Add New Home mission Event" onclick="window.location.href='addNewHomeEvent';">
            <img src="home.png" alt="Attendance Icon">
        </a>


        <a href="#" class="attendance-link" title="Add Appointments" onclick="window.location.href='viewCandidates';">
            <img src="appointment1.png" alt="Appointments Icon">
        </a>


        <a href="#" class="attendance-link" title="View Appointments" onclick="window.location.href='viewAllAppointmentsReadonly';">
            <img src="appointment.png" alt="Appointments Icon">
        </a>


        <a href="#" class="attendance-link" title="Sathvartha Ready" onclick="window.location.href='viewAllAppointmentsSR';">
            <img src="appointment.png" alt="Appointments Icon">
        </a>

        <a href="#" class="attendance-link" title="In Fellowship" onclick="window.location.href='viewAllAppointmentsIF';">
            <img src="church.png" alt="Appointments Icon">
        </a>



        <!--    <a href="#" class="attendance-link tooltip" onclick="markAttendance()" data-title="Mark Attendance for Online Sathvartha">-->
        <!--        <img src="check.png" alt="Attendance Icon">-->
        <!--    </a>-->


        <!--    <a href="#" class="attendance-link" onclick="window.location.href='view7DCan';">Mark Attendance for Online Sathvartha</a>-->

    <?php endif; ?>
</div>

<?php if ($designation == 'TaskManager'): ?>


    <a href="#" class="attendance-link" title="View Telecaller Tasks" onclick="window.location.href='viewAllTelecallersList';">
        <img src="phone.png" alt="Attendance Icon">
    </a>

    <a href="#" class="attendance-link" title="View SM Tasks" onclick="window.location.href='viewAllSMList';">
        <img src="social-media.png" alt="Attendance Icon">
    </a>


    <a href="#" class="attendance-link" title="CSV File upload" onclick="window.location.href='csvFileUpload';">
        CSV 📁
    </a>

    <a href="#" class="attendance-link" title="Evangelist Allocated Countries" onclick="window.location.href='/evngAllCntr';">
        🌍
    </a>

<?php endif; ?>



<div class="icon-button-group search-icons">
    <?php if ($designation == 'Evng Coordinator'): ?>
        <div class="hamburger-menu">
            <button class="hamburger-icon" onclick="toggleMenu()" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>

            <div class="dropdown-menu" id="menuDropdown">
                <button class="dropdown-item" onclick="window.location.href='/reportManagement';">
                    <i class="fas fa-file-alt"></i> View Report
                </button>

                <button class="dropdown-item" onclick="window.location.href='/evngRegistration';">
                    <i class="fas fa-user-plus"></i> Evangelist Registration
                </button>

                <button class="dropdown-item" onclick="window.location.href='/viewRegistration';">
                    <i class="fas fa-list"></i> View Submitted Registrations
                </button>

                <button class="dropdown-item" onclick="window.location.href='/viewAllRegistrations';">
                    <i class="fas fa-list"></i> View all Registrations
                </button>

                <button class="dropdown-item" onclick="window.location.href='myPref';">
                    <i class="fas fa-sliders-h"></i> Evangelization Preference
                </button>

                <button class="dropdown-item" onclick="window.location.href='view7DApproval';">
                    <i class="fas fa-check-circle"></i> 7D Approval
                </button>

                <button class="dropdown-item" onclick="window.location.href='view7DApproved';">
                    <i class="fas fa-list-alt"></i> 7D Approved Candidates
                </button>

                <button class="dropdown-item" onclick="window.location.href='viewMyTasks';">
                    <i class="fas fa-tasks"></i> My Task
                </button>

                <button class="dropdown-item" onclick="window.location.href='getWordSessionsApproved';">
                    <i class="fas fa-book-open"></i> My Word Sessions
                </button>

                <button class="dropdown-item" onclick="window.location.href='viewAssignedWordSessions';">
                    <i class="fas fa-check-circle"></i> Approve Word Sessions
                </button>

                <button class="dropdown-item" onclick="window.location.href='mylangPref';">
                    <i class="fas fa-language"></i> Word Session Language Preference
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php if ($designation == 'SathvarthaOrganizer'): ?>

    <a href="#" class="attendance-link" title="Organize Sathvartha Event" onclick="window.location.href='allEvents';">
        <img src="event1.png" alt="Attendance Icon">
    </a>



<?php endif; ?>

<div class="icon-button-group search-icons">
    <?php if ($designation == 'Management' ): ?>
        <div class="hamburger-menu">
            <button class="hamburger-icon" onclick="toggleMenu()" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>

            <div class="dropdown-menu" id="menuDropdown">
                <button class="dropdown-item" onclick="window.location.href='/reportManagement';">
                    <i class="fas fa-file-alt"></i> View Report
                </button>

                <button class="dropdown-item" onclick="window.location.href='/evngRegistration';">
                    <i class="fas fa-user-plus"></i> Evangelist Registration
                </button>

                <button class="dropdown-item" onclick="window.location.href='/viewRegistration';">
                    <i class="fas fa-list"></i> View Submitted Registrations
                </button>

                <button class="dropdown-item" onclick="window.location.href='/viewAllRegistrations';">
                    <i class="fas fa-list"></i> View All Registrations
                </button>

                <button class="dropdown-item" onclick="window.location.href='/appRegistration';">
                    <i class="fas fa-check-circle"></i> Approval / Rejection
                </button>

                <button class="dropdown-item" onclick="window.location.href='view7DApproval';">
                    <i class="fas fa-check-circle"></i> 7D Approval
                </button>

                <button class="dropdown-item" onclick="window.location.href='view7DApproved';">
                    <i class="fas fa-list-alt"></i> 7D Approved Candidates
                </button>
                <button class="dropdown-item" onclick="window.location.href='evangelistRatings';">
                    <i class="fas fa-list-alt"></i> Give Rating
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>




<div class="icon-button-group">
    <?php if ($designation !== 'Evangelist' && $designation !== 'Event Leader' && $designation !== 'Evng Coordinator' && $designation !== 'Caretaker' && $designation !== 'Management'  && $designation !== 'TaskManager' && $designation !== 'LocalOrganizer' && $designation !== 'PanelMember' && $designation !='SathvarthaOrganizer' && $designation !='Group Leader'): ?>
        <button class="icon-button" title="View Report" onclick="window.location.href='/reportManagement';">
            <i class="fas fa-file-alt"></i>
        </button>
        <button class="icon-button" title="Evangelist Registration" onclick="window.location.href='/evngRegistration';">
            <i class="fas fa-user-plus"></i>
        </button>
        <button class="icon-button" title="Approval/Rejection" onclick="window.location.href='/appRegistration';">
            <i class="fas fa-check-circle"></i>
        </button>
        <button class="icon-button" title="View Submitted Registrations" onclick="window.location.href='/viewRegistration';">
            <i class="fas fa-list"></i>
        </button>
        <button class="icon-button" title="View all Registrations" onclick="window.location.href='/viewAllRegistrations';">
            <i class="fas fa-list"></i>
        </button>
        <button class="icon-button seven-day-badge" title="View Candidates" onclick="window.location.href='view7DCan';">
            7D
        </button>
    <?php endif; ?>
</div>

<?php if ($designation == 'Group Leader'): ?>
    <div class="hamburger-menu">
        <button class="hamburger-icon" onclick="toggleMenu()" aria-label="Menu">
            <i class="fas fa-bars"></i>
        </button>

        <div class="dropdown-menu" id="menuDropdown">
            <button class="dropdown-item" onclick="window.location.href='viewMyTasks';">
                <i class="fas fa-tasks"></i> My Task
            </button>

            <button class="dropdown-item" onclick="window.location.href='myPref';">
                <i class="fas fa-sliders-h"></i> Evangelization Preference
            </button>

            <button class="dropdown-item" onclick="window.location.href='getWordSessionsApproved';">
                <i class="fas fa-book-open"></i> Word Sessions
            </button>

            <button class="dropdown-item" onclick="window.location.href='viewAssignedWordSessions';">
                <i class="fas fa-check-circle"></i> Approve Sessions
            </button>

            <button class="dropdown-item" onclick="window.location.href='mylangPref';">
                <i class="fas fa-language"></i> Word Session Language Preference
            </button>

            <button class="dropdown-item" onclick="window.location.href='mycountryPref';">
                <i class="fas fa-globe-americas"></i> Word Session Country Preference
            </button>



        </div>
    </div>
<?php endif; ?>
<div class="container">
<!--    <h2>Evangelist Dashboard</h2>-->
<!--    <i>As for you, always be sober, endure suffering, do the work of an evangelist, carry out your ministry fully. (2 Timothy 4:5)</i>-->

    <?php
    $dashboardData = Application::$app->session->get('evngDashboardData2');
    $designation = $dashboardData[0]->designation;

    $candidates = $_SESSION['evngDashboardData'] ?? [];
    $groupedCandidates = [
        'Completed' => [],
        'Withdrawn' => [],
        'Active' => [],
        'InActive' => [],
        'Exit/Drop-out' => [],
        'Ready for 7D Sathvartha' => [],
    ];

    $statusMapping = [
        'Exit' => 'Exit/Drop-out',
    ];

    foreach ($candidates as $candidate) {
        //$status = ucfirst(strtolower(trim($candidate->activeStatus)));
        $status = trim($candidate->activeStatus);
        $status = $statusMapping[$status] ?? $status;

        if (isset($groupedCandidates[$status])) {
            $groupedCandidates[$status][] = $candidate;
        } else {
            //echo "Unrecognized status: " . htmlspecialchars($candidate->activeStatus) . "<br>";
        }
    }
    ?>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search by Name or Mobile" class="search-input">
<!--        <select id="statusFilter" style="width: 25%; padding: 10px; margin-bottom: 20px; border-radius: 8px; border: 1px solid #ccc;">-->
        <select id="statusFilter" class="status-filter">
            <option value="">Status</option>
            <option value="active">Active</option>
            <option value="exit/drop-out">Exit/Drop-out</option>
            <option value="completed">Completed</option>
            <option value="withdrawn">Withdrawn</option>
            <option value="inactive">Inactive</option>
            <option value="Ready for 7D Sathvartha">Ready for 7D Sathvartha</option>
        </select>
    </div>

    <?php
    foreach ($groupedCandidates as $status => $candidates) {
        if (!empty($candidates)) {
            echo "<div class='status-section'>";
            echo "<div class='status-title'>$status</div>";

            foreach ($candidates as $candidate) {
                ?>
                <div class="card" data-id="<?php echo $candidate->mobile; ?>">

                    <div class="card-content">
                        <p><strong><?php echo htmlspecialchars($candidate->participantName); ?></strong></p>
                        <p><i><?php echo htmlspecialchars($candidate->mobile); ?></i></p>
                        <!-- Hidden fields for additional data -->
                        <input type="hidden" class="country" value="<?php echo htmlspecialchars($candidate->country); ?>">
                        <input type="hidden" class="evangelist" value="<?php echo htmlspecialchars($candidate->evangelist); ?>">
                        <input type="hidden" class="language" value="<?php echo htmlspecialchars($candidate->language); ?>">
                        <input type="hidden" class="source" value="<?php echo htmlspecialchars($candidate->source); ?>">
                        <input type="hidden" class="mediaType" value="<?php echo htmlspecialchars($candidate->mediaType); ?>">
                        <input type="hidden" class="activeStatus" value="<?php echo htmlspecialchars($candidate->activeStatus); ?>">
                        <input type="hidden" class="remark" value="<?php echo htmlspecialchars($candidate->remark ?? ''); ?>">

                    </div>
                    <div class="card-icons">
                        <!-- <i class="fas fa-plus plus-icon" onclick="handlePlusClick(event, '<?php echo $candidate->mobile; ?>')"></i> -->

                        <i class="fas fa-edit edit-icon" onclick="handleEditClick(event, '<?php echo $candidate->mobile; ?>')"></i>
                    </div>
                </div>
                <?php
            }

            echo "</div>";
        }
    }
    ?>
</div>

<?php if ($designation != 'Caretaker' && $designation != 'Event Leader'): ?>
    <div class="button-container">
        <a id="addCandidateButton" class="floating-button">
            <i class="fas fa-plus"></i>
        </a>
    </div>
<?php endif; ?>

<script>
    document.getElementById('addCandidateButton').addEventListener('click', function() {
        window.location.href = '/candidate';
    });

    document.getElementById('searchInput').addEventListener('input', filterCards);
    document.getElementById('statusFilter').addEventListener('change', filterCards);

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.card').forEach((cardElement, index) => {
            cardElement.addEventListener('click', function () {
                handleCardClick(index, cardElement);
            });
        });
    });

    function filterCards() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            const participantName = card.querySelector('p:nth-child(1)').innerText.toLowerCase();
            const mobile = card.querySelector('p:nth-child(2)').innerText.toLowerCase();
            const matchesSearchTerm = participantName.includes(searchTerm) || mobile.includes(searchTerm);
            const status = card.parentElement.querySelector('.status-title').innerText.toLowerCase();
            //const matchesStatus = !statusFilter || status.includes(statusFilter);
            const matchesStatus = !statusFilter || status.trim() === statusFilter;


            card.style.display = matchesSearchTerm && matchesStatus ? 'block' : 'none';
        });
    }

    function handlePlusClick(event, index) {
        console.log("Plus icon clicked for candidate ID:", index);
        event.stopPropagation();
        const cardElement = document.querySelector('.card[data-id="' + index + '"]');
        if (!cardElement) {
            console.error("Card element not found for candidate ID:", index);
            return;
        }
        handleCardClick(index, cardElement);
    }

    function handleEditClick(event, index) {
        event.stopPropagation(); // Prevent the click event from bubbling up to the card

        // Fetch the candidate details from the card based on the index
        const cardElement = document.querySelector('.card[data-id="' + index + '"]');
        if (!cardElement) {
            console.error("Card element not found for candidate ID:", index);
            return;
        }

        // Retrieve specific details from card elements
        const participantName = cardElement.querySelector('p:nth-child(1)').innerText;
        const mobile = cardElement.querySelector('p:nth-child(2)').innerText;

        // Retrieve hidden field values
        const country = cardElement.querySelector('.country').value;
        const evangelist = cardElement.querySelector('.evangelist').value;
        const language = cardElement.querySelector('.language').value;
        const source = cardElement.querySelector('.source').value;
        const mediaType = cardElement.querySelector('.mediaType').value;
        const activeStatus = cardElement.querySelector('.activeStatus').value;
        const remark = cardElement.querySelector('.remark').value;

        console.log("Country fetched:", country); // Debugging log

        // Make a POST request to store session data
        fetch('/storeSessionData', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                participantName: participantName,
                country: country,
                evangelist: evangelist,
                mobile: mobile,
                language: language,
                source: source,
                mediaType: mediaType,
                activeStatus: activeStatus,
                remark: remark,
                index: index
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = '/editCandidate'; // Redirect to the edit candidate page
                } else {
                    console.error('Error storing session data:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }


    function handleCardClick(index, cardElement) {
        //const evngName = '<?php echo htmlspecialchars($_SESSION['loginForm']->username); ?>';
        const evngName = '<?php echo htmlspecialchars(Application::$app->session->get('nameFinal')); ?>';
        const participantElement = cardElement.querySelector('p:nth-child(1)');
        const mobileElement = cardElement.querySelector('p:nth-child(2)');

        if (!participantElement || !mobileElement) {
            console.error("Expected elements not found inside cardElement for candidate ID:", index);
            return;
        }

        const participantName = participantElement.innerText;
        const mobile = mobileElement.innerText;
        const encodedMobile = encodeURIComponent(mobile);

        window.location.href = `/getClassDetails?username=${evngName}&candidate=${participantName}&mobile=${encodedMobile}&index=${index}`;
    }
</script>
<script>
    document.getElementById('addReportButton').addEventListener('click', function() {
// Redirect to the "/candidate" page
        window.location.href = '/reportManagement';
    });
</script>
<script>
    document.getElementById('addRegButton').addEventListener('click', function() {
// Redirect to the "/candidate" page
        window.location.href = '/evngRegistration';
    });
</script>
<script>
    document.getElementById('addAppButton').addEventListener('click', function() {
// Redirect to the "/candidate" page
        window.location.href = '/appRegistration';
    });
</script>
<script>
    document.getElementById('viewButton').addEventListener('click', function() {
// Redirect to the "/candidate" page
        window.location.href = '/viewRegistration';
    });
</script>
<script>
    function toggleMenu() {
        const menu = document.getElementById('menuDropdown');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    // Hide dropdown when clicking outside
    window.addEventListener('click', function(e) {
        const menu = document.getElementById('menuDropdown');
        const button = document.querySelector('.hamburger-icon');
        if (!menu.contains(e.target) && !button.contains(e.target)) {
            menu.style.display = 'none';
        }
    });
</script>
<script>
    function toggleMenu() {
        const menu = document.getElementById('menuDropdown');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    // Hide dropdown when clicking outside
    window.addEventListener('click', function(e) {
        const menu = document.getElementById('menuDropdown');
        const button = document.querySelector('.hamburger-icon');
        if (!menu.contains(e.target) && !button.contains(e.target)) {
            menu.style.display = 'none';
        }
    });
</script>
</body>
</html>
