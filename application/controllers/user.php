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

		public function addReservation(){
			if($this->session->userdata('user_objectId')){
			$reserveDate= $this->input->post("reserveDate");
			$reserveTime= $this->input->post("reserveTime");
			$serviceId =$this->input->post("serviceId");
			$userId = $this->session->userdata('user_objectId');
	
				$query = $this->db->query("INSERT INTO `vet_app`.`users_reservation` VALUES (NULL,'".$serviceId."','".$userId."','".$reserveDate."','".$reserveTime."');");

				if ($this->db->affected_rows() > 0)
				{
					set_status_header((int)200); 
				}else{
					set_status_header((int)500); 
				}
			}
			 
		}

		public function manageReservation(){
			if($this->session->userdata('user_objectId')){
				
				$userId = $this->session->userdata('user_objectId');

				$query = $this->db->query("SELECT * FROM users_reservation ur INNER JOIN services svs ON ur.serviceId = svs.objectId  WHERE ur.userId='".$userId."';");	
	
				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('user_navbar','',true);

				$servicesData['list_of_reservations'] = $query->result_array();

				$data['content_body'] = $this->load->view('user_manage_reservation',$servicesData,true);
				

				$this->load->view("layout",$data);
			}else{
				redirect("/");
			}

		}
}

?>
