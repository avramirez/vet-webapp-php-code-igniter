$(document).ready(function(){
	$("body").on("click",".addReservation",function(e){
		$("#myModal #myModalLabel").text($(this).parent().parent().children('.serviceTitle').text());
		$(".submitReservation").attr("data-objectId",$(this).attr("data-objectId"));
		$("#myModal").modal();
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
		}
	});
	$("body").on("click",".submitReservation",function(e){
		if($(".reserveDate").text()!="" && $(".reserveTime").text() !=""){
			$.ajax({
				method:"POST",
				async:true,
				data:{
					'reserveDate':$(".reserveDate").text(),
					'reserveTime':$(".reserveTime").text(),
					'serviceId':$(this).attr("data-objectId")
				},
				url:"user/addReservation",
				success:function(data,status,jqXHR){
					$('#myModal').modal('hide');
					$('.addSuccess').show();
				}

			})
			$('#myModal .alert').hide();
		}else{
			$('#myModal .alert').show();
		}
	})


	if($('#userManageReservation').length){

		$('.userNavbar li.navReserveManage').addClass('active');

		$("body").on("click",".editReservation",function(e){
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
			if($(".reserveDate").text()!="" && $(".reserveTime").text() !=""){
				$.ajax({
					method:"POST",
					async:true,
					data:{
						'reserveDate':$(".reserveDate").text(),
						'reserveTime':$(".reserveTime").text(),
						'serviceId':$(this).attr("data-objectId")
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

		$("#userRegister").validate({
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

			if($orderQuantityInput.val() == ""){
				
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
					}
				})
			}	
		})		

	}else if ($("#adminAddUser").length) {
		$('body').on('click','.editUserFromAdmin',function(){
			console.log("tae");
		});

		$("#addUserAdmin").validate({
			submitHandler:function(form){
				$.ajax({  
				  type: "POST",  
				  url: $("form").attr("action"),  
				  data: $("form").serialize(),  
				  success: function(data,status,jqXHR) {  
				  	$(".addUserSuccess strong").text("Successfuly added a user!")
				  	$(".addUserSuccess").show();
				  	$.ajax({
							url:document.URL,
							success:function(data){
								$("#adminAddUser").html($(data).find("#adminAddUser").html());
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
			}
		})
	}

	// $('body').on('focus','.inputError.error',function(){
	// 	$(this).val("");
	// 	$(this).removeClass("inputError error");
	// })

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
	
})