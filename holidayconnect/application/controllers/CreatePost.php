<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class CreatePost extends \Restserver\Libraries\REST_Controller {
	
	function __construct() {
        parent::__construct();
		$this->load->model('UserModelFile');
        $this->load->model('PostModelFile');

        Header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *');
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); 
    }
    //Set up routes to render the create post view.
    public function index_get(){
        if ($this->UserModelFile->is_logged_in()) {
            $this->load->view('navigation',array('username' => $this->session->username));
            $this->load->view('createpost');
        }
        else {
            $this->load->view('login');
        }
    }
    //Save the post image in the designated folder.
    public function store_post() {
        if ($this->UserModelFile->is_logged_in()) {
            $config['upload_path'] = "./images/userposts/";//path
            $config['allowed_types'] = 'gif|jpg|png';//file types allowed
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('result'=>'failed','error' => $this->upload->display_errors());
                $this->response($error);
            } else {
                $data = array('result'=>'done','image_metadata' => $this->upload->data());
                $this->response($data);    
            }
            }
        else {
            $this->load->view('login');
        }
    }
    //Save the profile picture image in the designated folder.
    public function profpic_post() {
        if ($this->UserModelFile->is_logged_in()) {
            $config['upload_path'] = "./images/profilepics/";
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $error = array('result'=>'failed','error' => $this->upload->display_errors());
                $this->response($error);
            } else {
                $data = array('result'=>'done','image_metadata' => $this->upload->data());
                $this->response($data);    
            }
            }
        else {
            $this->load->view('login');
        }
    }
    //A POST request to create a new post.
    public function create_post() {
        if ($this->UserModelFile->is_logged_in()) {
            $username = $this->session->username;
            $locationid = $this->post('locationid');
            $postImage = $this->post('postImage');
            $caption = $this->post('caption');
            $result = $this->PostModelFile->createPost($username, $locationid, $postImage, $caption);

            $this->response($result); 
            if ($result) {
                $this->response(array('result' => 'done'));
            } else {
                $this->response(array('result' => 'failed'));
            }
        }
        else {
            $this->load->view('login');
        }
    }
    //An API endpoint to retrieve all posts from a specific user.
    public function userposts_get(){
        $username = $this->get('username');
        $result = $this->PostModelFile->getPostsfromUsername($username);
        $this->response($result);
    }
    public function location_get() {
        //The action retrieves all locations.
        if($this->get('action') == 'all') {
            $locations = $this->PostModelFile->getLocations();
            if ($locations) {
                $this->response($locations);
            } else {
                $this->response(NULL);
            } 
        }
        //The action retrieves the post by its ID.
        if($this->get('action') == 'id') {
            $locationid = $this->get('locationid');
            $locations = $this->PostModelFile->getLocationbyId($locationid);
            $this->response($locations);
        }
    }
    //Retrieve the location view.
     public function locations_get() {
        if ($this->UserModelFile->is_logged_in()) {
            $locationid = $this->get('locationid');
            $this->load->view('navigation',array('username' => $this->session->username));
            $this->load->view('locations',array('locationid' => $locationid));
        }
        else {
            $this->load->view('login');
        } 
    }
    public function post_get() {
        if ($this->UserModelFile->is_logged_in()) {
            $postid = $this->get('postid');
            //If the action is "view", retrieve post details based on its ID.
            if($this->get('action') == 'view') {
                $result = $this->PostModelFile->postfromid($postid);
                $this->response($result);
            }
            //Otherwise, load the post view.
            else{
                $this->load->view('navigation',array('username' => $this->session->username));
                $this->load->view('post',array('postid' => $postid,'username' => $this->session->username));
            }
        }
        else {
            $this->load->view('login');
        } 
    }
    //An API endpoint to retrieve posts from a specified location.
    public function locationposts_get(){
        if ($this->UserModelFile->is_logged_in()) {
            $locationid = $this->get('locationid');
            $result = $this->PostModelFile->postsFromLocation($locationid);
            $this->response($result);
        }
        else {
            $this->load->view('login');
        } 
    }
    //An API endpoint to retrieve the like count.
    public function likecount_get(){
        if ($this->UserModelFile->is_logged_in()) {
            $postid = $this->get('postid');
            $result = $this->PostModelFile->likeCount($postid);
            $this->response($result);
        }
        else {
            $this->load->view('login');
        }
    }
}