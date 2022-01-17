<?php


defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_login();
		date_default_timezone_set('asia/jakarta');
		$this->load->model('User_model', 'user');
	}

	public function index()
	{
		$tanggal = date('Y-m-d');
		$absen			= $this->user->cekabsen($this->session->userdata('username'), $tanggal)->row_array();
		$num = $this->user->cekabsen($this->session->userdata('username'), $tanggal);
		$data = [
			'title' => 'Dashboard',
			'page' => 'user/index',
			'subtitle' => 'Dashboard',
			'subtitle2' => 'User',
			'users' => $this->db->get('users')->result(),
		];

		if ($num->num_rows() == 0) {
			$data['waktu'] = 'Anda hari ini belum melakukan absen masuk';
		} elseif ($absen['status'] == 'masuk') {
			$data['waktu'] = 'Anda hari ini belum melakukan absen pulang';
		} elseif ($absen['status'] == 'terlambat') {
			$data['waktu'] = 'Anda hari ini belum melakukan absen pulang';

		}elseif ($absen['status'] == 'pulang') {
			$data['waktu'] = 'Anda telah melakukan absen masuk dan pulang';
		}

		$this->load->view('templates/app', $data);
	}

	public function proses_absen()
	{
		$id = $this->session->userdata('nip');
		$nama = $this->session->userdata('nama');
		$p = $this->input->post();
		$tahun 			= date('Y');
		$bulan 			= date('m');
		$hari 			= date('d');
		$absen			= $this->user->absendaily($this->session->userdata('nip'), $tahun, $bulan, $hari);
		if ($absen->num_rows() == 0) {
			$data = [
				'nip'	=> $id,
				'nama' => $nama,
				'keterangan' => $p['ket'],
				'keterangan_kerja' => $p['keterangan_kerja'],
				'maps_absen' => htmlspecialchars($this->input->post('location_maps', true)),
				'deskripsi' => $p['deskripsi'],
			];
			$this->db->insert('absen', $data);
			$this->session->set_flashdata('message', 'swal("Berhasil!", "Melakukan absen masuk", "success");');
			redirect('user');
		} elseif ($absen->num_rows() == 1) {
			$data = [
				'nip'	=> $id,
				'nama' => $nama,
				'keterangan' => $p['ket'],
				'keterangan_kerja' => $p['keterangan_kerja'],
				'maps_absen' => htmlspecialchars($this->input->post('location_maps', true)),
				'deskripsi' => $p['deskripsi'],
			];
			$this->db->insert('absen', $data);
			$this->session->set_flashdata('message', 'swal("Berhasil!", "Melakukan absen pulang", "success");');
			redirect('user');
		}
	}

	public function edituser($id)
	{

		$this->form_validation->set_rules('nama', 'Nama Karyawan', 'required|trim', [
			'required' => 'Nama Karyawan tidak boleh kosong.'
		]);

		$this->form_validation->set_rules('username', 'username', 'required|trim', [
			'required' => 'username tidak boleh kosong.',
		]);


		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', [
			'required' => 'Jenis Kelamin tidak boleh kosong.'
		]);



		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Edit Profil',
				'page' => 'user/editprofil',
				'subtitle' => 'Karyawan',
				'subtitle2' => 'Edit Profil',
				'data' => $this->db->get('jabatan')->result(),
				'detail' => $this->user->tampiluserwhere($id)->row()
			];
			$this->load->view('templates/app', $data);
		} else {
			

			$oldPhoto = $this->input->post('ganti_gambar');
			$path = './images/users/';
			$config['upload_path'] 		= './images/users/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['overwrite']  		= true;

			$this->load->library('upload', $config);
			// Jika foto diubah
			if ($_FILES['photo']['name']) {
				if ($this->upload->do_upload('photo')) {

					// @unlink($path . $oldPhoto);
					unlink(FCPATH . 'images/users/' . $oldPhoto);
					if (!$this->upload->do_upload('photo')) {
						$this->session->set_flashdata('message', 'swal("Ops!", "Photo gagal diupload", "error");');
						redirect('User/edituser');
					} else {
						$newPhoto = $this->upload->data();
						$gbr = $newPhoto['file_name'];
					}
				}
			}
			$data = [
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'photo' => $gbr
			];

			$this->user->editprofil($id, $data);
			$this->session->set_flashdata('message', 'swal("Berhasil!", "Profil Berhasil Diubah!", "success");');

			redirect(base_url('User'));
		}
	}
}

/* End of file User.php */
