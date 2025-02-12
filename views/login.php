<?php

use app\core\Application;
?>
<!doctype html>
<html lang="en">
<head>
    <title>Login 04</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    
        <style>
        .ftco-section {
            margin-top: -110px; /* Adjust this value as needed */
        }
    </style>
    
<style>
        .login-wrap {
            position: relative;
        }

        .logo-image {
            position: absolute;
           top: 10px; /* Add padding from the top */
            right: 10px; /* Add padding from the right */
            width: 80px; /* Adjust the width as needed */

        }

        .forgot-password-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .primary-link {
            text-decoration: none; /* Remove underline */
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 14px;
            display: inline-block; /* Make it behave like a button */
            cursor: pointer; /* Change cursor to pointer to indicate it's clickable */
            transition: background-color 0.3s ease, transform 0.2s ease;
            border: none; /* Remove default border for links */
        }

        .primary-link:hover {
            background-color: #45a049;
            transform: translateY(-1px);
        }

        .primary-link:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.6);
        }

        .primary-link1 {
            color: #007bff; /* Calming blue color */
            text-decoration: underline;
            font-size: 1rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .primary-link1:hover {
            text-decoration: none; /* Removes underline on hover for a cleaner effect */
            color: #0056b3; /* Slightly darker blue for hover effect */
        }

        .forgot-password-container1 {
            text-align: center; /* Centers the link */
            margin-top: 1rem; /* Adds spacing for better readability */
        }

        .primary-link2 {
            color: #007bff;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none; /* Start with no underline for a cleaner look */
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .primary-link2::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px; /* Positioned just below the text */
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #007bff, #0056b3);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .primary-link2:hover {
            color: #0056b3; /* Darker shade for hover effect */
        }

        .primary-link2:hover::after {
            opacity: 1;
            transform: scaleX(1.1); /* Slightly expands the underline */
        }

        .forgot-password-container2 {
            text-align: center;
            margin-top: 1.5rem;
        }


        /* Reset default anchor tag styles (if any) */
        a {
            text-decoration: none;
            outline: none;
        }
    </style>

<!--    --><?php
//    $imagePath = '../views/images/bg-1.jpg';
//
//    if (file_exists($imagePath)) {
//        echo "Image file exists!";
//
//
//    } else {
//        echo "Image file not found!";
//    }
//
//
//    ?>
<!--   <style>-->
<!---->
<!--       /* Style for the password container */-->
<!--       .form-group.mb-3 {-->
<!--           position: relative;-->
<!--       }-->
<!---->
<!--       /* Style for the eye icon */-->
<!--       .field-icon.toggle-password {-->
<!--           position: absolute;-->
<!--           top: 50%;-->
<!--           right: 10px;-->
<!--           transform: translateY(-50%);-->
<!--           cursor: pointer;-->
<!--           font-size: 18px;-->
<!--       }-->
<!---->
<!--       /* Hide the checkbox input */-->
<!--       .toggle-password {-->
<!--           display: none;-->
<!--       }-->
<!---->
<!---->
<!---->
<!---->
<!--   </style>-->



</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
<!--            <div class="col-md-6 text-center mb-5">-->
<!--                <h2 class="heading-section">Login</h2>-->
<!--            </div>-->
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img" style="background-image: url(images/bg-1.jpg);">
                    </div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                               <img src="images/logo.jpg" alt="Logo" class="logo-image" width="50">
                                <h3 class="mb-4">Sign In</h3>
                            </div>
                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end"></p>
                            </div>
                        </div>
                        <?php
                        /** @var $model \app\models\RegisterModel */
                        ?>

                        <?php $form = \app\core\form\Form::begin('',"post")  ?>
<!--                        <form action="#" class="signin-form">-->
                            <div class="form-group mb-3">

                                <?php echo $form->field($model,'username')  ?>
<!---->
<!--                                <label class="label" for="name">Username</label>-->
<!--                                <input type="text" class="form-control" placeholder="Username" required>-->
                            </div>
                            <div class="form-group mb-3">
                                <?php echo $form->field($model,'password')->passwordField()  ?>
<!--                                <input type="checkbox" id="toggle-password" class="toggle-password">-->
<!--                                <label for="toggle-password" class="field-icon toggle-password">-->
<!--                                    <i class="fa fa-fw fa-eye"></i>-->
<!--                                </label>-->
<!--                                <span toggle="#xx" class="fa fa-fw fa-eye field-icon toggle-password"></span>-->

                                <!--                                <label class="label" for="password">Password</label>-->
<!--                                <input type="password" class="form-control" placeholder="Password" required>-->
                            </div>

                        <input type="text" name="hidden_field" style="display: none;">
                            <div class="form-group">
                                <button type="submit" value="Login" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                            </div>
                        </form>
                        <?php if (Application::$app->session->get('UI') === 'evg'): ?>
                            <div class="forgot-password-container1">
                                <a href="/forgotPassword" class="primary-link1">
                                    Forgot password?
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>

