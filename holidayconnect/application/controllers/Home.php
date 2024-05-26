<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Home extends \Restserver\Libraries\REST_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('UserModelFile');
        $this->load->model('PostModelFile');

        Header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *');
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); 
    }
    //Holiday Connect Home Page View
    public function index_get()
    {//Verify if the user is logged in; if not, redirect them to the login page.
        if ($this->UserModelFile->is_logged_in()) {
            $this->load->view('navigation',array('username' => $this->session->username));
            $this->load->view('home',array('username' => $this->session->username));
        }
        else {
            $this->load->view('login');
        }
    }
    //An API endpoint to retrieve posts from users being followed.
    public function followingposts_get(){
        if ($this->UserModelFile->is_logged_in()) {
            $username = $this->get('username');
            $result=$this->PostModelFile->getPostsofFollowing($username);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
    //An API endpoint to retrieve comments on posts.
    public function comments_get(){
        if ($this->UserModelFile->is_logged_in()) {
            $postid = $this->get('postid');
            $result=$this->PostModelFile->getComments($postid);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
    //A POST API request to add comments.
    public function comments_post(){
        if ($this->UserModelFile->is_logged_in()) {
            $username = $this->session->username;
            $postid = $this->post('postid');
            $comment = $this->post('comment');
            $result=$this->PostModelFile->addComments($postid, $comment, $username);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
    //An API endpoint to check if a user has already liked a post.
    public function checklikes_get(){
        if ($this->UserModelFile->is_logged_in()) {
            $username = $this->session->username;
            $postid = $this->get('postid');
            $result=$this->PostModelFile->checklikes($username, $postid);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
    //POST requests to like posts.
    public function like_post(){
        if ($this->UserModelFile->is_logged_in()) {
            $username = $this->session->username;
            $username = $this->post('username');
            $postid = $this->post('postid');
            $result=$this->PostModelFile->likepost($username, $postid);
            $this->response($result); 
        }
        else {
            $this->load->view('login');
        }
    }
    
}