<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Holiday Connect Home</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/b9008b61cc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/home.css">
</head>

<body>
<!-- Container for feed content -->
<div class="feedcontainer">
    <!-- Container for users not followed -->
    <div class='notfollowing'>
        <!-- Heading -->
        <div class='heading'> Follow New Users to View Posts in Your Timeline </div>
        <!-- User listing -->
        <div class='userlisting'></div>
    </div>
<div>

<script type="text/javascript" lang="javascript">//inline javascript with backbone framework
    var username="<?php echo $username ?>";
    $(document).ready(function () {
        event.preventDefault();
        $.ajax({// Retrieve the follow count of the specific user.
            url: "<?php echo base_url() ?>index.php/myprofile/followcount?username="+username,
            method: "GET"
        }).done(function (data) {
            if (data.following==0){// If the follow count is 0, show no posts and suggest users to follow.
                $.ajax({
                    url: "<?php echo base_url() ?>index.php/users/user",
                    method: "GET"
                }).done(function (data) {
                    for (i = 0; i < 5; i++) {
                        var div ="<a href='<?php echo base_url() ?>index.php/users/userprofile/?username="
                         +data[i].Username+"'><div class='users'><div class= 'profilepicdiv'><img class='profilepic' src='<?php echo base_url() ?>images/profilepics/"
                         +data[i].UserImage+"'/></div>"+data[i].Username+"</br>"+data[i].Name+"</div></a>";
                        $('.userlisting').append(div);
                    } 
                });
            }
            else{
                $('.notfollowing').remove(); 
            }
        });
        postCollection.fetch();// Fetch backbone collection on startup.
    });

    var PostCollection = Backbone.Collection.extend({
        url: "<?php echo base_url() ?>index.php/home/followingposts?username="+username,
    });
    var html = "";
    var PostDisplay = Backbone.View.extend({
        el: ".feedcontainer",
        initialize: function () {
            this.listenTo(this.model, "add", this.showResults);
        },
        showResults: function (m) {// Show all posts in the Backbone view.
            html = html + "<div class='postdiv'><div class='locationdiv'><a href='<?php echo base_url() ?>index.php/posts/locations?locationid="
            + m.get('LocationId') +"'><span><i class='fa-solid fa-location-dot'></i>"
            + m.get('LocationName') +"</span></a></div><a href='<?php echo base_url() ?>index.php/posts/post?postid="
            + m.get('PostId') +"'><img class='postimage' src='<?php echo base_url() ?>images/userposts/"
            + m.get('PostImage') + "'/></a><div class='userlikediv'><div class='usernamediv'><a href='<?php echo base_url() ?>index.php/users/userprofile/?username="
            + m.get('Username') +"'><span>"+ m.get('Username') +"</span></a></div><div class='likediv' id='likediv"
            + m.get('PostId') +"'><i onclick='like("+m.get('PostId')+");' class='fa-solid fa-heart'></i></div></div><div class='captiondiv'>"
            + m.get('Caption')+"</div><div class='commentsdiv' id='commentsdiv"
            + m.get('PostId') +"'></div></div>";
            this.$el.html(html);
            // Retrieve comments for each post and render them.
            $.ajax({
                url: "<?php echo base_url() ?>index.php/home/comments?postid="+m.get('PostId'),
                method: "GET"
            }).done(function (res) {
                if(res.length!=0){             
                    for (i = 0; i < res.length; i++) {
                        if(i<2){
                            var div ="<span><a class='commuserlink' href='<?php echo base_url() ?>index.php/users/userprofile/?username="+res[i].Username+"'>"+res[i].Username+"</a>"
                            +res[i].CommentBody+"</span></br>";
                            $('#commentsdiv'+m.get('PostId')).append(div);
                        }
		          } 
                }
            });
            $.ajax({// Verify if the user has already liked them or not and adjust the color accordingly.
                url: "<?php echo base_url() ?>index.php/home/checklikes?username="+username+"&postid="+m.get('PostId'),
                method: "GET"
            }).done(function (res) {
                if(res){
                    document.getElementById("likediv"+m.get('PostId')).style.color = "#FC6464";
                }
                else{
                    document.getElementById("likediv"+m.get('PostId')).style.color = "#666666";
                }
            });
        }
    });
    var postCollection = new PostCollection();
    var postDisplay = new PostDisplay({model: postCollection})

    // Handling click events on like buttons.
    function like($postid){
        $.ajax({
                url: "<?php echo base_url() ?>index.php/home/like",
                data: JSON.stringify({username: username,postid:$postid}),
                contentType: "application/json",
                method: "POST"
        }).done(function (data) {
            $.ajax({
                url: "<?php echo base_url() ?>index.php/home/checklikes?username="+username+"&postid="+$postid,
                method: "GET"
            })
            .done(function (res) {
                if(res){
                    document.getElementById("likediv"+$postid).style.color = "#FC6464";
                }
                else{
                    document.getElementById("likediv"+$postid).style.color = "#666666";
                }
            });
        });
    }
</script>
</body>

<footer>
    &copy;Holiday Connect 2024 | W1809835
</footer>

</html>