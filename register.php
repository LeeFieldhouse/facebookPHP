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
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/register_style.css">
</head>
<body>

  <div id="app" class="wrapper">
    <?php if (isset($_POST['register_button']) && !in_array("<span style='color: red;'><br>You're all set! Goahead and login!</span><br>", $error_array)) {
      echo '{{loginFalse()}}';
    }
    if (in_array("<span style='color: red;'><br>You're all set! Goahead and login!</span><br>", $error_array)) {
      echo '{{loginTrue()}}';
    } ?>


    <div class="row login_box ">

      <!-- Login form -->
      <div v-if="login">
        <form action="register.php" method="post">
          <div class="input-field col s12">
            <input type="email" placeholder="email" name="log_email" value="<?php if (isset($_SESSION['log_email'])){echo $_SESSION['log_email'];} ?>" required>
          </div>
          <div class="input-field col s12">
            <input type="password" placeholder="password" name="log_password" required>
          </div>
          <button class="btn " type="submit" name="log_button" value="Login">
            <i class="material-icons left">forward</i>
            <span class="">Login</span>
          </button>
          <?php if (in_array("<span style='color: red;'><br>You're all set! Goahead and login!</span><br>", $error_array)){echo "<span style='color: red;'><br>You're all set! Goahead and login!</span><br>";} ?>
            <br>
          <?php if (in_array("Email or password was incorrect<br>", $error_array)){echo ("<span style='color: red;'>Email or password was incorrect</span><br>");} ?>

          <br>
          <?php if(!in_array("<span style='color: red;'><br>You're all set! Goahead and login!</span><br>", $error_array)){
            echo '<a href="#" id="signup" class="signup" @click="loginFalse()">Need an account? Register here!</a>';
          } ?>

        </form>
      </div> <!-- End Login Form -->


      <!-- Register Form -->
      <div v-if="!login">
        <form action="register.php" method="POST">

          <!-- First Name -->
          <div class="input-field col s12 xl12">
            <input type="text" name="reg_fname" placeholder="First Name" value="<?php if (isset($_SESSION['reg_fname'])) {
              echo $_SESSION['reg_fname'];
            }        ?>" required>
            <span class="helper-text red-text left" data-error="wrong" data-success="right">
              <?php if (in_array("Your first name must be between 2 and 25 characters<br>", $error_array) ){echo "Your first name must be between 2 and 25 characters<br>";} ?>
            </span>
          </div>

          <!-- Last Name -->
          <div class="input-field col s12 xl12">
            <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if (isset($_SESSION['reg_lname'])){
              echo $_SESSION['reg_lname'];
            } ?>" required>
            <span class="helper-text red-text left" data-error="wrong" data-success="right">
<?php         if (in_array("Your last name must be between 2 and 25 characters<br>", $error_array) ){echo "Your last name must be between 2 and 25 characters<br>";}?>
            </span>
          </div>

          <!-- Email -->
          <div class="input-field col s12 xl12">
            <input type="email" name="reg_email" placeholder="email@address.com" value="<?php if (isset($_SESSION['reg_email'])){
              echo $_SESSION['reg_email'];
            } ?>" required>
            <span class="helper-text red-text left" data-error="wrong" data-success="right">
              <?php if (in_array("This email is already in use!<br>", $error_array) ){echo "This email is already in use!<br>";}
              else if (in_array("Email is not in the correct format.<br>", $error_array) ){echo "Email is not in the correct format.<br>";}
              else if (in_array("Emails don't match<br>", $error_array) ){echo "Emails don't match<br>";}          ?>
            </span>
          </div>

          <!-- Check Email -->
          <div class="input-field col s12 xl12">
            <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php if (isset($_SESSION['reg_email2'])){
              echo $_SESSION['reg_email2'];
            } ?>" required>
          </div>

          <!-- Password -->
          <div class="input-field col s12 xl12">
            <input type="password" name="reg_password" placeholder="Password" required>
            <span class="helper-text red-text left" data-error="wrong" data-success="right">  <?php if (in_array("Your password must be between 8 and 30 characters!<br>", $error_array)){echo "Your password must be between 8 and 30 characters!<br>";}
              else if (in_array("Your password can only contain english characters or numbers<br>", $error_array)){echo "Your password can only contain english characters or numbers<br>";}
              else if (in_array("Passwords don't match yo!<br>", $error_array)){echo "Passwords don't match yo!<br>";} ?></span>
          </div>

          <!-- Check Password -->
          <div class="input-field col s12 xl12">
            <input type="password" name="reg_password2" placeholder="Confirm Password" required>
          </div>

          <!-- Submit Button -->
          <button class="btn" type="submit" name="register_button" value="Register">
            <i class="material-icons left">forward</i>
            <span>Register</span>
          </button>

            <br>

            <?php if (!$error_array) {
              echo '<a href="#" id="signup" class="signup" @click.prevent="loginTrue">Already have an account? Sign in here!</a>';
            } ?>
          </form>


        </div> <!-- End Register Form -->
      </div> <!-- Row -->
    </div> <!-- App -->

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="assets/js/register.js" charset="utf-8"></script>

    <script>
    var app = new Vue({
      el: '#app',
      data: {
        login: true,
        
      },
      methods: {
        loginFalse(){
          this.login = false;
        },
        loginTrue(){
          this.login = true;
        }
      },
    })

    </script>
  </body>
  </html>
