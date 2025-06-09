<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Attendance Marking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .btn-mark {
            padding: 6px 12px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-mark:hover {
            background: #218838;
        }

        /* Ensure text wraps properly in the Mobile column */
        td:first-child {
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            max-width: 120px; /* Adjust as needed */
        }

        /* MODAL STYLING */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 15px;
            width: 80%;
            max-width: 320px; /* Reduced size */
            border-radius: 8px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Full-Screen Modal for Small Screens */
        @media (max-width: 480px) {
            .modal-content {
                width: 95%;
                max-width: none;
            }
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .modal input, .modal button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .modal input {
            background: #f9f9f9;
        }

        .modal button {
            background: #007bff;
            color: white;
            cursor: pointer;
            font-weight: bold;
            border: none;
            transition: 0.3s;
        }

        .modal button:hover {
            background: #0056b3;
        }

        .modal .cancel-btn {
            background: red;
        }

        .modal .cancel-btn:hover {
            background: darkred;
        }

        /* Close modal when clicking outside */
        .modal-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .error-msg {
            color: red;
            font-size: 14px;
            display: block;
            margin-top: 5px;
        }

        .readonly-field {
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .modal-field {
            margin-bottom: 10px;
            text-align: left;
        }


        .modal-field label {
            display: block;
            font-weight: bold;
            font-size: 14px; /* Smaller label size */
            margin-bottom: 3px;
        }


        .modal-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&display=swap');

        .dashboard-header {
            text-align: center;
            margin: 60px auto 40px;
            font-family: 'Inter', sans-serif;
            color: #1f1f1f;
        }

        .dashboard-header .title {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 0.3px;
            margin-bottom: 6px;
        }

        .dashboard-header .subtitle {
            font-size: 17px;
            font-weight: 300;
            color: #555;
        }

        /* Back Button Styling */
        .back-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
        }

        .back-button i {
            margin-right: 8px; /* Space between icon and text */
            font-size: 18px;
        }

        .back-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px); /* Slight lift effect */
        }

        .back-button:active {
            background-color: #004085; /* Darker shade when clicked */
            transform: translateY(0); /* Reset position on click */
        }

    </style>
</head>
<body>

<!--<div class="header">-->
<!---->
<!--    <a class="nav-link" href="#" id="logout-link">-->
<!--        <button type="button" class="btn btn-primary">Logout</button>-->
<!--    </a>-->
<!--</div>-->

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

<div class="container">
    <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">
        <i class="fas fa-arrow-left"></i> Back
    </button>
</div>


<div class="dashboard-header">
    <div class="title">Candidate Attendance</div>
    <div class="subtitle"><i>Mark online Sathvartha attendance</i></div>
</div>
<form method="GET" action="/searchAttendancePage">
    <input type="text" name="search" placeholder="Search by name or mobile" value="<?= $_GET['search'] ?? '' ?>">
    <button type="submit">Search</button>
</form>

