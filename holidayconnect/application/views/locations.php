<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Holiday Connect Locations</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/b9008b61cc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/home.css">
</head>

<body>
    <div class="locationcontainer">
        <!-- Location list -->
        <div class="locationlistdiv">
            <!-- Display the location name -->
            <span id='locationname'></span>
            <!-- Location list -->
            <div id="locationlist"> </div>
        </div>
        <!-- Post display area -->
        <div class="postlocadiv"></div>
    </div>

<script type="text/javascript" lang="javascript">
    var locationid="<?php echo $locationid ?>";    
    $(document).ready(function () {
        event.preventDefault();
        $.ajax({// Get all posts from the given location ID at the start and display the posts
            url: "<?php echo base_url() ?>index.php/posts/location/action/id?locationid="+locationid,
            method: "GET"
            }).done(function (data) {
                document.getElementById("locationname").innerHTML = "<i class='fa-solid fa-location-dot'></i>"+data.LocationName;
            });
        $.ajax({
            url: "<?php echo base_url() ?>index.php/posts/location/action/all",
            method: "GET"
        })
        .done(function (data) {
            for (i = (locationid-8); i < (+locationid+8); i++) {
                if(data[i]!=null){// Display a few other locations in the list for easier browsing
                    var span ="<a href='<?php echo base_url() ?>index.php/posts/locations?locationid="
                    +data[i].LocationId+"'><span>"+data[i].LocationName+"</span></a></br>";
			        $('#locationlist').append(span);
                }
		    }  
        });
        // Define a Backbone collection to fetch posts based on location ID
        postCollection.fetch();
    });    
    // Define a Backbone view to display posts
    var PostCollection = Backbone.Collection.extend({
        url: "<?php echo base_url() ?>index.php/posts/locationposts?locationid="+locationid,
    });

    var html = "";
    var PostDisplay = Backbone.View.extend({
        el: ".postlocadiv",// Element to show the view
        initialize: function () {
            this.listenTo(this.model, "add", this.showResults);
        },
        showResults: function (m) {
            // Render each post as HTML and append to the element
            html = html + "<div class='imagelocdiv'><a href='<?php echo base_url() ?>index.php/posts/post?postid="
            +m.get('PostId')+"'><img class='locpostimage' src='<?php echo base_url() ?>images/userposts/"+m.get('PostImage')+"'/></a></div>";
            this.$el.html(html);  
        }
    });
    // Create an instance of the PostCollection
    var postCollection = new PostCollection();
    // Create an instance of the PostDisplay view with the PostCollection as its model
    var postDisplay = new PostDisplay({model: postCollection})

</script>
</body>

<footer>
    &copy;Holiday Connect 2024 | W1809835
</footer>

</html>