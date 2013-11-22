$(document).ready(function(){
	$("body").on("click",".addReservation",function(e){
		
		$("#myModal #myModalLabel").text($(this).parent().parent().children('.serviceTitle').text());
		$("#myModal").modal();
	})
})