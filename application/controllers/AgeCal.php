<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgeCal extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('age_model');
    }

    public function index(){
        $this->load->view('date_of_birth_form');
    }

    public function age_cal(){
        $dateOfBirth = $this->input->post('dob');
        $age = $this->age_model->age_cal($dateOfBirth);
        $data['age'] = $age;
        $this->load->view('age_result',$data);
    }
}