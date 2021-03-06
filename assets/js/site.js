$(document).ready(function(){
	$("body").on("click",".addReservation",function(e){
		$("#myModal #myModalLabel").text($(this).parent().parent().children('.serviceTitle').text());
		$(".submitReservation").attr("data-objectId",$(this).attr("data-objectId"));
		$("#myModal").modal();
		$.ajax({
			url:"user/getPetName",
			success:function(data){
				$(".petNameUser").text(data);
			}
		});
	})
	$('#myModal').on('hidden.bs.modal', function () {
  		resetReservationModal("#myModal");
	})
	$("body").on("change",".reserveTimeSelect",function(e){
		if($(this).val() !=0){
			$(".reserveTime").text($(".reserveTimeSelect option:selected").text());
		}
	})
	$("#datepicker").datepicker({
		onSelect:function(date,obj){
			if($(".reserveDate").length){
				$(".reserveDate").text(date)
			}
		},
		minDate:'0'
	});

	jQuery.validator.addMethod("notEqual", function(value, element, param) {
  		var target = $(param);
			if ( this.settings.onfocusout ) {
				target.unbind(".validate-equalTo").bind("blur.validate-equalTo", function() {
					$(element).valid();
				});
			}
		return value.toLowerCase() !== target.val().toLowerCase();
	}, "Username must be different from Email");



	if($('#userManageReservation').length){

		$('.userNavbar li.navReserveManage').addClass('active');

		$("body").on("click",".editReservation",function(ccoie){
			$("#reserveDoctorSelect option[value='"+$(this).parent().parent().children('.doctorsId').val()+"']").attr("selected", "selected");
			$("#editReserveModal .doctorsIdEdit").text($(this).parent().parent().children('.doctorsId').text());
			$("#editReserveModal #myModalLabel").text($(this).parent().parent().children('.serviceTitle').text());
			$("#editReserveModal .reserveDate").text($(this).parent().parent().children('.serviceDate').text());
			$("#editReserveModal .reserveTime").text($(this).parent().parent().children('.serviceTime').text());
			$(".updateReservation").attr("data-objectId",$(this).attr("data-objectId"));
			$("#editReserveModal").modal();
		})

		$('#editReserveModal').on('hidden.bs.modal', function () {
	  		resetReservationModal("#editReserveModal");
		})

		$("body").on("click",".updateReservation",function(e){
			var doctorsId = parseInt($("#reserveDoctorSelect option:selected").val());
			if($(".reserveDate").text()!="" && $(".reserveTime").text() !="" && $("#reserveDoctorSelect").text()!="Choose Doctor"){
				$.ajax({
					method:"POST",
					async:true,
					data:{
						'reserveDate':$(".reserveDate").text(),
						'reserveTime':$(".reserveTime").text(),
						'serviceId':$(this).attr("data-objectId"),
						'doctorsId':doctorsId
					},
					url:"updateReservation",
					success:function(data,status,jqXHR){
						$('#editReserveModal').modal('hide');
						reloadUserManageReservationTable();
					}
				})
			}else{
				$('#editReserveModal .alert').show();
			}
		})

		$("body").on("click",".deleteReservation",function(e){

			$("#confirmationModal h5.message").text("Are you sure you want to delete "+$(this).parent().parent().children('.serviceTitle').text()+"?")
			$("#confirmationModal .confirmAction").attr("data-confirm","confirmDelete");
			$("#confirmationModal .confirmAction").attr("data-objectId",$(this).attr("data-objectId"));
			$("#confirmationModal").modal();
		})

		$("body").on("click","#confirmationModal .confirmAction",function(e){
			var $this = $(this);
			if($this.attr("data-confirm")=="confirmDelete"){
				deleteUserReserVation();
			}
			
		})

		function deleteUserReserVation(){
			$.ajax({
					method:"POST",
					async:true,
					data:{
						'serviceId':$("#confirmationModal .confirmAction").attr("data-objectId")
					},
					url:"deleteReservation",
					success:function(data,status,jqXHR){
						reloadUserManageReservationTable();
						$('#confirmationModal').modal('hide');
						$(".reservationAlert strong").text("Delete Success!");
						$(".reservationAlert").show();
					}
				})				
		}

	}else if($('#userReserve').length){
		$('.userNavbar li.navReserve').addClass('active');

			$("body").on("click",".submitReservation",function(e){
				if($(".reserveDate").text()!="" && $(".reserveTime").text() !="" && $("#reserveDoctorSelect").text()!="Choose Doctor"){
					var serviceId = $(this).attr("data-objectId");
					var doctorsId = parseInt($(".reserveDoctorSelect option:selected").val());
					console.log(doctorsId);
					$.ajax({
						method:"POST",
						async:false,
						data:{
							'reserveDate':$(".reserveDate").text(),
							'reserveTime':$(".reserveTime").text(),
							'serviceId':serviceId,
							'doctorsId':doctorsId
						},
						url:"user/checkReservationAvailable",
						success:function(data,status,jqXHR){
							$.ajax({
								method:"POST",
								async:false,
								data:{
									'reserveDate':$(".reserveDate").text(),
									'reserveTime':$(".reserveTime").text(),
									'serviceId':serviceId,
									'doctorsId':doctorsId
								},
								url:"user/addReservation",
								success:function(data,status,jqXHR){
									$('#myModal').modal('hide');
									$('.addSuccess').show();
									$('.searchUserServices').click();
									////gojo						
								}
							})
						},
						  statusCode:{
						  	500:function(){
						  		alert("Date and Time is already taken for this service. Please choose another date and time.");
						  	}
						  }

					})

					

					$('#myModal .alert').hide();
				}else{
					$('#myModal .alert').show();
				}
			})

	}else if($('#sigInPage').length){

		$('.navMainLayout li#navSignin').addClass('active');

		$(".form-signin").validate({
			submitHandler:function(form){
				$.ajax({  
				  type: "POST",  
				  url: $("form").attr("action"),  
				  data: $("form").serialize(),  
				  success: function(data,status,jqXHR) {  
				  	console.log(data);
					location.reload();
				  },
				  error:function(data,status,jqXHR){
				  	
				  },
				  statusCode:{
				  	401:function(){
				  		$(".alert-danger").show();
				  	}
				  }
				}); 
			}
		});

	}else if($('#homepage').length){
		$('.navMainLayout li#navHome').addClass('active');
	}else if($('#userRegister').length){

		$('.navMainLayout li#navUserRegister').addClass('active');
		$('body').on('change','#inputEmail',function(event){
		  $.ajax({
		  method:"POST",
		  data:{
		  'userEmailCheck':$(this).val()
		  },
		  url:"admin/checkEmailExist",
		  success:function(data,status,jQxr){
		  	console.log("ee");
		  	$("#inputEmail").val("Email already exist!");
		  },
		  statusCode:{
			  	400:function(){
			  		
			  	}
			  }
		  });
		});
		$("#userRegister").validate({
			rules: {
			    confirm_inputPassword: {
			      equalTo: "#inputPassword"
			    },
			    username: { notEqual: "#inputEmail" }
			  },
			submitHandler:function(form){
				$.ajax({  
				  type: "POST",  
				  url: $("form").attr("action"),  
				  data: $("form").serialize(),  
				  success: function(data,status,jqXHR) {  
				  	$("form").hide();
				  	$(".alert-success").show();
				  },
				  error:function(data,status,jqXHR){
				  	
				  },
				  statusCode:{
				  	400:function(){
				  		console.log("nooo");
				  	}
				  }
				}); 
			}
		});

	}else if ($('#orderPage').length) {

		$('.userNavbar li.navOrder').addClass('active');

		$('body').on('click','.addToCart',function(e){
			$orderRow = $(this).parent().parent();
			$orderQuantityInput = $orderRow.children(".orderQuantity").children("input");
			var productQuantity = parseInt($orderRow.find(".productQuantity").text());

				
			if($orderQuantityInput.val() == "" || (parseInt($orderQuantityInput.val()) > productQuantity)){
				alert("Stock isnt Enough!");

			}else if($orderQuantityInput.val() > 50 ){
				alert("The max order is 50");
				$orderQuantityInput.val("50");
			}else if($orderQuantityInput.val() == "" || (parseInt($orderQuantityInput.val()) > productQuantity) || parseInt($orderQuantityInput.val()) < 0){
			
			}else{
				$('.detailProductName').text($orderRow.children('.productName').text());
				$('.detailProductType span').text($orderRow.children('.productType').text());
				$('.detailProductAmount span').text($orderQuantityInput.val());
				$("#confirmationModal input[name='detailProductAmount']").val($('.detailProductAmount span').text());
				$('.detailPrice span.value').text($orderRow.children('.productPrice').children("span").text());
				$('.detailTotalPrice span.value').text(parseFloat($orderRow.children('.productPrice').children("span").text()) * parseFloat($orderQuantityInput.val()));
				$("#confirmationModal input[name='detailTotalPrice']").val($('.detailTotalPrice span.value').text());
				$('#confirmationModal').modal();
				$('.confirmAction').attr('data-objectId',$(this).attr('data-objectId'));
			}

		})

		$("body").on("click","#confirmationModal .confirmAction",function(e){
			var $this = $(this);
			if($this.attr("data-confirm")=="confirmAddOrder"){
				$.ajax({
					type:"POST",
					async:true,
					data:{
						'productId':$("#confirmationModal .confirmAction").attr("data-objectId"),
						'productAmount':$("input[name='detailProductAmount']").val(),
						'totalPrice':$("input[name='detailTotalPrice']").val()
					},
					url:'addOrder',
					success:function(data,status,jqXHR){
						$('.orderSuccess strong').text("Added order successfuly! You may view it in view cart page.")
						$('.orderSuccess').show();
						$('#confirmationModal').modal('hide');
						$.ajax({
							url:document.URL,
							success:function(data){
								$("#orderPage").html($(data).find("#orderPage").html());
							}
						})
					},statusCode:{
						  	500:function(){
						  		console.log("ettt");
						  		$('#confirmationModal .modal-footer').prepend(" <strong>Warning!</strong> Invalid Request, refresh the page to get the latest quantity count.");
						  	}
						  }
				})
			}	
		})

}else if ($("#adminAddService").length) {
		$('body').on('click','.editServiceFromAdmin',function(e){
			$('#addServicecollapse').collapse('show');
			var $row = $(this).closest("tr");
			$("#serviceNameUpdate").val($row.find(".servicesName").text());
			$("#groupNameUpdate").val($row.find(".group").text());
			$("#priceBoxUpdate").val($row.find(".price").text());			
			$("#serviceObjectIdUpdate").val($(this).attr("data-objectid"));
			$("#addServiceAdmin").hide();
			$("#updateServiceAdmin").show();
			$(".panelAddEditService > .panel-heading .panel-title").text("Update Service");
			
		});

		$('body').on('click','.backToAddService',function(e){
			$("#updateServiceAdmin").hide();
			$("#addServiceAdmin").show();
			$(".panelAddEditService > .panel-heading .panel-title").text("Add a User");
		});

		$('body').on('click','.removeServiceFromAdmin',function(e){
			$('#confirmationModal .confirmAction').attr("data-objectid",$(this).attr("data-objectid"));
			$('#confirmationModal .confirmAction').attr("data-confirm","confirmDeleteAdmin");
			$('#confirmationModal .modal-body').text(" Are you sure you want to delete this item?");
			$('#confirmationModal').modal();
		});
		$('body').on('click','.confirmAction',function(){
			
				$.ajax({
					method:"POST",
					url:'deleteService',
					data:{
						'serviceObjectId':$(this).attr("data-objectid")
					},
					success:function(data,status,jqXHR){
					$(".addServiceSuccess strong").text("Successfuly removed Service!");
				  	$(".addServiceSuccess").show();
				  	$('#confirmationModal').modal('hide');
				  	$.ajax({
							url:document.URL,
							success:function(data){
								$("#adminServiceTables").html($(data).find("#adminServiceTables").html());
							}
					})
					}
				})
		});
		$('body').on('click','.searchServicesBtn',function(e){

			$.ajax({
				method:"POST",
				url:'searchServicesName',
				data:{
					'servicesNameSearch':$(".searchServiceTextAdmin").val()
				},
				success:function(data,status,jqXHR){
					$("#adminServiceTables").html($(data).find("#adminServiceTables").html());
				}
			});
		});


	
	}else if ($("#adminManageReservation").length) {


$('body').on('click','#generateReservationReport',function(e){
	e.preventDefault();
			if($('.reportYearTo').val() !=0 && $('.reportYearFrom').val() !=0 && ($('.reportYearFrom').val() <= $('.reportYearTo').val()) && ($('.reportMonthFrom').val() <= $('.reportMonthTo').val())){
				$("#generatePDF").submit();
				$("#generateUserReportcollapse .alert-danger").hide();
				// $("#generateUserReportcollapse .alert-danger").hide();
				// $.ajax({
				// 	method:"POST",
				// 	async:true,
				// 	data:{
				// 		'reportMonthFrom':$('.reportMonthFrom').val(),
				// 		'reportYearFrom':$('.reportYearFrom').val(),
				// 		'reportMonthTo':$('.reportMonthTo').val(),
				// 		'reportYearTo':$('.reportYearTo').val()
				// 	},
				// 	url:'generateReservationReport',
				// 	success:function(data,status,jqXHR){
						
				// 	}
				// });
			}else{
				$("#generateUserReportcollapse .alert-danger").show();
				$("#generateUserReportcollapse .alert-danger strong").text("Please choose a proper dates!")
			}
		})


		$('body').on('change','#reservationUserEmail',function(event){
		  $.ajax({
		  method:"POST",
		  data:{
		  'userEmailCheck':$(this).val()
		  },
		  url:"checkEmailExist",
		  success:function(data,status,jQxr){
		  	console.log(data);
		  	$(".petName").text(data);
		  },
		  statusCode:{
			  	400:function(){
			  		$("#reservationUserEmail").val("Email doesnt exist!");
			  	}
			  }
		  });
		});
		$('.adminServicesReservation').select2();

		 $('body').on('click','#backToAddReservation',function(event){
			 	$('#saveChangesReservation').hide();
				$('#backToAddReservation').hide();
				$('#addReservationButton').show();
				$('#addOrEditReservation .panel-title a span:last-child').text("Add Reservation");
				$("#addReservationAdmin").attr("action","addReservation");
				$("#reservationUserEmail").val("");
				$(".adminServicesReservation").prop('selectedIndex',0).trigger("change");
				$(".reserveTime").text("");
				$(".reserveDate").text("");
  			$('#datepicker').datepicker('setDate');
  			$('.reserveTimeSelect').prop('selectedIndex',0);
		 });

		$('body').on('click','.adminEditReservation',function(event){
			$('#collapseOne').collapse('show');
			$('#saveChangesReservation').show();
			$('#backToAddReservation').show();
			$('#addReservationButton').hide();
			$('#addOrEditReservation .panel-title a span:last-child').text("Edit Reservation");
			$("#addReservationAdmin").attr("action","editReservation");
			$("#reservationId").val($(this).attr("data-objectId"));
			var $row = $(this).closest("tr");
			$("#reservationUserEmail").val($row.find(".userEmail").text());
			$('.adminServicesReservation').select2('val',$row.find('.serviceTitle').attr("data-serviceid"));
			
			$('#datepicker').datepicker("setDate", new Date($row.find('.serviceDate').text()));
			$('.reserveDate').text($row.find('.serviceDate').text());
			$('.reserveTimeSelect').val($row.find('.serviceTime').text());
			$('.reserveTime').text($row.find('.serviceTime').text());

		});

		$('body').on('click','.adminConfirmReservation',function(event){
			$("#processReservationModal .registrationId").val($(this).attr("data-objectid"));
			$("#processReservationModal").modal();
		});

		$('body').on('click','.adminApproveReservation',function(event){
			$("#approveReservationModal .registrationId").val($(this).attr("data-objectid"));
			$("#approveReservationModal").modal();
		});

		

		$('body').on('click','.adminDeleteReservation',function(event){
			$("#confirmationModal h5.message").text("Are you sure you want to delete "+$(this).parent().parent().children('.serviceTitle').text()+"?")
			$("#confirmationModal .confirmAction").attr("data-confirm","confirmDelete");
			$("#confirmationModal .confirmAction").attr("data-objectId",$(this).attr("data-objectId"));
			$("#confirmationModal").modal();
		});

		$("body").on("click","#confirmationModal .confirmAction",function(e){
			var $this = $(this);
			if($this.attr("data-confirm")=="confirmDelete"){
				$.ajax({
					async:true,
				  method:"POST",
				  data:{
				  	'reservationObjecId':$(this).attr("data-objectId")
				  },
				  url: "deleteAdminReservation",
				  success: function(data,status,jQxr){
						$("#confirmationModal").modal('hide');
						$(".addReservationSuccess strong").text("Successfuly removed a reservation!");
						$(".addReservationSuccess").show();
						$.ajax({
							url:document.URL,
							success:function(data){
								$("#adminReservationTable").html($(data).find("#adminReservationTable").html());
							}
						})
					},
					statusCode:{
						  400:function(){

						  }
					}
				 });
			}
			
		});


		$("#addReservationAdmin").validate({
			submitHandler:function(form){
				if($(".reserveDate").text() =="" || $(".reserveDate label").length){
					$(".reserveDate").html('<label for="reservationUserEmail" class="error">This field is required.</label>');
				}
				if($(".reserveTime").text() =="" || $(".reserveTime label").length){
					$(".reserveTime").html('<label for="reservationUserEmail" class="error">This field is required.</label>');
				}
				if($(".reserveDate label").length ==0 && $(".reserveTime label").length ==0){
					var doctorsId = parseInt($(".reserveDoctorSelect option:selected").val());
					var serviceId =$('select.adminServicesReservation').val();
							$.ajax({
								method:"POST",
								async:false,
								data:{
									'reserveDate':$(".reserveDate").text(),
								  	'reserveTime':$(".reserveTime").text(),
								  	'serviceId':serviceId,
								  	'doctorsId':doctorsId
								},
								url:"/user/checkReservationAvailable",
								success:function(data,status,jqXHR){
														$.ajax({  
														  type: "POST",  
														  url: $("#addReservationAdmin").attr("action"),
														  data: {
														  	'reserveDate':$(".reserveDate").text(),
														  	'reserveTime':$(".reserveTime").text(),
														  	'serviceId':serviceId,
														  	'reservationUserEmail':$('#reservationUserEmail').val(),
														  	'reservationId':$("#reservationId").val(),
														  	'doctorsId':doctorsId
														  },
														  success: function(data,status,jqXHR) {  
														  	if($('#saveChangesReservation:visible').length){
														  		$(".addReservationSuccess strong").text("Successfuly updated reservation!");
														  		$('#saveChangesReservation').hide();
																	$('#backToAddReservation').hide();
																	$('#addReservationButton').show();
																	$('#addOrEditReservation .panel-title a span:last-child').text("Add Reservation");
																	$("#addReservationAdmin").attr("action","addReservation");
																	$("#reservationUserEmail").val("");
																	$(".adminServicesReservation").prop('selectedIndex',0).trigger("change");
																	$(".reserveTime").text("");
																	$(".reserveDate").text("");
													  			$('#datepicker').datepicker('setDate');
													  			$('.reserveTimeSelect').prop('selectedIndex',0);	
														  	}else{
														  		$(".addReservationSuccess strong").text("Successfuly added a reservation!");
														  	}
														  	$('#collapseOne').collapse('hide');
														  	$(".adminServicesReservation").prop('selectedIndex',0).trigger("change");
														  	$(".reserveTime").text("");
																$(".reserveDate").text("");
																$("#reservationUserEmail").val("");
												  			$('#datepicker').datepicker('setDate');
												  			$('.reserveTimeSelect').prop('selectedIndex',0);
														  	$(".addReservationSuccess").show();
														  	$.ajax({
																	url:document.URL,
																	success:function(data){
																		$("#adminReservationTable").html($(data).find("#adminReservationTable").html());
																	}
															})
														  },
														  error:function(data,status,jqXHR){
														  	
														  },
														  statusCode:{
														  	400:function(){
														  		console.log("FAIL");
														  	}
														  }
													});

								},
								  statusCode:{
								  	500:function(){
								  		alert("Date and Time is already taken for this service. Please choose another date and time.");
								  	}
								  }
							})
		 

				}
			}
		});

	}else if ($("#adminUsersOrder").length){
		
		$('body').on('click','.processOrderAdmin',function(e){
			console.log("sss");
			var $row = $(this).closest('tr');
			$.ajax({
				method:"POST",
				url:'processOrder',
				data:{
					batchOrderId:$row.find('.batchOrderId').text(),
					usersId:$row.find('input.usersId').val()
				},
				success:function(data,status,jqXHR){
					$('#confirmationModal .confirmAction').attr("data-formSubmit","generateOrderReceipt");
					$('#confirmationModal .confirmAction').text("Process Order and Print Receipt");
					$('#confirmationModal .modal-body').html(data);
					$('#confirmationModal .modal-title').text('Process Order')
					$('#confirmationModal').modal();
				}
			});

		});

		$('body').on('click','.deleteOrderAdmin',function(e){
			console.log("sss");
			var $row = $(this).closest('tr');
			$.ajax({
				method:"POST",
				url:'deleteAdminOrder',
				data:{
					batchOrderId:$row.find('input.batchOrderIdDelete').val(),
					usersId:$row.find('input.usersId').val()
				},
				success:function(data,status,jqXHR){
					$(".addOrderSuccess strong").text("Delete Succes!");
					$(".addOrderSuccess").show();
					$.ajax({
						method:"POST",
						url:document.URL,
						success:function(data,status,jqXHR){
							$("#adminOrderTable").html($(data).find("#adminOrderTable").html());
							$("#adminPaymentTable").html($(data).find("#adminPaymentTable").html());
							
						}
					});
				}
			});

		});

		$('body').on('click','#confirmationModal .confirmAction',function(e){
			$.ajax({
				method:"POST",
				url:document.URL,
				success:function(data,status,jqXHR){
					$("#adminOrderTable").html($(data).find("#adminOrderTable").html());
				}
			});
			$('#'+ $(this).attr("data-formSubmit") +'').submit();
			$('#confirmationModal').modal('hide');

		});

		$('body').on('click','#adminUsersOrder .searchOrderOfUser',function(e){
			$.ajax({
				method:"POST",
				url:'searchUserOrder',
				data:{
					'userEmailSearch':$("#searchUserEmail").val()
				},
				success:function(data,status,jqXHR){
					$("#adminOrderTable").html(data);
				}
			});
		});
	}else if ($("#adminProducts").length) {
		$('body').on('click','#generateProductReport',function(e){
			e.preventDefault();
			if($('.reportYearTo').val() !=0 && $('.reportYearFrom').val() !=0 && ($('.reportYearFrom').val() <= $('.reportYearTo').val()) && ($('.reportMonthFrom').val() <= $('.reportMonthTo').val())){

				$("#generatePDF").submit();
				$("#generateUserReportcollapse .alert-danger").hide();

				// $("#generateUserReportcollapse .alert-danger").hide();
				// $.ajax({
				// 	method:"POST",
				// 	async:true,
				// 	data:{
				// 		'reportMonthFrom':$('.reportMonthFrom').val(),
				// 		'reportYearFrom':$('.reportYearFrom').val(),
				// 		'reportMonthTo':$('.reportMonthTo').val(),
				// 		'reportYearTo':$('.reportYearTo').val()
				// 	},
				// 	url:'generateProductReport',
				// 	success:function(data,status,jqXHR){

				// 	}
				// });
			}else{
				$("#generateUserReportcollapse .alert-danger").show();
				$("#generateUserReportcollapse .alert-danger strong").text("Please choose a proper dates!")
			}
		})

	}else if ($("#adminAddUser").length) {

		$(".adminNavbar .navAdminUserManage").addClass("active");

		$('body').on('click','#generateUserReport',function(e){
			e.preventDefault();
			if($('.reportYearTo').val() !=0 && $('.reportYearFrom').val() !=0 && ($('.reportYearFrom').val() <= $('.reportYearTo').val()) && ($('.reportMonthFrom').val() <= $('.reportMonthTo').val())){

				$("#generatePDF").submit();
				$("#generateUserReportcollapse .alert-danger").hide();

				// $("#generateUserReportcollapse .alert-danger").hide();
				// $.ajax({
				// 	method:"POST",
				// 	async:true,
				// 	data:{
				// 		'reportMonthFrom':$('.reportMonthFrom').val(),
				// 		'reportYearFrom':$('.reportYearFrom').val(),
				// 		'reportMonthTo':$('.reportMonthTo').val(),
				// 		'reportYearTo':$('.reportYearTo').val()
				// 	},
				// 	url:'admin/generateUserPDF',
				// 	success:function(data,status,jqXHR){

				// 	}
				// });
			}else{
				$("#generateUserReportcollapse .alert-danger").show();
				$("#generateUserReportcollapse .alert-danger strong").text("Please choose a proper dates!")
			}
		})
		
		
		$('body').on('change','#userLevelAdd',function(e){
			if($(this).val() !== "1"){
				$("#petInformationContainer").hide();
			}else{
				$("#petInformationContainer").show();
			}
		});
		$('body').on('click','.editUserFromAdmin',function(e){
			$('#addUsercollpase').collapse('show');
			var $row = $(this).closest("tr");
			$("#inputEmailUpdate").val($row.find(".userEmail").text());
			$("#usernameUpdate").val($row.find(".userUsername").text());
			$("#firstNameUpdate").val($row.find(".userFirstName").text());
			$("#lastNameUpdate").val($row.find(".userLastName").text());
			$("#userLevelUpdate").val($row.find(".userUserLevel span").attr("data-userlevel"));
			$("#userObjectIdUpdate").val($(this).attr("data-objectid"));
			$("#addUserAdmin").hide();
			$("#updateUser").show();
			$(".panelAddEditUser > .panel-heading .panel-title").text("Update User");
		});
		$('body').on('click','.backToAddUser',function(e){
			$("#updateUser").hide();
			$("#addUserAdmin").show();
			$(".panelAddEditUser > .panel-heading .panel-title").text("Add a User");
			
		});

		$('body').on('click','.removeUserFromAdmin',function(e){
			$('#confirmationModal .confirmAction').attr("data-objectid",$(this).attr("data-objectid"));
			$('#confirmationModal .confirmAction').attr("data-confirm","confirmDeleteAdmin");
			$('#confirmationModal .modal-body').text(" Are you sure you want to delete this item?");
			$('#confirmationModal').modal();
		});

		$('body').on('click','.generatenewPassword',function(e){
			$('#confirmationModal .confirmAction').attr("data-objectid",$("#userObjectIdUpdate").val());
			$('#confirmationModal .confirmAction').attr("data-confirm","confirmGenerateNewPassword");
			$('#confirmationModal .modal-body').html("<p>Are you sure you want to generate new password for this user?</p><p>Your new password would be: <span id='newGeneratedPassword' style='color:red;font-weight:bold;'>"+Math.random().toString(36).substring(10)+"</span></p>");
			
			$('#confirmationModal').modal();
		});

		$('body').on('click','.confirmAction',function(){
			if($(this).attr("data-confirm") == "confirmDeleteAdmin"){
				$.ajax({
					method:"POST",
					url:'admin/deleteUser',
					data:{
						'userObjectId':$(this).attr("data-objectid")
					},
					success:function(data,status,jqXHR){
						$(".addUserSuccess strong").text("Successfuly removed user!");
				  	$(".addUserSuccess").show();
				  	$('#confirmationModal').modal('hide');
				  	$.ajax({
							url:document.URL,
							success:function(data){
								$("#adminUsersTable").html($(data).find("#adminUsersTable").html());
							}
					})
					}
				})
			}else if($(this).attr("data-confirm") == "confirmGenerateNewPassword"){
				$.ajax({
					method:"POST",
					url:'admin/generateNewPassword',
					data:{
						'userObjectId':$(this).attr("data-objectid"),
						'inputPassword':$('#newGeneratedPassword').text()
					},
					success:function(data,status,jqXHR){
						$(".addUserSuccess strong").text("Successfuly reset password!");
				  	$(".addUserSuccess").show();
				  	$('#confirmationModal').modal('hide');
				  	
					}
				})
			}
		})
		$("#addUserAdmin").validate({
			rules: {
			    confirm_inputPassword: {
			      equalTo: "#inputPassword"
			    },
			    username: { notEqual: "#inputEmail" }
			  },
			submitHandler:function(form){
				$.ajax({  
				  type: "POST",  
				  url: $("#addUserAdmin").attr("action"),  
				  data: $("#addUserAdmin").serialize(),  
				  success: function(data,status,jqXHR) {  
				  	$(".addUserSuccess strong").text("Successfuly added a user!");
				  	$(".addUserSuccess").show();
				  	$.ajax({
							url:document.URL,
							success:function(data){
								$("#adminUsersTable").html($(data).find("#adminUsersTable").html());
							}
					})
				  },
				  error:function(data,status,jqXHR){
				  	
				  },
				  statusCode:{
				  	400:function(){
				  		console.log("nooo");
				  	}
				  }
				}); 
			}
		});
		$("#updateUser").validate({
			submitHandler:function(form){
				$.ajax({  
				  type: "POST",  
				  url: $("#updateUser").attr("action"),  
				  data: $("#updateUser").serialize(),  
				  success: function(data,status,jqXHR) {  
				  	$(".addUserSuccess strong").text("Successfuly updated user!")
				  	$(".addUserSuccess").show();
				  	$.ajax({
							url:document.URL,
							success:function(data){
								$("#adminUsersTable").html($(data).find("#adminUsersTable").html());
							}
					})
				  },
				  error:function(data,status,jqXHR){
				  	
				  },
				  statusCode:{
				  	400:function(){
				  		console.log("nooo");
				  	}
				  }
				}); 
			}
		});

	}else if($('#viewCartPage').length){
		$('body').on('click','.editOrder',function(){
			$orderRow = $(this).parent().parent();
			$orderQuantityInput = $orderRow.children(".orderAmount").text();
		
			$("#confirmationModal .detailProductName").text($orderRow.children(".productName").text());
			$("#confirmationModal .detailProductAmount input").val($orderRow.children(".orderAmount").text());
			$("#confirmationModal .detailPrice .value").text($orderRow.children(".productPrice").children("span").text());
			$("#confirmationModal .detailTotalPrice .value").text($orderRow.children(".productTotal").children("span").text());
			$("#confirmationModal input[name='detailTotalPrice']").val($orderRow.children(".productTotal").children("span").text());
			$("#confirmationModal input[name='oldValueAmount']").val($("#confirmationModal .detailProductAmount input").val());
			$("#confirmationModal #myModalLabel").text("Edit Order");
			$("#confirmationModal").modal();
			$("#confirmationModal .confirmAction").attr("data-confirm","confirmUpdate");
			$("#confirmationModal .confirmAction").text("Update");
			$("#confirmationModal .confirmAction").attr("data-objectId",$(this).attr("data-objectId"));
			$("#confirmationModal .confirmAction").attr("data-productId",$(this).attr("data-productId"));
			$("#confirmationModal .editOrderBody").show();
		})

		$('body').on('change','#confirmationModal .detailProductAmount input',function(){
			$("#confirmationModal .detailTotalPrice .value").text(parseFloat($("#confirmationModal .detailProductAmount input").val()) * parseFloat($("#confirmationModal .detailPrice .value").text()));
			$("#confirmationModal input[name='detailTotalPrice']").val($("#confirmationModal .detailTotalPrice .value").text());
		})
		
		$('body').on('click','#checkOut',function(e){
			$.ajax({
				method:"POST",
				url:"checkoutOrder",
				success:function(data,status,jqXHR){
					location.reload();
				}
			});
		});

		$('body').on('click','#cancelOrder',function(e){
			$.ajax({
				method:"POST",
				url:"cancelOrder",
				success:function(data,status,jqXHR){
					location.reload();
				}
			});
		});

		$('body').on('click','.removeFromCart',function(){
			$orderRow = $(this).parent().parent();
			$("#confirmationModal #myModalLabel").text("Confirm Remove");
			$("#confirmationModal").modal();
			$("#confirmationModal .detailProductAmount input").val($orderRow.children(".orderAmount").text());
			$("#confirmationModal .removeFromCartBody h4").text("Are you sure you want to delete this order?");
			$("#confirmationModal .removeFromCartBody").show();
			$("#confirmationModal .confirmAction").attr("data-objectId",$(this).attr("data-objectId"));
			$("#confirmationModal .confirmAction").attr("data-productId",$(this).attr("data-productId"));
			$("#confirmationModal .confirmAction").attr("data-confirm","confirmDeleteOrder");
			$("#confirmationModal .confirmAction").text("Yes");
		})

		$('body').on('click','#payOrder',function(){
			$("#confirmationModal #myModalLabel").text("Pay Order");
			$("#confirmationModal").modal();
			$("#confirmationModal .confirmAction").attr("data-confirm","confirmPay");
			$("#confirmationModal .payOrderBody").show();
		})

		$('#confirmationModal').on('hidden.bs.modal', function () {
  			$("#confirmationModal .removeFromCartBody").hide();
  			$("#confirmationModal .editOrderBody").hide();
		})

		$('body').on('click','.confirmAction',function(){
			var $this = $(this);
			if($this.attr("data-confirm") =="confirmUpdate"){
				$.ajax({
					type:"POST",
					async:true,
					url:'updateOrder',
					data:{
						'orderObjectId':$this.attr("data-objectId"),
						'newAmount':$("#confirmationModal .detailProductAmount input").val(),
						'newTotalPrice':$("#confirmationModal input[name='detailTotalPrice']").val(),
						'productId':$this.attr("data-productId"),
						'incremental':parseFloat($("#confirmationModal input[name='oldValueAmount']").val()) -parseFloat($("#confirmationModal .detailProductAmount input").val())
					},
					success:function(data,status,jqXHR){
						$('.cartSuccess strong').text("Update successful!");
						$('.cartSuccess').show();
						$.ajax({
							url:document.URL,
							success:function(data){
								$("#viewCartPage").html($(data).find("#viewCartPage").html());
								$("#confirmationModal").modal('hide');
							}
						})
					}
				})
			}else if($this.attr("data-confirm") =="confirmDeleteOrder"){
				$.ajax({
					type:"POST",
					async:true,
					url:'deleteUserOrder',
					data:{
						'orderObjectId':$this.attr("data-objectId"),
						'incremental':$("#confirmationModal .detailProductAmount input").val(),
						'productId':$this.attr("data-productId")
					},
					success:function(data,status,jqXHR){
						$('.cartSuccess strong').text("Delete successful!");
						$('.cartSuccess').show();
						$.ajax({
							url:document.URL,
							success:function(data){
								$("#viewCartPage").html($(data).find("#viewCartPage").html());
								$("#confirmationModal").modal('hide');
							}
						})
					}
				});
			}else if($this.attr("data-confirm") == "confirmPay"){
				$.ajax({
					type:"POST",
					async:true,
					url:'payOrder',
					data:{
						'batchId':$("#batchId").val(),
						'remitId':$("#remitId").val(),
						'trackingNo':$("#trackingNo").val()
					},
					success:function(data,status,jqXHR){
						$('.cartSuccess strong').text("Payment Details sent to the admin for confirmation.");
						$('.cartSuccess').show();
						$.ajax({
							url:document.URL,
							success:function(data){
								$("#viewCartPage").html($(data).find("#viewCartPage").html());
								$("#confirmationModal").modal('hide');
							}
						})
					}
				});
			}
		})
	}


	function reloadUserManageReservationTable(){
		$.ajax({
			url:'manageReservation',
			success:function(data){
				console.log("updatee");
				$("#userManageReservation").html($(data).find("#userManageReservation").html());
			}
		})
	}
	function resetReservationModal(modalName){
		$(".reserveDate").text("");
  		$(".reserveTime").text("");
  		$('#datepicker').datepicker('setDate');
  		$('.reserveTimeSelect').prop('selectedIndex',0);
  		$(''+modalName+' .alert').hide();
	}


	//FIX FOR BS3 Alert dismissable
	$("body").on("click",".alert .close",function(e){
		$(this).closest("." + $(this).attr("data-hide")).hide();	
	})
	
	
	$('body').on('click','.searchManageUser',function(e){
			$.ajax({
				method:"POST",
				url:'admin/searchUsers',
				data:{
					'userEmailSearch':$(".searchManageUserText").val()
				},
				success:function(data,status,jqXHR){
					$("#adminUsersTable").html($(data).find("#adminUsersTable").html());
				}
			});
		});

	$('body').on('click','.searchManageProductsAdmin',function(e){
			$.ajax({
				method:"POST",
				url:'searchAdminProducts',
				data:{
					'userEmailSearch':$(".searchManageProductsTextAdmin").val()
				},
				success:function(data,status,jqXHR){
					$("#adminManageProducts").html($(data).find("#adminManageProducts").html());
				}
			});
		});


	$('body').on('click','.adminSearchReservation',function(e){
			$.ajax({
				method:"POST",
				url:'searchAdminReservation',
				data:{
					'userEmailSearch':$(".adminSearchReservationText").val()
				},
				success:function(data,status,jqXHR){
					$("#adminReservationTable").html($(data).find("#adminReservationTable").html());
				}
			});
		});

/////gerald
	$('body').on('click','.searchUserServices',function(e){
		if($('input[name=sortService1]:checked').val() == "S"){
			console.log("Surgery");
			$.ajax({
				method:"POST",
				url:'user/searchUserServices',
				data:{
					'userEmailSearch':$(".searchUserServicesText").val(),
					'serviceSort':"S"

				},
				success:function(data,status,jqXHR){
					$("#userReserve table").html($(data).find("#userReserve table").html());
				}
			});	
		}else if($('input[name=sortService1]:checked').val() == "O"){
			console.log("Others");
			$.ajax({
				method:"POST",
				url:'user/searchUserServices',
				data:{
					'userEmailSearch':$(".searchUserServicesText").val(),
					'serviceSort':"O"

				},
				success:function(data,status,jqXHR){
					$("#userReserve table").html($(data).find("#userReserve table").html());
				}
			});	
		} else{
			console.log("All");
			$.ajax({
				method:"POST",
				url:'user/searchUserServices',
				data:{
					'userEmailSearch':$(".searchUserServicesText").val(),
					'serviceSort':""

				},
				success:function(data,status,jqXHR){
					$("#userReserve table").html($(data).find("#userReserve table").html());
				}
			});	
		}


			
		});

	$('body').on('click','.searchProductUser',function(e){
		if($('input[name=sortCategory1]:checked').val() == "C"){
			console.log("Capsule");
			$.ajax({
				method:"POST",
				url:'searchorder',
				data:{
					'userEmailSearch':$(".searchProductUserText").val(),
					'userSort':"Cap"
				},
				success:function(data,status,jqXHR){
					$("#orderPage table").html($(data).find("#orderPage table").html());
				}
			});
		}
		else if($('input[name=sortCategory1]:checked').val() == "V"){
			console.log("Vitamins");
			$.ajax({
				method:"POST",
				url:'searchorder',
				data:{
					'userEmailSearch':$(".searchProductUserText").val(),
					'userSort':"Vit"
				},
				success:function(data,status,jqXHR){
					$("#orderPage table").html($(data).find("#orderPage table").html());
				}
			});	
		}
		else{
			console.log("Vitamins");
			$.ajax({
				method:"POST",
				url:'searchorder',
				data:{
					'userEmailSearch':$(".searchProductUserText").val(),
					'userSort':""
				},
				success:function(data,status,jqXHR){
					$("#orderPage table").html($(data).find("#orderPage table").html());
				}
			});	
		}
			
		});

		$('body').on('click','.editProductAdmin',function(e){
			
			$parentRow=$(this).closest("tr");
			// 

			
			
			
			
			$("#productIdToEdit").val($(this).attr("data-objectId"));
			$("#productNameEdit").val($parentRow.find(".productName").text());
			$("#productQtyEdit").val($parentRow.find(".productQuanitty").text());
			$("#productPriceEdit").val($parentRow.find(".productPrice").text().substring(2));
			$("#productTypeEdit").val($parentRow.find(".productType").text());
			
			
			
			

			
			$("#productEditModal").modal();
		});
	
		$('body').on('click','.removeProductAdmin',function(e){
			console.log("delll");
			$.ajax({
				url:'deleteProductAdmin',
				method:"POST",
				data:{
					'objectId':$(this).attr("data-objectId")
				},
				success:function(data,status,jqXHR){
					$.ajax({
							url:document.URL,
							success:function(data){
								$("#adminManageProducts").html($(data).find("#adminManageProducts").html());
							}
						})
				}
			})
		});
	

})