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

        <div class="form-group">
            <label for="uploadPhoto">Upload Photo</label>
            <input type="file" id="uploadPhoto" name="uploadPhoto" accept="image/*" required>
            <p class="note">Note: Image size should not exceed 1MB.</p>
            <div class="error-message" id="uploadPhotoError">Please upload a valid image file.</div>

            <!-- Image preview -->
            <img id="photoPreview" src="" alt="Photo Preview">
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
                <option value="Management">Management</option>
                <option value="Evangelist">Evangelist</option>
                <option value="Evng Coordinator">Evng Coordinator</option>
            </select>
            <div class="error-message" id="designationError">Please select a designation.</div>
        </div>
        <input type="hidden" name="updatedBy" value="<?= Application::$app->session->get('loginForm')->username; ?>">
        <input type="hidden" name="index" value="<?php echo htmlspecialchars($data['index'] ?? ''); ?>">

        <div class="button-group">
            <button type="submit" class="update-button">Register</button>
            <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">Back</button>








        </div>
    </form>
</div>

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
        const uploadPhoto = document.getElementById('uploadPhoto');
        const photoSize = uploadPhoto.files[0] ? uploadPhoto.files[0].size : 0;
        if (photoSize === 0) {
            showError('uploadPhotoError', 'Please upload a valid image file.');
            uploadPhoto.classList.add('input-error');
            isValid = false;
        } else if (photoSize > 1048576) { // 1MB
            showError('uploadPhotoError', 'The photo file size must be under 1MB.');
            uploadPhoto.classList.add('input-error');
            isValid = false;
        } else {
            uploadPhoto.classList.add('input-valid');
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
