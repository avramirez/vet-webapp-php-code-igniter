<?php
	class Home extends CI_Controller{
		public function __construct()
		{
		        parent::__construct();
		        // Your own constructor code
		}
		public function index(){
			$this->load->view("home");
		}

	}
?>