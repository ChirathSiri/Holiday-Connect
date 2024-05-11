<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Model for user-related database tasks
class UserModelFile extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Insert user data during sign-up
    function create($username, $password, $email, $name)
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $data = array('Username' => $username, 'Password' => $hashed, 'Email' => $email, 'Name' => $name);

        if ($this->db->insert('users', $data)) {
            return True;
        } else {
            return False;
        }
    }

   // Model to fetch all data from the user table
    public function getUsers()
    {
        $query = $this->db->get('users');
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    // Model to verify user credentials during login
    function login($username, $password)
    {
        $res = $this->db->get_where('users', array('Username' => $username));
        if ($res->num_rows() != 1) {
            return false;
        } else {
            $row = $res->row();
            if (password_verify($password, $row->Password)) {
                return true;
            } else {
                return false;
            }
        }
    }

    // Model to check if a user is logged in session
    function is_logged_in()
    {
        if (isset($this->session->is_logged_in) && $this->session->is_logged_in == True) {
            return True;
        } else {
            return False;
        }
    }

    // Model for updating the password column of the user table
    public function passwordreset($username, $password){
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $res = $this->db->get_where('users', array('Username' => $username));
        if ($res->num_rows() != 1){
            return false;
        }
        else{
            $dataToChange = array('Password' => $hashed);
            $id = array('Username' => $username);
            $query = $this->db->update('users',$dataToChange,array('Username' => $username));
            if ($query) {
                return $query;
            }
            else{
                return false;
            }
        }
    }

    // Model for searching users in the user table
    public function searchUser($username){
        $query=$this->db->query("SELECT * FROM users WHERE Username LIKE '".$username."%'");
        return $query->result();
    }

    // Model for handling follow actions and notification updates
    public function followuser($username,$isfollowing){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $following = $this->db->get_where('users', array('Username' => $isfollowing));
        $isfollowing= $following->row()->UserId;
        $res = $this->db->get_where('following', array('UserId' => $userId,'IsFollowing' => $isfollowing));
        if ($res->num_rows() == 1){
            $query=$this->db->delete('following', array('UserId' => $userId,'IsFollowing' => $isfollowing));
            $this->db->delete('notification', array('FromUser' => $userId,'UserId' => $isfollowing,'Notification'=>'Followed you!'));
            return "deleted";
        }
        else{
            $query=$this->db->insert('following', array('UserId' => $userId,'IsFollowing' => $isfollowing));
            $this->db->insert('notification', array('FromUser' => $userId,'UserId' => $isfollowing,'Notification'=>'Followed you!'));
            return "added";
        }
    }

    // Model for querying if a user is following another user
    public function checkfollowing($username,$isfollowing){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $following = $this->db->get_where('users', array('Username' => $isfollowing));
        $isfollowing= $following->row()->UserId;
        $res = $this->db->get_where('following', array('UserId' => $userId,'IsFollowing' => $isfollowing));

        if ($res->num_rows() == 1){
            return true;
        }
        else{
            return false;
        }
    }

    // Model for getting counts of followers/following
    public function followcount($username){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $res1 = $this->db->get_where('following', array('UserId' => $userId));
        $following=$res1->num_rows();
        $res2 = $this->db->get_where('following', array('IsFollowing' => $userId));
        $followers=$res2->num_rows();
        return array('following' => $following,'followers' => $followers);
        
    }

    //Retrieve all records from the "users" table where the username matches.
    public function getUser($username)
    {
        $res = $this->db->get_where('users', array('Username' => $username));
        return $res->row();
    }

    //A query to verify the user's availability.
    public function checkUser($username)
    {
        $res = $this->db->get_where('users', array('Username' => $username));
        return $res->num_rows();
    }

    //Update records in the user table.
    public function editprofile($username, $bio, $name, $email, $userimage){
        $query=$this->db->query("UPDATE users SET Name='".$name."',Email='".$email."',UserBio='".$bio."',UserImage='".$userimage."' WHERE Username='".$username."'");
        return $query;
    }

    //Retrieve all notifications associated with a user.
    public function notifications($username){
        $users = $this->db->get_where('users', array('Username' => $username));
        $userId= $users->row()->UserId;
        $query = $this->db->query("SELECT notification.*, users.Username FROM notification JOIN users ON users.UserId=notification.FromUser WHERE notification.UserId='".$userId."' ORDER BY Timestamp DESC");
        if ($query) {
            return $query->result();
        }
        return NULL;
    }
}