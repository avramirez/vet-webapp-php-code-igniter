<?php
	class Signin extends CI_Controller{
		public function __construct()
		{
		        parent::__construct();
		        // Your own constructor code
		        $this->load->library('session');

		}
		public function index(){
			if($this->session->userdata('user_objectId')){
				redirect("/user");
			}else{
				$data['stylesheets'] =array('0'=>'signin.css');
				$data['show_navbar'] ="false";
				$data['content_navbar'] = $this->load->view('layout_navbar','',true);
				$data['content_body'] = $this->load->view('sign_in','',true);
				$this->load->view("layout",$data);
			}
		}

	}
?>