<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Holiday Connect</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/login.css">

</head>

<body>
<!-- Logo section -->
<div class="logodiv">
    <!-- Logo image -->
    <img class="logoimage" src="<?php echo base_url()?>images/logo.png" alt="Logo"/> 
</div>
<!-- Login form section -->
<div class="loginform">

    <div class="logheading">
        <span>Welcome !</span>
    </div>

    <!-- error message if necessary -->

    <?php if (isset($login_error_msg)) { ?>
    <div class="errormsg">
        <?php echo $login_error_msg ?> 
    </div> <?php } ?>

    <form class="authforms" name="loginform">
        <!-- Username input -->
        <div class="input">
            <input class="loginfield" type=text id="username" name='username' onkeyup='checkinputs();' required/>
           
            <label class="loginlabel"> Username :
                <span style="color:#EB9494">*</span>
            </label>

        </div>
    
        <div class="input">
             <!-- Password input -->
            <input class="loginfield" type=password id="password" name='password' onkeyup='checkinputs();' required/>

            <label class="loginlabel"> Password :
                <span style="color:#EB9494">*</span>
            </label>
        </div>
        <!-- Login button -->
        <div class="action">
            <input class="loginbtn" type=submit disabled="disabled" id="login" value="LOGIN" />
        </div>
    </form>

    <div class="loginspandiv">

        <a href="<?php echo base_url()?>index.php/logincon/passwordreset">Forgot Your Password Here ?</a>
        <br>
        <span>Don't have an account? Please 
            <a href="<?php echo base_url()?>index.php/logincon/signup">Sign Up</a> 
            here !
        </span>
    </div>

</div>

    <script type="text/javascript" lang="javascript">
        //check if all inputs are not empty
        function checkinputs() {
            if (document.forms["loginform"]["username"].value != "" && document.forms["loginform"]["password"].value != "") {
                document.getElementById('login').disabled = false;
            }
            else{
                document.getElementById('login').disabled = true;
            }
        }
        $(document).ready(function () {
            //when login is clicked
            $('#login').click(function (event) {
                event.preventDefault();
                userLogin();
            });
        });
        // Define Backbone Model for handling login data
        var Login = Backbone.Model.extend({
            // Specify the URL for the login action on the server
            url:"<?php echo base_url()?>index.php/logincon/user/action/login"
        });
        // Define Backbone Collection for managing groups of login models
        var LoginCollection = Backbone.Collection.extend({
            // Specify the type of model that this collection will contain
            model: Login,// This collection contains instances of the Login model
        });

        var loginCollection = new LoginCollection();
        function userLogin() {
            var newLogin = new Login();
            newLogin.set('username', "@"+$("#username").val().toLowerCase());//username is converted to lowercase
            newLogin.set('password', $("#password").val());
            loginCollection.create(newLogin,{
                success: function(response){
                    var result=response.changed.result;
                    if (result=="success") {//redirect to home
                        location.href="<?php echo base_url()?>index.php/home/";  
                    } else {//else redirect to login
                        location.href="<?php echo base_url()?>index.php/logincon/login";
                    }
                }
            });
        }
    </script>
</body>

<footer>
    &copy;Holiday Connect 2024 | W1809835
</footer>

</html>