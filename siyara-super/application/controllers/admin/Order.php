<?php defined('BASEPATH') OR exit('No direct script access allowed');
class order extends MY_Controller {

	public function __construct(){

		parent::__construct();
		//auth_check(); // check login auth
		//$this->rbac->check_module_access();

		$this->load->model('admin/order_model', 'order_model');
		$this->load->model('admin/Activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	/*public function index(){

		$this->load->view('includes/_header');
		$this->load->view('order/order_list');
		$this->load->view('includes/_footer');
	}*/
	/*public function index(){
		
		$this->load->view('admin/includes/_header');
		$this->load->view('order/order_list');
		$this->load->view('admin/includes/_footer');
	}*/
	function index(){
		//$this->session->set_userdata('filter_keyword','');
		//$this->session->set_userdata('filter_status','');
		//$data['info'] = $this->order_model->get_filtered_orders();
	
		$data['info'] = $this->order_model->get_all_orders();
		$this->load->view('admin/includes/_header');
		$this->load->view('order/list', $data);
		$this->load->view('admin/includes/_footer');
	}

	public function datatable_json(){				   					   
		$records['data'] = $this->order_model->get_all_orders();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			//$status = ($row['is_active'] == 1)? 'checked': '';
			//$verify = ($row['is_verify'] == 1)? 'Verified': 'Pending';
			$data[]= array(
				++$i,
				$row['order_id'],
				$row['customer_id'],
				$row['total_amount'],
                $row['discount_percent'],
                $row['discount_amount'],
                $row['payable_amount'],
                $row['billing_address'],
				$row['delivery_address'],
				$row['date'],
				//'<span class="btn btn-success">'.$verify.'</span>',	
				//'<input class="tgl_checkbox tgl-ios" 
				//data-id="'.$row['id'].'" 
				//id="cb_'.$row['id'].'"
				//type="checkbox"  
				//'.$status.'><label for="cb_'.$row['id'].'"></label>',		
				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('order/view/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('order/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("order/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}
	function list_data(){

		$data['info'] = $this->order_model->get_all_orders();

		$this->load->view('admin/admin/list',$data);
	}
	//-----------------------------------------------------------
	function change_status()
	{   
		$this->order_model->change_status();
	}

	public function add(){
		
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

	public function edit($id = 0){

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
					redirect(base_url('admin/order/order_edit/'.$id),'refresh');
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
					'date' => $this->input->post('date'),
					
				);
				$data = $this->security->xss_clean($data);
				$result = $this->order_model->edit_order($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					
					$this->session->set_flashdata('success', 'order has been updated successfully!');
					redirect(base_url('admin/order'));
				}
			}
		}
		else{
			$data['order'] = $this->order_model->get_order_by_id($id);
			
			$this->load->view('admin/includes/_header');
			$this->load->view('order/order_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('order', array('order_id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'order has been deleted successfully!');
		redirect(base_url('admin/order'));
	}

}


?>