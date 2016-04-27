<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Quotables extends CI_Controller{

	
	public function index () {
			$this->load->library('form_validation');
			$this->load->view('login_register');
		}

	public function register(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("email", "E-Mail", "trim|required|valid_email");
		$this->form_validation->set_rules("confirmpass", "Confirm Password", "trim|required|matches[password]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|do_hash");
		$this->form_validation->set_rules("name", "Full Name", "trim|required|min_length[3]|xss_clean");
		$this->form_validation->set_rules("alias", "Alias", "trim|required|min_length[3]|xss_clean");
		$this->form_validation->set_rules("birthdate", "Birthdate", "trim|required|xss_clean");		
		if($this->form_validation->run() === FALSE){
			$this->load->view('login_register');
		}
		else{
			$this->load->model("Quotable");
			$user_info = $this->input->post();
			$add_user = $this->Quotable->add_user($user_info);
			if ($add_user){
				$this->session->set_userdata(['logged_info' => $add_user]);
				redirect("/quotables/view_dashboard");
			}
			else{
				$this->session->set_flashdata("login_error", "E-Mail Address is already registered");
				redirect('/');
			}
		}
	}

	public function signin_process(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("email2", "E-Mail", "trim|required|valid_email");
		$this->form_validation->set_rules("password2", "Password", "trim|required|min_length[8]|do_hash");

		if($this->form_validation->run() == FALSE){
			$this->load->view('login_register');
		}
		else {
			$this->load->model('Quotable');
			$user_info = $this->input->post();
			$user_signin = $this->Quotable->signin($user_info);
			if($user_signin) {
				$this->session->set_userdata(['logged_info' => $user_signin]);
				redirect('/quotables/view_dashboard');
			}
			else {
				$this->session->set_flashdata("login_error", "The E-Mail or Password information is incorrect.");
				redirect('/');
			}
		}
	}

	public function view_dashboard() {
		$logged_info = $this->session->userdata('logged_info');
		$this->load->model('Quotable');
		$this->load->library('form_validation');
		$favorites = $this->Quotable->get_favorites($logged_info['id']);
		$quotelist = $this->Quotable->get_quotelist($logged_info['id']);
		$this->load->view('quotes_dashboard', ['favorites' => $favorites, 'quotelist' => $quotelist]);
	}

	public function add_to_favorites($user_id, $quote_id){
		$this->load->model('Quotable');
		$this->Quotable->add_favorite($user_id, $quote_id);
		redirect('/quotables/view_dashboard');
	}

	public function remove_from_favorites($user_id, $quote_id){
		$this->load->model('Quotable');
		$this->Quotable->remove_favorite($user_id, $quote_id);
		redirect('/quotables/view_dashboard');
	}

	public function new_quote(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("quoted_by", "Quoted By", "trim|required|min_length[3]|xss_clean");
		$this->form_validation->set_rules("quote", "Message", "trim|required|min_length[10]|xss_clean");
				
		if($this->form_validation->run() == FALSE){
			$logged_info = $this->session->userdata('logged_info');
			$this->load->model('Quotable');
			$this->load->library('form_validation');
			$favorites = $this->Quotable->get_favorites($logged_info['id']);
			$quotelist = $this->Quotable->get_quotelist($logged_info['id']);
			$this->load->view('quotes_dashboard', ['favorites' => $favorites, 'quotelist' => $quotelist]);
		}
		else {
			$this->load->model('Quotable');
			$new_quote = $this->input->post();
			$this->Quotable->add_quote($new_quote);
			redirect('/quotables/view_dashboard');
		}
	}

	public function view_quotes($id) {
		$this->load->model('Quotable');
		$quote_list = $this->Quotable->get_user_quotes($id);
		$this->load->view('user_quotes', ['quote_list' => $quote_list]);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}

}

 ?>