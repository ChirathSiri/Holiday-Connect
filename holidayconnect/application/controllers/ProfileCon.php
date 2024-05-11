<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class ProfileCon extends \Restserver\Libraries\REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('UserModelFile');
        $this->load->model('PostModelFile');

        Header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *');
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); 
    }
    //The index method to display my profile page.
    public function index_get(){
        if ($this->UserModelFile->is_logged_in()) {
            $this->load->view('navigation',array('username' => $this->session->username));
            $this->load->view('myprofile',array('username' => $this->session->username));
        }
        else {
            $this->load->view('login');
        }
    }
    //The edit profile view.
    public function editprofile_get(){
        if ($this->UserModelFile->is_logged_in()) {
            $this->load->view('navigation',array('username' => $this->session->username));
            $this->load->view('editprofile',array('username' => $this->session->username));
        }
        else {
            $this->load->view('login');
        }
    }
    //An API endpoint to retrieve details of a user's posts.
    public function myposts_get(){
            $username = $this->session->username;
            $result = $this->PostModelFile->getPostsfromUsername($username);
            $this->response($result);
    }
    //A POST API endpoint to follow a user.
    public function follow_post(){
        if ($this->UserModelFile->is_logged_in()) {
            $username = $this->session->username;
            $isfollowing = $this->post('isfollowing');
            $result=$this->UserModelFile->followuser($username, $isfollowing);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
    //An API endpoint to check if a user is already following another user.
    public function checkfollow_get(){
        if ($this->UserModelFile->is_logged_in()) {
            $username = $this->session->username;
            $isfollowing = $this->get('isfollowing');
            $result=$this->UserModelFile->checkfollowing($username, $isfollowing);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
    //An API endpoint to retrieve follower/following count.
    public function followcount_get(){
        $username = $this->get('username');
        $result=$this->UserModelFile->followcount($username);
        $this->response($result); 
    }    
    //An API endpoint to retrieve all notifications for a user.
    public function notifications_get(){
        if ($this->UserModelFile->is_logged_in()) {
            $username = $this->session->username;
            $result=$this->UserModelFile->notifications($username);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
}