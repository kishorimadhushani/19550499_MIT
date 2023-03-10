<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Delivery extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('admin/delivery_model', 'delivery_model');
		$this->load->model('admin/Activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){

		$this->load->view('admin/includes/_header');
		$this->load->view('delivery/delivery_list');
		$this->load->view('admin/includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records['data'] = $this->delivery_model->get_all_deliverys();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$verify = ($row['is_verify'] == 1)? 'Verified': 'Pending';
			$data[]= array(
				++$i,
				$row['delivery_id'],
				$row['customer_id'],
				$row['order_id'],
                $row['product_id'],
                $row['vehicle_id'],
				date_time($row['created_at']),	
				'<span class="btn btn-success">'.$verify.'</span>',	
				'<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['id'].'" 
				id="cb_'.$row['id'].'"
				type="checkbox"  
				'.$status.'><label for="cb_'.$row['id'].'"></label>',		

				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('delivery_model/view/'.$row['id']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('delivery/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("delivery/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------
	function change_status()
	{   
		$this->delivery_model->change_status();
	}

	public function add(){
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('delivery_id', 'Delivery_id', 'trim|required');
			$this->form_validation->set_rules('customer_id', 'Customer_id', 'trim|required');
			$this->form_validation->set_rules('order_id', 'Order_id', 'trim|required');
			$this->form_validation->set_rules('product_id', 'Product_id', 'trim|required');
			$this->form_validation->set_rules('vehicle_id', 'Vehicle_id', 'trim|required');
			$this->form_validation->set_rules('date', 'Date', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/delivery_model/add'),'refresh');
			}
			else{
				$data = array(
					'delivery_id' => $this->input->post('delivery_id'),
					'customer_id' => $this->input->post('customer_id'),
					'order_id' => $this->input->post('order_id'),
					'product_id' => $this->input->post('product_id'),
					'vehicle_id' => $this->input->post('vehicle_id'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->vehicle_model->add_delivery($data);
				if($result){

					// Activity Log 
					$this->activity_model->add_log(1);

					$this->session->set_flashdata('success', 'Vehicle has been added successfully!');
					redirect(base_url('admin/vehicle_model'));
				}
			}
		}
		else{
			$this->load->view('admin/includes/_header');
			$this->load->view('vehicle/vehicle_add');
			$this->load->view('admin/includes/_footer');
		}
		
	}

	public function edit($id = 0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('delivery_id', 'Delivery_id', 'trim|required');
			$this->form_validation->set_rules('customer_id', 'Customer_id', 'trim|required');
			$this->form_validation->set_rules('order_id', 'Order_id', 'trim|required');
			$this->form_validation->set_rules('product_id', 'Product_id', 'trim|required');
			$this->form_validation->set_rules('vehicle_id', 'Vehicle_id', 'trim|required');
			$this->form_validation->set_rules('date', 'Date', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/delivery/delivery_edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'delivery_id' => $this->input->post('delivery_id'),
					'customer_id' => $this->input->post('customer_id'),
					'order_id' => $this->input->post('order_id'),
					'product_id' => $this->input->post('product_id'),
					'vehicle_id' => $this->input->post('vehicle_id'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->delivery_model->edit_delivery($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'delivery has been updated successfully!');
					redirect(base_url('admin/delivery'));
				}
			}
		}
		else{
			$data['delivery'] = $this->delivery_model->get_delivery_by_id($id);
			
			$this->load->view('admin/includes/_header');
			$this->load->view('delivery/delivery_edit', $data);
			$this->load->view('adminincludes/_footer');
		}
	}

	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('delivery', array('id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'Delivery has been deleted successfully!');
		redirect(base_url('admin/sdelivery'));
	}

}


?>