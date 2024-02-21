<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movies extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('moviemodel');
    }

    public function index(){
        $this->load->view('movie_search');
    }

    public function search(){
        $genre = $this->input->post('genre');

        $movies = $this->moviemodel->get_movies_by_genre('$genre');

        $data['movies'] = $movies;
        $this->load->view('saerch_result',$data);
    }

    public function allmoviews(){
        $movies = $this->moviemodel->get_all_movies();
        $data['movies'] = $movies;
        $this->load->view('all_movies',$data);
    }
}