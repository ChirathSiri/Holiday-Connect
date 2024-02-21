<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moviemodel extends CI_Model{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function get_movies_by_genre($genre){
        $this->db->select('*');
        $this->db->from('films');
        $this->db->where('genre',$genre);
        $query  = $this->db->get();

        return $query->result_array();
    }

    public function get_all_movies(){
        $this->db->select('*');
        $this->db->from('films');
        $query  = $this->db->get();

        return $query->result_array();
    }
}