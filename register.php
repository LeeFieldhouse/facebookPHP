<?php
    require 'config.php';
    require 'includes/form_handlers/register_handler.php';
    require 'includes/form_handlers/login_handler.php';
    
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="register.php" method="post">
        
        <input type="email" placeholder="email" name="log_email" value="<?php if (isset($_SESSION['log_email'])){echo $_SESSION['log_email'];} ?>" required>
        <br>
        <input type="password" placeholder="password" name="log_password" required>
        <br>
        <input type="submit" name="log_button" value="Login">
    </form>
    <?php if (in_array("Email or password was incorrect<br>", $error_array)){echo ("Email or password was incorrect<br>");} ?>
    <br>
    <form action="register.php" method="POST">
        <?php if (in_array("Your first name must be between 2 and 25 characters<br>", $error_array) ){echo "Your first name must be between 2 and 25 characters<br>";} ?>
        <input type="text" name="reg_fname" placeholder="First Name" value="<?php if (isset($_SESSION['reg_fname'])) {
            echo $_SESSION['reg_fname'];
        }        ?>" required>
        <br>
        
        <?php if (in_array("Your last name must be between 2 and 25 characters<br>", $error_array) ){echo "Your last name must be between 2 and 25 characters<br>";}?>
        <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if (isset($_SESSION['reg_lname'])){
            echo $_SESSION['reg_lname'];
        } ?>" required>
        <br>
        
        <?php if (in_array("This email is already in use!<br>", $error_array) ){echo "This email is already in use!<br>";}
            else if (in_array("Email is not in the correct format.<br>", $error_array) ){echo "Email is not in the correct format.<br>";}
            else if (in_array("Emails don't match<br>", $error_array) ){echo "Emails don't match<br>";}          ?>
        <input type="email" name="reg_email" placeholder="email@address.com" value="<?php if (isset($_SESSION['reg_email'])){
            echo $_SESSION['reg_email'];
        } ?>" required>
        <br>
        
        <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php if (isset($_SESSION['reg_email2'])){
            echo $_SESSION['reg_email2'];
        } ?>" required>
        <br>
        
        <?php if (in_array("Your password must be between 8 and 30 characters!<br>", $error_array)){echo "Your password must be between 8 and 30 characters!<br>";}
            else if (in_array("Your password can only contain english characters or numbers<br>", $error_array)){echo "Your password can only contain english characters or numbers<br>";}
            else if (in_array("Passwords don't match yo!<br>", $error_array)){echo "Passwords don't match yo!<br>";} ?>
        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        
        <input type="submit" name="register_button" value="Submit">
        <?php if (in_array("<span style='color: red;'><br>You're all set! Goahead and login!</span><br>", $error_array)){echo "<span style='color: red;'><br>You're all set! Goahead and login!</span><br>";} ?>
    </form>
</body>
</html>