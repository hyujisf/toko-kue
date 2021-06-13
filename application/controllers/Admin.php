<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index()
	{
        $data['user'] = $this->db->get_where('user',['mail' => $this->session->userdata('mail')])->row_array();
		
			// Data untuk header
			$txt_data = [
				'title'	=> 'Halaman Login',
				'mas_daf'=> 'Login'
			];
			// elemen view dari login
			$this->load->view('template/page_admin/header', $txt_data);
			$this->load->view('page_admin/admin');
			$this->load->view('template/page_admin/footer');
	}
}
