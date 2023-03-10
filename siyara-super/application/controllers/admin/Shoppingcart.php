<?php defined('BASEPATH') OR exit('No direct script access allowed');
class shoppingcart extends MY_Controller {
	
	public function __construct(){

		parent::__construct();
		//auth_check(); // check login auth
		//$this->rbac->check_module_access();
		

		$this->load->model('admin/product_model', 'product_model');
		$this->load->model('admin/order_model', 'order_model');
		//$this->load->model('admin/order_info_model', 'order_info_model');
		$this->load->model('admin/Activity_model', 'activity_model');
	}


	public function cart_products(){
		//$this->session->set_userdata('filter_type',$type);
		$this->session->set_userdata('filter_keyword','');
		$this->session->set_userdata('filter_status','');
		$data['info'] = $this->product_model->get_filtered_products();
		$this->load->view('admin/includes/_header');
		$this->load->view('shoppingcart/cart_products', $data);
		//$this->load->view('shoppingcart/index', $data);
		$this->load->view('admin/includes/_footer');
		$this->order_model->add_order_ifnotexsit();
	}

	public function add_to_cart($product_id)
	{
		echo $product_id;
		//echo $this->input->post('quantity1');
		echo $_GET['quantity'.$product_id];
		$available_quantity = $_GET['available_quantity'];
		$new_available_quantity=$available_quantity-$_GET['quantity'.$product_id];
		echo 'new available quantity:';
		echo $new_available_quantity;
		$data = array(
			'order_info_id'=> '-'.$this->session->userdata('admin_id').$product_id.'',
			'product_id' => $product_id,
			'order_id' => 0-$this->session->userdata('admin_id'),
			'product_price' => $_GET['price'],
			'quantity' => $_GET['quantity'.$product_id],
			'product_name' => $_GET['product_name'],
			'brand_name' => $_GET['brand_name'],
			'photo' => $_GET['photo'],
			'description' => $_GET['description'],
			'sub_total' => $_GET['quantity'.$product_id]*$_GET['price']

		);
		$result = $this->order_model->add_order_info_ifnotexsit($data,$new_available_quantity);
		redirect(base_url('admin/shoppingcart/cart_products'));
		
	}

	// Display shopping cart
	public function cart(){
		$data['info'] = $this->order_model->get_order_info_by_order_id();
		$this->load->view('admin/includes/_header');
		$this->load->view('shoppingcart/cart', $data);
		$this->load->view('admin/includes/_footer');
	}

	// Display shopping cart
	public function prepare_invoice(){
		$data['info'] = $this->order_model->get_order_info_by_order_id();
		$this->load->view('admin/includes/_header');
		$this->load->view('shoppingcart/prepare_invoice', $data);
		$this->load->view('admin/includes/_footer');
	}


	public function cart_add(){
		$data['info'] = $this->product_model->get_all_products();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/shoppingcart/cart_add', $data);
		$this->load->view('admin/includes/_footer');
	}
	


