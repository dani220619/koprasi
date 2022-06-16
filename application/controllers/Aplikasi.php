<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aplikasi extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_aplikasi');
    }

    public function index()
    {
        $data['title'] = "Aplikasi";
        $data['apl'] = $this->db->get('aplikasi')->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/aplikasi', $data);
    }
    public function update()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            $this->_validate();
            $id = $this->input->post('id');

            $nama = slug($this->input->post('logo'));
            $config['upload_path']   = './assets/foto/logo/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '6000';
            $config['max_width']     = '6000';
            $config['max_height']    = '6024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                $save  = array(
                    'nama_owner' => $this->input->post('nama_owner'),
                    'title' => $this->input->post('title'),
                    'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                    'copy_right'  => $this->input->post('copy_right'),
                    'tahun' => $this->input->post('tahun'),
                    'versi' => $this->input->post('versi'),
                    'logo' => $gambar['file_name']
                );
                // dead($save);
                $g = $this->Mod_aplikasi->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/logo/' . $g['logo']);
                }

                $this->Mod_aplikasi->updateAplikasi($id, $save);
                echo json_encode(array("status" => TRUE));
                redirect('aplikasi/index');
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'nama_owner' => $this->input->post('nama_owner'),
                    'title' => $this->input->post('title'),
                    'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                    'copy_right'  => $this->input->post('copy_right'),
                    'tahun' => $this->input->post('tahun'),
                    'versi' => $this->input->post('versi')
                );
                $this->Mod_aplikasi->updateAplikasi($id, $save);
                echo json_encode(array("status" => TRUE));
                redirect('aplikasi/index');
            }
        } else {
            $this->_validate();
            $id = $this->input->post('id');
            $save  = array(
                'nama_owner' => $this->input->post('nama_owner'),
                'alamat'    => $this->input->post('alamat'),
                'tlp'       => $this->input->post('tlp'),
                'title' => $this->input->post('title'),
                'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                'copy_right'  => $this->input->post('copy_right'),
                'tahun' => $this->input->post('tahun'),
                'versi' => $this->input->post('versi')
            );
            // dead($save);
            $this->Mod_aplikasi->updateAplikasi($id, $save);
            echo json_encode(array("status" => TRUE));

            redirect('aplikasi/index');
        }
    }
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_owner') == '') {
            $data['inputerror'][] = 'nama_owner';
            $data['error_string'][] = 'Nama PT Tidak Boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nama_aplikasi') == '') {
            $data['inputerror'][] = 'nama_aplikasi';
            $data['error_string'][] = 'Nama Aplikasi Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('alamat') == '') {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tlp') == '') {
            $data['inputerror'][] = 'tlp';
            $data['error_string'][] = 'No Telpon Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('title') == '') {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Title Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('copy_right') == '') {
            $data['inputerror'][] = 'copy_right';
            $data['error_string'][] = 'Copy Right tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tahun') == '') {
            $data['inputerror'][] = 'tahun';
            $data['error_string'][] = 'Tahun tidak boleh kosong';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
