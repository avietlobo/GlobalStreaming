<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Member Registration Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }



        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
            text-align: center;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #444;
            font-weight: 500;
        }

        /* Style for the red asterisk */
        label::after {
            content: "*";
            color: red;
            margin-left: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            background-color: #fff;
            transition: border-color 0.3s, box-shadow 0.3s;
            margin-top: 5px;
        }

        input[readonly] {
            background-color: #f1f1f1;
            cursor: not-allowed;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .button-group button {
            flex: 1;
            margin: 0 10px;
        }

        .header {
            display: flex;
            justify-content: flex-end;
            padding: 15px;
            background-color: #f1f1f1;
        }

        #logout-link button {
            margin-left: auto;
            background-color: #007bff; /* Match the back button color */
            color: #fff;
            border: none;
            border-radius: 3px;  /* Match the border radius of the back button */
            cursor: pointer;
            padding: 6px 12px;  /* Match the padding of the back button */
            font-size: 13px;  /* Match the font size of the back button */
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Match box shadow of the back button */
        }

        #logout-link button:hover {
            background-color: #0056b3; /* Darker shade on hover, similar to the back button */
        }

        .note {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
        }

        /* Error Message Styling */
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            position: absolute;
            top: 100%;
            left: 0;
            margin-top: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
            padding-left: 22px;
            display: flex;
            align-items: center;
        }

        .error-message::before {
            content: "❌";
            margin-right: 8px;
            font-size: 18px;
        }

        .input-error {
            border-color: #e74c3c;
            box-shadow: 0 0 5px rgba(231, 76, 60, 0.3);
        }

        .input-valid {
            border-color: #2ecc71;
            box-shadow: 0 0 5px rgba(46, 204, 113, 0.3);
        }

        /* Success Message (For future improvements) */
        .input-valid + .error-message {
            color: #2ecc71;
            opacity: 0;
        }

        /* Show the error messages */
        .input-error + .error-message {
            opacity: 1;
        }

        /* Image preview styling */
        #photoPreview {
            margin-top: 20px;
            max-width: 200px;
            max-height: 200px;
            display: none; /* Hide the preview initially */
        }

        .back-button1 {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;  /* Smaller padding */
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;  /* Smaller border radius */
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;  /* Smaller font size */
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
        }

        .header {
            display: flex;
            justify-content: flex-end;
            padding: 10px 20px;
            background-color: #ffffff; /* Ensure it matches body background */
            box-shadow: none; /* Remove any shadow that might create lines */
        }

        .success-alert {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            border-radius: 5px;
            text-align: center;
        }

        .error-message.show {
            opacity: 1;
        }
    </style>
</head>
<body>

<div class="header">
    <a class="nav-link" href="#" id="logout-link">
        <button type="button" class="btn btn-primary">Logout</button>
    </a>
</div>
<button type="button" class="back-button1" onclick="window.location.href='/evngDashboard1'">
    <i class="fas fa-arrow-left"></i> Back
</button>

