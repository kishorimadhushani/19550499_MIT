<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Driver extends MY_Controller {

	public function __construct(){

		parent::__construct();
		//auth_check(); // check login auth
		//$this->rbac->check_module_access();

		$this->load->model('admin/driver_model', 'driver_model');
		$this->load->model('admin/Activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	/*public function index(){

		$this->load->view('includes/_header');
		$this->load->view('driver/driver_list');
		$this->load->view('includes/_footer');
	}*/
	/*public function index(){
		
		$this->load->view('admin/includes/_header');
		$this->load->view('driver/driver_list');
		$this->load->view('admin/includes/_footer');
	}*/
	function index(){

	
		$data['info'] = $this->driver_model->get_all_drivers();
		$this->load->view('admin/includes/_header');
		$this->load->view('driver/list', $data);
		$this->load->view('admin/includes/_footer');
	}

	public function datatable_json(){				   					   
		$records['data'] = $this->driver_model->get_all_drivers();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			//$status = ($row['is_active'] == 1)? 'checked': '';
			//$verify = ($row['is_verify'] == 1)? 'Verified': 'Pending';
			$data[]= array(
				++$i,
				$row['driver_id'],
				$row['driver_name'],
				$row['e-mail'],
                $row['password'],
                $row['address'],
                $row['mobile_number'],	
				//'<span class="btn btn-success">'.$verify.'</span>',	
				//'<input class="tgl_checkbox tgl-ios" 
				//data-id="'.$row['id'].'" 
				//id="cb_'.$row['id'].'"
				//type="checkbox"  
				//'.$status.'><label for="cb_'.$row['id'].'"></label>',		
				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('driver/view/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('driver/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("driver/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}
	function list_data(){

		$data['info'] = $this->driver_model->get_all_drivers();

		$this->load->view('admin/admin/list',$data);
	}
	//-----------------------------------------------------------
	function change_status()
	{   
		$this->driver_model->change_status();
	}

	public function add(){
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('driver_id', 'driver_id', 'trim|required');
			$this->form_validation->set_rules('driver_name', 'driver_name', 'trim|required');
			$this->form_validation->set_rules('e-mail', 'E-mail', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('address', 'Adress', 'trim|required');
			$this->form_validation->set_rules('mobile_number', 'Moblile_number', 'trim|required|max_length[10]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/driver/driver_add'),'refresh');
			}
			else{
				$data = array(
					'driver_id' => $this->input->post('driver_id'),
					'driver_name' => $this->input->post('driver_name'),
					'e-mail' => $this->input->post('e-mail'),
					'password' => $this->input->post('password'),
					'address' => $this->input->post('address'),
					'mobile_number' => $this->input->post('mobile_number'));

				$data = $this->security->xss_clean($data);
				$result = $this->driver_model->add_driver($data);
				if($result){

					// Activity Log 
					$this->activity_model->add_log(1);

					$this->session->set_flashdata('success', 'driver has been added successfully!');
					redirect(base_url('admin/driver'));
				}
			}
		}
		else{
			$this->load->view('admin/includes/_header');
			$this->load->view('driver/driver_add');
			$this->load->view('admin/includes/_footer');
		}
		
	}

	public function edit($id = 0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){

			$this->form_validation->set_rules('driver_id', 'driver_id', 'trim|required');
			$this->form_validation->set_rules('driver_name', 'driver_name', 'trim|required');
			$this->form_validation->set_rules('e-mail', 'e-mail', 'trim|required');
			$this->form_validation->set_rules('password', 'password', 'trim|required');
			$this->form_validation->set_rules('address', 'address', 'trim|required');
			$this->form_validation->set_rules('mobile_number', 'mobile_number', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/driver/driver_edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'driver_id' => $this->input->post('driver_id'),
					'driver_name' => $this->input->post('driver_name'),
					'e-mail' => $this->input->post('e-mail'),
					'password' => $this->input->post('password'),
					'address' => $this->input->post('address'),
					'mobile_number' => $this->input->post('mobile_number'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->driver_model->edit_driver($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					
					$this->session->set_flashdata('success', 'driver has been updated successfully!');
					redirect(base_url('admin/driver'));
				}
			}
		}
		else{
			$data['driver'] = $this->driver_model->get_driver_by_id($id);
			
			$this->load->view('admin/includes/_header');
			$this->load->view('driver/driver_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('driver', array('driver_id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'driver has been deleted successfully!');
		redirect(base_url('admin/driver'));
	}

}


?>