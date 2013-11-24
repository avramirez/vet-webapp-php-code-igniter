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
	};



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