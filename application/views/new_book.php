<html>
<head>
	<title>Books</title>
	<meta charset="utf-8" />
	<meta name="description" content="This website is using Twitter Bootstrap"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/reviews.css">
</head>
<body>
	<nav class="navbar navbar-inverse">
 		 <div class="container-fluid header">
	 		 <div class="navbar-header">
				<h1>Add A New Book</h1>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="/books/index">Home</a></li>
		        <li><a href="/users/log_off">Log Off</a></li>
		      </ul>
			</div>
  		</div>
	</nav>	

	<div class="container">
		<!--shows errors if the user tries to add a new book and review without a book title and an author-->
		<?php if ($this->session->flashdata("form_validation"))
		{
			echo $this->session->flashdata("form_validation");
		} ?>
		<!--Gives the user the ability to add a new book and a new review-->
		<h3 class="panel">Add a New Book Title and a Review</h3>	
		<form class="form-horizontal" action="/books/book_details/<?= $authors[0]['id'] ?>"  method="post">
		  <div class="form-group">
		    <label for="new_title" class="col-sm-2 control-label">Book Title:</label>
		    <div class="col-sm-7">
		      <input type="text" class="form-control" name="title" id="new_title" placeholder="Your Book Title Here"/>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="author" class="col-sm-2 control-label">Author:</label>
		    <div class="col-sm-7">
			    <label for"existing">Choose from an Author Below:</label>
			       <select class="form-control" name="old_author" id="existing">
						<?php foreach ($authors as $author){ ?>
			 			 <option><?= $author['author']   ?></option>
			  		<?php } ?>
				   </select> 
		     	   <p id="new">OR</p>
		       	   <input type="text" class="form-control" name="new_author" id="author" placeholder="Add a New Author">
		    </div>
		  </div>

		  <div class="form-group">
			    <label for="review" class="col-sm-2 control-label">Review:</label>
			    <div class="col-sm-7">
			      <textarea class="form-control" name="review" rows="5"></textarea>
			    </div>
		   </div>

		    <div class="form-group">
		   	    <label for="stars" class="col-sm-2 control-label">Rating:</label>
			    <div class="col-sm-4">
			       <select class="form-control" name="stars">
			 			 <option>1</option>
			  			 <option>2</option>
			  			 <option>3</option>
			 			 <option>4</option>
			 			 <option>5</option>
				   </select>
			    </div>
		   </div>

		 	<div class="form-group">
		  	  <div class="col-sm-offset-2 col-sm-10">
		    	 <input type="hidden" class="form-control" value="<?= $this->session->userdata('user_id')  ?>" name="id" id="user_id">
		     	 <button type="submit" class="btn btn-danger">Add Book and Review</button>
		   	  </div>
	  	  	</div>
		</form>
	</div>
</body>
</html>	
