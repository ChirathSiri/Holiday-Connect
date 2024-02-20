<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function view($students_id)
	{
        $student_details = array(
            'name'  => 'chirath',
            'age'   => 17,
            'grade' => 5
        );

        $data['student'] = $student_details;

	
        $this->load->view('student_details',$data);

        $this->load->view('book',array('title' => 'PHP for Experts','author' => 'Dr X'));
	}

}