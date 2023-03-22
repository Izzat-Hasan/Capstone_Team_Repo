<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      $data = [
        'title' => 'Homeless Shelters',
        'description' => 'This will be the landing page (main page) of the website. We need to make this page related to our project. Talk about this in the meeting'
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'We are using this app to learn about PHP coding with databases.'
      ];

      $this->view('pages/about', $data);
    }
  }