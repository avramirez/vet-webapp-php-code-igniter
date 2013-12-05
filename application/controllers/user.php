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

			$query = $this->db->query("SELECT objectId,user_level from users where password='".$password."' AND email='".$email."';");
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				

				if($row->user_level == 1){
					$this->session->set_userdata('user_objectId',''.$row->objectId.'');	
				}else if($row->user_level == 2){
					$this->session->set_userdata('admin_objectId',''.$row->objectId.'');	
				}
				
			  	
			  	set_status_header((int)200);
			}else{
				set_status_header((int)401);
			}
		}

		public function addReservation(){
			if($this->session->userdata('user_objectId')){
			$reserveDate= $this->input->post("reserveDate");
			$reserveTime= $this->input->post("reserveTime");
			$reserveDateTime = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reserveDate.' '.$reserveTime.'')));
			$serviceId =$this->input->post("serviceId");
			$userId = $this->session->userdata('user_objectId');
	
				$query = $this->db->query("INSERT INTO `vet_app`.`users_reservation` 
					VALUES (NULL,'".$serviceId."',
						'".$userId."',
						'".$reserveDate."',
						'".$reserveTime."',
						'".$reserveDateTime."',
						0);");

				if ($this->db->affected_rows() > 0)
				{
					set_status_header((int)200); 
				}else{
					set_status_header((int)500); 
				}
			}
			 
		}
		public function updateReservation(){
			if($this->session->userdata('user_objectId')){
			$reserveDate= $this->input->post("reserveDate");
			$reserveTime= $this->input->post("reserveTime");
			$reserveDateTime = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reserveDate.' '.$reserveTime.'')));
			$serviceId =$this->input->post("serviceId");
			$userId = $this->session->userdata('user_objectId');
	
				$query = $this->db->query("UPDATE  vet_app.users_reservation 
					SET  reserveDate= '".$reserveDate."',
					reserveTime='".$reserveTime."',
					reserveDateTime='".$reserveDateTime."'  
					WHERE users_reservation.objectId =".$serviceId.";");

				if ($this->db->affected_rows() > 0)
				{
					set_status_header((int)200); 
				}else{
					set_status_header((int)500); 
				}
			}
			 
		}

		public function deleteReservation(){
			if($this->session->userdata('user_objectId')){
				$serviceId =$this->input->post("serviceId");

				$query = $this->db->query("DELETE FROM vet_app.users_reservation WHERE users_reservation.objectId = ".$serviceId.";");

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

				$query = $this->db->query("SELECT ur.objectId as reservationobjectId,svs.objectId as serviceObjectId,svs.service_name,ur.reserveDate,ur.reserveTime,svs.price FROM users_reservation ur INNER JOIN services svs ON ur.serviceId = svs.objectId  WHERE ur.userId='".$userId."';");	
	
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

		public function order(){
			if($this->session->userdata('user_objectId')){
				
				$userId = $this->session->userdata('user_objectId');

				$query = $this->db->query("SELECT * from products LIMIT 0 , 2000;");	
	
				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('user_navbar','',true);

				$servicesData['list_of_poducts'] = $query->result_array();

				$data['content_body'] = $this->load->view('user_order',$servicesData,true);
				

				$this->load->view("layout",$data);
			}else{
				redirect("/");
			}

		}

		public function addOrder(){
			if($this->session->userdata('user_objectId')){
				
				$userId = $this->session->userdata('user_objectId');
				$productId=$this->input->post('productId');
				$productAmount=$this->input->post('productAmount');
				$totalPrice=$this->input->post('totalPrice');

				$query = $this->db->query("INSERT INTO `vet_app`.`users_order` VALUES (NULL,'".$productId."','".$userId."','".$productAmount."','".$totalPrice."');");
				$updateProduct = $this->db->simple_query("UPDATE vet_app.products set product_quantity = (CASE WHEN ((product_quantity - ".$productAmount.") < 0) THEN 0 ELSE (product_quantity - ".$productAmount.") END) WHERE objectId='".$productId."';");

				if ($this->db->affected_rows() > 0 && updateProduct)
				{
					set_status_header((int)200); 
				}else{
					set_status_header((int)500); 
				}
				
			}else{
				redirect("/");
			}

		}

		public function updateOrder(){
			if($this->session->userdata('user_objectId')){
				$orderObjectId= $this->input->post("orderObjectId");
				$newAmount= $this->input->post("newAmount");
				$newTotalPrice =$this->input->post("newTotalPrice");
				$incremental=$this->input->post("incremental");
				$productId=$this->input->post("productId");
				$userId = $this->session->userdata('user_objectId');
	
				$query = $this->db->query("UPDATE  vet_app.users_order SET  productAmount= '".$newAmount."',totalPrice='".$newTotalPrice."' WHERE users_order.objectId =".$orderObjectId.";");
				$updateProduct = $this->db->simple_query("UPDATE vet_app.products set 
					product_quantity = (product_quantity + ".$incremental.") 
					WHERE objectId='".$productId."';");



				if ($this->db->affected_rows() > 0)
				{
					set_status_header((int)200); 
				}else{
					set_status_header((int)500); 
				}
			}
			 
		}

		public function deleteUserOrder(){
			if($this->session->userdata('user_objectId')){

				$orderObjectid =$this->input->post("orderObjectId");
				$incremental=$this->input->post("incremental");
				$productId=$this->input->post("productId");

				$query = $this->db->query("DELETE FROM vet_app.users_order WHERE users_order.objectId = ".$orderObjectid.";");
				$updateProduct = $this->db->simple_query("UPDATE vet_app.products set 
					product_quantity = (product_quantity + ".$incremental.") 
					WHERE objectId='".$productId."';");

				if ($this->db->affected_rows() > 0)
				{
					set_status_header((int)200); 
				}else{
					set_status_header((int)500); 
				}
			}
			 
		}

		public function viewCart(){
			if($this->session->userdata('user_objectId')){
				
				$userId = $this->session->userdata('user_objectId');

				$query = $this->db->query("SELECT uo.objectId as orderObjectid, prod.objectId as productObjectId, uo.productAmount, uo.totalPrice, prod.product_name,prod.product_price
				 from vet_app.users_order uo 
				 INNER JOIN  vet_app.products prod ON uo.productId = prod.objectId 
				 WHERE uo.usersId='".$userId."' 
				 LIMIT 0 , 2000;");	
	
				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('user_navbar','',true);

				$servicesData['list_of_orders'] = $query->result_array();

				$data['content_body'] = $this->load->view('user_viewcart',$servicesData,true);
				

				$this->load->view("layout",$data);
			}else{
				redirect("/");
			}

		}

		public function logout(){
			$this->session->sess_destroy();
			redirect("/");
		}
}

?>
