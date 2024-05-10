<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/edituserprofile.css">
</head>

<body>
<div class="editprofcontainer">
    <!-- Text editing section -->
    <div class="texteditdiv">
        <!-- Error message section -->
        <div class="errormsg" id="errormsg2"></div>
        <!-- Name change section -->
        <div class="namechangediv"></div>
        <!-- Email change section -->
        <div class="emailchangediv"></div>
        <!-- Bio change section -->
        <div class="biochangediv"></div>
        <!-- Edit image icon -->
        <img class="editimage" src="<?php echo base_url() ?>images/edit.png"/></a>
        <!-- Change password link -->
        <div class="changepwdiv"><a href="<?php echo base_url()?>index.php/users/passwordreset">Reset Password</a></div>
    </div>
    <!-- Profile picture editing section -->
    <div class="piceditdiv">
        <!-- Error message section -->
        <div class="errormsg" id="errormsg"></div>
        <!-- Profile image display section -->
        <div class="profimagediv"></div>
        <!-- File input for image upload -->
        <input type="file" id="image" name="image" onchange="readURL(this);" />
        <!-- Upload profile picture label -->
        <div class="dummy">Upload Profile Picture</div> 
    </div>
    <!-- Save changes button -->
    <div class="editprofdiv"><div id="editprofile"> Save Changes </div></div>
</div>

<script type="text/javascript" lang="javascript">
    var username="<?php echo $username ?>";
    var userimage="";
    var bio="";
    var name="";
    var email="";

    $(document).ready(function () {
        event.preventDefault();
        // Fetch user details upon loading and render them.
        $.ajax({
            url: "<?php echo base_url() ?>index.php/users/userdetails?username="+username,
            method: "GET"
        }).done(function (data) {
            userimage=data.UserImage;
            bio=data.UserBio;
            name=data.Name;
            email=data.Email;
            var div ="<img id='profpicid' src='<?php echo base_url() ?>images/profilepics/"+data.UserImage+"' alt='picture'/>";
            $('.profimagediv').append(div);
            var namediv="<div class='labeldiv'>Name</div><div class='inputdiv'><input class='inputedit' onkeyup='getname()' type=text id='name' name='name' value='"+data.Name+"'/></div>";
            $('.namechangediv').append(namediv);
            var emaildiv="<div class='labeldiv'>Email</div><div class='inputdiv'><input class='inputedit' onkeyup='validateemail()' type=text id='email' name='email' value='"+data.Email+"'/></div>";
            $('.emailchangediv').append(emaildiv);
            var biodiv="<div class='labeldiv'>Bio</div><div class='inputdiv'><textarea name='bio' id='bio' onkeyup='getbio()' maxlength='120'>"+data.UserBio+"</textarea></div>";
            $('.biochangediv').append(biodiv);
        });
    });
    // Validate the edited email address.
    function validateemail() {
        var x = $("#email").val();
        var atposition = x.indexOf("@");
        var dotposition = x.lastIndexOf(".");
        if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {
            document.getElementById("errormsg2").innerHTML = "Please enter a valid e-mail address";
        }
        else {
            document.getElementById("errormsg2").innerHTML = "";
            email = x;
        }
    }
    function getname() {
        name = $("#name").val();
    }
    function getbio() {
        bio = $("#bio").val();
    }
    // Display the uploaded image.
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var formdata = new FormData();
            var files = $('#image')[0].files;
            if(files.length > 0 ){
                formdata.append('image',files[0]);
                $.ajax({
                    url: "<?php echo base_url() ?>index.php/posts/profpic",//store the image in folder
                    data: formdata,
                    method: "POST",
                    contentType: false,
                    processData: false
                }).done(function (data) {
                    var result=data.result;
                    if (result=="done") {
                        userimage = data.image_metadata.file_name;//get file name
                        reader.onload = function (e) {
                        $('#profpicid').attr('src', e.target.result);
                        };
                        reader.readAsDataURL(input.files[0]);
                        document.getElementById("errormsg").innerHTML = '';
                    } else {
                        $error=data.error.slice(3,-4);
                        document.getElementById("errormsg").innerHTML = $error;
                    }
                });
            }
        }
    }
    // When the button is clicked to save changes.
    $("#editprofile").click(function(event) {
        event.preventDefault();
        var postdata = {
                userimage: userimage,
                username:username,
                bio:bio,
                name:name,
                email:email
        }
        $.ajax({
            url: "<?php echo base_url() ?>index.php/users/editprofile",
            data: JSON.stringify(postdata),
            contentType: "application/json",
            method: "PUT"
            }).done(function (data) {
                var result=data.result;
                if(result=="done"){// Redirect to my profile if the operation is successful.
                    location.href="<?php echo base_url()?>index.php/myprofile";
                }
                else{
                    document.getElementById("errormsg2").innerHTML = "Couldn't save your changes";
                }
            });
        });                    
</script>
</body>

<footer>
    &copy;Holiday Connect 2024 | W1809835
</footer>

</html>