<div class="container">

    <h1>Global Member Registration Form</h1>
    <p class="note">This form is used by New Evangelists/Support Team Members to Join Global Evangelisation Group</p>

    <?php if (isset($_SESSION['successMessage'])) : ?>
        <div class="success-alert">
            <p style="color: green; font-size: 16px; text-align: center; font-weight: 500;">
                <?= htmlspecialchars($_SESSION['successMessage']); ?>
            </p>
        </div>
        <?php unset($_SESSION['successMessage']); // Remove the message after it's displayed ?>
    <?php endif; ?>

    <!-- Display Success Message -->
    <?php if (!empty($successMessage)) : ?>
        <div class="success-alert">
            <p style="color: green; font-size: 16px; text-align: center; font-weight: 500;">
                <?= htmlspecialchars("Registration successful! Lets wait for approval."); ?>
            </p>
        </div>
    <?php endif; ?>

    <!-- Display error message if exists -->
    <?php use app\core\Application;

    if (!empty($errorMessage)) : ?>
        <div class="error-alert">
            <p style="color: red;"><?= htmlspecialchars($errorMessage); ?></p>
        </div>
    <?php endif; ?>


    <?php if (!empty($errorMessage2)) : ?>
        <div class="error-alert">
            <p style="color: red;"><?= htmlspecialchars($errorMessage2); ?></p>
        </div>
    <?php endif; ?>

    <form id="registrationForm" action="/submitRegistration" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

        <div class="form-group">
            <label for="memberID">Zion ID</label>
            <input type="text" id="memberID" name="memberID" required>
            <div class="error-message" id="memberIDError">Zion ID is a required field.</div>
        </div>

        <div class="form-group">
            <label for="memberName">Member Name</label>
            <input type="text" id="memberName" name="memberName" required>
            <div class="error-message" id="memberNameError">Please provide your full name.</div>
        </div>

        <div class="form-group">
            <label for="memberContact">Member Contact</label>
            <input type="text" id="memberContact" name="memberContact" required>
            <div class="error-message" id="memberContactError">A valid contact number is required.</div>
        </div>

        <!-- Upload Photo Section -->
        <div class="form-group">
            <label for="uploadPhoto">Upload Photo</label>
            <input type="file" id="uploadPhoto" name="uploadPhoto" accept="image/*"> <!-- REMOVED required -->
            <p class="note">Note: Image size should not exceed 1MB.</p>
            <div class="error-message <?= !empty($photoErrorMessage) ? 'show' : '' ?>">
                <?= !empty($photoErrorMessage) ? htmlspecialchars($photoErrorMessage) : 'Please upload or capture a photo.' ?>
            </div>
            <!-- Image preview -->
            <img id="photoPreview" src="" alt="Photo Preview">

            <!-- Hidden input to store base64 captured image -->
            <input type="hidden" name="capturedPhoto" id="capturedPhoto">

            <!-- Camera capture button -->
            <div style="margin-top: 10px;">
                <button type="button" onclick="startCamera()" style="background: none; border: none; cursor: pointer;">
                    <i class="fas fa-camera" style="font-size: 22px; color: #007bff;"></i> Capture Photo
                </button>
            </div>

            <!-- Camera modal and canvas (you can customize this) -->
            <div id="cameraModal" style="display:none;">
                <video id="video" autoplay style="width:100%; max-height: 250px;"></video><br>
                <button type="button" onclick="capturePhoto()">Take Photo</button>
                <button type="button" onclick="closeCamera()">Close</button>
            </div>
        </div>

        <div class="form-group">
            <label for="fellowship">Fellowship</label>
            <input type="text" id="fellowship" name="fellowship" placeholder="Enter Fellowship" required>
            <div class="error-message" id="fellowshipError">Fellowship information is required.</div>
        </div>

        <div class="form-group">
            <label for="memberEmail">Member Email ID</label>
            <input type="email" id="memberEmail" name="memberEmail" required>
            <div class="error-message" id="memberEmailError">Please enter a valid email address.</div>
        </div>

        <!-- New Designation dropdown -->
        <div class="form-group">
            <label for="designation">Designation</label>
            <select id="designation" name="designation" required>
                <option value="">Select Designation</option>
                <option value="Caretaker">Caretaker</option>
                <option value="Management">Management</option>
                <option value="Evangelist">Evangelist</option>
                <option value="Evng Coordinator">Evng Coordinator</option>
                <option value="Event Leader">Event Leader</option>
            </select>
            <div class="error-message" id="designationError">Please select a designation.</div>
        </div>
        <input type="hidden" name="updatedBy" value="<?= Application::$app->session->get('loginForm')->username; ?>">
        <input type="hidden" name="index" value="<?php echo htmlspecialchars($data['index'] ?? ''); ?>">

        <div class="form-group">
            <label for="workGroup">Work Group</label>
            <select id="workGroup" name="workGroup" required>
                <option value="">Select Work Group</option>
                <option value="Global TC Base-English">Global TC Base-English</option>
                <option value="Global SM-Malayalam">Global SM-Malayalam</option>
                <option value="GTC-Muvattupuzha">GTC-Muvattupuzha</option>
                <option value="GTC-Kalpetta">GTC-Kalpetta</option>
                <option value="Global SM-Hindi">Global SM-Hindi</option>
                <option value="GTC-Perambra">GTC-Perambra</option>
                <option value="GTC-Punnapra">GTC-Punnapra</option>
                <option value="Global TC Goa-Cntrl Zone">Global TC Goa-Cntrl Zone</option>
                <option value="GTC-Jordan">GTC-Jordan</option>
                <option value="GTC-Neriamangalam">GTC-Neriamangalam</option>
                <option value="GTC-Thevara">GTC-Thevara</option>
                <option value="GTC-Chempanthotty">GTC-Chempanthotty</option>
                <option value="GTC-Pazhayannur">GTC-Pazhayannur</option>
                <option value="GTC-Kannur">GTC-Kannur</option>
                <option value="GTC-Galilee">GTC-Galilee</option>
                <option value="Global TC Base-Konkani">Global TC Base-Konkani</option>
                <option value="Global TC-NZealand">Global TC-NZealand</option>
                <option value="Global SM-Italy">Global SM-Italy</option>
                <option value="GTC-Irinjalakuda">GTC-Irinjalakuda</option>
                <option value="Global TC Base-Malayalam">Global TC Base-Malayalam</option>
                <option value="Global SM-English">Global SM-English</option>
                <option value="Global SM-Spanish">Global SM-Spanish</option>
                <option value="GTC-Alakode">GTC-Alakode</option>
                <option value="GTC-Fort Kochi">GTC-Fort Kochi</option>
                <option value="GTC-Pathanapuram">GTC-Pathanapuram</option>
                <option value="GTC-Malayattor">GTC-Malayattor</option>
                <option value="GTC-Karunagapally">GTC-Karunagapally</option>
                <option value="GTC-Koratty">GTC-Koratty</option>
                <option value="Global TC Goa-West T1">Global TC Goa-West T1</option>
                <option value="Global TC Goa-West T2">Global TC Goa-West T2</option>
                <option value="Global SM-Portuguese">Global SM-Portuguese</option>
                <option value="Global TC Mumbai-Central">Global TC Mumbai-Central</option>
                <option value="GTC-Paravoor">GTC-Paravoor</option>
                <option value="GTC-Zoar">GTC-Zoar</option>
                <option value="GTC-Mananthavady">GTC-Mananthavady</option>
                <option value="GTC-Changanassery">GTC-Changanassery</option>
                <option value="Global TC Mumbai-Western">Global TC Mumbai-Western</option>
                <option value="GTC-Kunnamkalam">GTC-Kunnamkalam</option>
                <option value="Zion Global Management">Zion Global Management</option>
                <option value="GTC-Kovalam">GTC-Kovalam</option>
                <option value="GTC-Ernakulam">GTC-Ernakulam</option>
                <option value="GTC-Thiruvambady">GTC-Thiruvambady</option>
                <option value="GTC-Manjummel">GTC-Manjummel</option>
                <option value="GTC-Kozhinjampara">GTC-Kozhinjampara</option>
                <option value="ME-Sathvartha Streaming">ME-Sathvartha Streaming</option>
                <option value="GTC-Gethsamene">GTC-Gethsamene</option>
                <option value="GTC-Mannuthi">GTC-Mannuthi</option>
                <option value="GTC-Kelakam">GTC-Kelakam</option>
                <option value="GTC-Kakkayam">GTC-Kakkayam</option>
                <option value="GTC-Neyyattinkara">GTC-Neyyattinkara</option>
                <option value="GTC-Potta">GTC-Potta</option>
                <option value="GTC-Ezhupunna">GTC-Ezhupunna</option>
                <option value="GTC-Eden">GTC-Eden</option>
                <option value="Global SM-Tagalog">Global SM-Tagalog</option>
                <option value="Global TC-HMRGG">Global TC-HMRGG</option>
                <option value="Global TC-Bangalore">Global TC-Bangalore</option>
                <option value="Global SM-Arabic">Global SM-Arabic</option>
                <option value="Global SM-French">Global SM-French</option>
                <option value="GTC-Chennai">GTC-Chennai</option>
                <option value="GTC-Aluva">GTC-Aluva</option>
                <option value="GTC-Iritty">GTC-Iritty</option>
                <option value="Global TC-Mangalore">Global TC-Mangalore</option>
                <option value="Global TC Base-Tamil">Global TC Base-Tamil</option>
                <option value="GTC-Rajakumari">GTC-Rajakumari</option>
                <option value="GTC-Arthungal">GTC-Arthungal</option>
                <option value="GTC Goa Global Mission">GTC Goa Global Mission</option>
                <option value="UK-Sathvartha Streaming">UK-Sathvartha Streaming</option>
            </select>
            <div class="error-message" id="workGroupError">Please select a work group.</div>
        </div>

        <div class="button-group">
            <button type="submit" class="update-button">Register</button>
            <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">Back</button>








        </div>
    </form>
