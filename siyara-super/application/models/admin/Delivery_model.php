<?php
	class Delivery_model extends CI_Model{

		public function add_delivery($data){
			$this->db->insert('delivery', $data);
			return true;
		}

		//---------------------------------------------------
		// get all deliverys for server-side datatable processing 
		public function get_all_delivery(){
			$this->db->select('*');
			$this->db->where('is_admin',0);
			return $this->db->get('delivery')->result_array();
		}


		//---------------------------------------------------
		// Get delivery detial by delivery_id
		public function get_delivery_by_delivery_id($deliveryId){
			$query = $this->db->get_where('delivery', array('delivery_id' => $deliveryId));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit delivery Record
		public function edit_delivery($data, $deliveryId){
			$this->db->where('delivery_id', $deliveryId);
			$this->db->update('delivery', $data);
			return true;
		}

		//---------------------------------------------------
		// Change delivery status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('delivery_id', $this->input->post('delivery_id'));
			$this->db->update('delivery');
		} 

	}

?>