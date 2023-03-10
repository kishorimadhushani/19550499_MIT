<?php
	class Order_info_model extends CI_Model{

		public function add_order_info($data){
			$this->db->insert('order_info', $data);
			return true;
		}

		//---------------------------------------------------
		// get all order_info for server-side datatable processing 
		public function get_all_order_info(){
			$this->db->select('*');
			$this->db->where('is_admin',0);
			return $this->db->get('order_info')->result_array();
		}


		//---------------------------------------------------
		// Get order_info detial by order_info_id
		public function get_order_info_by_order_info_id($orderinfoId){
			$query = $this->db->get_where('order_info', array('order_info_id' => $orderinfoId));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit order_info Record
		public function edit_order_info($data, $orderinfoId){
			$this->db->where('order_info_id', $orderinfoId);
			$this->db->update('order_info', $data);
			return true;
		}

		//---------------------------------------------------
		// Change order_info status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('order_info_id', $this->input->post('order_info_id'));
			$this->db->update('order_info');
		} 

	}

?>