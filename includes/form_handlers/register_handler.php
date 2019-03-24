<?php
//DECLARING VAR TO PREVENT ERR
$fname = "";
$lname = "";
$email = "";
$email2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = [];

if (isset($_POST['register_button'])) {
//Registration form values

//First Name
$fname = strip_tags($_POST['reg_fname']); //Remove html tags
$fname = str_replace(' ', '', $fname); //Remove spaces
$fname = ucfirst(strtolower($fname)); //Uppercase first letter
$_SESSION['reg_fname'] = $fname; //Stores first name into session variable

//Last Name
$lname = strip_tags($_POST['reg_lname']); //Remove html tags
$lname = str_replace(' ', '', $lname); //Remove spaces
$lname = ucfirst(strtolower($lname)); //Uppercase first letter
$_SESSION['reg_lname'] = $lname; //Stores last name into session variable

//Email
$email = strip_tags($_POST['reg_email']); //Remove html tags
$email = str_replace(' ', '', $email); //Remove spaces
$email = strtolower($email); //Lowercase
$_SESSION['reg_email'] = $email; //Stores email in session variable

//Email 2
$email2 = strip_tags($_POST['reg_email2']); //Remove html tags
$email2 = str_replace(' ','',$email2); //Remove spaces
$email2 = strtolower($email2); //Lowercase
$_SESSION['reg_email2'] = $email2; //Stores email in session variable

//password
$password = strip_tags($_POST['reg_password']); //Remove html tags
//password2
$password2 = strip_tags($_POST['reg_password2']); //Remove html tags

//date
$date = date('Y-m-d');




//Check email submitted
if ($email == $email2){
//Check if email is in valid format
if (filter_var($email, FILTER_VALIDATE_EMAIL)){
$email = filter_var($email, FILTER_VALIDATE_EMAIL);

//Check if email already exists
$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

//Count number of rows returned
$num_rows = mysqli_num_rows($e_check);
if ($num_rows != null) {
array_push($error_array, "This email is already in use!<br>");
}

}
else{
array_push($error_array, "Email is not in the correct format.<br>");
}
}
else{
array_push($error_array, "Emails don't match<br>");
}

if (strlen($fname) < 2 || strlen($fname) > 25){
array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
}
if (strlen($lname) < 2 || strlen($lname) > 25){
array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
}
//Check Password
if ($password != $password2){
array_push($error_array, "Passwords don't match yo!<br>");
}
if (!ctype_alnum($password)){
array_push($error_array, "Your password can only contain english characters or numbers<br>");
}
if (strlen($password) > 30 || strlen($password ) < 8){
array_push($error_array, "Your password must be between 8 and 30 characters!<br>");
}

if (empty($error_array)) {
$password = md5($password); //Encrypt Password before sending to db

//Generate username by concatenating first and last name
$username = strtolower($fname . "_" . $lname);
$check_username_query = mysqli_query($con, "SELECT username FROM users where username='$username'");

$i = 0;
//if username exists add number to username
while(mysqli_num_rows($check_username_query) != 0) {
$i++; //Add 1 to i
$username = $username . "_" . $i;
$check_username_query = mysqli_query($con, "SELECT username FROM users where username='$username'");

}

$avatarDir = "assets/images/profile_pics/default";
$fileCount = 0;
$files = glob($avatarDir . "*");
if ($files){
$fileCount = count($files);
}
$randomAvatar = mt_rand(0, $fileCount + 1);
$profile_pic = "assets/images/profile_pics/default/$randomAvatar.png";




if(!$query = mysqli_query($con, "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',' )")){
echo mysqli_error($con);
}else {

array_push($error_array, "<span style='color: red;'><br>You're all set! Goahead and login!</span><br>");

//Clear session variables
$_SESSION['reg_fname'] = "";
$_SESSION['reg_lname'] = "";
$_SESSION['reg_email'] = "";
$_SESSION['reg_email2'] = "";
$_SESSION['reg_password'] = "";

}
}
}

?>