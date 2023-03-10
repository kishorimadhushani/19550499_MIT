<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Order_infos extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('order_info_model');
		$this->load->model('admin/Activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){

		$this->load->view('includes/_header');
		$this->load->view('order_info/order_info_list');
		$this->load->view('includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records['data'] = $this->order_info_model->get_all_order_info();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$verify = ($row['is_verify'] == 1)? 'Verified': 'Pending';
			$data[]= array(
				++$i,
				$row['order_info_id'],
				$row['order_id'],
				$row['product_id'],
                $row['product_price'],
                $row['quantity'],	
				'<span class="btn btn-success">'.$verify.'</span>',	
				'<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['id'].'" 
				id="cb_'.$row['id'].'"
				type="checkbox"  
				'.$status.'><label for="cb_'.$row['id'].'"></label>',		

				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('order_info/view/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('order_info/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("order_info/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------
	function change_status()
	{   
		$this->order_info_model->change_status();
	}

	public function add(){
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('order_info_id', 'Order_info_id', 'trim|required');
			$this->form_validation->set_rules('order_id', 'Order_id', 'trim|required');
			$this->form_validation->set_rules('product_id', 'Product_id', 'trim|required');
			$this->form_validation->set_rules('product_price', 'Product_price', 'trim|required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('order_info/add'),'refresh');
			}
			else{
				$data = array(
					'order_info_id' => $this->input->post('order_info_id'),
					'order_id' => $this->input->post('order_id'),
					'product_id' => $this->input->post('product_id'),
					'product_price' => $this->input->post('product_price'),
					'quantity' => $this->input->post('quantity'),

				);
				$data = $this->security->xss_clean($data);
				$result = $this->order_info_model->add_order_info($data);
				if($result){

					// Activity Log 
					$this->activity_model->add_log(1);

					$this->session->set_flashdata('success', 'order_info has been added successfully!');
					redirect(base_url('order_info'));
				}
			}
		}
		else{
			$this->load->view('includes/_header');
			$this->load->view('order_info/order_info_add');
			$this->load->view('includes/_footer');
		}
		
	}

	public function edit($id = 0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('order_info_id', 'Order_info_id', 'trim|required');
			$this->form_validation->set_rules('order_id', 'Order_id', 'trim|required');
			$this->form_validation->set_rules('product_id', 'Product_id', 'trim|required');
			$this->form_validation->set_rules('product_price', 'Product_price', 'trim|required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('order_info/order_info_edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'order_info_id' => $this->input->post('order_info_id'),
					'order_id' => $this->input->post('order_id'),
					'product_id' => $this->input->post('product_id'),
					'product_price' => $this->input->post('product_price'),
					'quantity' => $this->input->post('quantity'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->order_info_model->edit_order_info($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'order_info has been updated successfully!');
					redirect(base_url('order_info'));
				}
			}
		}
		else{
			$data['order_info'] = $this->order_info_model->get_order_info_by_id($id);
			
			$this->load->view('includes/_header');
			$this->load->view('order_info/order_info_edit', $data);
			$this->load->view('includes/_footer');
		}
	}

	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('order_info', array('id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'Order_info has been deleted successfully!');
		redirect(base_url('order_info'));
	}

}


?>