</div>

<script>
    let videoStream;

    function startCamera() {
        document.getElementById("cameraModal").style.display = "block";
        const video = document.getElementById("video");

        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                videoStream = stream;
                video.srcObject = stream;
            })
            .catch((err) => {
                alert("Unable to access camera: " + err.message);
            });
    }

    function closeCamera() {
        document.getElementById("cameraModal").style.display = "none";
        if (videoStream) {
            videoStream.getTracks().forEach(track => track.stop());
        }
    }

    function capturePhoto() {
        const video = document.getElementById("video");
        const canvas = document.createElement("canvas");
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const context = canvas.getContext("2d");
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const dataUrl = canvas.toDataURL("image/jpeg");

        document.getElementById("photoPreview").src = dataUrl;
        document.getElementById("photoPreview").style.display = "block";
        document.getElementById("capturedPhoto").value = dataUrl;

        closeCamera();
    }</script>

<script>
    function validateForm() {
        let isValid = true;

        // Clear all error messages and reset styles
        clearErrors();

        // Validate Zion ID
        const memberID = document.getElementById('memberID');
        if (!memberID.value.trim()) {
            showError('memberIDError', 'Zion ID is a required field.');
            memberID.classList.add('input-error');
            isValid = false;
        } else {
            memberID.classList.add('input-valid');
        }

        // Validate Member Name
        const memberName = document.getElementById('memberName');
        if (!memberName.value.trim()) {
            showError('memberNameError', 'Please provide your full name.');
            memberName.classList.add('input-error');
            isValid = false;
        } else {
            memberName.classList.add('input-valid');
        }

        // Validate Contact
        const memberContact = document.getElementById('memberContact');
        if (!memberContact.value.trim()) {
            showError('memberContactError', 'A valid contact number is required.');
            memberContact.classList.add('input-error');
            isValid = false;
        } else {
            memberContact.classList.add('input-valid');
        }

        // Validate Upload Photo
        const fileInput = document.getElementById("uploadPhoto");
        const capturedPhoto = document.getElementById("capturedPhoto").value;
        const uploadPhotoError = document.getElementById("uploadPhotoError");

        if (!fileInput.files.length && !capturedPhoto) {
            uploadPhotoError.style.display = "block";
            fileInput.classList.add("input-error");
            return false;
        } else {
            uploadPhotoError.style.display = "none";
            fileInput.classList.remove("input-error");
            return true;
        }
    }

        // Validate Fellowship
        const fellowship = document.getElementById('fellowship');
        if (!fellowship.value.trim()) {
            showError('fellowshipError', 'Fellowship information is required.');
            fellowship.classList.add('input-error');
            isValid = false;
        } else {
            fellowship.classList.add('input-valid');
        }

        // Validate Email
        const memberEmail = document.getElementById('memberEmail');
        const emailValue = memberEmail.value;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(emailValue)) {
            showError('memberEmailError', 'Please enter a valid email address.');
            memberEmail.classList.add('input-error');
            isValid = false;
        } else {
            memberEmail.classList.add('input-valid');
        }

        // Validate Designation
        const designation = document.getElementById('designation');
        if (designation.value === "") {
            showError('designationError', 'Please select a designation.');
            designation.classList.add('input-error');
            isValid = false;
        } else {
            designation.classList.add('input-valid');
        }

        return isValid;
    }

    function showError(fieldId, message) {
        const errorElement = document.getElementById(fieldId);
        errorElement.innerText = message;
    }

    function clearErrors() {
        const errorMessages = document.querySelectorAll('.error-message');
        const inputFields = document.querySelectorAll('input');

        errorMessages.forEach(error => error.innerText = '');
        errorMessages.forEach(error => error.style.opacity = 0); // Hide error messages immediately
        inputFields.forEach(input => {
            input.classList.remove('input-error', 'input-valid');
        });
    }

    // Show the uploaded photo as a preview
    const uploadPhotoInput = document.getElementById('uploadPhoto');
    const photoPreview = document.getElementById('photoPreview');

    uploadPhotoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Set the src of the image element to the uploaded photo's data URL
                photoPreview.src = e.target.result;
                photoPreview.style.display = 'block'; // Show the preview image
            };

            reader.readAsDataURL(file);
        } else {
            photoPreview.style.display = 'none'; // Hide the preview if no file is selected
        }
    });
</script>

</body>
</html>
