<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_admin');
        $this->load->model('Mod_user');
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function user_data()
    {
        $data['title'] = "User Data";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['user'] = $this->Mod_admin->admin()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/user_data', $data);
    }
    public function insert_admin()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function update_admin()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/user_data');
            // echo json_encode(array("status" => TRUE));
        }
    }

    public function del_admin()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/user_data');
    }

    public function pegawai()
    {
        $data['title'] = "Pegawai Data";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['pegawai'] = $this->Mod_admin->pegawai()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/pegawai', $data);
    }
    public function insert_pegawai()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'id_level'  => $this->input->post('level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/pegawai');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/pegawai');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }
    public function update_pegawai()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),

                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/pegawai');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/pegawai');
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/pegawai');
            // echo json_encode(array("status" => TRUE));
        }
    }

    public function del_pegawai()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('swal', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/pegawai');
    }
    public function anggota()
    {
        $data['title'] = "Pegawai Data";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['anggota'] = $this->Mod_admin->anggota()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/anggota', $data);
    }
    public function insert_anggota()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'id_level'  => $this->input->post('level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }
    public function update_anggota()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),

                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/anggota');
            // echo json_encode(array("status" => TRUE));
        }
    }
    public function del_anggota()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/anggota');
    }

    public function simpanan()
    {
        $data['title'] = "Simpanan Data";

        $data['user_level'] = $this->Mod_user->userlevel();
        $data['anggota'] = $this->Mod_admin->anggota()->result();

        // dead($nik);
        $this->template->load('layoutbackend', 'admin/simpanan', $data);
    }
    public function tambah_simpanan($nik)
    {
        $data['title'] = "Simpanan Data";
        $nik = $this->db->get_where('tbl_user', ['nik' => $nik])->row_array();
        $nik = $nik['nik'];
        $data['simpanan'] = $this->Mod_user->getnik($nik)->row_array();
        // dead($data['simpanan']);
        $this->template->load('layoutbackend', 'admin/tambah_simpanan', $data);
    }
    public function insert_simpanan()
    {
        // var_dump($this->input->post('username'));

        $save  = array(
            'id' => rand(00000, 99999),
            'nik' => $this->input->post('nik'),
            'jumlah' => $this->input->post('jumlah'),
            'tanggal_bayar' => date("Y-m-d H:i:s"),

        );
        // dead($save);
        $this->Mod_user->insertSimpanan("simpanan", $save);
        redirect('admin/simpanan');
        // echo json_encode(array("status" => TRUE));
    }
    public function update_simpanan()
    {
        // var_dump($this->input->post('username'));
        $id = $this->input->post('id');
        $nik = $this->input->post('nik');
        $save  = array(
            'nik' => $nik,
            'jumlah' => $this->input->post('jumlah'),
            'tanggal_bayar' => date("Y-m-d H:i:s"),

        );
        // dead($save);
        $this->Mod_user->updateSimpanan($id, $save);
        redirect('admin/detail_simpanan/' . $nik . '');
        // echo json_encode(array("status" => TRUE));
    }
    public function delete($id)
    {
        $this->Mod_user->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
        $this->session->set_flashdata('success', 'Data Simpanan Wajib Berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function del_simpanan($nik)
    {
        // dead($nik);
        $id = $this->input->get('id');
        $this->db->delete('simpanan', array('id' => $id));

        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/detail_simpanan/' . $nik . '');
    }

    public function backup_data()
    {
        $data["title"]         = "Backup Database Dengan CodeIgniter";
        $this->template->load('layoutbackend', 'admin/backup_data', $data);
    }




    public function detail_simpanan($nik)
    {
        $data['title'] = "Detail Simpanan Data";

        $data['det_simpanan'] = $this->Mod_user->detail_simpanan($nik)->result();
        $data['jml'] = $this->Mod_admin->total_simpanan($nik)->row_array();
        // dead($data['jumlah']);
        $this->template->load('layoutbackend', 'admin/detail_simpanan', $data);
    }

    public function pinjaman()
    {
        $data['title'] = "Pinjaman Data";
        $data['lama'] = ['6', '10', '12'];
        $data['nama'] = $this->Mod_admin->nama_peminjam()->result();
        $data['pinjaman'] = $this->Mod_admin->pinjaman()->result();

        // dead($data['lama']);
        $this->template->load('layoutbackend', 'admin/pinjaman', $data);
    }
    public function insert_pinjaman()
    {
        // var_dump($this->input->post('username'));

        $save  = array(
            'id' => rand(0000, 9999),
            'id_user' => $this->input->post('id_user'),
            'no_pinjaman' => 'ANG' . rand(000, 999),
            'jumlah' => $this->input->post('jumlah'),
            'lama' => $this->input->post('lama'),
            'bunga' => $this->input->post('bunga'),
            'tanggal' => date("Y-m-d H:i:s"),

        );
        // dead($save);
        $this->Mod_user->insertpinjaman("pinjaman", $save);
        redirect('admin/pinjaman');
        // echo json_encode(array("status" => TRUE));
    }
    public function update_pinjaman()
    {
        // var_dump($this->input->post('username'));
        $id = $this->input->post('id');
        $save  = array(
            'id' => $id,
            'id_user' => $this->input->post('id_user'),
            'no_pinjaman' => $this->input->post('no_pinjaman'),
            'jumlah' => $this->input->post('jumlah'),
            'lama' => $this->input->post('lama'),
            'bunga' => $this->input->post('bunga'),
            'tanggal' => date("Y-m-d H:i:s"),

        );
        // dead($save);
        $this->Mod_user->updatepinjaman($id, $save);
        redirect('admin/pinjaman');
        // echo json_encode(array("status" => TRUE));
    }
    public function delete_pinjaman($id)
    {
        $this->Mod_user->delete_pinjaman($id); // Panggil fungsi delete() yang ada di SiswaModel.php
        $this->session->set_flashdata('success', 'Data Simpanan Wajib Berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function angsuran()
    {
        $data['title'] = "Angsuran Data";
        $data['lama'] = ['6', '10', '12'];
        $data['nama'] = $this->Mod_admin->nama_peminjam()->result();
        $data['angsuran'] = $this->Mod_admin->angsuran()->result();

        // dead($data['lama']);
        $this->template->load('layoutbackend', 'admin/angsuran', $data);
    }
    public function list_angsuran()
    {
        $data['title'] = "List Angsuran Data";
        $data['nama'] = $this->Mod_admin->nama_peminjam()->result();

        $data['list_angsuran'] = $this->Mod_admin->pinjaman()->result();

        // dead($data['lama']);
        $this->template->load('layoutbackend', 'admin/list_angsuran', $data);
    }
    public function tambah_angsuran($id)
    {
        $data['title'] = "Tambah Angsuran Data";
        // $data['lama'] = ['6', '10', '12'];
        $data['riwayat_angsuran'] = $this->Mod_admin->riwayat_angsuran($id)->result();
        $data['angsuran'] = $this->Mod_admin->detail_angsuran($id)->row();
        $data['lama'] = $this->Mod_admin->lama()->result();
        $data['sb'] = $this->Mod_admin->sdhbyr()->result();
        // foreach ($ds as $d) {
        //     $i = 1;
        //     for ($i; $i <= $d->jml_angsuran; $i++) {
        //         $data['sb'] = $i;
        //     }
        // }


        // dead($data['sb']);

        $this->template->load('layoutbackend', 'admin/tambah_angsuran', $data);
    }
    public function insert_angsuran()
    {
        $id = $this->input->post('id_pinjaman');
        $id_angsuran = 'ANG' . rand(000, 999);
        $jumlah_angsuran = $this->input->post('jumlah_angsuran[]', TRUE);

        foreach ($jumlah_angsuran as $key) { // Kita buat perulangan berdasarkan nisn sampai data terakhir
            $save[$key] =
                array(
                    'jumlah_angsuran' => $key,
                    'id' => $id_angsuran++,
                    'id_user' => $this->input->post('id_user'),
                    'no_angsuran' => $this->input->post('no_pinjaman'),
                    'id_pinjaman' => $id,
                    'nilai' => $this->input->post('nilai'),
                    'tanggal' => date("Y-m-d H:i:s"),
                    'metode_pembayaran' => "Manual"
                );

            $key;
        }
        // dead($save);
        $this->Mod_admin->insertangsuran("angsuran", $save);
        redirect('admin/tambah_angsuran/' . $id . '');
        // echo json_encode(array("status" => TRUE));

    }
    public function delete_angsuran($id)
    {
        $this->Mod_user->delete_angsuran($id); // Panggil fungsi delete() yang ada di SiswaModel.php
        $this->session->set_flashdata('success', 'Data Simpanan Wajib Berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function detail_angsuran($id)
    {
        $data['title'] = "Pinjaman Data";
        $data['lama'] = ['6', '10', '12'];
        $data['nama'] = $this->Mod_admin->nama_peminjam()->row();
        $data['angsuran'] = $this->Mod_admin->detail_angsuran($id)->row();

        // dead($data['lama']);
        $this->template->load('layoutbackend', 'admin/detail_angsuran', $data);
    }


    public function backup()
    {

        $this->load->dbutil();
        $data['setting_school'] = "DATA";
        $prefs = [
            'format' => 'zip',
            'filename' => $data['setting_school']['setting_value'] . '-' . date("Y-m-d H-i-s") . '.sql'
        ];
        $backup = $this->dbutil->backup($prefs);
        $file_name = $data['setting_school']['setting_value'] . '-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->download($file_name);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('full_name') == '') {
            $data['inputerror'][] = 'full_name';
            $data['error_string'][] = 'Full Name is required';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
