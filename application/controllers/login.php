<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{    

    public function __construct()
    {
        parent::__construct();

      
    }

    public function index ()
    {
    	$this->load->view('index');
    }

	// validates the user sign_in
	public function sign_in()
	{
		$this->load->model('Login_Reg');
		$customer = $this->Login_Reg->get_user($this->input->post());

	// if our query comes back with a user we run the following code and set the array to a session so we can access throughout the site.
		if($customer)
		{
			$user = array(
				'user_id'=> $customer['id'],
				'first_name' => $customer['first_name'],
				'last_name' => $customer['last_name'],
				'alias' => $customer['alias'],
				'email' => $customer['email'],
				'full_name' => $customer['first_name'] . ' ' . $customer['last_name'],
				'is_logged_in' => true
				);
			$this->session->set_userdata($user);
			redirect('books/index');

		}
	
		
		else
		{
			$this->session->set_flashdata('user_error', "Invalid Email or Password! Please try again!");
			redirect('/');
		}
	}

	//validates the new user registration
	public function registration ()
	{
		

		//runs if there are errors in the registration fields
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required"); 
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required"); 
		$this->form_validation->set_rules("alias", "Alias", "trim|required"); 
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email] "); 
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|matches[passconf]"); 
		$this->form_validation->set_rules("passconf", "Password Confirmation", "trim|required"); 

		if ($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('form_validation', validation_errors());
			redirect('/');
		}
		else 
		{
			$this->load->model("Login_Reg");
			$data = $this->input->post();
			$this->Login_Reg->new_user($data);
			$customer = $this->Login_Reg->get_user($this->input->post());

			if($customer)
			{
				$user = array(
					'user_id'=> $customer['id'],
					'first_name' => $customer['first_name'],
					'last_name' => $customer['last_name'],
					'alias' => $customer['alias'],
					'email' => $customer['email'],
					'full_name' => $customer['first_name'] . ' ' . $customer['last_name'],
					'is_logged_in' => true
					);
				
				$this->session->set_userdata($user);
				redirect('books/index');

			}	
	    }
	}
}

