<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Holiday Connect Create New Post</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/createnewpost.css">
</head>
<body>
    <!-- Upload post container -->
    <div class="uppostcontainer">
    <!-- File upload section -->
    <div class="filediv">
        <!-- Error message section -->
        <div class="errormsg" id="errormsg"></div>
        <!-- Post picture display -->
        <div class="postpicdiv">
             <img id='postpicid' src='<?php echo base_url() ?>images/userposts/image.png' alt='picture'/>
        </div>
        <!-- File input for image upload -->
        <input type="file" id="image" name="image" required="required" onchange="readURL(this);"/>  
        <!-- Upload picture label -->
        <div class="dummy"><p>Upload Picture</p></div>     
    </div>
    <!-- Caption section -->
    <div class="captiondiv">   
        <!-- Caption label -->
        <div class="caplabel"> <label for="caption">Write a Caption...</label></div>
        <!-- Caption input -->
        <div><textarea name="caption" id="caption"  maxlength="100"></textarea></div>
        <!-- Location label -->
        <div class="loclabel"><label for="locations">Add a Location Tag</label></div>
        <!-- Location select -->
        <div>
            <select onchange='getlocation();' id="locations">
                <option id ='locationName' value=""></option>
            </select>
        </div>
    </div>
    <!-- Post submit button -->
    <div class="postsubmitdiv"><div id="uploadpost">Post</div></div>
    </div>

    <script type="text/javascript" lang="javascript">
        var postImage="";
        var $locationid = "1";
        // Load location posts at startup and display them in the dropdown.
        $.ajax({
            url: "<?php echo base_url() ?>index.php/posts/location/action/all",
            method: "GET"
        }).done(function (data) {
	        $('#locations option').remove(); 
			for (i = 0; i < data.length; i++) {
		    	var option ="<option id ='locationName' value="+data[i].LocationId+">"+data[i].LocationName+"</option>";
			    $('#locations').append(option);
		    }                     
        });
        // Retrieve the location value from the form element.
        function getlocation() {
            $locationid = document.getElementById("locations").value;
        }
        // Display the uploaded image.
        function readURL(input) {
        document.getElementById("errormsg").innerHTML = "";
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var formdata = new FormData();
            var files = $('#image')[0].files;
            if(files.length > 0 ){
                formdata.append('image',files[0]);
                reader.onload = function (e) {
                $('#postpicid').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);        
            }
        }
        }
        // Function called when the upload button is clicked.
        $("#uploadpost").click(function(event) {
            event.preventDefault();
            var formdata = new FormData();
            var files = $('#image')[0].files;
            if(files.length > 0 ){
                formdata.append('image',files[0]);
            $.ajax({
                url: "<?php echo base_url() ?>index.php/posts/store",// Store the image in the folder.
                data: formdata,
                method: "POST",
                contentType: false,
                processData: false
            }).done(function (data) {
                var result=data.result;
                if (result=="done") {
                    $postImage = data.image_metadata.file_name; // Retrieve the filename from the saved image.
                    var postdata = {
                        locationid: $locationid,
                        postImage: $postImage,
                        caption: $('#caption').val()
                    };
                    $.ajax({
                        url: "<?php echo base_url() ?>index.php/posts/create", // Send data to the database.
                        data: JSON.stringify(postdata),
                        contentType: "application/json",
                        method: "POST"
                    }).done(function (data) {
                        var result = data.result;
                        if (result == "done") {// Redirect to my profile upon success.
                            location.href="<?php echo base_url()?>index.php/myprofile";
                        }
                        else {// Otherwise, display an error message.
                            document.getElementById("errormsg").innerHTML = "Post Creation Unsuccesful !";
                        }
                    });
                } else {
                    $error=data.error.slice(3,-4);
                    document.getElementById("errormsg").innerHTML = $error;
                }
            });
            }
            else{
                document.getElementById("errormsg").innerHTML = "Please Upload a Image !";
            }
        });
        </script>
</body>

<footer>
    &copy;Holiday Connect 2024 | W1809835
</footer>

</html>