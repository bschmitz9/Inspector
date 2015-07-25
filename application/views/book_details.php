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
	<!-- set our navbar -->
		<nav class="navbar navbar-inverse">
	 		 <div class="container-fluid header">
		 		 <div class="navbar-header">
					<h1>Details By Book</h1>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav navbar-right">
			        <li><a href="/books/index">Home</a></li>
			        <li><a href="/books/new_book">Add Book and Review</a></li>
			        <li><a href="/users/log_off">Log Off</a></li>
			      </ul>
    			</div>
	  		</div>
		</nav>	

		<div class="container">
		<!-- flashes any errors if the user tries to add a new message without adding any content-->
			<?php if ($this->session->flashdata("form_validation"))
			{
				echo $this->session->flashdata("form_validation");
			} ?>
	
			<h3 class="panel">Reviews</h3>
			<div class="row">
				<!-- shows the book and the reviews associatied with that book -->
				<div class="col-sm-6">
				<?php if(!empty($info[0]['content'])) {?>
					<h3><span id="title">Title:</span> <?= $info[0]['title']?></h3>
					<p><strong><span id="author">Author: </span></strong><?= $info[0]['author'] ?></p>

					<?php foreach ($info as $detail) { ?>	
								<div class="review_section">
									<img class="star_number" src="/assets/images/<?= $detail['stars']?>.png">
									<p><a href="/users/show/<?= $detail['user_id'] ?>"><?= $detail['first_name']?></a> says: <?= $detail['content'] ?></p>
									<p>Posted on <?=$detail['review_created'] ?> 
										<?php if ( $detail['user_review'] === $this->session->userdata['user_id'] )  { ?>
											<a href="/books/delete_book/<?= $detail['id'] ?>/<?= $detail['review_id'] ?>">Delete Your Review</a></p>
										<?php } ?>
								</div>
								<?php } 
					 }
					else {
						echo "There are currently no reviews for this book! Add a review!";
				}  ?>
				</div>
				<div class="col-md-6 add-review">
					<!--gives the user the option to add a new review-->
					<h3><u>Add a Review</u></h3>

					<form action="/books/new_review/<?= $info[0]['id'] ?>" method="post">	
						<textarea class="form-control" name="reviews" rows="3"></textarea>
						<div class="form-group pick_stars">
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
			    				<input type="hidden" class="form-control" value="<?= $this->session->userdata('user_id') ?>" name="user_id" id="user_id">
			      				<input type="hidden" class="form-control" value="<?= $info[0]['id']  ?>" name="book_id" id="book_id">
			      				<button type="submit" class="btn btn-danger submit">Add Review</button>
			    			</div>
		  	 		 	</div>
					</form>
				</div>
			</div>
		</div>	
</body>
</html>