<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('customer_model');
		//$this->load->model('activity_model');
	}

	//-----------------------------------------------------------
	public function index(){

		$this->load->view('includes/_header');
		$this->load->view('customer/customer_list');
		$this->load->view('includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records['data'] = $this->customer_model->get_all_customers();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$verify = ($row['is_verify'] == 1)? 'Verified': 'Pending';
			$data[]= array(
				++$i,
				$row['customername'],
				$row['email'],
				$row['mobile_no'],
				date_time($row['created_at']),	
				'<span class="btn btn-success">'.$verify.'</span>',	
				'<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['id'].'" 
				id="cb_'.$row['id'].'"
				type="checkbox"  
				'.$status.'><label for="cb_'.$row['id'].'"></label>',		

				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('customer/view/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('customer/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("customer/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------
	function change_status()
	{   
		$this->customer_model->change_status();
	}

	public function add(){
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('customername', 'customername', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('customer/add'),'refresh');
			}
			else{
				$data = array(
					'customername' => $this->input->post('customername'),
					'email' => $this->input->post('email'),
					'address' => $this->input->post('address'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'address' => $this->input->post('address'),
                    'mobile_no' => $this->input->post('mobile_no'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->customer_model->add_customer($data);
				if($result){

					// Activity Log 
					$this->activity_model->add_log(1);

					$this->session->set_flashdata('success', 'Customer has been added successfully!');
					redirect(base_url('customer'));
				}
			}
		}
		else{
			$this->load->view('admin/includes/_header');
			$this->load->view('customer/customer_add');
			$this->load->view('admin/includes/_footer');
		}
		
	}

	public function edit($id = 0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('customername', 'customername', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('customer/customer_edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'customername' => $this->input->post('customername'),
					'email' => $this->input->post('email'),
					'address' => $this->input->post('address'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'address' => $this->input->post('address'),
                    'mobile_no' => $this->input->post('mobile_no'),
					'is_active' => $this->input->post('status'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->customer_model->edit_customer($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'Customer has been updated successfully!');
					redirect(base_url('customer'));
				}
			}
		}
		else{
			$data['customer'] = $this->customer_model->get_customer_by_id($id);
			
			$this->load->view('includes/_header');
			$this->load->view('customer/customer_edit', $data);
			$this->load->view('includes/_footer');
		}
	}

	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('customer', array('id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'Customer has been deleted successfully!');
		redirect(base_url('customer'));
	}

}


?>