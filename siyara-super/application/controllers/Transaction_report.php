<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Transaction_reports extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('transaction_report_model');
		$this->load->model('Activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){

		$this->load->view('includes/_header');
		$this->load->view('transaction_report/transaction_report_list');
		$this->load->view('includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records['data'] = $this->transaction_report_model->get_all_transaction_reports();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$verify = ($row['is_verify'] == 1)? 'Verified': 'Pending';
			$data[]= array(
				++$i,
				$row['transaction_report_id'],
				$row['customer_id'],
				$row['order_id'],
                $row['product_id'],
                $row['payment_id'],
				date_time($row['created_at']),	
				'<span class="btn btn-success">'.$verify.'</span>',	
				'<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['id'].'" 
				id="cb_'.$row['id'].'"
				type="checkbox"  
				'.$status.'><label for="cb_'.$row['id'].'"></label>',		

				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('transaction_report/view/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('transaction_report/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("transaction_report/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------
	function change_status()
	{   
		$this->transaction_report_model->change_status();
	}

	public function add(){
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('transaction_report_id', 'Transaction_report_id', 'trim|required');
			$this->form_validation->set_rules('customer_id', 'Costomer_id', 'trim|required');
			$this->form_validation->set_rules('order_id', 'Order_id', 'trim|required');
			$this->form_validation->set_rules('product_id', 'Product_id', 'trim|required');
			$this->form_validation->set_rules('payment_id', 'Payment_id', 'trim|required');
			$this->form_validation->set_rules('date', 'Date', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/transaction_reports/add'),'refresh');
			}
			else{
				$data = array(
					'transaction_id' => $this->input->post('transaction_id'),
					'customer_id' => $this->input->post('customer_id'),
					'order_id' => $this->input->post('order_id'),
					'product_id' => $this->input->post('product_id'),
					'payment_id' => $this->input->post('payment_id'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->transaction_report_model->add_transaction_report($data);
				if($result){

					// Activity Log 
					$this->activity_model->add_log(1);

					$this->session->set_flashdata('success', 'Transaction_report has been added successfully!');
					redirect(base_url(transaction_report'));
				}
			}
		}
		else{
			$this->load->view('includes/_header');
			$this->load->view('transaction_report/transaction_report_add');
			$this->load->view('includes/_footer');
		}
		
	}

	public function edit($id = 0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
            $this->form_validation->set_rules('transaction_report_id', 'Transaction_report_id', 'trim|required');
			$this->form_validation->set_rules('customer_id', 'Costomer_id', 'trim|required');
			$this->form_validation->set_rules('order_id', 'Order_id', 'trim|required');
			$this->form_validation->set_rules('product_id', 'Product_id', 'trim|required');
			$this->form_validation->set_rules('payment_id', 'Payment_id', 'trim|required');
			$this->form_validation->set_rules('date', 'Date', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/transaction_reports/transaction_report_edit/'.$id),'refresh');
			}
			else{
				$data = array(
                    'transaction_id' => $this->input->post('transaction_id'),
					'customer_id' => $this->input->post('customer_id'),
					'order_id' => $this->input->post('order_id'),
					'product_id' => $this->input->post('product_id'),
					'payment_id' => $this->input->post('payment_id'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->transaction_report_model->edit_transaction_report($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'Transaction_report has been updated successfully!');
					redirect(base_url('transaction_report'));
				}
			}
		}
		else{
			$data['transaction_report'] = $this->transaction_report_model->get_transaction_report_by_id($id);
			
			$this->load->view('includes/_header');
			$this->load->view('transaction_report/transaction_report_edit', $data);
			$this->load->view('includes/_footer');
		}
	}

	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('transaction_report', array('id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'Transaction_report has been deleted successfully!');
		redirect(base_url('transaction_report'));
	}

}


?>