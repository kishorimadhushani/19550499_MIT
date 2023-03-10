<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Vehicles extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('vehicle_model');
		$this->load->model('Activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){

		$this->load->view('includes/_header');
		$this->load->view('vehicle/vehicle_list');
		$this->load->view('includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records['data'] = $this->vehicle_model->get_all_vehicles();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$verify = ($row['is_verify'] == 1)? 'Verified': 'Pending';
			$data[]= array(
				++$i,
				$row['vehicle_id'],
				$row['type'],
				$row['discription'],	
				'<span class="btn btn-success">'.$verify.'</span>',	
				'<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['id'].'" 
				id="cb_'.$row['id'].'"
				type="checkbox"  
				'.$status.'><label for="cb_'.$row['id'].'"></label>',		

				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('vehicle/view/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('vehicle/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("vehicles/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------
	function change_status()
	{   
		$this->vehicle_model->change_status();
	}

	public function add(){
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('vehicle_id', 'Vehicle_id', 'trim|required');
			$this->form_validation->set_rules('type', 'Type', 'trim|required');
			$this->form_validation->set_rules('description', 'Discription', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('vehicle/add'),'refresh');
			}
			else{
				$data = array(
					'vehicl_id' => $this->input->post('vehicle_id'),
					'type' => $this->input->post('type'),
					'description' => $this->input->post('description'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->vehicle_model->add_vehicle($data);
				if($result){

					// Activity Log 
					$this->activity_model->add_log(1);

					$this->session->set_flashdata('success', 'Vehicle has been added successfully!');
					redirect(base_url('vehicle'));
				}
			}
		}
		else{
			$this->load->view('includes/_header');
			$this->load->view('vehicle/vehicle_add');
			$this->load->view('includes/_footer');
		}
		
	}

	public function edit($id = 0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('vehicle_id', 'Vehicle_id', 'trim|required');
			$this->form_validation->set_rules('type', 'Type', 'trim|required');
			$this->form_validation->set_rules('description', 'Discription', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/vehicles/vehicle_edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'vehicl_id' => $this->input->post('vehicle_id'),
					'type' => $this->input->post('type'),
					'description' => $this->input->post('description'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->vehicle_model->edit_vehicle($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'Vehicle has been updated successfully!');
					redirect(base_url('vehicle'));
				}
			}
		}
		else{
			$data['vehicle'] = $this->vehicle_model->get_vehicle_by_id($id);
			
			$this->load->view('includes/_header');
			$this->load->view('vehicle/vehicle_edit', $data);
			$this->load->view('includes/_footer');
		}
	}

	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('vehicle', array('id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'Vehicle has been deleted successfully!');
		redirect(base_url('vehicle'));
	}

}


?>