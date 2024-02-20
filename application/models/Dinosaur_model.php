

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dinosaur_model extends CI_Model {

    // Define an array to store period information
    private $periods = array(
        'Triassic' => 'Plesiosaurs',
        'Jurassic' => 'Tyrannosaurus Rex',
        // Add more periods and corresponding dinosaurs as needed
    );

    public function get_period_info($period) {
        // Retrieve information about the specified period
        return isset($this->periods[$period]) ? $this->periods[$period] : 'Period not found';
    }
}