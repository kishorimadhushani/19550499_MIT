<?php
	class Driver_model extends CI_Model{

		public function add_driver($data){
			$this->db->insert('driver', $data);
			return true;
		}

		//---------------------------------------------------
		// get all drivers for server-side datatable processing 
		public function get_all_drivers(){
			$this->db->select('*');
			//$this->db->where('is_admin',0);
			return $this->db->get('driver')->result_array();
		}


		//---------------------------------------------------
		// Get driver detial by driver_id
		public function get_driver_by_id($driverId){
			$query = $this->db->get_where('driver', array('driver_id' => $driverId));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit driver Record
		public function edit_driver($data, $driverId){
			$this->db->where('driver_id', $driverId);
			$this->db->update('driver', $data);
			return true;
		}

		//---------------------------------------------------
		// Change driver status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('driver_id', $this->input->post('driver_id'));
			$this->db->update('driver');
		} 


	}

?>