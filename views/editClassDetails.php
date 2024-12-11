<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class Details</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
            height: 100%;
            background-color: #f4f4f5;
            font-family: Arial, sans-serif;
            color: #000;
        }
        body {
            padding: 20px;
        }
        form {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        input[readonly] {
            background-color: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
        }
        .toggle-container {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }
        .toggle-button {
            flex: 1;
            padding: 10px;
            margin: 0 5px;
            text-align: center;
            background-color: #ddd;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s, color 0.3s;
            border: none;
            color: #000;
        }
        .toggle-button.active {
            background-color: #007BFF;
            color: white;
        }
        .toggle-radio {
            display: none;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .back-arrow {
            display: flex;
            align-items: center;
            color: #007BFF;
            font-size: 24px;
            text-decoration: none;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .back-arrow svg {
            width: 24px;
            height: 24px;
            margin-right: 8px;
            fill: currentColor;
        }

    </style>
</head>
<body>

<div class="container">
<div class="button-container">
    <a href="#"  class="back-arrow" id="backArrow" onclick="goBack()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M15 18l-6-6 6-6" stroke-width="3" stroke="currentColor" fill="none"/>
        </svg>
        Back
    </a>
</div>

<a href="#" id="logout-link">
    <button style="position: absolute; top: 20px; right: 20px;">Logout</button>
</a>

<?php
// Simulate autopopulation with query parameters or backend data
$participant = htmlspecialchars($_GET['participant'] ?? 'John Doe');
$recordDate = htmlspecialchars($_GET['recordDate'] ?? '2024-10-28');
$evangelist = htmlspecialchars($_GET['evangelist'] ?? 'Evangelist Name');
$language = htmlspecialchars($_GET['language'] ?? 'English');
$classFrom = htmlspecialchars($_GET['classFrom'] ?? '');
$status = htmlspecialchars($_GET['status'] ?? 'Ongoing');
$username = htmlspecialchars($_GET['username'] ?? '');
$password = htmlspecialchars($_GET['password'] ?? '');
$mediaType = htmlspecialchars($_GET['mediaType'] ?? 'Web Video');
$remark = htmlspecialchars($_GET['remark'] ?? '');
$mobile = htmlspecialchars($_GET['mobile'] ?? '');
?>

<form action="/saveClassDetails" method="POST">
    <label>Participant Name:</label>
    <input type="text" name="participant" value="<?= $participant; ?>" readonly>

    <label>Record Date:</label>
    <input type="text" name="recordDate" value="<?= $recordDate; ?>" readonly>

    <label>Evangelist:</label>
    <input type="text" name="evangelist" value="<?= $evangelist; ?>" readonly>

    <label>Language:</label>
    <input type="text" name="language" value="<?= $language; ?>" readonly>

    <label>Class No:</label>
    <input type="text" name="classFrom" value="<?= $classFrom; ?>" readonly>

    <label>Status:</label>
    <div class="toggle-container">
        <label class="toggle-button <?= $status === 'Ongoing' ? 'active' : ''; ?>" for="ongoing">
            Ongoing
        </label>
        <input type="radio" id="ongoing" name="status" value="Ongoing"
               class="toggle-radio" <?= $status === 'Ongoing' ? 'checked' : ''; ?>>

        <label class="toggle-button <?= $status === 'Repeating' ? 'active' : ''; ?>" for="repeating">
            Repeating
        </label>
        <input type="radio" id="repeating" name="status" value="Repeating"
               class="toggle-radio" <?= $status === 'Repeating' ? 'checked' : ''; ?>>
    </div>

    <label>Media Type:</label>
    <select name="mediaType" required>
        <option value="Web Video" <?= $mediaType === 'Web Video' ? 'selected' : ''; ?>>Web Video</option>
        <option value="Web Audio" <?= $mediaType === 'Web Audio' ? 'selected' : ''; ?>>Web Audio</option>
    </select>

    <label>Remark:</label>
    <textarea name="remark" required><?= $remark; ?></textarea>

    <label>Mobile:</label>
    <input type="text" name="mobile" value="<?= $mobile; ?>" readonly>

    <div class="button-group">
        <button type="submit">Save Changes</button>
        <button type="button" onclick="goBack()">Back</button>
    </div>
</form>

<script>
    function goBack() {
        window.history.back();
    }

    const toggleButtons = document.querySelectorAll('.toggle-button');
    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            toggleButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            document.getElementById(button.getAttribute('for')).checked = true;
        });
    });
</script>

</body>
</html>
