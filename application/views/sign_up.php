<div class="container" style="margin-top:25px;">
<div class="col-md-6 col-md-offset-3 panel panel-default" style="padding:0px;">
  <div class="panel-heading"> Register</div>
  <div class="panel-body">
    <div class="col-md-12">
    	<div class="alert alert-success" style="display:none;">Registration Successful!</div>
    	<form id="userRegister" role="form" action="registration/register" method="POST">
		  <div class="form-group">
		    <label for="inputEmail">Email address</label>
		    <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Enter email" required>
		  </div>
		  <div class="form-group">
		    <label for="username">Username</label>
		    <input type="text" class="form-control" name="username" id="username" placeholder="Username" minlength="5" required>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword">Password</label>
		    <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password" minlength="6" maxlength="50" required>
		  </div>
		  <div class="form-group">
		    <label for="firstName">First Name</label>
		    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" minlength="3" required>
		  </div>
			<div class="form-group">
			    <label for="lastName">Last Name</label>
			    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" minlength="3" required>
		  	</div>
		  <button type="submit" class="btn btn-default pull-right">Register</button>
		</form>
    </div>
  </div>
</div>
</div>