<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books extends CI_Controller 
{    

    public function __construct()
    {
        parent::__construct();
    }

    // this shows all the book reviews and book titles after the user has signed in or registered
    public function index ()
 	{
 	    $this->load->model('Reviews');
    	$data['books'] = $this->Reviews->get_reviews();
    	$data['reviews'] = $this->Reviews->get_all_reviews();

      // set a for loop to move through and show everything on the page
        for ($i=0; $i < count($data['books']) ; $i++) { 
            $test = $data['books'][$i];
            $ddd = new DateTime($test['created_at']);
            $data['books'][$i]['created_at'] = $ddd->format("F j, Y, g:i a");
        }

    	$this->load->view('books', $data);
    }

    // loads the new book page
    public function new_book()
    {
        $this->load->model('Reviews');
        $book['authors'] = $this->Reviews->get_all_books();
        $book['feedback'] = $this->Reviews->get_reviews();
        $this->load->view('new_book', $book);
    }

    // loads the book details page where you can view reviews for a certain book or add a new review yourself
    public function book_details($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Title", "trim|required"); 
        $this->form_validation->set_rules("review", "Review", "trim|required");  

        if ($this->form_validation->run() === FALSE)
        {
            $this->session->set_flashdata('form_validation', validation_errors());
            redirect('/books/new_book');
        }
        else
        {
            $user_id = $this->input->post('id');
            $title = $this->input->post('title');
                if($this->input->post('new_author'))
                {
                    $author = $this->input->post('new_author');
                }
                elseif ($this->input->post('old_author'))
                {
                    $author = $this->input->post('old_author');
                }
            $review = $this->input->post('review');
            $stars = $this->input->post('stars');
            $this->load->model('Reviews');
            $book_id = $this->Reviews->add_new_book($title, $author);
            $this->Reviews->add_new_review($user_id, $book_id, $review, $stars);
            redirect('/books/view_book/'.$book_id);
        }
    }

    // views the book details
    public function view_book ($id)
    {
        $this->load->model('Reviews');
        $book['info'] = $this->Reviews->get_book_by_id($id);

        //set a for loop to move through everything and show it on the page
        for ($i=0; $i <count($book['info']) ; $i++) 
        { 
            $test = $book['info'][$i];
            $ddd = new DateTime($test['review_created']);
            $book['info'][$i]['review_created'] = $ddd->format("F j, Y, g:i a");
        }
        $this->load->view('book_details', $book);
    }

    // add a new review from the book details page
    public function new_review($id)
    {
        $book_id = $id;

        $this->load->library("form_validation");
        $this->form_validation->set_rules("reviews", "Reviews", "trim|required"); 

     
        if ($this->form_validation->run() === FALSE)
        {
            $this->session->set_flashdata('form_validation', validation_errors());
            redirect('/books/view_book/'.$book_id);
        }
        else
        {
        $user_id = $this->input->post('user_id');
        $book_id = $this->input->post('book_id');
        $review = $this->input->post('reviews');
        $stars = $this->input->post('stars');
        $this->load->model('Reviews');
        $this->Reviews->add_new_review($user_id, $book_id, $review, $stars);
        redirect('/books/view_book/'.$book_id); 
        }
    }

    // deletes the book from the book details page
    public function delete_book($book_id, $review_id)
    {
         $this->load->model('Reviews');
         $this->Reviews->delete($review_id);
         redirect('/books/view_book/'.$book_id);
    }


    // deletes the book from the books page
    public function remove_book($review_id)
    {
         $this->load->model('Reviews');
         $this->Reviews->delete($review_id);
         redirect('/books/index');
    }

}
   






















