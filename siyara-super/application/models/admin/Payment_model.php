<?php
	class Payment_model extends CI_Model{

		public function add_payment($data){
			$this->db->insert('payments', $data);
			return true;
		}

		//---------------------------------------------------
		// get all payments for server-side datatable processing 
		public function get_all_payments(){
			$this->db->select('*');
			$this->db->where('is_admin',0);
			return $this->db->get('payments')->result_array();
		}


		//---------------------------------------------------
		// Get payment detial by payment_id
		public function get_payment_by_payment_id($paymentId){
			$query = $this->db->get_where('payments', array('payment_id' => $paymentId));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit payment Record
		public function edit_payment($data, $paymentId){
			$this->db->where('payment_id', $paymentId);
			$this->db->update('payments', $data);
			return true;
		}

		//---------------------------------------------------
		// Change payment status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('payment_id', $this->input->post('payment_id'));
			$this->db->update('payments');
		} 

	}

?>