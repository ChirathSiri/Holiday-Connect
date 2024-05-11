<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Holiday Connect User Account</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/profile.css">
</head>

<body>
<div class="profilecontainer">
<!-- Profile details section -->
<div class="profiledeetdiv">
    <!-- Top section containing profile picture and follow details -->
    <div class="topdiv">
        <!-- Profile picture display -->
        <div class="profpicdiv"></div>
        <!-- Follow details -->
        <div class="followdiv">
            <!-- Following count -->
            <div class="flabel">Following</div>
            <div class="fcount" id="followingc"></div>
            <!-- Followers count -->
            <div class="flabel">Followers</div>
            <div class="fcount" id="followerc"></div>
        </div>
    </div>
    <!-- Username display -->
    <div class="usernamediv" id="nametag"><?php echo $username ?></div>
    <!-- Full name display -->
    <div class="namediv"></div>
    <!-- Bio display -->
    <div class="biodiv"></div>
    <!-- Follow button -->
    <div class="profbottomdiv">
     <!-- Follow button -->
        <a href="#" onclick='follow();'><div id="followbutton"> </div></a>
    </div>
</div>
<!-- Posts section -->
<div class="postsdiv" id="postsdiv"></div>
</div>

<script type="text/javascript" lang="javascript">
    var username="<?php echo $username ?>";
    $(document).ready(function () {
        event.preventDefault();
        postCollection.fetch();// Fetch posts from the collection upon startup.
        checkfollow();// Verify if the current profile follows this user.
        $.ajax({// Retrieve user details and show them.
            url: "<?php echo base_url() ?>index.php/logincon/userdetails?username="+username,
            method: "GET"
        }).done(function (data) {
            var div ="<img class='profileimage' src='<?php echo base_url() ?>images/profilepics/"+data.UserImage+"'/>";
            $('.profpicdiv').append(div);
            var name ="<span>"+data.Name+"</span>";
            $('.namediv').append(name);
            var bio ="<span>"+data.UserBio+"</span>";
            $('.biodiv').append(bio);
        });
        followcount();
    });
    // Backbone model for a post
    var Post = Backbone.Model.extend({
        // URL to fetch user posts from the server
        url: "<?php echo base_url() ?>index.php/createpost/userposts?username="+username
    });
    // Backbone collection for user posts
    var PostCollection = Backbone.Collection.extend({
        // URL to fetch user posts collection from the server
        url: "<?php echo base_url() ?>index.php/createpost/userposts?username="+username,
        // Specify the model associated with this collection
        model: Post,
        // Parse the fetched data
        parse: function(data) {
            return data;
        } 
    });
    // Backbone view to display user posts
    var PostDisplay = Backbone.View.extend({
        // Root element to bind the view
        el: "#postsdiv",
        // Initialize the view
        initialize: function () {
            // Listen to 'add' event on the model
            this.listenTo(this.model, "add", this.showResults);
        },
        // Show the posts
        showResults: function () {
            // Iterate over each model in the collection
            var html = "";
            // Generate HTML for each post
            this.model.each(function (m) {
                html = html + "<div class='postimagediv'><a href='<?php echo base_url() ?>index.php/createpost/post?postid="
                + m.get('PostId') +"'><img class='postimage' src='<?php echo base_url() ?>images/userposts/"
                + m.get('PostImage') + "'/></a></div>";
            });
            // Set the HTML content of the root element
            this.$el.html(html);
        }
    });
    var postCollection = new PostCollection();
    var postDisplay = new PostDisplay({model: postCollection})
    function followcount(){
        $.ajax({// Retrieve follower/following count and show it.
            url: "<?php echo base_url() ?>index.php/profilecon/followcount?username="+username,
            method: "GET"
        }).done(function (data) {
            document.getElementById("followingc").innerHTML = data.following
            document.getElementById("followerc").innerHTML = data.followers
        });
    }
    function follow(){// Handling click events on the follow button.
        $.ajax({
            url: "<?php echo base_url() ?>index.php/profilecon/follow",
            data: JSON.stringify({isfollowing: username}),
            contentType: "application/json",
            method: "POST"
        }).done(function () {
            checkfollow();
            followcount();
        });
    }
    function checkfollow(){// Verify if the user has already followed and update the button accordingly.
        $.ajax({
            url: "<?php echo base_url() ?>index.php/profilecon/checkfollow?isfollowing="+username,
            method: "GET"
        }).done(function (data) {
            if (data) {
                 document.getElementById("followbutton").innerHTML = "Unfollow"
            }
            else {
                document.getElementById("followbutton").innerHTML = "Follow"
            }
        });
    }        
</script>
</body>

<footer>
    &copy;Holiday Connect 2024 | W1809835
</footer>

</html>