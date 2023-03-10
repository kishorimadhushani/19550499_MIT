<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('admin/payment_model', 'payment_model');
		$this->load->model('admin/Activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){

		$this->load->view('includes/_header');
		$this->load->view('payment/payment_list');
		$this->load->view('includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records['data'] = $this->payment_model->get_all_payments();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$verify = ($row['is_verify'] == 1)? 'Verified': 'Pending';
			$data[]= array(
				++$i,
				$row['payment_id'],
				$row['customer_id'],
				$row['order_id'],
                $row['total_amount'],
				date_time($row['created_at']),	
				'<span class="btn btn-success">'.$verify.'</span>',	
				'<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['id'].'" 
				id="cb_'.$row['id'].'"
				type="checkbox"  
				'.$status.'><label for="cb_'.$row['id'].'"></label>',		

				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('payment/view/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('payment/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("payment/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------
	function change_status()
	{   
		$this->payment_model->change_status();
	}

	public function add(){
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('payment_id', 'Payment_id', 'trim|required');
			$this->form_validation->set_rules('customer_id', 'Customer_id', 'trim|required');
			$this->form_validation->set_rules('order_id', 'Order_id', 'trim|required');
			$this->form_validation->set_rules('total_amount', 'Total_amount', 'trim|required');
			$this->form_validation->set_rules('date', 'Date', 'trim|required');
			

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('payment/add'),'refresh');
			}
			else{
				$data = array(
					'payment_id' => $this->input->post('payment_id'),
					'customer_id' => $this->input->post('customer_id'),
					'order_id' => $this->input->post('order_id'),
					'total_amount' => $this->input->post('total_amount'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->payment_model->add_payment($data);
				if($result){

					// Activity Log 
					$this->activity_model->add_log(1);

					$this->session->set_flashdata('success', 'Payment has been added successfully!');
					redirect(base_url('payment'));
				}
			}
		}
		else{
			$this->load->view('includes/_header');
			$this->load->view('payment/payment_add');
			$this->load->view('includes/_footer');
		}
		
	}

	public function edit($id = 0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('payment_id', 'Payment_id', 'trim|required');
			$this->form_validation->set_rules('customer_id', 'Customer_id', 'trim|required');
			$this->form_validation->set_rules('order_id', 'Order_id', 'trim|required');
			$this->form_validation->set_rules('total_amount', 'Total_amount', 'trim|required');
			$this->form_validation->set_rules('date', 'Date', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('payment/payment_edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'payment_id' => $this->input->post('payment_id'),
					'customer_id' => $this->input->post('customer_id'),
					'order_id' => $this->input->post('order_id'),
					'total_amount' => $this->input->post('total_amount'),S
					//'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->payment_model->edit_payment($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'Payment has been updated successfully!');
					redirect(base_url('payment'));
				}
			}
		}
		else{
			$data['payment'] = $this->payment_model->get_payment_by_id($id);
			
			$this->load->view('admin/includes/_header');
			$this->load->view('payment/payment_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('payment', array('id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'Payment has been deleted successfully!');
		redirect(base_url('payment'));
	}

}


?>