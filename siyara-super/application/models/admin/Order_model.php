<?php
	class Order_model extends CI_Model{

		public function add_order($data){
			$this->db->insert('order', $data);
			return true;
		}

		public function add_order_ifnotexsit(){
			$id = $this->session->userdata('admin_id');
			$data = array( 'order_id' => '0'-$id, 'customer_id' => $id);
			$this->db->replace('order',$data);
			
			return true;
		}
		
		public function add_order_info_ifnotexsit($data,$new_available_quantity)
		{

			//$id = $this->session->userdata('order_info_id');
			$this->db->where('order_info_id',$data['order_info_id']);
			$q = $this->db->get('order_info');
			
			if ( $q->num_rows() > 0 )  {
					echo 'found!';
					$old_quantity=0;
					$old_subtotal=0;
					foreach ($q ->result() as $row)
					{
						//echo $row->title;
						$old_quantity=$row->quantity;
						$old_subtotal=$row->sub_total;

					}
					//update the quantity in the cart if same item is trying to add
					$data1 = array(
					'quantity' => $data['quantity']+ $old_quantity,
					'sub_total' => $data['sub_total']+$old_subtotal,
					);
				$this->db->where('order_info_id', $data['order_info_id']);
				$this->db->update('order_info', $data1);
				
				//reduce the vaailable quantity in the product table
				$data2 = array(
					'quantity' => $new_available_quantity,
					);

				$this->db->where('product_id', $data['product_id']);
				$this->db->update('product', $data2);

			} else {
				echo 'not found';
				$this->db->insert('order_info',$data);

				//reduce the vaailable quantity in the product table
				$data2 = array(
					'quantity' => $new_available_quantity,
					);

				$this->db->where('product_id', $data['product_id']);
				$this->db->update('product', $data2);

			}
			


					
		}
		//---------------------------------------------------
		// get all orders for server-side datatable processing 
		public function get_all_orders(){
			$this->db->select('*');
			//$this->db->where('is_admin',0);
			return $this->db->get('order')->result_array();
		}

		function get_filtered_orders()
		{

			$this->db->from('order');

			//$this->db->join('ci_admin_roles','ci_admin_roles.admin_role_id=ci_admin.admin_role_id');

			//if($this->session->userdata('filter_type')!='')

				//$this->db->where('ci_admin.admin_role_id',$this->session->userdata('filter_type'));

			//if($this->session->userdata('filter_status')!='')

				//$this->db->where('ci_admin.is_active',$this->session->userdata('filter_status'));


			$filterData = $this->session->userdata('filter_keyword');

			$this->db->like('order.order_id',$filterData);
			$this->db->or_like('order.customer_id',$filterData);
			//$this->db->or_like('order.description',$filterData);
			//$this->db->or_like('order.order_id',$filterData);
			//$this->db->or_like('order.mobile_no',$filterData);
			//$this->db->or_like('order.username',$filterData);

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
		// Get order detial by Order_id
		public function get_order_by_id($orderId){
			$query = $this->db->get_where('order', array('order_id' => $orderId));
			return $result = $query->row_array();
		}

		// Get order Info detial by Order_id
		public function get_order_info_by_order_id(){
			$order_id=0-$this->session->userdata('admin_id');
			$this->db->where('order_id',$order_id);
			$query= $this->db->get('order_info');
			$module = array();
			if ( $query->num_rows() > 0 )  {
					echo 'found!';
					foreach ($query ->result() as $row)
					{
						$module = $query->result_array();
					}

			return $module;
			}
		}

		
		//---------------------------------------------------
		// Edit order Record
		public function edit_order($data, $orderId){
			$this->db->where('order_id', $orderId);
			$this->db->update('order', $data);
			return true;
		}

		
		//---------------------------------------------------
		// Change order status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('order_id', $this->input->post('order_id'));
			$this->db->update('order');
		} 

	}

?>