<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen_model extends CI_Model
{

	public function rekapData()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('jabatan', 'jabatan.jabatan_id = users.jabatan_id');
		$this->db->order_by('jabatan_nama', 'DESC');
		return $this->db->get();
	}

	public function getAbsenByid($id)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('users', 'absen.nip = users.nip');
		$this->db->where('users.nip', $id);
		$this->db->order_by('tanggal', 'desc');
		return $this->db->get()->result();
	}

	public function getAbsenByusername($id)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('users', 'absen.username = users.username');
		$this->db->where('users.username', $id);
		$this->db->order_by('tanggal', 'desc');
		return $this->db->get()->result_array();
	}

	public function getAbsenByjabatan($id)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('users', 'absen.username = users.username');
		$this->db->where('users.jabatan_id', $id);
		$this->db->order_by('tanggal', 'desc');
		return $this->db->get()->result_array();
	}

	public function joinAbsen()
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('users', 'users.username = absen.username');
		$this->db->join('jabatan', 'jabatan.jabatan_id = users.jabatan_id');
		$this->db->order_by('tanggal', 'desc');
		return $this->db->get();
	}

	public function tampilData()
	{
		return $this->db->get('absen');
	}


	public function absenWhere($where)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('username', $where);
		$this->db->order_by('tanggal', 'desc');
		return $this->db->get();
	}

	public function whereTanggal($awal, $akhir, $nama)
	{

		// $this->db->query("SELECT * FROM absen WHERE tanggal BETWEEN  AND ;");
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
		$this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
		$this->db->where('username', $nama);
		
		return $this->db->get();
	}

	public function update_absen($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	public function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function cek_id($username)
	{
		$query_str =

		$this->db->where('username', $username)
		->get('users');
		if ($query_str->num_rows() > 0) {
			return $query_str->row();
		} else {
			return false;
		}
	}

	public function cek_kehadiran($username, $tgl)
	{
		$query_str =

		$this->db->where('username', $username)
		->where('tanggal', $tgl)->get('absen');
		if ($query_str->num_rows() > 0) {
			return $query_str->row();
		} else {
			return false;
		}
	}

	public function absen_masuk($data)
	{
		return $this->db->insert('absen', $data);
	}

	public function absen_pulang($username, $data)
	{
		$tgl = date('Y-m-d');
		return

		$this->db->where('username', $username)
		->where('tanggal', $tgl)
		->update('absen', $data);
	}

	public function joinAll($where)
	{
		$this->db->select('*');
		$this->db->from('absen a'); 
		$this->db->join('users b', 'b.username=a.username');
		$this->db->join('jabatan c', 'c.jabatan_id=b.jabatan_id');
		$this->db->where('c.jabatan_id',$where);
		$this->db->order_by('a.tanggal','desc');         
		return $this->db->get(); 
	}

	


}

/* End of file ModelName.php */
