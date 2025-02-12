<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
        }

        input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .primary {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .primary:hover {
            background-color: #45a049;
        }

        .form-footer {
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .form-footer a {
            text-decoration: none;
            color: #4CAF50;
        }
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
            display: none;
        }

    </style>
</head>
<body>
<div class="container">
    <h2>Reset Your Password</h2>
    <form action="/resetPassword" method="POST">
<!--        <input type="hidden" name="email" value="--><?php //echo htmlspecialchars($_GET['email']); ?><!--">-->

        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit" class="primary">Set New Password</button>
    </form>
    <div class="form-footer">
        <p>Remembered your password? <a href="/login">Login here</a></p>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm_password");
        const errorMessage = document.createElement("p");

        errorMessage.classList.add("error-message");
        confirmPassword.insertAdjacentElement("afterend", errorMessage);

        function validatePasswords() {
            if (confirmPassword.value.trim() !== "" && password.value !== confirmPassword.value) {
                errorMessage.textContent = "Passwords do not match!";
                errorMessage.style.display = "block";
            } else {
                errorMessage.style.display = "none";
            }
        }

        password.addEventListener("input", validatePasswords);
        confirmPassword.addEventListener("input", validatePasswords);
    });
</script>

</body>

</html>
