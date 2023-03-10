<?php defined('BASEPATH') OR exit('No direct script access allowed');
class product extends MY_Controller {

	public function __construct(){

		parent::__construct();
		//auth_check(); // check login auth
		//$this->rbac->check_module_access();

		$this->load->model('admin/product_model', 'product_model');
		$this->load->model('admin/Activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	/*public function index(){

		$this->load->view('includes/_header');
		$this->load->view('product/product_list');
		$this->load->view('includes/_footer');
	}*/
	/*public function index(){
		
		$this->load->view('admin/includes/_header');
		$this->load->view('product/product_list');
		$this->load->view('admin/includes/_footer');
	}*/
	function index(){
		$this->session->set_userdata('filter_keyword','');
		$this->session->set_userdata('filter_status','');
		$data['info'] = $this->product_model->get_filtered_products();
	
		//$data['info'] = $this->product_model->get_all_products();
		$this->load->view('admin/includes/_header');
		$this->load->view('product/list', $data);
		$this->load->view('admin/includes/_footer');
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

		$this->load->view('admin/admin/list',$data);
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
			$this->form_validation->set_rules('brand_name', 'Brand_name', 'trim');
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim');
			//$this->form_validation->set_rules('photo', 'Photo', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim');

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
			$this->form_validation->set_rules('brand_name', 'Brand_name', 'trim');
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim');
			$this->form_validation->set_rules('photo', 'Photo', 'trim');
            $this->form_validation->set_rules('description', 'Description', 'trim');
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

}


?>