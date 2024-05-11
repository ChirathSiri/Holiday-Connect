<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Holiday Connect Profile</title>
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
            <div class="profpicdiv"></div>
            <!-- Profile picture display -->
            <div class="followdiv">
                <!-- Show followers and following count in the user profile -->
                <div class="flabel"> Following </div>
                <div class="fcount" id="followingc"></div>
                <div class="flabel"> Followers </div>
                <div class="fcount" id="followerc"></div>
            </div>
        </div>
        <!-- Username display -->
        <div class="usernamediv"><?php echo $username ?></div>
        <!-- Full name display -->
        <div class="namediv"></div>
        <!-- Bio display -->
        <div class="biodiv"></div>
        <!-- Edit profile button -->
        <div class="profbottomdiv">
            <img class="editimage" src="<?php echo base_url() ?>images/edit.png"/></a>
            <a class="editprlink" href="<?php echo base_url()?>index.php/profilecon/editprofile">edit profile</a>
        </div>
    </div>
    <!-- Posts section -->
    <div class="postsdiv" id="postsdiv"></div>
</div>
<div class="addlinkbutton">
 <!-- Add post link -->
    <a href="<?php echo base_url()?>index.php/createpost">
    <img class="linkimage" src="<?php echo base_url() ?>images/add.png"/></a>
</div>

<script type="text/javascript" lang="javascript">
    var username="<?php echo $username ?>";
    // Backbone fetches the post collection on startup.
    $(document).ready(function () {
        event.preventDefault();
        postCollection.fetch();
        $.ajax({// Retrieve user details via API.
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
        $.ajax({// Retrieve follower/following counts.
            url: "<?php echo base_url() ?>index.php/profilecon/followcount?username="+username,
            method: "GET"
        }).done(function (data) {
            document.getElementById("followingc").innerHTML = data.following
            document.getElementById("followerc").innerHTML = data.followers
        });
    });
   // Define Backbone model for a post
    var Post = Backbone.Model.extend({
        // URL to fetch post data from the server
        url: "<?php echo base_url() ?>index.php/profilecon/myposts"
    });
    // Define Backbone collection for posts
    var PostCollection = Backbone.Collection.extend({
        // URL to fetch post collection data from the server
        url: "<?php echo base_url() ?>index.php/profilecon/myposts",
        // Define the model associated with this collection
        model: Post,
        // Parse the fetched data
        parse: function(data) {
            return data;
        } 
    });
    // Backbone view to display the posts.
    var PostDisplay = Backbone.View.extend({
        // Element to bind the view to
        el: "#postsdiv",
        // Initialize the view
        initialize: function () {
            this.listenTo(this.model, "add", this.showResults);
        },
        showResults: function () {
            var html = "";
            // Iterate over each model in the collectio
            this.model.each(function (m) {
                html = html + "<div class='postimagediv'><a href='<?php echo base_url() ?>index.php/createpost/post?postid="
                + m.get('PostId') +"'><img class='postimage' src='<?php echo base_url() ?>images/userposts/"
                + m.get('PostImage') + "'/></a></div>";
            });
            // Set the HTML content of the element
            this.$el.html(html);
        }
    });
    // Instantiate post collection and view
    var postCollection = new PostCollection();
    var postDisplay = new PostDisplay({model: postCollection})
</script>
</body>

<footer>
    &copy;Holiday Connect 2024 | W1809835
</footer>

</html>