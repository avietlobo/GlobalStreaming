<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"], input[type="password"], input[type="number"] {
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
            font-size: 16px;
        }
        .center-align {
            text-align: center; /* Center-align the content within this element */
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .icon {
            margin-right: 10px;
            color: #888;
        }
    </style>
</head>
<body>
<?php
/** @var $model \app\models\RegisterModel */
?>
<div class="login-container">
    <h2><i class="fas fa-sign-in-alt icon"></i>Sign In</h2>
    <?php $form = \app\core\form\Form::begin('',"post")  ?>
    <?php echo $form->field($model,'username')  ?>
    <?php echo $form->field($model,'password')->passwordField()  ?>
    <!--<button type="submit" class= "btn btn-primary">Submit</button>-->
    <input type="submit" value="Login">

    </form>
</div>
</body>
</html>