<div class="table-container">
    <table>
        <thead>
        <tr>
            <th>Mobile</th>
            <th>Record Date</th>
            <th>Participant Name</th>
            <th>Country</th>
            <th>Language</th>
            <th>Evangelist</th>
            <th>Source</th>
            <th>Allotted Days</th>
            <th>Media Type</th>
            <th>Active Status</th>
            <th>WhatsApp Group</th>
            <th>Action</th>
            <th>Location</th>
            <th>Attendance Date</th>
            <th>Feedback</th>
            <th>Evangelist Email</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($data)) {
            foreach ($data as $candidate) {
                echo "<tr>
                <td>{$candidate['mobile']}</td>
                <td>{$candidate['recordDate']}</td>
                <td>{$candidate['participantName']}</td>
                <td>{$candidate['country']}</td>
                <td>{$candidate['language']}</td>
                <td>{$candidate['evangelist']}</td>
                <td>{$candidate['source']}</td>
                <td>{$candidate['allotedDays']}</td>
                <td>{$candidate['mediaType']}</td>
                <td>{$candidate['activeStatus']}</td>
                <td>{$candidate['wgroup']}</td>";
                if (empty($candidate['attendedDate'])) {
                    echo "<td>
                <button class='btn-mark' onclick='markAttendance(
                    \"{$candidate['userid']}\",
                    \"{$candidate['mobile']}\",
                    \"{$candidate['participantName']}\",
                    \"{$candidate['evangelist']}\"
                )'>Mark</button>
            </td>";
                } else {
                    echo "<td></td>";
                }
                echo "<td>{$candidate['location']}</td>
                      <td>{$candidate['attendedDate']}</td>
                      <td>{$candidate['feedback']}</td>
                      <td>{$candidate['userid']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='15' style='text-align:center;'>No data available</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<div style="text-align: center; margin-top: 20px;">
    <?php
    $visiblePages = 5; // Show 5 pages at a time
    $startPage = max(1, $currentPage - floor($visiblePages / 2));
    $endPage = min($totalPages, $startPage + $visiblePages - 1);
    ?>

    <!-- First Page Button -->
    <?php if ($currentPage > 1): ?>
        <a href="?page=1" style="margin: 5px; padding: 8px 12px; text-decoration: none; background: #ddd; color: black; border-radius: 5px;">First</a>
    <?php endif; ?>

    <!-- Previous Button -->
    <?php if ($currentPage > 1): ?>
        <a href="?page=<?= $currentPage - 1 ?>" style="margin: 5px; padding: 8px 12px; text-decoration: none; background: #ddd; color: black; border-radius: 5px;">Prev</a>
    <?php endif; ?>

    <!-- Page Numbers -->
    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
        <a href="?page=<?= $i ?>"
           style="margin: 5px; padding: 8px 12px; text-decoration: none;
                   background: <?= ($i == $currentPage) ? '#007bff' : '#ddd' ?>;
                   color: <?= ($i == $currentPage) ? 'white' : 'black' ?>;
                   border-radius: 5px;">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <!-- Next Button -->
    <?php if ($currentPage < $totalPages): ?>
        <a href="?page=<?= $currentPage + 1 ?>" style="margin: 5px; padding: 8px 12px; text-decoration: none; background: #ddd; color: black; border-radius: 5px;">Next</a>
    <?php endif; ?>

    <!-- Last Page Button -->
    <?php if ($currentPage < $totalPages): ?>
        <a href="?page=<?= $totalPages ?>" style="margin: 5px; padding: 8px 12px; text-decoration: none; background: #ddd; color: black; border-radius: 5px;">Last</a>
    <?php endif; ?>
</div>

<!-- Modal Structure -->
<div id="attendanceModal" class="modal">
    <div class="modal-content">
        <div><i><strong>Mark Attendance</strong></i></div>
<!--        <input type="hidden" id="userId">-->

        <div class="modal-field">
            <label>Mobile:</label>
            <span id="mobile" ></span>
        </div>

        <div class="modal-field">
            <label>Participant Name:</label>
            <div id="participantName" ></div>
        </div>

        <div class="modal-field">
            <label>Evangelist:</label>
            <div id="evangelist" ></div>
        </div>

        <div class="modal-field">
            <label>Evangelist Email:</label>
            <div id="email" ></div>
        </div>

        <div class="modal-field">
            <label>Location:</label>
            <input type="text" id="location" placeholder="Enter location">
            <span id="locationError" class="error-msg"></span>
        </div>

        <div class="modal-field">
            <label>Attendance Date:</label>
            <input type="date" id="attendanceDate">
            <span id="attendanceDateError" class="error-msg"></span>
        </div>

        <div class="modal-field">
            <label>Feedback:</label>
            <input type="text" id="feedback" placeholder="Enter feedback">
            <span id="feedbackError" class="error-msg"></span>
        </div>

        <div class="modal-actions">
            <button onclick="saveAttendance()">Submit</button>
            <button class="cancel-btn" onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>

<div id="customConfirmModal" style="display:none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);">
    <div style="background: white; padding: 20px; max-width: 400px; margin: 100px auto; border-radius: 8px; box-shadow: 0 0 10px #000;">
        <h3 style="margin-top: 0;">Confirm Action</h3>
        <p>Are you sure you want to continue?</p>
        <div style="text-align: right;">
            <button id="cancelConfirmBtn" style="margin-right: 10px; padding: 6px 12px;">Cancel</button>
            <button id="okConfirmBtn" style="background-color: #28a745; color: white; padding: 6px 12px;">Yes, Confirm</button>
        </div>
    </div>
</div>





<script>

    // Set max date to yesterday
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("attendanceDate");
        const today = new Date();
        today.setDate(today.getDate() - 1); // Yesterday
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const maxDate = `${yyyy}-${mm}-${dd}`;
        dateInput.setAttribute("max", maxDate);
    });


    function markAttendance(userId, mobile, participantName, evangelist) {

        document.getElementById("email").textContent  = userId;
        document.getElementById("mobile").textContent  = mobile;
        document.getElementById("participantName").textContent  = participantName;
        document.getElementById("evangelist").textContent  = evangelist;
        document.getElementById("attendanceModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("attendanceModal").style.display = "none";
        document.getElementById("attendanceModal").style.display = "none";

        // Clear error messages
        document.getElementById("locationError").textContent = "";
        document.getElementById("attendanceDateError").textContent = "";
        document.getElementById("feedbackError").textContent = "";

        // Clear input fields
        document.getElementById("location").value = "";
        document.getElementById("attendanceDate").value = "";
        document.getElementById("feedback").value = "";
    }

    // Close Modal when Clicking Outside
    document.getElementById("attendanceModal").addEventListener("click", function(event) {
        if (event.target.classList.contains("modal")) {
            closeModal();
        }
    });

    function saveAttendance() {
        let location = document.getElementById("location").value.trim();
        let attendanceDate = document.getElementById("attendanceDate").value.trim();
        let feedback = document.getElementById("feedback").value.trim();

        let mobile = document.getElementById("mobile").textContent;
        let participantName = document.getElementById("participantName").textContent;
        let evangelist = document.getElementById("evangelist").textContent;
        let evangelistEmail = document.getElementById("email").textContent;
        let hasError = false;

        // Clear previous errors
        document.getElementById("locationError").textContent = "";
        document.getElementById("attendanceDateError").textContent = "";
        document.getElementById("feedbackError").textContent = "";

        let isValid = true;
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Normalize to midnight for accurate comparison


        if (location === "") {
            document.getElementById("locationError").textContent = "Location is required.";
            isValid = false;
        }

        if (attendanceDate === "") {
            document.getElementById("attendanceDateError").textContent = "Attendance Date is required.";
            isValid = false;
            hasError = true;
        }

        else {
            const enteredDate = new Date(attendanceDate);
            enteredDate.setHours(0, 0, 0, 0); // Normalize entered date too
            if (enteredDate >= today) {
                document.getElementById("attendanceDateError").textContent = "Date cannot be today or a future date.";
                isValid = false;
            }
        }

        if (feedback === "") {
            document.getElementById("feedbackError").textContent = "Feedback is required.";
            isValid = false;
        }

        if (!isValid) {
            return; // Stop form submission if any field is invalid
        }

        let formData = new FormData();
        formData.append("mobile", mobile);
        formData.append("participantName", participantName);
        formData.append("evangelist", evangelist);
        formData.append("evangelistEmail", evangelistEmail);


        formData.append("location", location);
        formData.append("attendanceDate", attendanceDate);
        formData.append("feedback", feedback);

        formData.append("isOnlineSathAttended", 1); // Assuming attendance means "Yes"


        // Show custom modal
        const modal = document.getElementById("customConfirmModal");
        modal.style.display = "block";

        document.getElementById("cancelConfirmBtn").onclick = () => {
            modal.style.display = "none";
        };



    //     // Disable the submit button to prevent multiple clicks
    //     let submitButton = document.querySelector(".modal-actions button");
    //     submitButton.disabled = true;
    //     submitButton.textContent = "Submitting...";
    //
    //     fetch("/saveAttendance", {
    //         method: "POST",
    //         body: formData
    //     })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.success) {
    //                 showSuccessMessage("Attendance marked successfully!");
    //                 setTimeout(() => {
    //                     window.location.href = window.location.href;
    //                 }, 2000);
    //
    //
    //             }else {
    //                 alert("Error: " + data.error);
    //             }
    //         })
    //         .catch(error => {
    //             alert("Request failed: " + error);
    //         }) .finally(() => {
    //         submitButton.disabled = false;
    //         submitButton.textContent = "Submit";
    //     });
    //
    //     closeModal();
    // }

        document.getElementById("okConfirmBtn").onclick = () => {
            modal.style.display = "none";

            let submitButton = document.querySelector(".modal-actions button");
            submitButton.disabled = true;
            submitButton.textContent = "Submitting...";

            fetch("/saveAttendance", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessMessage("Attendance marked successfully!");
                        setTimeout(() => {
                            window.location.href = window.location.href;
                        }, 2000);
                    } else {
                        alert("Error: " + data.error);
                    }
                })
                .catch(error => {
                    alert("Request failed: " + error);
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.textContent = "Submit";
                    closeModal(); // if applicable
                });
        };
    }

    // Function to show a temporary success message
    function showSuccessMessage(message) {
        let successDiv = document.createElement("div");
        successDiv.textContent = message;
        successDiv.style.position = "fixed";
        successDiv.style.top = "20px";
        successDiv.style.left = "50%";
        successDiv.style.transform = "translateX(-50%)";
        successDiv.style.background = "#28a745";
        successDiv.style.color = "white";
        successDiv.style.padding = "10px 20px";
        successDiv.style.borderRadius = "5px";
        successDiv.style.boxShadow = "0px 4px 6px rgba(0,0,0,0.1)";
        successDiv.style.zIndex = "1000";
        document.body.appendChild(successDiv);

        setTimeout(() => {
            successDiv.remove();
        }, 2000);
    }


</script>

</body>
</html>
