<?php
defined('BASEPATH') or exit('No direct script access allowed');

//A model for handling tasks related to posts in the database.
class PostModelFile extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    //Insert rows into the post table.
    function createPost($username, $locationid, $postImage, $caption)
    {
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $data = array('UserId' => $userId, 'LocationId' => $locationid, 'PostImage' => $postImage, 'Caption' => $caption);
        if ($this->db->insert('posts', $data)) {
            return True;
        } else {
            return False;
        }
    }

    //Query the post table to retrieve posts authored by a specific user.
    function getPostsfromUsername($username)
    {
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $query=$this->db->query( "SELECT * FROM posts WHERE UserId=".$userId." ORDER BY Timestamp DESC");
        return $query->result();
    }

    //Retrieve all locations from the database.
    function getLocations(){
        $query = $this->db->get('location');
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    //Query the database to retrieve posts from users being followed.
    function getPostsofFollowing($username){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $query=$this->db->query("SELECT posts.*, users.Username, location.LocationName FROM posts JOIN users ON users.UserId=posts.UserId JOIN location ON location.LocationId=posts.LocationId WHERE posts.userid IN 
        (SELECT IsFollowing FROM following WHERE following.UserId=".$userId.") ORDER BY Timestamp DESC");
        return $query->result();
    }

    //Query the table to retrieve comments for each post.
    function getComments($postid){
        $comments = $this->db->query( "SELECT comments.*,users.Username FROM comments JOIN users ON users.UserId=comments.UserId WHERE PostId=".$postid." ORDER BY Timestamp DESC");
        return $comments->result();
    }

    //Insert rows into the comments table.
    function addComments($postid, $comment, $username){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $posts = $this->db->get_where('posts', array('PostId' => $postid));
        $postuser= $posts->row()->UserId;
        $query=$this->db->insert('comments', array('UserId' => $userId,'PostId' => $postid,'CommentBody' => $comment));
        $this->db->insert('notification', array('FromUser' => $userId,'UserId' => $postuser, 'PostId' => $postid, 'CommentBody' => $comment, 'Notification'=>'Commented on your post!'));
        return $query;
    }

    //Query the like table to verify if a user has liked a post.
    public function checklikes($username, $postid){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $res = $this->db->get_where('likes', array('UserId' => $userId,'PostId' => $postid));
        if ($res->num_rows() == 1){
            return true;
        }
        else{
            return false;
        }
    }

    //Insert a row into both the likes and notification tables.
    public function likepost($username, $postid){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $posts = $this->db->get_where('posts', array('PostId' => $postid));
        $postuser= $posts->row()->UserId;
        $res = $this->db->get_where('likes', array('UserId' => $userId,'PostId' => $postid));
        if ($res->num_rows() == 1){
            $query=$this->db->delete('likes', array('UserId' => $userId,'PostId' => $postid));
            $this->db->delete('notification', array('FromUser' => $userId,'UserId' => $postuser, 'PostId' => $postid, 'Notification'=>'Liked your post!'));
            return "deleted";
        }
        else{
            $query=$this->db->insert('likes', array('UserId' => $userId,'PostId' => $postid));
            $this->db->insert('notification', array('FromUser' => $userId,'UserId' => $postuser, 'PostId' => $postid, 'Notification'=>'Liked your post!'));
            return "added";
        }
    }

    //Query the post table to retrieve posts from a specific location.
    public function postsFromLocation($locationid){
        $res = $this->db->get_where('posts', array('LocationId' => $locationid));
        return $res->result();
    }

    //Query locations by their location ID.
    public function getLocationbyId($locationid){
        $res = $this->db->get_where('location', array('LocationId' => $locationid));
        return $res->row();
    }

    //Query posts by their post ID.
    public function postfromid($postid){
        $res = $this->db->query( "SELECT posts.*, users.Username, users.UserImage, location.LocationName FROM posts JOIN users ON users.UserId=posts.UserId JOIN location ON location.LocationId=posts.LocationId WHERE posts.PostId =".$postid);
        return $res->row();
    }

    //Retrieve the number of rows from the likes table based on the post ID.
    public function likeCount($postid){
        $res2 = $this->db->get_where('likes', array('PostId' => $postid));
        $likes=$res2->num_rows();
        return $likes;
    }
} 