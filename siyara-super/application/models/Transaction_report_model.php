<?php
	class Transaction_report_model extends CI_Model{

		public function add_transaction_report($data){
			$this->db->insert('transaction_report', $data);
			return true;
		}

		//---------------------------------------------------
		// get all transaction_report for server-side datatable processing 
		public function get_all_transaction_report(){
			$this->db->select('*');
			$this->db->where('is_admin',0);
			return $this->db->get('transaction_report')->result_array();
		}


		//---------------------------------------------------
		// Get transaction_report detial by transaction_report_id
		public function get_transaction_report_by_transaction_report_id($transaction_reportId){
			$query = $this->db->get_where('transaction_report', array('transaction_report_id' => $transaction_reportId));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit transaction_report Record
		public function edit_transaction_report($data, $transaction_reportId){
			$this->db->where('transaction_report_id', $transaction_reportId);
			$this->db->update('transaction_report', $data);
			return true;
		}

		//---------------------------------------------------
		// Change transaction_report status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('transaction_report_id', $this->input->post('transaction_report_id'));
			$this->db->update('transaction_report');
		} 

	}

?>