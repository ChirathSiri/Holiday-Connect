<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Holiday Connect Reset Password</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" 
        type="text/javascript"></script>
    <link rel="stylesheet" 
        type="text/css" href="../../css/login.css">

</head>
<body>
 <!-- Logo section -->
<div class="logodiv">
    <img class="logoimage" src="<?php echo base_url()?>images/logo.png" alt="Logo"/> 
</div>
<!-- Password reset form -->
<div class="pwform">
    <!-- Heading -->
    <div class="pwresetheading"><span> RESET YOUR PASSWORD </span></div>
    <!-- Error message section -->
    <div class="errormsg" id="errormsg"></div>
    <!-- Form -->
    <form class="authforms" name="loginform">
        <div class="input">
            <!-- Username input -->
            <input class="loginfield" type=text id="username" name='username' onkeyup='checkinputs();' required/>
            <label class="loginlabel"> Enter Your Username :<span style="color:#EB9494">*</label>
        </div>
        <div class="input">
            <!-- Password input -->
            <input class="loginfield" type=password id="password" name='password' onkeyup='checkinputs();' required/>
            <label class="loginlabel"> Enter New Password :<span style="color:#EB9494">*</label>
        </div>
        <!-- Submit button -->
        <div class="action">
            <input class="loginbtn" type=submit disabled="disabled" id="changepw" value="RESET" />
        </div>
    </form>
    <!-- Sign up link -->
    <div class="loginspandiv">
        <span>Or <a href="<?php echo base_url()?>index.php/logincon/signup"> Sign Up </a> Here !</span>
    </div>
</div>

<script type="text/javascript" lang="javascript">
//check inputs to see if theyre are empty
function checkinputs() {
    if (document.forms["loginform"]["username"].value != "" && document.forms["loginform"]["password"].value != "") {
        document.getElementById('changepw').disabled = false;
    }
    else{
        document.getElementById('changepw').disabled = true;
    }
}
//when button is clicked to change password
$("#changepw").click(function(event) {
    event.preventDefault();
    var pwdata = {
        username: "@" + $('#username').val().toLowerCase(),
        password: $('#password').val()
    };
    $.ajax({
        url: "<?php echo base_url() ?>index.php/logincon/user/action/passwordreset",
        data: JSON.stringify(pwdata),
        contentType: "application/json",
        method: "POST"
    }).done(function (data) {
        var result = data.result;
        if (result == "success") {
            location.href = "<?php echo base_url() ?>index.php/logincon/login";
        }
        else if (result == "logged") {//if result is logged, means user is changing pw while logged in
            location.href = "<?php echo base_url() ?>index.php/profilecon";
        }
        else {
            document.getElementById("errormsg").innerHTML = "Username Does Not Exist !"
        }
    });
    });
</script>
</body>

</html>