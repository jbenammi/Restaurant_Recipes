<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class CloudRecipes extends CI_Controller{

	public function index () {
		$this->load->library('form_validation');
		$this->load->view('main');
		}

	public function goto_register(){
		$this->load->library('form_validation');
		$this->load->view('register');
	}

	public function view_ingredients(){
		$logged_info = $this->session->userdata('logged_info');
		$this->load->model('cloudrecipe');
		$list = $this->cloudrecipe->get_ingr_list($logged_info['restaurants_id']);
		$this->load->view('view_ingredients', ['ingr_list' => $list]);
	}
	public function new_ingredient_view () {
		$this->load->library('form_validation');
		$this->load->model('cloudrecipe');
		$ingr_cat_list = $this->cloudrecipe->get_ingr_category();
		$this->load->view('new_ingredient', ['ingr_cat_list' => $ingr_cat_list]);
	}
	public function add_recipe_view () {
		$logged_info = $this->session->userdata('logged_info');
		$this->load->library('form_validation');
		$this->load->model('cloudrecipe');
		$list = $this->cloudrecipe->get_ingr_list($logged_info['restaurants_id']);
		$unitlist = $this->cloudrecipe->get_units_list();
		$recCatlist = $this->cloudrecipe->get_recipe_cat();
		$this->load->view('new_recipe', ['ingr_list' => $list, 'unit_list' => $unitlist, 'rec_cat_list' => $recCatlist]);
	}
	public function add_recipes(){
		$this->load->library('form_validation');
		$logged_info = $this->session->userdata('logged_info');
		$values = $this->input->post();
		$values['user_id'] = $logged_info['user_id'];
		$values['restaurants_id'] = $logged_info['restaurants_id'];
		$this->load->model('cloudrecipe');
		$this->cloudrecipe->add_recipe($values);
		redirect('/add_recipe');
	}

	public function get_recipe_lists(){
		$logged_info = $this->session->userdata('logged_info');
		$this->load->model('cloudrecipe');
		$recipelist = $this->cloudrecipe->get_recipe_list($logged_info['restaurants_id']);
		$this->load->view('view_recipe_list', ['recipelist' => $recipelist]);
	}
	public function ingr_list_api() {
		$this->load->library('form_validation');
		$this->load->model('cloudrecipe');
		$list = $this->cloudrecipe->get_ingr_list();
		$this->load->view('ingr_list_data', ['ingr_list' => $list]);
	}

	public function units_list($num) {
		$this->load->library('form_validation');
		$this->load->model('cloudrecipe');
		$list = $this->cloudrecipe->get_units_list();
		return $list;
	}

	public function add_ingredients () {
		$logged_info = $this->session->userdata('logged_info');
		$values = $this->input->post();
		$values['user_id'] = $logged_info['user_id'];
		$values['restaurants_id'] = $logged_info['restaurants_id'];
		$this->load->model('cloudrecipe');
		$this->cloudrecipe->add_ingredient($values);
		redirect('/view_ingredients');
	}


	public function register(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("email", "E-Mail", "trim|required|valid_email");
		$this->form_validation->set_rules("confirmpass", "Confirm Password", "trim|required|matches[password]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|do_hash");
		$this->form_validation->set_rules("fname", "First Name", "trim|required|min_length[3]|xss_clean");
		$this->form_validation->set_rules("lname", "Last Name", "trim|required|min_length[3]|xss_clean");
		$this->form_validation->set_rules("restaurant", "Restaurant", "trim|required|min_length[3]|xss_clean");
		$this->form_validation->set_rules("address", "Restaurant Address", "trim|required|xss_clean");
			$this->form_validation->set_rules("city", "City", "trim|required|xss_clean");
		$this->form_validation->set_rules("state", "State", "required");
		$this->form_validation->set_rules("zip", "Zip Code", "required|max_length[10]|numeric|xss_clean");
		$this->form_validation->set_rules("phone", "Phone Number", "required|max_length[10]|numeric|xss_clean");
		if($this->form_validation->run() === FALSE){
			$this->load->view('main');
		}
		else{
			$this->load->model("cloudrecipe");
			$form_info = $this->input->post();
			$add_restaurant = $this->cloudrecipe->register_restaurant($form_info);
			if ($add_restaurant){
				$this->session->set_userdata(['logged_info' => $add_restaurant]);
				redirect("/get_recipe_lists");
			}
			else{
				$this->session->set_flashdata("login_error", "This Restaurant is already setup. Please contact your restaurants' RecipeNimbus admin to register.");
				redirect('/');
			}
		}
	}
	public function signin_process(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("email2", "E-Mail", "trim|required|valid_email");
		$this->form_validation->set_rules("restaurant2", "Restaurant", "trim|required|min_length[3]|xss_clean");
		$this->form_validation->set_rules("password2", "Password", "trim|required|min_length[8]|do_hash");

		if($this->form_validation->run() == FALSE){
			$this->load->view('main');
		}
		else {
			$this->load->model('cloudrecipe');
			$user_info = $this->input->post();
			$user_signin = $this->cloudrecipe->signin($user_info);
			if($user_signin) {
				$this->session->set_userdata(['logged_info' => $user_signin]);
				redirect('/get_recipe_lists');
			}
			else {
				$this->session->set_flashdata("login_error", "The E-Mail, Restaurant, or Password information is incorrect.");
				redirect('/');
			}
		}
	}
	public function logout (){
		$this->session->sess_destroy();
		redirect('/');
	}

}


?>