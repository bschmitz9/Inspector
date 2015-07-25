<html>
<head>
	<title>Login and Registration</title>
	<meta charset="utf-8" />
	<meta name="description" content="This website is using Twitter Bootstrap"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script> 
	<style type="text/css">
		.panel{
			color:red;
		}
		.inspector{
			margin-left: 160px;
		}

	</style>
</head>
<body>
	<div class="container">	
		<h1 class="panel">Inspector <small>Keeping an eye on the best books around town!</small></h1>
<!-- this loads the header we use for login and registration -->
		<?php if ($this->session->flashdata("form_validation"))
		{
				echo $this->session->flashdata("form_validation");
		} ?>

		<?php if ($this->session->flashdata('user_error'))
		{	
			echo ($this->session->flashdata('user_error'));
		} ?>

		<div class="row">
			<div class="col-md-6">
				<h1>Register</h1>
<!-- this is the form the user will user to register for the site -->
				<form action="/login/registration" method="post">
				<!-- hidden input field to set each user value at 1, if it is the first user we set the admin level to 9 in the controller-->
					 <input type="hidden" class="form-control" name="user_level" value="1" id="first_name" placeholder="Your First Name"/>
					  <div class="form-group">
					    <label for="first_name">First Name</label>
					    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Your First Name">
					  </div>
					   <div class="form-group">
					    <label for="last_name">Last Name</label>
					    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Your Last Name">
					  </div>
					  <div class="form-group">
					    <label for="alias">Alias</label>
					    <input type="text" class="form-control" name="alias" id="alias" placeholder="Enter Your Alias">
					  </div>
					  <div class="form-group">
					    <label for="email">Email Address</label>
					    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Your Email">
					  </div>
					   <div class="form-group">
					    <label for="password">Password</label>
					    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
					  </div>
					   <div class="form-group">
					    <label for="passconf">Confirm Password</label>
					    <input type="password" class="form-control" name="passconf" id="passconf" placeholder="Confirm Your Password">
					  </div>
					  <button type="submit" class="btn btn-danger btn-block">Sign Up</button>
				</form>
			</div>
	
	<!--user sign in -->
		    <h1>Sign In</h1>
			<div class="col-md-6">
				<form action="/login/sign_in" method="post"> 
				  <div class="form-group">
				    <label for="email">Email Address</label>
				    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email">
				  </div>
				  <div class="form-group">
				    <label for="password">Password</label>
				    <input type="password" class="form-control" name="password" id="password" placeholder="Your Password">
				  </div>
				  <button type="submit" class="btn btn-danger btn-block">Sign In</button>
				</form>

				<div class="row">
					<div class="col-md-6">
						<img class="inspector" src="/assets/images/inspector.jpeg" alt="image"/>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- end of registration form -->
</body>
</html>