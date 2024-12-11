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

