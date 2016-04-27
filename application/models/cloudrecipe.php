<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class CloudRecipe extends CI_Model {


	public function get_ingr_category(){
		$query = "SELECT id AS ingr_cat_id, category AS ingr_category FROM ingr_categories";
		return $this->db->query($query)->result_array();
	}






}

?>