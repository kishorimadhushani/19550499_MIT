<?php
	class vehicle_model extends CI_Model{

		public function add_vehicle($data){
			$this->db->insert('vehicle', $data);
			return true;
		}

		//---------------------------------------------------
		// get all vehicles for server-side datatable processing 
		public function get_all_vehicles(){
			$this->db->select('*');
			//$this->db->where('is_admin',0);
			return $this->db->get('vehicle')->result_array();
		}

		function get_filtered_vehicles()
		{

			$this->db->from('vehicle');

			//$this->db->join('ci_admin_roles','ci_admin_roles.admin_role_id=ci_admin.admin_role_id');

			//if($this->session->userdata('filter_type')!='')

				//$this->db->where('ci_admin.admin_role_id',$this->session->userdata('filter_type'));

			//if($this->session->userdata('filter_status')!='')

				//$this->db->where('ci_admin.is_active',$this->session->userdata('filter_status'));


			$filterData = $this->session->userdata('filter_keyword');

			$this->db->like('vehicle.type',$filterData);
			//$this->db->or_like('vehicle.brand_name',$filterData);
			//$this->db->or_like('vehicle.description',$filterData);
			$this->db->or_like('vehicle.vehicle_id',$filterData);
			//$this->db->or_like('vehicle.mobile_no',$filterData);
			//$this->db->or_like('vehicle.username',$filterData);

			//$this->db->where('ci_admin.is_supper !=', 1);

			//$this->db->order_by('ci_admin.admin_id','desc');

			$query = $this->db->get();

			$module = array();

			if ($query->num_rows() > 0) 
			{
				$module = $query->result_array();
			}

			return $module;
		}

		//---------------------------------------------------
		// Get vehicle detial by vehicle_id
		public function get_vehicle_by_id($vehicleId){
			$query = $this->db->get_where('vehicle', array('vehicle_id' => $vehicleId));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit vehicle Record
		public function edit_vehicle($data, $vehicleId){
			$this->db->where('vehicle_id', $vehicleId);
			$this->db->update('vehicle', $data);
			return true;
		}

		//---------------------------------------------------
		// Change vehicle status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('vehicle_id', $this->input->post('vehicle_id'));
			$this->db->update('vehicle');
		} 


	}

?>