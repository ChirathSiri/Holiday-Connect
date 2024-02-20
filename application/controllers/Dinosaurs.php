<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dinosaurs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the model
        $this->load->model('dinosaur_model');
    }

    public function periods() {
        // Load the view containing links to periods
        $this->load->view('period_links');
    }

    public function getinfo($period) {
        // Get information about the specified period from the model
        $period_info = $this->dinosaur_model->get_period_info($period);
        // Pass the period information to the view
        $data['period_info'] = $period_info;
        $this->load->view('period_info', $data);
    }
}