$(document).ready(function(){
	$("body").on("click",".addReservation",function(e){
		$("#myModal #myModalLabel").text($(this).parent().parent().children('.serviceTitle').text());
		$(".submitReservation").attr("data-objectId",$(this).attr("data-objectId"));
		$("#myModal").modal();
	})
	$('#myModal').on('hidden.bs.modal', function () {
  		$(".reserveDate").text("");
  		$(".reserveTime").text("");
  		$('.reserveTimeSelect').prop('selectedIndex',0);
  		$('#myModal .alert').hide();
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
				}

			})
			$('#myModal .alert').hide();
		}else{
			$('#myModal .alert').show();
		}
	})


	if($('#userManageReservation').length){
		$('.userNavbar li.navReserveManage').addClass('active');
	}else if($('#userReserve').length){
		$('.userNavbar li.navReserve').addClass('active');
	}else if($('#userRegister').length){
		$('.navMainLayout li').removeClass('active');
		$('.navMainLayout li#navUserRegister').addClass('active');
		$("#userRegister").validate();
	}



})