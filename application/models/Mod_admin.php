<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By ARYO
 */
class Mod_admin extends CI_Model
{
    public function count_all()
    {

        $this->db->from('aplikasi');
        return $this->db->count_all_results();
    }
    public function admin()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '1'
        ");
        return $query;
    }
    public function pegawai()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '2'
        ");
        return $query;
    }

    public function anggota()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '3'
        ");
        return $query;
    }
    public function total_simpanan($nik)
    {
        $query = $this->db->query("
         select sum(jumlah) as jumlah
        from simpanan
        where nik = " . $nik . "
        ");
        return $query;
    }
    public function pinjaman()
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        ");
        return $query;
    }
    public function nama_peminjam()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '3'
        ");
        return $query;
    }
    public function angsuran()
    {
        $query = $this->db->query("
        select a.*, tu.nik, tu.full_name, p.no_pinjaman, p.jumlah, p.lama, .p.bunga, sum(a.jumlah_angsuran) as total_angsuran
        from angsuran a
        left join tbl_user tu
        on a.id_user=tu.id_user
        left join pinjaman p
        on a.id_pinjaman=p.id
        ");
        return $query;
    }
    public function detail_angsuran($id)
    {
        $query = $this->db->query("
        select a.*, tu.nik, tu.full_name, sum(a.nilai) as total_angsuran, p.*
        from angsuran a
        left join tbl_user tu
        on a.id_user=tu.id_user
        left join pinjaman p
        on a.id_pinjaman=p.id
        where p.id = " . $id . "
        ");
        return $query;
    }
    public function riwayat_angsuran($id)
    {
        $query = $this->db->query("
        select *
        from angsuran
        where id_pinjaman = " . $id . "
        order by jumlah_angsuran asc
        ");
        return $query;
    }
    public function lama()
    {
        $query = $this->db->query("
        select *
        from lama
        ");
        return $query;
    }
    function insertangsuran($tabel, $data)
    {
        $insert = $this->db->insert_batch($tabel, $data);
        return $insert;
    }
    public function save_batch($data)
    {
        return $this->db->insert_batch('angsuran', $data);
    }
    public function sdhbyr()
    {
        $query = $this->db->query("
       select jumlah_angsuran, no_angsuran
        from angsuran 
        where no_angsuran = 'AN0010'
        ");
        return $query;
    }
    public function angsuran_anggota($nik)
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        where tu.nik = " . $nik . "
        ");
        return $query;
    }
}
