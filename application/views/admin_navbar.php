 <div class="header">
        <ul class="nav nav-pills pull-right adminNavbar">
 <?php
 	if($userLevel ==4){
         	echo'<li class="navReserveManage"><a href="'.base_url().'admin/manageReservation">Reservations</a></li>';
         	echo'<li><a href="'.base_url().'user/logout">Log-Out</a></li>';
        
 	}else if ($userLevel ==3) {
 			echo'<li class="navAdminUserManage"><a href="'.base_url().'admin">Manage Users</a></li>';
         	echo'<li class="navProducts"><a href="'.base_url().'admin/userorder">Order</a></li>';
         	echo'<li><a href="'.base_url().'user/logout">Log-Out</a></li>';
 	}elseif ($userLevel ==2) {
 			echo'<li class="navAdminUserManage"><a href="'.base_url().'admin">Manage Users</a></li>';
         	echo'<li class="navProducts"><a href="'.base_url().'admin/manageproducts">Products</a></li>';
         	echo'<li class="navProducts"><a href="'.base_url().'admin/userorder">Order</a></li>';
         	echo'<li class="navReserveManage"><a href="'.base_url().'admin/manageReservation">Reservations</a></li>';
         	echo'<li><a href="'.base_url().'user/logout">Log-Out</a></li>';
 	}
 ?>
 
 </ul>
        <h3 class="text-muted">Vets in Practice (Admin)</h3>
</div>