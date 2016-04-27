<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class CloudRecipes extends CI_Controller{

	public function index () {
			$this->load->library('form_validation');
			// $this->load->view('new_ingredient');
			redirect('/new_ingredient');
		}

	public function new_ingredient_view () {
			$this->load->library('form_validation');
			$this->load->model('cloudrecipe');
			$ingr_cat_list = $this->cloudrecipe->get_ingr_category();
			$this->load->view('new_ingredient', ['ingr_cat_list' => $ingr_cat_list]);
	}

	public function add_ingredients () {
			$this->load->model('cloudrecipe');

	}

}


?>