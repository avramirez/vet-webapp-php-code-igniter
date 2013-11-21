<?php
	class Home extends CI_Controller{
		public function __construct()
		{
		        parent::__construct();
		        // Your own constructor code

		}
		public function index(){
			$name ="Andrew";
			$build = "huge";

			$data['name'] = $name;
			$data['build'] = $build;

			$this->load->view("home",$data);
		}

	}
?>