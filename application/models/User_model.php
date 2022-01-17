<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	function absendaily($id, $tahun, $bulan, $hari)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('username', $id);
		$this->db->where('year(tanggal)', $tahun);
		$this->db->where('month(tanggal)', $bulan);
		$this->db->where('day(tanggal)', $hari);
		return $this->db->get();
	}

	public function tampiluserwhere($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('nip', $id);
		return $this->db->get();
	}

	public function editprofil($id, $data)
	{
		$this->db->update('users', $data, ['nip' => $id]);
		return $this->db->affected_rows();
	}


	public function cekabsen($id, $tanggal)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('username', $id);
		$this->db->where('tanggal', $tanggal);
		return $this->db->get();
	}
}

/* End of file ModelName.php */
