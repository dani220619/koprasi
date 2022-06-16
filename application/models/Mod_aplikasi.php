<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By ARYO
 */
class Mod_aplikasi extends CI_Model
{
    public function count_all()
    {

        $this->db->from('aplikasi');
        return $this->db->count_all_results();
    }

    function getAll()
    {
        return $this->db->get("aplikasi");
    }
    function getAplikasi($id)
    {
        $this->db->where("id", $id);
        return $this->db->get("aplikasi")->row();
    }

    function updateAplikasi($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('aplikasi', $data);
    }

    function getImage($id)
    {
        $this->db->select('logo');
        $this->db->from('aplikasi');
        $this->db->where('id', $id);
        return $this->db->get();
    }
    public function tot_anggota()
    {
        $query = $this->db->query("
        select count(nik) as total_ang 
        from tbl_user 
        where id_level = '3'
        ");
        return $query;
    }
    public function tot_pegawai()
    {
        $query = $this->db->query("
        select count(nik) as total_pgw 
        from tbl_user 
        where id_level = '2'
        ");
        return $query;
    }
    public function tot_admin()
    {
        $query = $this->db->query("
        select count(nik) as total_adm 
        from tbl_user 
        where id_level = '1'
        ");
        return $query;
    }
    public function tot_simpanan()
    {
        $query = $this->db->query("
        select sum(jumlah) as total_simpanan 
        from simpanan 
        ");
        return $query;
    }
}
