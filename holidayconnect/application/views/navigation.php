<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Holiday Connect</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" 
          type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/navigation_page.css">
</head>
<body>
     <div class="navigationdiv">
          <!-- Logo -->
          <div class="logodiv">
               <a href="<?php echo base_url()?>index.php/home">
               <img class="logoimage" src="<?php echo base_url() ?>images/logo.png" alt="Logo" /></a>
          </div>
          <!-- Search bar -->
          <div class="searchdiv"> 
               <input type="text" class="search" id="search" placeholder="Search for user..." onkeyup='searchusers()'/>
               <img class="searchicon" src="<?php echo base_url() ?>images/search.png" alt="Search Icon"/>
          </div>
          <!-- Navigation link -->
          <div class="linkdiv">
               <!-- Home link -->
               <div class="linkelement">
                    <a href="<?php echo base_url()?>index.php/home">
                    <img class="homeimage" src="<?php echo base_url() ?>images/home.png"/></a>
               </div>
               <!-- Notification bell icon -->
               <div class="linkelement">
                    <img style="cursor:pointer" onclick='notifications();' class="bellimage" src="<?php echo base_url() ?>images/bell.png"/>
               </div>
               <!-- Logout Link -->
               <div class="linkelement">
                    <a href="<?php echo base_url()?>index.php/logincon/logout">
                    <img class="logoutimage" src="<?php echo base_url() ?>images/logout.png"/></a>
               </div>
               <div class="container">
                    <img id="theme-toggle" class="lightimage" src="<?php echo base_url() ?>images/moon.png" alt="Toggle Light Mode">
               </div>
          </div>
          <!-- User profile link -->
          <div class="profilediv">
               <div class="userlink">
               <a href="<?php echo base_url()?>index.php/profilecon" class="profilelink"><span><?php echo $username ?></span></a></div>
          </div>
     </div>
     <!-- Search Result and Notification -->
     <div class="searchresults" id="searchresults"></div>
     <div class="notifications" id="notifications"></div>

     <script type="text/javascript" lang="javascript">
     var username="<?php echo $username ?>";
     function searchusers() {
          if($('#search').val().length==0){
               document.getElementById("searchresults").style.display = "none";
          }
          else{// Overlay displayed only when something is typed.
               document.getElementById("searchresults").style.display = "block";
          }
          var userdata = {
                username: "@" + $('#search').val().toLowerCase()
          };
          $.ajax({// Retrieve users based on the search string.
                url: "<?php echo base_url() ?>index.php/logincon/user/action/searchuser",
                data: JSON.stringify(userdata),
                contentType: "application/json",
                method: "POST"
            }).done(function (data) {
               $('#searchresults div').remove(); 
               $('#searchresults a').remove(); 
               if(data.length==0){// Show "No results" if the array length is 0.
                    var div ="<div class ='user noresult'>No Results</div>";
                    $('#searchresults').append(div);
               }
               else{//show user with their user profile
                    for (i = 0; i < data.length; i++) {
                         var div ="<a class='userlinks' href='<?php echo base_url() ?>index.php/logincon/userprofile/?username="
                         +data[i].Username+"'><div class ='user'><div class= 'seauserimagediv'><img class='seauserimage' src='<?php echo base_url() ?>images/profilepics/"
                         +data[i].UserImage+"'/></div><div class='searuserdeet'>"+data[i].Username+"<br>"+data[i].Name+"</div></div></a>";
                         $('#searchresults').append(div);
		          } 
               }
          });
     }
     // Upon clicking the notification button
     function notifications(){// The overlay is only displayed when clicked.
          if(document.getElementById("notifications").style.display == "none"){
               document.getElementById("notifications").style.display = "block";
               $.ajax({// Retrieve notifications for the user.
                    url: "<?php echo base_url() ?>index.php/profilecon/notifications",
                    data: JSON.stringify({username: username}),
                    contentType: "application/json",
                    method: "GET"
               }).done(function (data) {
                    $('#notifications div').remove(); 
                    $('#notifications a').remove(); 
                    if(data.length==0){// No notifications available.
                    var div ="<div class =''>No Notifications</div>";
                    $('#notifications').append(div);
               }
               else{
                    for (i = 0; i < data.length; i++) {
                         // If there is a comment body, it indicates a comment notification.
                         if (data[i].CommentBody!=null && data[i].PostId!=null){
                              var div ="<a href='<?php echo base_url() ?>index.php/createpost/post?postid="
                              +data[i].PostId+"'><div>"+data[i].Username+"    "+data[i].Notification+"</br><span class='commentspam'>"
                              +data[i].CommentBody+"</span></div></a>";
                              $('#notifications').append(div);
                         }// If there is a post ID but no comment, it signifies a post like.
                         else if(data[i].CommentBody==null && data[i].PostId!=null){
                              var div ="<a href='<?php echo base_url() ?>index.php/createpost/post?postid="
                              +data[i].PostId+"'><div>"+data[i].Username+"    "+data[i].Notification+"</div></a>";
                              $('#notifications').append(div);
                         }// Otherwise, it indicates a follow notification.
                         else if(data[i].CommentBody==null && data[i].PostId==null){
                              var div ="<a href='<?php echo base_url() ?>index.php/logincon/userprofile/?username="
                              +data[i].Username+"'><div>"+data[i].Username+"    "+data[i].Notification+"</div></a>";
                              $('#notifications').append(div);
                         }
		          } 
               }
          });
     }
     else{
          document.getElementById("notifications").style.display = "none";
     }
     }
     </script>

     <script>
          const themeToggle = document.getElementById('theme-toggle');
          const body = document.body;

          themeToggle.addEventListener('click', () => {
               body.classList.toggle('dark-mode');
               const currentSrc = themeToggle.getAttribute('src');
               const newSrc = currentSrc.includes('sun') ? '<?php echo base_url() ?>images/moon.png' : '<?php echo base_url() ?>images/sun.png';
               themeToggle.setAttribute('src', newSrc);
          });
     </script>
</body>

<footer>
    &copy;Holiday Connect 2024 | W1809835
</footer>

</html>