<?php
	class Admin extends CI_Controller{
		public function __construct()
		{
		        parent::__construct();
		        // Your own constructor code
		        $this->load->library('session');

		}
		public function index(){
			if($this->session->userdata('admin_objectId')){
				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('admin_navbar','',true);

				$query = $this->db->query("SELECT * FROM users");

				$usersData['users'] = $query->result_array();

				$data['content_body'] = $this->load->view('admin_homepage',$usersData,true);
				
				$this->load->view("layout",$data);

			}else{
				redirect("/");
			}
		}

		public function manageReservation(){
			if($this->session->userdata('admin_objectId')){
				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('admin_navbar','',true);

				$query = $this->db->query("SELECT 
					ur.objectId as reservationobjectId,
					svs.objectId as serviceObjectId,
					u.objectId as usersObjectId,
					u.username,
					u.email,
					u.first_name,
					u.last_name,
					svs.service_name,
					ur.reserveDate,
					ur.reserveTime,
					svs.price 
					FROM users_reservation ur 
					INNER JOIN services svs ON ur.serviceId = svs.objectId 
					INNER JOIN users u ON ur.userId = u.objectId;");

				$usersData['reservations'] = $query->result_array();

				$data['content_body'] = $this->load->view('admin_reservation',$usersData,true);
				
				$this->load->view("layout",$data);

			}else{
				redirect("/");
			}
		}

		public function addReservation(){

		}

		public function addUser(){
			$this->load->library('encrypt');

			$inputEmail = $this->input->post("inputEmail");
			$inputPassword = $this->input->post("inputPassword");
			$inputPassword = $hash = $this->encrypt->sha1($inputPassword);
			$username = $this->input->post("username");
			$firstName = $this->input->post("firstName");
			$lastName = $this->input->post("lastName");
			$userLevel = $this->input->post("userLevel");


			if($inputEmail){
				$query = $this->db->query("INSERT INTO `vet_app`.`users` VALUES (NULL,'".$username."', '".$inputPassword."', '".$firstName."', '".$lastName."','".$inputEmail."',".$userLevel.");");

				if ($this->db->affected_rows() > 0)
				{
					set_status_header((int)200);
				}else{
					set_status_header((int)400);
				}
			}else{
					set_status_header((int)400);
			}
		}

		public function updateUser(){
			$this->load->library('encrypt');

			$inputEmail = $this->input->post("inputEmailUpdate");
			$username = $this->input->post("usernameUpdate");
			$firstName = $this->input->post("firstNameUpdate");
			$lastName = $this->input->post("lastNameUpdate");
			$userLevel = $this->input->post("userLevelUpdate");
			$userObjectIdUpdate = $this->input->post("userObjectIdUpdate");


			if($inputEmail){
				$query = $this->db->query("UPDATE vet_app.users SET username='".$username."',first_name ='".$firstName."',last_name='".$lastName."', email='".$inputEmail."',user_level=".$userLevel." WHERE objectId='".$userObjectIdUpdate."';");

				if ($this->db->affected_rows() > 0)
				{
					set_status_header((int)200);
				}else{
					set_status_header((int)200);
				}
			}else{
					set_status_header((int)400);
			}
		}

		public function deleteUser(){
			$userObjectId=$this->input->post("userObjectId");
			$query = $this->db->query("DELETE FROM vet_app.users WHERE users.objectId = ".$userObjectId.";");

				if ($this->db->affected_rows() > 0)
				{
					set_status_header((int)200); 
				}else{
					set_status_header((int)500); 
				}
		}
	}
?>
