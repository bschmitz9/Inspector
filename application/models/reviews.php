<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Reviews extends CI_Model
	{
	// query to get reviews in descending order on the home page once a user has logged in
		public function get_reviews()
		{

			$query = "SELECT users.id, users.alias, users.first_name, users.last_name, books.title, reviews.id as review_id, reviews.book_id, reviews.user_id as user_review, reviews.stars, reviews.content, reviews.created_at
				 		 FROM users
				 		 LEFT JOIN reviews on users.id = reviews.user_id
				 	     -- LEFT JOIN customer_book on users.id = customer_book.user_id
						 LEFT JOIN books on books.id = reviews.book_id
						 ORDER BY created_at DESC
						 LIMIT 0,3";
			

			return $this->db->query($query) -> result_array();
		}
 	// gets user review titles for each user on the details page
		public function user_reviews($id)
		{				 
			$query = "SELECT books.title, reviews.id as review_id, reviews.book_id, reviews.content, reviews.created_at as date_review, users.id, users.first_name, users.last_name, users.alias, users.email
						 FROM books	
						 JOIN reviews
						 ON books.id = reviews.book_id	 
						 JOIN users	
						 ON reviews.user_id = users.id
						 WHERE users.id = ?
						 ORDER BY reviews.created_at DESC
						 LIMIT 0,5";
			 		
					$values = $id;

					return $this->db->query($query, $values) -> result_array();		
		}


	// gets all reviews for the user after he logs in, this is in the right colum in ascending order
		public function get_all_reviews()
		{
			$query = "SELECT * FROM books";
			return $this->db->query($query) -> result_array();
		}

	// get's one user's details for the user's detail page.
		public function get_one_user($id)
		{
		$query = "SELECT * FROM users WHERE id = ".$id;
		return $this->db->query($query)->row_array();
		}

	// gets the total number of reviews for each user and shows on the user details page
		public function get_user_total_reviews($id)
		{
			$query = "SELECT users.id, users.first_name, count(reviews.id) as Review_ID, reviews.content as Total_Reviews
						FROM users
						LEFT JOIN reviews
						ON users.id = reviews.user_id
						WHERE users.id = ?";
			$values = $id;


			return $this->db->query($query, $id) -> result_array();
		}

	// gets all books and info
		public function get_all_books()
		{
			$query = "SELECT * FROM books";
			return $this->db->query($query) -> result_array();
		}

	// this info is added to the books table when the user addsa new book and review
		public function add_new_book($title, $author)
		{
			// var_dump($title, $author);
			// die;
			$query = "INSERT INTO books (title, author, created_at, updated_at) VALUES (?,?,now(),now())";
			
			$values = array($title, $author);

			$this->db->query($query, $values);

			return mysql_insert_id(); 
		}

	// inserts the review along with the appropriate ids into the reviews table
		public function add_new_review($user_id, $book_id, $review, $stars)
		 {
			$query = "INSERT INTO reviews (user_id, book_id, content, stars, created_at, updated_at) VALUES (?,?,?,?, now(), now())";

			$values = array($user_id, $book_id, $review, $stars);

			$this->db->query($query, $values);
		 }

	// allows the user to get the book based on id
		 public function view_book($id)
		{				 
			$query = "SELECT books.id, books.title, books.author, reviews.id as review_id, reviews.book_id, reviews.content, 
				reviews.created_at, users.id, users.first_name, users.last_name, users.alias, users.email, users.created_at, 
				users.updated_at
				FROM books
				JOIN reviews
				ON books.id = reviews.book_id	 
				JOIN users	
				ON reviews.user_id = users.id
				WHERE books.id = ?";
			 		
				$values = $id;

				return $this->db->query($query, $values) -> result_array();		
		}

	// gets book by title
		public function get_book_by_title($title)
		{
			
			$query = "SELECT * FROM books WHERE books.title = ?";

			$values = $title;

			return $this->db->query($query, $values)->row_array();
		}

		
	// gets the book by specific id
		public function get_book_by_id($id)
		{
			
			$query = "SELECT books.*, reviews.id as review_id, reviews.user_id as user_review, reviews.content, reviews.stars, reviews.created_at as review_created, reviews.updated_at, users.id as user_id, users.first_name
			FROM books
			LEFT JOIN reviews
			ON books.id = reviews.book_id
			LEFT JOIN users
			ON reviews.user_id = users.id
			WHERE books.id = ?
			ORDER BY review_created DESC";

			$values = $id;

			return $this->db->query($query, $values)->result_array();

		}

	// deletes the specific review by its id
		public function delete($id)
		{
			$this->db->query("DELETE FROM reviews WHERE reviews.id = ?", array($id));
		}
	 }
























