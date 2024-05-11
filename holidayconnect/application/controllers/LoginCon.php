<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class LoginCon extends \Restserver\Libraries\REST_Controller {
	
	function __construct() {
        parent::__construct();
		$this->load->model('UserModelFile');

        Header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *');
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); 
    }
    
    // Display the login interface
    public function index_get(){
        $this->load->view('login');
    }

    // Display the signup interface
    public function signup_get(){
        $this->load->view('signup');
    }

    public function login_get(){
        // Show login with an error message if the provided data is invalid
        if (isset($this->session->login_error) && $this->session->login_error == True) {
            $this->session->unset_userdata('login_error');
            $this->load->view('login',
                              array('login_error_msg' => "Invalid Username or Password. Try Again !"));
        }
        else {
            $this->load->view('login');
        }
    }
    // Update the session status to logged_out by setting logged_in to false
    public function logout_get(){
            $this->session->is_logged_in = False;
            $this->login_get();
    }

    // Display the userprofile interface
    public function userprofile_get(){
        if ($this->UserModelFile->is_logged_in()) {
            $username = $this->get('username');
            $this->load->view('navigation',array('username' => $this->session->username));
            $this->load->view('userprofile',array('username' => $username));
        }
        else {
            $this->load->view('login');
        }
    }
    
    // Endpoint to retrieve all users from the API
    public function user_get(){
        $result = $this->UserModelFile->getUsers();
        $this->response($result); 
    }

    public function user_post() {
        // If the action is "signup", initiate user action.
        if($this->get('action') == 'signup') {
            $username = $this->post('username');
            $password = $this->post('password');
            $email = $this->post('email');
            $name = $this->post('name');
            $result = $this->UserModelFile->create($username, $password, $email, $name);
            if ($result === FALSE) {
                $this->response(array('result' => 'failed'));
            } else {
                $this->response(array('result' => 'success'));
            } 
        
        // If the action is "login", verify the data and include the user in the session.
        } else if($this->get('action') == 'login') {
            $username = $this->post('username');
            $password = $this->post('password');

            $result = $this->UserModelFile->login($username,$password);

            if ($result === false) {
                $this->session->login_error = True;
                $this->response(array('result' => 'failed'));
            }
            else {
                $this->session->is_logged_in = true;
                $this->session->username = $username;
                $this->response(array('result' => 'success'));
            }
        // If the action is "checker", verify whether the user is already present in the database.
        }else if($this->get('action') == 'checkuser') {
            $username = $this->post('username');
            $result = $this->UserModelFile->checkUser($username);
            $this->response($result);                
        }

        // If the action is "password-reset", modify the user's password.
        else if($this->get('action') == 'passwordreset') {
            $username = $this->post('username');
            $password = $this->post('password');
            $result=$this->UserModelFile->passwordreset($username, $password);
            if ($result) {
                if ($this->UserModelFile->is_logged_in()){
                    $this->response(array('result' => 'logged'));
                }
                else{
                    $this->response(array('result' => 'success'));
                }
            }
            else {
                $this->response(array('result' => 'failed'));
            }            
        }

        // If the action is "search user", retrieve user details.
        else if($this->get('action') == 'searchuser') {
            if ($this->UserModelFile->is_logged_in()) {
                $username = $this->post('username');
                $result=$this->UserModelFile->searchUser($username);
                $this->response($result); 
            }
            else {
                $this->load->view('login');
            }      
        }        
    }

    //Display password reset interface
    public function passwordreset_get(){
        $this->load->view('passwordreset');
    }

    // Endpoint to fetch details for the specified user from the API
    public function userdetails_get() {
        if ($this->UserModelFile->is_logged_in()) {
            $username = $this->get('username');
            $userlist = $this->UserModelFile->getUser($username);
            if ($userlist) {
                $this->response($userlist);
            } else {
                $this->response(NULL);
            }  
        }
        else {
            $this->load->view('login');
        } 
    }

    // Update user details using a POST request.
    public function editprofile_put(){
        if ($this->UserModelFile->is_logged_in()) {
            $username = $this->put('username');
            $bio = $this->put('bio');
            $name = $this->put('name');
            $email = $this->put('email');
            $userimage = $this->put('userimage');
            $result=$this->UserModelFile->editprofile($username, $bio, $name, $email, $userimage);
            if ($result) {
                $this->response(array('result' => 'done'));
            }
            else {
                $this->response(array('result' => 'fail'));
            }
        }
        else {
            $this->load->view('login');
        } 
    }
}