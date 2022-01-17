<?php


defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Absen extends CI_Controller
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
			'title' => 'Data Absensi',
			'page' => 'admin/absensi/dataabsensi',
			'subtitle' => 'Admin',
			'subtitle2' => 'Data Absensi',
			'data' => $this->absen->joinAbsen()->result_array()
		];

		$this->load->view('templates/app', $data, FALSE);
	}

	public function deleteAbsensi($id)
	{
		$this->db->delete('absen', ['id_absen' => $id]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Data Absensi Berhasil Dihapus!", "success");');
		redirect(base_url('data-absensi'));
	}

	public function getAbsenId($id)
	{
		$data = [
			'title' => 'Data Absensi',
			'page' => 'user/absensi/dataabsensi',
			'subtitle' => 'User',
			'subtitle2' => 'Data Absensi',
			'data' => $this->absen->getAbsenByusername($id)
		];

		$this->load->view('templates/app', $data, FALSE);
	}

	public function rekapAbsensi()
	{
		$data = [
			'title' => 'Rekap Absensi Perjabatan',
			'page' => 'admin/absensi/rekapabsensi',
			'subtitle' => 'Admin',
			'subtitle2' => 'Rekap Absensi Perjabatan',
			'data' =>  $this->karyawan->tampilDataJabatan()->result_array()
		];

		$this->load->view('templates/app', $data, FALSE);
	}

	public function detailRekapAbsensi($id)
	{
		$data = [
			'title' => 'Rekap Absensi Perkaryawan',
			'page' => 'admin/absensi/detailrekapabsensi',
			'subtitle' => 'Admin',
			'subtitle2' => 'Rekap Absensi Perkaryawan',
			'nama' => $this->uri->segment(3),
			'user' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array(),
			'data' => $this->absen->getAbsenByjabatan($id)
		];

		$this->load->view('templates/app', $data, FALSE);
	}

	public function rekapAbsensiPerKaryawan()
	{
		$data = [
			'title' => 'Rekap Absensi Karyawan ('.$this->uri->segment(3).')',
			'page' => 'admin/absensi/rekapabsensiperkaryawan',
			'subtitle' => 'Admin',
			'subtitle2' => 'Rekap Absensi Karyawan',
			'nama' => $this->uri->segment(3),
			'user' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array(),
			'data' => $this->absen->absenWhere($this->uri->segment(3))->result_array()
		];

		$this->load->view('templates/app', $data);
	}

	public function rekapAbsensiPerOrangFilter()
	{
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$nama = $this->input->post('nama');

		$data = [
			'title' => 'Filter Rekap Absensi Karyawan',
			'page' => 'admin/absensi/rekapabsensiperkaryawanfilter',
			'subtitle' => 'Admin',
			'subtitle2' => 'Filter Rekap Absensi Karyawan',
			'user' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array(),
			'data' => $this->absen->whereTanggal($awal, $akhir, $nama)->result_array()
		];

		$this->load->view('templates/app', $data);
	}

	function cek_id()
	{
		$result_code = $this->input->post('username');
		$tgl = date('Y-m-d');
		$jam_msk = date('H:i:s');
		$jam_klr = date('H:i:s');
		$cek_id = $this->absen->cek_id($result_code);
		$cek_kehadiran = $this->absen->cek_kehadiran($result_code, $tgl);
		$jam = $this->db->get('jam')->row_array();

	if (!$cek_id) {
            $this->session->set_flashdata('message', 'swal("Gagal!", "Gagal Absen!, Qr Code tidak ditemukan!", "error");');
            redirect($_SERVER['HTTP_REFERER']);

        }

         elseif ($cek_kehadiran && $cek_kehadiran->jam_masuk != '00:00:00' && $cek_kehadiran->jam_keluar == '00:00:00' && date('H:i:s') >=$jam['jam_keluar'] ) {
            $data = array(
                'jam_keluar' => $jam_klr,
                'status' => 'pulang',
            );
            $this->absen->absen_pulang($result_code, $data);
            $this->session->set_flashdata('message', 'swal("Berhasil!", "Berhasil Absen Pulang!", "success");');
            redirect($_SERVER['HTTP_REFERER']);

        } elseif ($cek_kehadiran && $cek_kehadiran->jam_masuk != '00:00:00' && $cek_kehadiran->jam_keluar != '00:00:00' && $cek_kehadiran->status == 'pulang') {
           $this->session->set_flashdata('message', 'swal("Warning!", "Sudah Absen Pulang!", "warning");');
            redirect($_SERVER['HTTP_REFERER']);
            return false;

        } elseif ($cek_kehadiran && $cek_kehadiran->jam_masuk != '00:00:00' && $cek_kehadiran->jam_keluar == '00:00:00' && date('H:i:s') <= $jam['jam_keluar']) {
            $this->session->set_flashdata('message', 'swal("Warning!", "Sudah Absen Masuk!", "warning");');
            redirect($_SERVER['HTTP_REFERER']);
            return false;
        }

        // elseif ($cek_kehadiran && $cek_kehadiran->jam_masuk == '00:00:00' && $cek_kehadiran->jam_keluar == '00:00:00'&& date('H:i:s') > '09:00:00' && date('H:i:s') < '16:00:00' ) {
        //     $data = array(
        //         'username' => $result_code,
        //         'tanggal' => $tgl,
        //         'jam_masuk' => $jam_msk,
        //         'status' => 'Terlambat',
        //     );
        //     $this->M_absen->absen_masuk($data);
        //     $this->session->set_flashdata('messageAlert', $this->messageAlert('warning', 'Anda Terlambat'));
        //     redirect($_SERVER['HTTP_REFERER']);;
        // }

    
        else {
            if (date('H:i:s') >= $jam['toleransi_masuk']) {
            $alert = 'Absen terlambat';
            
            $data = array(
                'username' => $result_code,
                'tanggal' => $tgl,
                'jam_masuk' => $jam_msk,
                'status' => 'terlambat',
            );
            }
            else{
                $alert='Absen Masuk';
                $data = array(
                'username' => $result_code,
                'tanggal' => $tgl,
                'jam_masuk' => $jam_msk,
                'status' => 'masuk',
            );
            }
            $this->absen->absen_masuk($data);
            $this->session->set_flashdata('message', 'swal("Berhasil!", "Berhasil ' . $alert . '", "success");');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


	public function scanqr()
	{
		$data = [
			'title' => 'Scan QR Code',
			'page' => 'admin/absensi/scanqrcode',
			'subtitle' => 'Admin',
			'subtitle2' => 'Scan QR Code',
			'user' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array(),
			'karyawan' =>  $this->karyawan->tampilData()->result_array()
		];

		$this->load->view('templates/app', $data, FALSE);
	}

	public function ambilqr()
	{
		$data = [
			'title' => 'Ambil QR Code',
			'page' => 'admin/absensi/ambilqr',
			'subtitle' => 'Admin',
			'subtitle2' => 'Ambil QR Code',
			'user' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array(),
			'karyawan' => $this->karyawan->tampilData()->result_array()
		];

		$this->load->view('templates/app', $data, FALSE);
	}

	public function cetakqr()
	{
		$data = [
			'title' => 'Cetak QR Code',
			'page' => 'admin/absensi/cetakqr',
			'subtitle' => 'Admin',
			'subtitle2' => 'Cetak QR Code',
			'user' => $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array(),
			'karyawan' =>  $this->karyawan->karyawanWhere(['nip' => $this->uri->segment(3)])->row_array()
		];

		$this->load->library('ciqrcode');

		$params['data'] = $data['karyawan']['username'];
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH . "assets/img/qrcode/" . $data['karyawan']['username'] . 'code.png';
		$this->ciqrcode->generate($params);

		$this->load->view('templates/app', $data, FALSE);
	}
}

/* End of file Absen.php */
