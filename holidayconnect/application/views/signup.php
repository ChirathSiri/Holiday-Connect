<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Holiday Connect Signup</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" 
        type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"
        type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js"
        type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/login.css">

</head>

<body>
    <div class="logodiv"><img class="logoimage" src="<?php echo base_url() ?>images/logo.png" alt="Logo" /> </div>

    <div class="signform">
        <div class="logheading">
            <span> Enter Your Details </span>
        </div>
        
        <form class="authforms" name="signupform">
            <!-- Error message section -->
            <div class="errormsg" id="errormsg"></div>
            <!-- Username input -->
            <div class="input">

                <input class="signfield" type=text id="username" name='username'
                    onkeyup='checkusername(); checkinputs();' required />
                <label class="signlabel">Enter Username :<span style="color:#EB9494">*</span></label>
            </div>
            <!-- Email input -->
            <div class="input">
                <input class="signfield" type=text id="email" name='email' onkeyup='checkinputs(); validateemail()'
                    required />
                <label class="signlabel">Enter Email :<span style="color:#EB9494">*</span></label>
            </div>
            <!-- Full name input -->
            <div class="input">
                <input class="signfield" type=text id="name" name='name' onkeyup='checkinputs();' required />
                <label class="signlabel">Enter Full Name :</label>
            </div>
            <!-- Password input -->
            <div class="input">
                <input class="signfield" type=password id="password" name='password' onkeyup='checkinputs();'
                    required />
                <label class="signlabel">Enter Password :<span style="color:#EB9494">*</span></label>
            </div>
            <!-- Submit button -->
            <div class="action">
                <input class="signupbtn" type=submit id="createUser" disabled="disabled" value="SIGN UP" />
            </div>
        </form>
        <div class="signspandiv">
            <span>Already have a Holiday CONNECT account? Please <a href="<?php echo base_url() ?>index.php/logincon/login">Login</a> </span>
        </div>
    </div>

    <script type="text/javascript" lang="javascript">
    // Check if the required inputs are empty.
    function checkinputs() {
        if (document.forms["signupform"]["username"].value != "" && document.forms["signupform"]["email"].value != "" &&
            document.forms["signupform"]["password"].value != "" && document.getElementById("errormsg").innerHTML == "") {
            document.getElementById('createUser').disabled = false;
        }
        else{
            document.getElementById('createUser').disabled = true;
        }
    }
    function validateemail() {// Validate the email before sending it through the API.
        var x = document.forms["signupform"]["email"].value;
        var atposition = x.indexOf("@");
        var dotposition = x.lastIndexOf(".");
        if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {
            document.getElementById("errormsg").innerHTML = "Please enter a valid Email Address !";
        }
        else {
            document.getElementById("errormsg").innerHTML = "";
            checkinputs();
        }
    }
    function checkusername() {// Verify if the username is already taken or not.
        $.ajax({
            url: "<?php echo base_url() ?>index.php/logincon/user/action/checkuser",
            data: { 'username': "@" + $('#username').val().toLowerCase() },
            method: "POST"// Utilize the POST method.
        }).done(function (data) {
            if (data == 0) {
                document.getElementById("errormsg").innerHTML = "";
                checkinputs();
            }
            else {
                document.getElementById("errormsg").innerHTML = "User Already Exists !"
            }
        });
    }
    $(document).ready(function () {
        $('#createUser').click(function (event) {// Invoke a function when the button is clicked.
            event.preventDefault();
            userSignup();
        });
    });
    // Define Backbone Model for handling signup data
    var User = Backbone.Model.extend({
        // Specify the URL for the signup action on the server
        url: "<?php echo base_url() ?>index.php/logincon/user/action/signup"
    });
    // Define Backbone Collection for managing groups of signup models
    var UserCollection = Backbone.Collection.extend({
        // Specify the type of model that this collection will contain
        model: User// This collection contains instances of the signup model
    });
    var usersCollection = new UserCollection();
    function userSignup() {
        var newUser = new User();
        newUser.set('username', "@" + $("#username").val().toLowerCase());// Convert the username to lowercase.
        newUser.set('email', $("#email").val());
        newUser.set('name', $("#name").val());
        newUser.set('password', $("#password").val());// Redirect back to the home page.
        usersCollection.create(newUser, {
            success: function () {// Redirect to the login success page.
                location.href = "<?php echo base_url() ?>index.php/logincon/login";
            }
        });
    }
    </script>
</body>

</html>