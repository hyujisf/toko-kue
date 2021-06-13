<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		//  Tujuannya agar tidak mengulang pemanggilan function
		$this->load->library('form_validation');

	}
	// untuk login
	public function index()
	{
		$this->form_validation->set_rules('mail', 'Email', 'required|trim|valid_email', [
			'required' => 'Email perlu diisi',
			'valid_email' => 'Format Email tidak sesuai'
		]);
		$this->form_validation->set_rules('pass', 'Password', 'required|trim', [
			'required' => 'Untuk masuk dibutuhkan password'
		]);
		if($this->form_validation->run() == false){
			// Data untuk header
			$txt_data = [
				'title'	=> 'Halaman Login',
				'mas_daf'=> 'Login'
			];
			// elemen view dari login
			$this->load->view('template/auth/header', $txt_data);
			$this->load->view('auth/login');
			$this->load->view('template/auth/footer');
		} else {
			// Untuk memvalidasi jika sukses
			$this->_login();
		}
	}

	private function _login()
	{
		$mail = $this->input->post('mail');
		$pass = $this->input->post('pass');

		$user = $this->db->get_where('user', ['mail' => $mail])->row_array();

		if($user) {
			// Jika usernya ditemukan
			if($user['stat'] == 1){

				if(password_verify($pass, $user['pass'])) {
					$data = [
						'mail' => $user['mail'],
						'role' => $user['role'],
					];
					$this->session->set_userdata($data);
					if($user['role']= 1){
						redirect('admin');
					} elseif($user['role']= 2){
						redirect('penjual');
					}else{
						redirect('toko');
					}
					
				} else {
					$this->session->set_flashdata('alert','
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Password yang kamu masukan <strong>salah</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					');
					redirect('auth');

				}

			} else {
				$this->session->set_flashdata('alert','
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Hemmp</strong> Sepertinya Akun kamu tidak aktif.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('alert','
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Gawat!</strong> Email salah atau tidak dapat ditemukan, coba lagi
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			');
			redirect('auth');
		}

	}
    
	// untuk registrasi
    public function regist()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Nama Perlu diisi'
		]);
		$this->form_validation->set_rules('mail', 'Email', 'required|trim|valid_email|is_unique[user.mail]', [
			'required' => 'Email perlu diisi',
			'valid_email' => 'Format Email tidak sesuai',
			'is_unique' => 'Email telah digunakan, coba yang lain'
		]);
		$this->form_validation->set_rules('1pass', 'Password', 'required|trim|matches[upass]|min_length[8]', [
			'required' => 'Pasword tidak boleh kosong',
			'min_length' => 'Password terlalu pendek, butuh min 8 karakter',
			'matches' => 'Password tidak cocok'
		]);
		$this->form_validation->set_rules('upass', 'Ulangi Password', 'required|trim|matches[1pass]');

		if($this->form_validation->run() == false){
			// Data untuk header
			$txt_data = [
				'title'	=> 'Halaman Daftar',
				'mas_daf'=> 'Daftar'
			];
			// elemen view dari registrasi
			$this->load->view('template/auth/header', $txt_data);
			$this->load->view('auth/registrasi');
			$this->load->view('template/auth/footer');
		} else {
			$dbinsert = [
				'name' => htmlspecialchars($this->input->post('nama')),
				'mail' => htmlspecialchars($this->input->post('mail')),
				'pass' => password_hash($this->input->post('1pass'),PASSWORD_DEFAULT),
				'img' => 'default.jpg',
				'role' => 3,
				'stat' => 1,
				'tgljoin' => time()
			];

			$this->db->insert('user', $dbinsert);
			$this->session->set_flashdata('alert','
			<div class="alert alert-success" role="alert">
				<h4 class="alert-heading">Selamat!</h4>
				<p>Akun kamu sudah berhasil kami buat</p>
			</div>
			');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('mail');
		$this->session->unset_userdata('role');
		$this->session->set_flashdata('alert','
		<div class="alert alert-primary" role="alert">
			<h4 class="alert-heading">Selamat!</h4>
			<p>Berhasil untuk Keluar dari akun kamu</p>
		</div>
		');
	}
}