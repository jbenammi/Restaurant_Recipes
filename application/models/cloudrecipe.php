<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class CloudRecipe extends CI_Model {

	public function add_user($user_info){
		
		$query3 = "SELECT id FROM restaurants WHERE restaurants.name = ?";
		$info = [$user_info['restaurant']];
		$rest_info = $this->db->query($query3, $info)->row_array();
		$query = "INSERT INTO users(first_name, last_name, email, password, created_on, updated_on, restaurants_id) VALUES(?, ?, ?, ?, now(), now(), ?)";

		$user = [$user_info['fname'], $user_info['lname'], $user_info['email'], $user_info['password'], $rest_info['id']];
		$query2 = "SELECT users.id AS user_id, first_name, last_name, email, restaurants_id from users JOIN restaurants ON users.restaurants_id = restaurants.id WHERE email = ? AND restaurants.name = ?";
		$user2 = [$user_info['email'], $user_info['restaurant']];
		if($this->db->query($query2, $user2)->row_array() == null){
			$this->db->query($query, $user);
			return $this->db->query($query2, $user2)->row_array();
		}
		else {
			return FALSE;
		}
	}

	public function register_restaurant($form_info){
		
		$query = "SELECT restaurants.name FROM restaurants WHERE restaurants.name = ?";
		$info = [$form_info['restaurant']];
		
		$query2 = "INSERT INTO restaurants(name, address, city, state, zip, phone_number, created_on, updated_on) VALUES(?, ?, ?, ?, ?, ?, now(), now())";
		$info2 = [$form_info['restaurant'], $form_info['address'], $form_info['city'], $form_info['state'], $form_info['zip'], $form_info['phone']];

		$query3 = "SELECT id FROM restaurants WHERE name = ?";
		$info3 = [$form_info['restaurant']];

		$query5 = "SELECT users.id FROM users WHERE email = ?";
		$info5 = [$form_info['email']];


		$query7 = "SELECT users.id AS user_id, first_name, last_name, email, restaurants_id from users WHERE email = ?";
		$info7 = [$form_info['email']];

		if($this->db->query($query, $info)->row_array() == null){
			$this->db->query($query2, $info2);
			$rest_id = $this->db->query($query3, $info3)->row_array();
			$query4 = "INSERT INTO users(first_name, last_name, email, password, created_on, updated_on, restaurants_id) VALUES(?, ?, ?, ?, now(), now(), ?)";
			$info4 = [$form_info['fname'], $form_info['lname'], $form_info['email'], $form_info['password'], $rest_id['id']];
			$this->db->query($query4, $info4);
			$user_id = $this->db->query($query5, $info5)->row_array();
			$query6 = "UPDATE restaurants SET main_admin_id = ? WHERE id = ?";
			$info6 = [$user_id['id'], $rest_id['id']];
			$this->db->query($query6, $info6);
			return $this->db->query($query7, $info7)->row_array();
		}
		else {
			return FALSE;
		}
	}





	public function signin($user_info){
		$query3 = "SELECT id FROM restaurants WHERE restaurants.name = ?";
		$info = [$user_info['restaurant2']];
		$rest_info = $this->db->query($query3, $info)->row_array();
		$query = "SELECT users.id AS user_id, first_name, last_name, email, restaurants_id from users JOIN restaurants ON users.restaurants_id = restaurants.id WHERE email = ? AND password = ? AND users.restaurants_id = ?";
		$user = [$user_info['email2'], $user_info['password2'], $rest_info['id']];
		return $this->db->query($query, $user)->row_array();
	}


	public function get_ingr_category(){
		$query = "SELECT id AS ingr_cat_id, category AS ingr_category FROM ingr_categories";
		return $this->db->query($query)->result_array();
	}


	public function add_ingredient ($values){
		$query = "INSERT INTO ingredients(name, usda_number, ingr_category_id, uom_categories_id, created_on, updated_on, restaurant_id)  VALUES(?, ?, ?, ?, now(), now(), ?)";
		$info = [$values['ingr_name'], $values['usda_num'], $values['ingr_category'], $values['measure_grp'], $values['restaurants_id']];
		$this->db->query($query, $info);
	}

	public function get_ingr_list ($id) {
		$query = "SELECT ingredients.name, usda_number, uom_categories.category AS uom_type, uom_categories.id AS uom_type_id, ingr_categories.category AS ingr_category, ingredients.id AS ingr_id FROM ingredients JOIN ingr_categories ON ingr_categories.id = ingredients.ingr_category_id JOIN uom_categories ON ingredients.uom_categories_id = uom_categories.id WHERE ingredients.restaurant_id = ? ORDER BY ingredients.name";
		$info = [$id];
		return $this->db->query($query, $info)->result_array();
	}

	public function get_units_list () {
		$query = "SELECT * FROM units";
		return $this->db->query($query)->result_array();
	}
	public function get_recipe_cat () {
		$query = "SELECT * FROM recipe_categories";
		return $this->db->query($query)->result_array();
	}







	public function add_recipe ($values){
		$rec_info = $values;
		$query = "INSERT INTO recipes(name, servings, instructions, created_on, updated_on, recipe_category_id, user_id, restaurant_id) VALUES(?, ?, ?, now(), now(), ?, ?, ?)";

		$info = [$rec_info['recipe_name'], $rec_info['servings'], $rec_info['directions'], $rec_info['rec_cat'], $rec_info['user_id'], $rec_info['restaurants_id']];
		
		$this->db->query($query, $info);

		$recipeId = $this->db->insert_id();
		
		$information = $values;
		for ($x = 0; $x < 3; $x++){
			array_pop($information);
		}

		$ingr_in_rec = [];
		foreach ($information as $key => $value) {
		 	if($key !='recipe_name' AND $key != 'servings' AND $key != 'rec_cat' ){
		 		$ingr_in_rec[] = $value;
		 	}
		 }
		 $ing = [$recipeId];
		 for ($i = 0; $i < count($ingr_in_rec); $i+=3){
		 	for($j = $i; $j < $i+3; $j++){
		 		$ing[] = $ingr_in_rec[$j];
		 	}
		 	$query2 = "INSERT INTO ingredients_in_recipes(recipes_id, ingredients_id, amount, units_id, created_on, updated_on) VALUES(?, ?, ?, ?, now(), now())";
		 	$this->db->query($query2, $ing);
			$ing = [$recipeId];
		 }
	}

	public function get_recipe_list ($id){
		$query = "SELECT recipes.id AS recipe_id, name, servings, category FROM recipes JOIN recipe_categories ON recipe_categories.id = recipes.recipe_category_id WHERE recipes.restaurant_id = ?";
		$info = [$id];
		return $this->db->query($query, $info)->result_array();
	}


}


?>