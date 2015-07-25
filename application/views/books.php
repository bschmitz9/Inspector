<html>
<head>
	<title>Books</title>
	<meta charset="utf-8" />
	<meta name="description" content="This website is using Twitter Bootstrap"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/reviews.css">
</head>
<body>
	<nav class="navbar navbar-inverse">
 		 <div class="container-fluid header">
	 		 <div class="navbar-header">
				<h1>Welcome, <?= $this->session->userdata('alias')  ?>!</h1>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="/books/new_book">Add Book and Review</a></li>
		        <li><a href="/users/log_off">Log Off</a></li>
		      </ul>
			</div>
  		</div>
	</nav>			
	<!-- gets each book and inserts it on the page in descending order -->
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<h5>Recent Book Reviews:</h5>
					<?php  foreach ($books as $book) { 
					   if(($book['content'])){ ?>
					   	<div id="review_section">
							<p class="reviews" id="title"><strong><a href="/books/view_book/<?= $book['book_id'] ?>"><?= $book['title'] ?></a></strong></p>
							<img class="star_number" src="/assets/images/<?= $book['stars']?>.png">
							<p class="reviews"><a href="/users/show/<?= $book['id'] ?>"><?=$book['alias']?></a> says: "<?= $book['content'] ?>."</p>
							<p>Posted on <?= $book['created_at'] ?> 
								<?php if ( $book['user_review'] === $this->session->userdata['user_id'])  { ?>
										<a href="/books/remove_book/<?= $book['review_id'] ?>">Delete Your Review</a></p>
								<?php } ?>
						</div>
					<?php } ?>
				<?php }  ?>
			</div>
			
	<!-- loop through the books to show them in ascending order, earliers to latest -->
			<div class="col-md-5 other_reviews">
				<h5>Other Books with Reviews:</h5>
				<?php foreach ($reviews as $review) { ?>
					<p><a href="/books/view_book/<?= $review['id'] ?>"><?= $review['title'] ?></a></p>
				<?php } ?>
			</div>	
		</div>
	</div>
</body>
</html>
