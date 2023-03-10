<?php
	class User_model extends CI_Model{

		public function add_user($data){
			$this->db->insert('users', $data);
			return true;
		}

		//---------------------------------------------------
		// get all users for server-side datatable processing (ajax based)
		public function get_all_users(){
			$this->db->select('*');
			$this->db->where('is_admin',0);
			return $this->db->get('users')->result_array();
		}


		//---------------------------------------------------
		// Get user detial by user_id
		public function get_user_by_user_id($userid){
			$query = $this->db->get_where('users', array('user_id' => $userid));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit user Record
		public function edit_user($data, $userid){
			$this->db->where('user_id', $userid);
			$this->db->update('users', $data);
			return true;
		}

		//---------------------------------------------------
		// Change user status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('user_id', $this->input->post('user_id'));
			$this->db->update('users');
		} 

	}

?>