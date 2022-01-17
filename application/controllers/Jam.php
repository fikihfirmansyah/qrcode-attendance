<?php


defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Jam extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Absen_model', 'absen');
		$this->load->model('karyawan_model', 'karyawan');
		is_login();
	}

	public function index()
	{
		$data = [
			'title' => 'Data Jam',
			'page' => 'admin/jam/datajam',
			'subtitle' => 'Admin',
			'subtitle2' => 'Data Jam',
			'data' => $this->db->get('jam')->result_array()
		];

		$this->load->view('templates/app', $data, FALSE);

	}

	public function editJam($id)
	{
		$this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required|trim', [
			'required' => 'Jam Masuk tidak boleh kosong.'
		]);

		$this->form_validation->set_rules('jam_keluar', 'Jam Keluar', 'required|trim', [
			'required' => 'Jam Keluar tidak boleh kosong.'
		]);

		$this->form_validation->set_rules('toleransi_masuk', 'Toleransi Masuk', 'required|trim', [
			'required' => 'Jam Toleransi Masuk tidak boleh kosong.'
		]);
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Edit Data Jam',
				'page' => 'admin/jam/editjam',
				'subtitle' => 'Admin',
				'subtitle2' => 'Edit Data jam',
				'jam' => $this->db->get_where('jam',array('id_jam' => $id))->row_array()
			];
			$this->load->view('templates/app', $data);
		} else {
			$data = [
				'jam_masuk' 	=> $this->input->post('jam_masuk'),
				'jam_keluar' => $this->input->post('jam_keluar'),
				'toleransi_masuk' => $this->input->post('toleransi_masuk')
			];

			$this->db->where('id_jam', $id);
			$this->db->update('jam', $data);
			$this->session->set_flashdata('message', 'swal("Berhasil!", "Data Jam Berhasil Diedit!", "success");');
			redirect(base_url('data-jam'));
		}
	}
}

/* End of file Jam.php */
