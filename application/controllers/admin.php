<?php
	class Admin extends CI_Controller{
		public function __construct()
		{
		        parent::__construct();
		        // Your own constructor code
		        $this->load->library('session');
		}

		private function checkAllowed($notAllowedLevels){
					$userLevel = $this->session->userdata('user_level');
					if (in_array($userLevel, $notAllowedLevels)) {
					    if($userLevel == 3){
					    	redirect("admin");
					    }else if ($userLevel == 4) {
					    	redirect("admin/manageReservation"); 
					    }
					}
				}
		public function index(){
			if($this->session->userdata('admin_objectId')){
				$this->checkAllowed([4]);
				
				$navbarData['userLevel'] = $this->session->userdata('user_level');

				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('admin_navbar',$navbarData,true);
				$query = $this->db->query("SELECT * FROM users");
				$usersData['users'] = $query->result_array();

				$data['content_body'] = $this->load->view('admin_homepage',$usersData,true);
				
				$this->load->view("layout",$data);

			}else{
				redirect("/");
			}
		}

		public function backup(){

			// Load the DB utility class
			$this->load->dbutil();

			// Backup your entire database and assign it to a variable
			$backup =& $this->dbutil->backup(); 

			// Load the file helper and write the file to your server
			$this->load->helper('file');
			write_file('/path/to/mybackup.gz', $backup); 

			// Load the download helper and send the file to your desktop
			$this->load->helper('download');
			force_download('mybackup.gz', $backup);
		}


		public function audit(){
			if($this->session->userdata('admin_objectId')){
				$this->checkAllowed([3,4]);
				
				$navbarData['userLevel'] = $this->session->userdata('user_level');

				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('admin_navbar',$navbarData,true);
				$query = $this->db->query("SELECT * FROM audit_trail 
					ORDER BY time DESC;");
				$usersData['audits'] = $query->result_array();

				$data['content_body'] = $this->load->view('admin_audit',$usersData,true);
				
				$this->load->view("layout",$data);

			}else{
				redirect("/");
			}
		}


		public function manageProducts()
		{
			if($this->session->userdata('admin_objectId')){
				$this->checkAllowed([3,4]);
				
				$navbarData['userLevel'] = $this->session->userdata('user_level');

				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('admin_navbar',$navbarData,true);

				$query = $this->db->query("SELECT * FROM products;");
				
				$usersData['products'] = $query->result_array();

				$data['content_body'] = $this->load->view('admin_products',$usersData,true);
				
				$this->load->view("layout",$data);

			}else{
				redirect("/");
			}
		}
		
		public function billing()
		{
			if($this->session->userdata('admin_objectId')){
				$this->checkAllowed([3,4]);
				
				$navbarData['userLevel'] = $this->session->userdata('user_level');

				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('admin_navbar',$navbarData,true);

				$customer = $this->db->query("SELECT * FROM users WHERE user_level=1;");
				$billingData['customers'] = $customer->result_array();

				$doc = $this->db->query("SELECT * FROM doctors");
				$billingData['docs'] = $doc->result_array();

				$surgery = $this->db->query("SELECT * FROM services WHERE active=3;");
				$billingData['surgerys'] = $surgery->result_array();

				$data['content_body'] = $this->load->view('admin_billing',$billingData,true);
				
				$this->load->view("layout",$data);

			}else{
				redirect("/");
			}
		}

		public function generateBilling(){
			if($this->session->userdata('admin_objectId')){
				$this->load->helper(array('dompdf', 'file'));

				
				$reportMonthFrom=$this->input->post("reportMonthFrom");
				$reportYearFrom=$this->input->post("reportYearFrom");
				$reportDayFrom=$this->input->post("reportDayFrom");
				$reportMonthTo=$this->input->post("reportMonthTo");
				$reportYearTo=$this->input->post("reportYearTo");
				$reportDayTo=$this->input->post("reportDayTo");

				$customerId=$this->input->post("customer");
				$petName=$this->input->post("petName");
				$surgeryId=$this->input->post("surgery");
				$doctorId=$this->input->post("doctor");
				

				$reportDateFrom = date('Y-m-d', strtotime(str_replace('-', '/', ''.$reportMonthFrom.'/'.$reportDayFrom.'/'.$reportYearFrom.'')));
				$reportDateto = date('Y-m-d', strtotime(str_replace('-', '/', ''.$reportMonthTo.'/'.$reportDayTo.'/'.$reportYearTo.'')));
				
				$timeDiff = abs(strtotime(str_replace('-', '/', ''.$reportMonthTo.'/'.$reportDayTo.'/'.$reportYearTo.'')) -strtotime(str_replace('-', '/', ''.$reportMonthFrom.'/'.$reportDayFrom.'/'.$reportYearFrom.'')));

				$numDays = ($timeDiff/86400) + 1; 

				

     			$billingData['daysNumber']=$numDays;
     			$billingData['petName']=$petName;

				$customer = $this->db->query("SELECT * FROM users WHERE objectId='".$customerId."';");
				$billingData['customers'] = $customer->result_array();

				$doc = $this->db->query("SELECT * FROM doctors WHERE objectId='".$doctorId."';");
				$billingData['docs'] = $doc->result_array();

				$surgery = $this->db->query("SELECT * FROM services WHERE objectId='".$surgeryId."';");
				$billingData['surgerys'] = $surgery->result_array();

				
				$billingData['reportDateFrom']=$reportDateFrom;
				$billingData['reportDateto']=$reportDateto;
				

			    $html =$this->load->view('admin_generated_billing',$billingData,true);
			    // $this->output->append_output($html);
			    pdf_create($html, 'salesReport');

			}else{
				redirect("/");
			}
		}

		public function sales()
		{
			if($this->session->userdata('admin_objectId')){
				$this->checkAllowed([3,4]);
				
				$navbarData['userLevel'] = $this->session->userdata('user_level');

				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('admin_navbar',$navbarData,true);

				// $query = $this->db->query("SELECT * FROM products;");
				
				// $usersData['products'] = $query->result_array();

				$data['content_body'] = $this->load->view('admin_sales','',true);
				
				$this->load->view("layout",$data);

			}else{
				redirect("/");
			}
		}
		
		public function generateSalesReport(){
			if($this->session->userdata('admin_objectId')){
				$this->load->helper(array('dompdf', 'file'));

				
				$reportMonthFrom=$this->input->post("reportMonthFrom");
				$reportYearFrom=$this->input->post("reportYearFrom");
				$reportMonthTo=$this->input->post("reportMonthTo");
				$reportYearTo=$this->input->post("reportYearTo");
				$reportMode=$this->input->post("reportMode");

				$reportDateFrom = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reportMonthFrom.'/01/'.$reportYearFrom.'')));
				$reportDateto = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reportMonthTo.'/01/'.$reportYearTo.'')));
				$reportDateto = date_format(date_modify(new DateTime($reportDateto),'last day of  this month'), 'Y-m-d H:i:s');

				//NEED TO OPTIMIZE :P
				if($reportMode =="Daily"){
				$query = $this->db->query("SELECT SUM(allSales.gross) as saleGross,allSales.saleDate
											from (
											SELECT SUM(totalPrice)as gross,uo.orderDate as saleDate FROM users_order uo WHERE uo.active=0 GROUP BY day(uo.orderDate)
											UNION ALL
											SELECT SUM(price) as gross, ur.reserveDateTime as saleDate from users_reservation ur INNER JOIN services serv ON serv.objectId = ur.serviceId WHERE ur.confirmed=1 GROUP BY day(ur.reserveDateTime)) as allSales 
											WHERE allSales.saleDate >= '".$reportDateFrom."' AND allSales.saleDate <='".$reportDateto."' 
											GROUP BY day(allSales.saleDate);");

				}else if($reportMode =="Weekly"){
				$query = $this->db->query("SELECT SUM(allSales.gross) as saleGross,week(allSales.saleDate) as saleDate, allSales.saleDate as rawSaleDate 
											from (
											SELECT SUM(totalPrice)as gross,uo.orderDate as saleDate FROM users_order uo 
											WHERE uo.orderDate >= '".$reportDateFrom."' AND uo.orderDate <='".$reportDateto."' 
											AND uo.active=0 GROUP BY week(uo.orderDate)
											UNION ALL
											SELECT SUM(price) as gross, ur.reserveDateTime as saleDate from users_reservation ur INNER JOIN services serv ON serv.objectId = ur.serviceId 
											WHERE ur.reserveDateTime >= '".$reportDateFrom."' AND ur.reserveDateTime <='".$reportDateto."' 
											AND ur.confirmed=1 GROUP BY week(ur.reserveDateTime)) as allSales 
											GROUP BY week(allSales.saleDate);");

				}

				$allItems= $this->db->query("SELECT * from (SELECT uo.orderDate as saleDate, 
											prod.product_name as itemName,
											uo.productAmount as itemQuantity,
											prod.product_price as itemPrice,
											uo.totalPrice as itemTotalPrice,
											WEEK(uo.orderDate) as itemWeek,
											YEAR(uo.orderDate) as itemYear
											FROM users_order uo 
											INNER JOIN products as prod ON uo.productId = prod.objectId
											WHERE uo.orderDate >= '".$reportDateFrom."' AND uo.orderDate <='".$reportDateto."'
											AND uo.active=0 
												UNION ALL 
													SELECT ur.reserveDateTime as saleDate, 
													serv.service_name as itemName,
													1 as itemQuantity,
													serv.price as itemPrice, 
													serv.price as itemTotalPrice,
													WEEK(ur.reserveDateTime) as itemWeek,
													YEAR(ur.reserveDateTime) as itemYear
													from users_reservation ur 
													INNER JOIN services serv ON serv.objectId = ur.serviceId 
													WHERE ur.reserveDateTime >= '".$reportDateFrom."' AND ur.reserveDateTime <='".$reportDateto."' 
													AND ur.confirmed=1) allItems
										ORDER by allItems.saleDate ASC;");
				$salesReport['allItems'] = $allItems->result_array();

				$salesReport['sales'] = $query->result_array();
				$salesReport['reportMode']=$reportMode;
				
				

				$salesReport['reportDateFrom']=$reportDateFrom;
				$salesReport['reportDateto']=$reportDateto;
				

			     $html =$this->load->view('admin_generated_sales_report',$salesReport,true);
			    // $this->output->append_output($html);
			    pdf_create($html, 'salesReport');

			}else{
				redirect("/");
			}
		}

		public function userorder(){
			

			if($this->session->userdata('admin_objectId')){
				$this->checkAllowed([4]);
				
				$navbarData['userLevel'] = $this->session->userdata('user_level');

				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('admin_navbar',$navbarData,true);

				$data['content_body'] = $this->load->view('admin_order','',true);
				
				$this->load->view("layout",$data);

			}else{
				redirect("/");
			}
		}

		public function searchUserOrder(){
			if($this->session->userdata('admin_objectId')){
				$inputEmail = $this->input->post('userEmailSearch');

				
				$userByEmail=$this->db->query("SELECT * FROM users where email='".$inputEmail."'");
				
				if($userByEmail->num_rows() > 0){
					$user = $userByEmail->row();
				
					// $query = $this->db->query("SELECT uo.objectId as orderObjectid, 
					// 	prod.objectId as productObjectId, 
					// 	uo.productAmount, 
					// 	uo.totalPrice, 
					// 	prod.product_name,
					// 	prod.product_price
					//  from vet_app.users_order uo 
					//  INNER JOIN  vet_app.products prod ON uo.productId = prod.objectId 
					//  WHERE uo.usersId='".$user->objectId."' 
					//  ORDER BY uo.orderDate DESC 
					//  LIMIT 0 , 2000;");

					$query = $this->db->query("SELECT batchOrderId,usersId,active from users_order 
						WHERE usersId='".$user->objectId."' 
						AND batchOrderId IS NOT NULL
						GROUP BY batchOrderId 
						ORDER BY orderDate DESC;");

					$ordersData['list_of_orders'] = $query->result_array();

					$this->load->view('admin_order_table',$ordersData);
				}
				

			}else{
				redirect("/");
			}
		}

		public function processOrder(){
			if($this->session->userdata('admin_objectId')){
				$usersId = $this->input->post('usersId');
				$batchOrderId = $this->input->post('batchOrderId');

				$query = $this->db->query("SELECT uo.objectId as orderObjectid, 
						prod.objectId as productObjectId,
						uo.usersId as usersObjectId,
						uo.batchOrderId, 
						uo.productAmount, 
						uo.totalPrice, 
						prod.product_name,
						prod.product_price
					 from vet_app.users_order uo 
					 INNER JOIN  vet_app.products prod ON uo.productId = prod.objectId 
					 WHERE uo.usersId='".$usersId."' 
					 AND uo.batchOrderId='".$batchOrderId."' 
					 ORDER BY uo.orderDate DESC 
					 LIMIT 0 , 2000;");

				$ordersData['list_of_orders'] = $query->result_array();
				$this->load->view('admin_process_order',$ordersData);

			}else{
				redirect("/");
			}
		}

		public function generateOrderReceipt(){
			if($this->session->userdata('admin_objectId')){

			$this->load->helper(array('dompdf', 'file'));

				$userId =$this->input->post('usersId');
				$batchOrderId =$this->input->post('batchOrderId');


				$query = $this->db->query("SELECT uo.objectId as orderObjectid, 
					prod.objectId as productObjectId, 
					ur.first_name,
					ur.last_name,
					uo.productAmount, 
					uo.totalPrice,
					prod.product_name,
					prod.product_price,
					uo.batchOrderId, 
					(SELECT SUM(uo.totalPrice) from vet_app.users_order uo 
				 WHERE uo.usersId='".$userId."' AND uo.batchOrderId IS NOT NULL) as totalAll 
				 from vet_app.users_order uo 
				 INNER JOIN  vet_app.products prod ON uo.productId = prod.objectId 
				 INNER JOIN  vet_app.users ur ON uo.usersId = ur.objectId 
				 WHERE uo.usersId='".$userId."' 
				 AND uo.batchOrderId='".$batchOrderId."' 
				 AND uo.batchOrderId IS NOT NULL 
				 ORDER BY orderDate DESC 
				 LIMIT 0 , 2000;");	
	
				$servicesData['list_of_orders'] = $query->result_array();

				$updateActive=$this->db->query("UPDATE users_order SET active=0 
					WHERE usersId=".$userId.";");				

				$html =$this->load->view('user_order_receipt_report',$servicesData,true);

				 // $this->output->append_output($html);

		    	pdf_create($html, 'order_receipt');
		    }else{
				redirect("/");
			}
		}

		public function confirmReservation(){
			if($this->session->userdata('admin_objectId')){

				$this->load->helper(array('dompdf', 'file'));

				
				$registrationId =$this->input->post('registrationId');


				$query = $this->db->query("SELECT * from users_reservation ur 
					INNER JOIN users us ON us.objectId = ur.userId 
					INNER JOIN services serv ON ur.serviceId = serv.objectId 
					WHERE ur.objectId='".$registrationId."';");	
	
				$servicesData['reservations'] = $query->result_array();

				$updateActive=$this->db->query("UPDATE users_reservation SET confirmed=1 
					WHERE  objectId='".$registrationId."';");				

				$html =$this->load->view('admin_reservation_receipt',$servicesData,true);

				 // $this->output->append_output($html);
 
		    	pdf_create($html, 'reservation_receipt');
		    	

			}else{
				redirect("/");
			}
		}

	


		public function approveReservation(){
			if($this->session->userdata('admin_objectId')){

				
				
				$registrationId =$this->input->post('registrationId');




				$updateActive=$this->db->query("UPDATE users_reservation SET confirmed=2 
					WHERE  objectId='".$registrationId."';");				

				redirect("/admin/manageReservation");


			}else{
				redirect("/");
			}
		}
		
		
		public function manageReservation(){
			if($this->session->userdata('admin_objectId')){

				$this->checkAllowed([3]);
				
				$navbarData['userLevel'] = $this->session->userdata('user_level');

				$data['stylesheets'] =array('jumbotron-narrow.css');
				$data['show_navbar'] ="true";
				$data['content_navbar'] = $this->load->view('admin_navbar',$navbarData,true);

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
					svs.price,
					ur.confirmed,
					ur.timestamp
					FROM users_reservation ur 
					INNER JOIN services svs ON ur.serviceId = svs.objectId 
					INNER JOIN users u ON ur.userId = u.objectId 
					ORDER BY ur.reserveDateTime DESC;");

				$services = $this->db->query("SELECT * FROM services where active=1;");	

				$usersData['reservations'] = $query->result_array();
				$usersData['serviceslist'] = $services->result_array();

				$data['content_body'] = $this->load->view('admin_reservation',$usersData,true);
				
				$this->load->view("layout",$data);

			}else{
				redirect("/");
			}
		}

		public function deleteAdminReservation(){
			if($this->session->userdata('admin_objectId')){
				$serviceId =$this->input->post("reservationObjecId");

				$query = $this->db->query("DELETE FROM vet_app.users_reservation WHERE users_reservation.objectId = ".$serviceId.";");

				if ($this->db->affected_rows() > 0)
				{
					set_status_header((int)200); 
				}else{
					set_status_header((int)400); 
				}
			}
		}

		public function addReservation(){
		if($this->session->userdata('admin_objectId')){
		 	$reserveDate= $this->input->post("reserveDate");
			$reserveTime= $this->input->post("reserveTime");
			$reserveDateTime = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reserveDate.' '.$reserveTime.'')));
			$serviceId =$this->input->post("serviceId");
			
	 		$inputEmail = $this->input->post("reservationUserEmail");
	 		
			$userByEmail=$this->db->query("SELECT * FROM users where email='".$inputEmail."'");
			
			$user = $userByEmail->row();

			$query = $this->db->query("INSERT INTO `vet_app`.`users_reservation` 
			VALUES (NULL,'".$serviceId."',
			'".$user->objectId."',
			'".$reserveDate."',
			'".$reserveTime."',
			'".$reserveDateTime."',
			0,NULL);");

			 	if ($this->db->affected_rows() > 0)
			 	{
			 		set_status_header((int)200); 
			 	}else{
			 		set_status_header((int)400); 
			 	}
			 }
		}

		public function editReservation(){
		if($this->session->userdata('admin_objectId')){
		 	$reserveDate= $this->input->post("reserveDate");
			$reserveTime= $this->input->post("reserveTime");
			$reserveDateTime = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reserveDate.' '.$reserveTime.'')));
			$serviceId =$this->input->post("serviceId");
			$reservationId =$this->input->post("reservationId");
			
	 		$inputEmail = $this->input->post("reservationUserEmail");
	 		
			$userByEmail=$this->db->query("SELECT * FROM users where email='".$inputEmail."'");
			
			$user = $userByEmail->row();

			$query = $this->db->query("UPDATE `vet_app`.`users_reservation` 
				SET serviceId='".$serviceId."',
				userId='".$user->objectId."',
				reserveDate='".$reserveDate."',
				reserveTime='".$reserveTime."',
				reserveDateTime='".$reserveDateTime."' 
				where objectId ='".$reservationId."';");

			 	if ($this->db->affected_rows() > 0)
			 	{
			 		set_status_header((int)200); 
			 	}else{
			 		set_status_header((int)200); 
			 	}
			 }
		}



		public function checkEmailExist(){
			$inputEmail = $this->input->post("userEmailCheck");
			$query=$this->db->query("SELECT  * FROM users where email='".$inputEmail."'");
			
			if($query->num_rows() > 0){
			 //$datauser['userobject']=$query->result_array();
			 set_status_header((int)200);
			}else{
			 set_status_header((int)400);
			}

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
				$query = $this->db->query("INSERT INTO `vet_app`.`users` VALUES (NULL,'".$username."', '".$inputPassword."', '".$firstName."', '".$lastName."','".$inputEmail."',".$userLevel.",NULL);");

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

		public function generateNewPassword(){
			$this->load->library('encrypt');
			$userObjectId=$this->input->post("userObjectId");
			$inputPassword = $this->input->post("inputPassword");
			$inputPassword = $hash = $this->encrypt->sha1($inputPassword);

			$query = $this->db->query("UPDATE vet_app.users 
				SET password = '".$inputPassword."' 
				WHERE users.objectId = ".$userObjectId.";");

				if ($this->db->affected_rows() > 0)
				{
					set_status_header((int)200); 
				}else{
					set_status_header((int)500); 
				}
		}

		public function generateUserPDF(){
			$this->load->helper(array('dompdf', 'file'));

			$reportMonthFrom=$this->input->post("reportMonthFrom");
			$reportYearFrom=$this->input->post("reportYearFrom");
			$reportMonthTo=$this->input->post("reportMonthTo");
			$reportYearTo=$this->input->post("reportYearTo");

			$reportDateFrom = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reportMonthFrom.'/01/'.$reportYearFrom.'')));
			$reportDateto = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reportMonthTo.'/01/'.$reportYearTo.'')));
			$reportDateto = date_format(date_modify(new DateTime($reportDateto),'last day of  this month'), 'Y-m-d H:i:s');

			$query = $this->db->query("SELECT * FROM users 
				WHERE createdAt >= '".$reportDateFrom."' 
				AND createdAt <='".$reportDateto."';");
			$usersData['users'] = $query->result_array();
			
			
			$usersData['reportDateFrom']=$reportDateFrom;
			$usersData['reportDateto']=$reportDateto;
			

		    $html =$this->load->view('admin_user_report',$usersData,true);
		    // $this->output->append_output($html);
		    pdf_create($html, 'userReport');
		}

		public function generateProductReport(){
			$this->load->helper(array('dompdf', 'file'));

			$reportMonthFrom=$this->input->post("reportMonthFrom");
			$reportYearFrom=$this->input->post("reportYearFrom");
			$reportMonthTo=$this->input->post("reportMonthTo");
			$reportYearTo=$this->input->post("reportYearTo");

			$reportDateFrom = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reportMonthFrom.'/01/'.$reportYearFrom.'')));
			$reportDateto = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reportMonthTo.'/01/'.$reportYearTo.'')));
			$reportDateto = date_format(date_modify(new DateTime($reportDateto),'last day of  this month'), 'Y-m-d H:i:s');


			// $query = $this->db->query("SELECT * FROM products 
			// 	WHERE createdAt >= '".$reportDateFrom."' 
			// 	AND createdAt <='".$reportDateto."';");

			// NOTE CHANGE THIS
			$query = $this->db->query("SELECT * FROM products;");

			$usersData['products'] = $query->result_array();
			
			
			$usersData['reportDateFrom']=$reportDateFrom;
			$usersData['reportDateto']=$reportDateto;
			

		    $html =$this->load->view('admin_products_report',$usersData,true);
		    // $this->output->append_output($html);
		    pdf_create($html, 'productReport');
		}


		public function generateReservationReport(){
			$this->load->helper(array('dompdf', 'file'));

			$reportMonthFrom=$this->input->post("reportMonthFrom");
			$reportYearFrom=$this->input->post("reportYearFrom");
			$reportMonthTo=$this->input->post("reportMonthTo");
			$reportYearTo=$this->input->post("reportYearTo");

			$reportDateFrom = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reportMonthFrom.'/01/'.$reportYearFrom.'')));
			$reportDateto = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', ''.$reportMonthTo.'/01/'.$reportYearTo.'')));
			$reportDateto = date_format(date_modify(new DateTime($reportDateto),'last day of  this month'), 'Y-m-d H:i:s');

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
					svs.price,
					ur.confirmed
					FROM users_reservation ur 
					INNER JOIN services svs ON ur.serviceId = svs.objectId 
					INNER JOIN users u ON ur.userId = u.objectId 
					WHERE ur.reserveDateTime >= '".$reportDateFrom."' 
					AND ur.reserveDateTime <='".$reportDateto."' 
					ORDER BY ur.reserveDateTime DESC;");

			
			$usersData['reservations'] = $query->result_array();
			
			
			$usersData['reportDateFrom']=$reportDateFrom;
			$usersData['reportDateto']=$reportDateto;
			

		    $html =$this->load->view('admin_reservation_report',$usersData,true);

		    
		    // $this->output->append_output($html);
		    
		    pdf_create($html, 'admin_reservation_report');
		    

		    // $this->output->set_header('Content-type: application/pdf');
		    // $this->output->set_header('Content-Disposition: attachment; filename="admin_reservation_report.pdf"');
		    // $data = pdf_create($html, '', false);
		    // 	$this->output->append_output($data);
		
		}
		
	}
?>
