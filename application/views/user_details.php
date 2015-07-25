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
				<h1>User Details</h1>
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

	<!-- shows user details and the reviews that particular user has made -->
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="user-info">
					<h3 class="text-center"><u>User Alias: <?= $review_titles[0]['alias']?></u></h3>
					<p><strong><u>Name:</u></strong> <?=  $review_titles[0]['first_name'] . " " . $review_titles[0]['last_name']  ?></p>
					<p><strong><u>Email:</u></strong> <?= $review_titles[0]['email'] ?> </p>
					<p><strong><u>Total Reviews:</u></strong> <?= $total_reviews[0]['Review_ID'] ?></p>
				</div>

				<div class="insight">
					<p class="latest-reviews"><u><?= $review_titles[0]['alias'] ?>'s Latest Reviews:</u></p>
					<?php foreach ($review_titles as $review_title){?>
							<u><a class="book-title" href="/books/view_book/<?= $review_title['book_id']  ?>"><p><?= $review_title['title']?></a>:</u><br> <?= $review_title['content'] ?><br><strong><span class="posted-on">Posted on <?= $review_title['date_review'] ?></span></strong></p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>


				