<?php
	class Supplier_model extends CI_Model{

		public function add_supplier($data){
			$this->db->insert('supplier', $data);
			return true;
		}

		//---------------------------------------------------
		// get all suppliers for server-side datatable processing 
		public function get_all_suppliers(){
			$this->db->select('*');
			//$this->db->where('is_admin',0);
			return $this->db->get('supplier')->result_array();
		}


		//---------------------------------------------------
		// Get supplier detial by supplier_id
		public function get_supplier_by_id($supplierId){
			$query = $this->db->get_where('supplier', array('supplier_id' => $supplierId));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit supplier Record
		public function edit_supplier($data, $supplierId){
			$this->db->where('supplier_id', $supplierId);
			$this->db->update('supplier', $data);
			return true;
		}

		//---------------------------------------------------
		// Change supplier status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('supplier_id', $this->input->post('supplier_id'));
			$this->db->update('supplier');
		} 


	}

?>