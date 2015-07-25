<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller 
{    

    public function __construct()
    {
        parent::__construct();

    }

    public function index ()
    {
    	
    }

    // the method shows each user on the customer_detail page
    public function show($id)
	{
		$this->load->model('Reviews');
        $data['total_reviews'] = $this->Reviews->get_user_total_reviews($id);
        $data['review_titles'] = $this->Reviews->user_reviews($id);

        for ($i=0; $i <count($data['review_titles']) ; $i++) { 
            $test = $data['review_titles'][$i];
            $ddd = new DateTime($test['date_review']);
            $data['review_titles'][$i]['date_review'] = $ddd->format("F j, Y, g:i a");
        }
    
		$this->load->view('user_details', $data);	
		
	}

    // logs the user off
    public function log_off()
    {
    	$this->session->sess_destroy();
    	redirect('/');
    }

   

}