	function index($type=''){

		//$this->session->set_userdata('filter_type',$type);
		$this->session->set_userdata('filter_keyword','');
		//$this->session->set_userdata('filter_status','');
		
		$data['admin_roles'] = $this->admin->get_admin_roles();
		
		$data['title'] = 'Admin List';

		$this->load->view('admin/includes/_header');
		$this->load->view('admin/shoppingcart/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	public function add_new_order(){
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('order_id', 'order_id', 'trim|required');
			$this->form_validation->set_rules('customer_id', 'customer_id', 'trim|required');
			$this->form_validation->set_rules('total_amount', 'total_amount', 'trim|required');
			$this->form_validation->set_rules('discount_percent', 'discount_percent', 'trim');
			$this->form_validation->set_rules('discount_amount', 'discount_amount', 'trim');
			$this->form_validation->set_rules('payable_amount', 'payable_amount', 'trim|required');
            $this->form_validation->set_rules('billing_address', 'billing_address', 'trim|required');
			$this->form_validation->set_rules('delivery_address', 'delivery_address', 'trim|required');
			$this->form_validation->set_rules('date', 'date', 'trim|required');


			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/order/order_add'),'refresh');
			}
			else{
				$data = array(
					'order_id' => $this->input->post('order_id'),
					'customer_id' => $this->input->post('customer_id'),
					'total_amount' => $this->input->post('total_amount'),
					'discount_percent' => $this->input->post('discount_percent'),
					'discount_amount' => $this->input->post('discount_amount'),
					'payable_amount' => $this->input->post('payable_amount'),
					'billing_address' => $this->input->post('billing_address'),
					'delivery_address' => $this->input->post('delivery_address'),
					'date' => $this->input->post('date'));

				$data = $this->security->xss_clean($data);
				$result = $this->order_model->add_order($data);
				if($result){

					// Activity Log 
					$this->activity_model->add_log(1);

					$this->session->set_flashdata('success', 'order has been added successfully!');
					redirect(base_url('admin/order'));
				}
			}
		}
		else{
			$this->load->view('admin/includes/_header');
			$this->load->view('order/order_add');
			$this->load->view('admin/includes/_footer');
		}
		
	}

	function filterdata(){

		//$this->session->set_userdata('filter_type',$this->input->post('type'));
		//$this->session->set_userdata('filter_status',$this->input->post('status'));
		$this->session->set_userdata('filter_keyword',$this->input->post('keyword'));
	}


	public function datatable_json(){				   					   
		$records['data'] = $this->product_model->get_all_products();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			//$status = ($row['is_active'] == 1)? 'checked': '';
			//$verify = ($row['is_verify'] == 1)? 'Verified': 'Pending';
			$data[]= array(
				++$i,
				$row['product_id'],
				$row['product_name'],
				$row['brand_name'],
                $row['price'],
                $row['quantity'],
                $row['photo'],
                $row['description'],	
				//'<span class="btn btn-success">'.$verify.'</span>',	
				//'<input class="tgl_checkbox tgl-ios" 
				//data-id="'.$row['id'].'" 
				//id="cb_'.$row['id'].'"
				//type="checkbox"  
				//'.$status.'><label for="cb_'.$row['id'].'"></label>',		
				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('product/view/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('product/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("product/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}
	function list_data(){

		$data['info'] = $this->product_model->get_all_products();

		$this->load->view('shoppingcart/cart_products',$data);
	}
	//-----------------------------------------------------------
	function change_status()
	{   
		$this->product_model->change_status();
	}

	public function add(){
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('product_id', 'product_id', 'trim|required');
			$this->form_validation->set_rules('product_name', 'Product_name', 'trim|required');
			$this->form_validation->set_rules('brand_name', 'Brand_name', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
			//$this->form_validation->set_rules('photo', 'Photo', 'trim|required');
           // $this->form_validation->set_rules('description', 'Description', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/product/product_add'),'refresh');
			}
			else{
				$data = array(
					'product_id' => $this->input->post('product_id'),
					'product_name' => $this->input->post('product_name'),
					'brand_name' => $this->input->post('brand_name'),
					'price' => $this->input->post('price'),
					'quantity' => $this->input->post('quantity'),
					'photo' => $this->input->post('photo'),
					'description' => $this->input->post('description'));

				$data = $this->security->xss_clean($data);
				$result = $this->product_model->add_product($data);
				if($result){

					// Activity Log 
					$this->activity_model->add_log(1);

					$this->session->set_flashdata('success', 'Product has been added successfully!');
					redirect(base_url('admin/product'));
				}
			}
		}
		else{
			$this->load->view('admin/includes/_header');
			$this->load->view('product/product_add');
			$this->load->view('admin/includes/_footer');
		}
		
	}



	public function edit($id = 0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('product_id', 'product_id', 'trim|required');
			$this->form_validation->set_rules('product_name', 'product_name', 'trim|required');
			$this->form_validation->set_rules('brand_name', 'Brand_name', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
			$this->form_validation->set_rules('photo', 'Photo', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/product/product_edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'product_id' => $this->input->post('product_id'),
					'product_name' => $this->input->post('product_name'),
					'brand_name' => $this->input->post('brand_name'),
					'price' => $this->input->post('price'),
					'quantity' => $this->input->post('quantity'),
					'photo' => $this->input->post('photo'),
					'description' => $this->input->post('description'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->product_model->edit_product($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					
					$this->session->set_flashdata('success', 'product has been updated successfully!');
					redirect(base_url('admin/product/index'));
				}
			}
		}
		else{
			$data['product'] = $this->product_model->get_product_by_id($id);
			
			$this->load->view('admin/includes/_header');
			$this->load->view('product/product_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('product', array('product_id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'product has been deleted successfully!');
		redirect(base_url('admin/product'));
	}



	public function edit_order_info_cart($product_id){
		
		echo $product_id;
		//echo $this->input->post('quantity1');
		echo $_GET['quantity'.$product_id];
		$available_quantity = 0;
		$new_available_quantity=$available_quantity-$_GET['quantity'.$product_id];
		echo 'new available quantity:';
		echo $new_available_quantity;
		$data = array(
			'order_info_id'=> '-'.$this->session->userdata('admin_id').$product_id.'',
			'product_id' => $product_id,
			'order_id' => 0-$this->session->userdata('admin_id'),
			'product_price' => $_GET['price'],
			'quantity' => $_GET['quantity'.$product_id],
			'product_name' => $_GET['product_name'],
			'brand_name' => $_GET['brand_name'],
			'photo' => $_GET['photo'],
			'description' => $_GET['description'],
			'sub_total' => $_GET['quantity'.$product_id]*$_GET['price']

		);
		$result = $this->order_model->add_order_info_ifnotexsit($data,$new_available_quantity);
		
		$this->db->where('order_info_id', $orderInfoId);
		$this->db->update('order_info', $data);
		$this->session->set_flashdata('success', 'cart has been updated successfully!');
		redirect(base_url('admin/shoppingcart/cart'));
	}

	public function delete_order_info($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		


		$this->db->where('order_info_id',$id);
		$q = $this->db->get('order_info');
			
			if ( $q->num_rows() > 0 )  {
					echo 'found!';
					$reserved_quantity=0;
					$product_id=0;
					$available_quantity=0;

					foreach ($q ->result() as $row)
					{
						$reserved_quantity=$row->quantity;
						$product_id=$row->product_id;
						
						$this->db->where('product_id',$product_id);
						$q2 = $this->db->get('product');
						if ( $q2->num_rows() > 0 ){
							foreach ($q2 ->result() as $row2){
								$available_quantity=$row2->quantity;
							}
						}

					}
					//update the quantity in the cart if same item is trying to add
					$data1 = array(
					'quantity' => $available_quantity+ $reserved_quantity,
					//'sub_total' => $data['sub_total']+$old_subtotal,
					);
				$this->db->where('product_id', $product_id);
				$this->db->update('product', $data1);
				
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
		
		//Delete product from order_info
		$this->db->delete('order_info', array('order_info_id' => $id));

			// Activity Log 
		$this->activity_model->add_log(3);
		$this->session->set_flashdata('success', 'product has been deleted successfully from the cart!');
		redirect(base_url('admin/shoppingcart/cart'));

	}


}


?>