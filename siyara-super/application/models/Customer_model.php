<?php
	class Customer_model extends CI_Model{

		public function add_customer($data){
			$this->db->insert('customer', $data);
			return true;
		}

		//---------------------------------------------------
		// get all customers for server-side datatable processing 
		public function get_all_customer(){
			$this->db->select('*');
			$this->db->where('is_admin',0);
			return $this->db->get('customer')->result_array();
		}


		//---------------------------------------------------
		// Get customer detial by customer_id
		public function get_customer_by_customer_id($customerId){
			$query = $this->db->get_where('customer', array('customer_id' => $customerId));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit customer Record
		public function edit_customer($data, $customerId){
			$this->db->where('customer_id', $customerId);
			$this->db->update('customer', $data);
			return true;
		}

		//---------------------------------------------------
		// Change customer status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('customer_id', $this->input->post('customer_id'));
			$this->db->update('customer');
		} 

	}

?>