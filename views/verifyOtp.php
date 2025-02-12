<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
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

        h2 {
            margin-bottom: 1.5rem;
            color: #007bff;
            font-size: 1.8rem;
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

        input[type="number"] {
            padding: 0.9rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100%;
            max-width: 300px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="number"]:focus {
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
</head>
<body>
<div class="container">
    <h2>Verify OTP</h2>
    <form action="/verifyOtp" method="POST">
        <label for="otp">Enter OTP:</label>
        <input type="number" id="otp" name="otp" required placeholder="6-digit OTP">
        <button type="submit" class="primary">Verify</button>
        <!-- Optional error message display -->
        <?php use app\core\Application;

        if (isset($errorMessage) && !empty($errorMessage)) : ?>
            <p style="color: red; font-size: 0.9rem; margin-top: 1rem;">
                <?= htmlspecialchars($errorMessage) ?>
            </p>
        <?php endif; ?>
        <!-- Hidden form for resending OTP -->

    </form>
    <!-- Form for resending OTP -->
    <form id="resend-otp-form" action="/sendOtp" method="POST" style="display: none;">
        <!-- Add this input field for email -->


        <input type="hidden" id="resend-email" name="email" value="<?= htmlspecialchars($regEmail) ?>"> <!-- Replace with user’s email dynamically if possible -->
    </form>


    <!-- Resend OTP link -->
    <p style="font-size: 0.9rem; margin-top: 1rem;">
        Didn't receive OTP?
        <a href="#" id="resend-link" style="color: #007bff; text-decoration: underline; cursor: pointer;" onclick="submitResendOtpForm()">Click here to resend</a>
    </p>
    <p id="resend-message" style="color: green; font-size: 0.9rem; margin-top: 1rem; display: none;">A new OTP has been sent to your email.</p>

    <script>
        function submitResendOtpForm() {
            // You can add custom validation here if needed
            document.getElementById('resend-otp-form').submit();
            document.getElementById('resend-message').style.display = 'block'; // Show a success message after submission
        }
    </script>

</div>
</body>
</html>
