<?php
	class User extends CI_Controller{
		public function __construct()
		{
		        parent::__construct();
		        // Your own constructor code
		        $this->load->library('session');

		}
		public function index(){
			if($this->session->userdata('user_objectId')){
				
				$query = $this->db->query("SELECT * FROM services;");	
				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('user_navbar','',true);

				$servicesData['services'] = $query->result_array();

				$data['content_body'] = $this->load->view('user_homepage',$servicesData,true);
				

				$this->load->view("layout",$data);
			}else{
				redirect("/");
			}

		}
		public function signIn(){

		}
		public function postSignIn(){	

			$this->load->library('encrypt');

			$email = $this->input->post("userEmail");
			$password = $this->input->post("userPassword");
			$password =  $hash = $this->encrypt->sha1($password);

			$query = $this->db->query("SELECT objectId from users where password='".$password."' AND email='".$email."';");
			if ($query->num_rows() > 0)
			{
				 $row = $query->row();

			  $this->session->set_userdata('user_objectId',''.$row->objectId.'');

			  redirect("user");
			}else{
				 $this->output->append_output("Wrong Username or Password");
			}
		}
}

?>
