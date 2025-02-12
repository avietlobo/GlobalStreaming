<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        /* Global Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            background-color: #f8f8f8;
            color: #333;
            margin: 0;
        }

        /* Container Styling */
        .container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid #e0e0e0; /* Add a subtle border */
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h3 {
            margin-bottom: 1.5rem;
            color: #007bff;
            font-size: 24px;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center all form elements */
            gap: 1.5rem;
        }

        label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #555;
            text-align: center;
        }

        input[type="email"] {
            padding: 0.9rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100%;
            max-width: 300px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="email"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        /* Button Styling */
        .primary {
            padding: 0.9rem;
            font-size: 1rem;
            font-weight: 600;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            max-width: 300px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .primary:hover {
            background-color: #0056b3;
        }

        .primary:focus {
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        .primary:active {
            transform: scale(0.98);
        }

        /* Media Queries */
        @media (max-width: 480px) {
            .container {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
    <script>
        function validateEmail(event) {
            const emailInput = document.getElementById('email');
            const email = emailInput.value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                event.preventDefault();
                alert('Please enter a valid email address.');
                emailInput.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container">
    <h3>Reset Your Password</h3>
    <form action="/sendOtp" method="POST" onsubmit="return validateEmail(event)">
        <label for="email">Enter your registered email ID:</label>
        <input type="email" id="email" name="email" required placeholder="Email address">
        <button type="submit" class="primary">Send OTP</button>
        <!-- Display error message if it exists -->
        <?php if (isset($errorMessage) && !empty($errorMessage)) : ?>
            <p style="color: red; font-size: 0.9rem; margin-top: 1rem;">
                <?= htmlspecialchars($errorMessage) ?>
            </p>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
