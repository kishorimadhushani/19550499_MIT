<?php
	class Product_model extends CI_Model{

		public function add_product($data){
			$this->db->insert('product', $data);
			return true;
		}

		//---------------------------------------------------
		// get all products for server-side datatable processing 
		public function get_all_products(){
			$this->db->select('*');
			//$this->db->where('is_admin',0);
			return $this->db->get('product')->result_array();
		}

		function get_filtered_products()
		{

			$this->db->from('product');

			//$this->db->join('ci_admin_roles','ci_admin_roles.admin_role_id=ci_admin.admin_role_id');

			//if($this->session->userdata('filter_type')!='')

				//$this->db->where('ci_admin.admin_role_id',$this->session->userdata('filter_type'));

			//if($this->session->userdata('filter_status')!='')

				//$this->db->where('ci_admin.is_active',$this->session->userdata('filter_status'));


			$filterData = $this->session->userdata('filter_keyword');

			$this->db->like('product.product_name',$filterData);
			$this->db->or_like('product.brand_name',$filterData);
			//$this->db->or_like('product.description',$filterData);
			$this->db->or_like('product.product_id',$filterData);
			//$this->db->or_like('product.mobile_no',$filterData);
			//$this->db->or_like('product.username',$filterData);

			//$this->db->where('ci_admin.is_supper !=', 1);

			//$this->db->order_by('ci_admin.admin_id','desc');

			$query = $this->db->get();

			$module = array();

			if ($query->num_rows() > 0) 
			{
				$module = $query->result_array();
			}

			return $module;
		}



		//---------------------------------------------------
		// Get product detial by product_id
		public function get_product_by_id($productId){
			$query = $this->db->get_where('product', array('product_id' => $productId));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit product Record
		public function edit_product($data, $productId){
			$this->db->where('product_id', $productId);
			$this->db->update('product', $data);
			return true;
		}

		//---------------------------------------------------
		// Change product status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('product_id', $this->input->post('product_id'));
			$this->db->update('product');
		} 


	}

?>