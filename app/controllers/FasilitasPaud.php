<?php

class FasilitasPaud extends Controller
{
    public function index()
    {
        $data['title'] = 'Halaman Data Guru';
        $data['data_fasilitas'] = $this->model('FasilitasModel')->getallFasilitas();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('fasilitas/index', $data);
        $this->view('templates/footer', $data);
    }

    public function tambah()
    {
        if ($this->model('FasilitasModel')->tambahFasilitas($_POST, $_FILES) > 0) {
            Flasher::setMessage('Berhasil', 'ditambah', 'success');
            header('location: ' . base_url . '/fasilitaspaud');
        } else {
            Flasher::setMessage('Gagal', 'ditambah', 'danger');
            header('location: ' . base_url . '/fasilitaspaud');
        }
    }


    public function hapusfasilitas()
    {
        if ($this->model('FasilitasModel')->hapusfasilitas($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'dihapus', 'success');
            header('location: ' . base_url . '/fasilitaspaud');
        } else {
            Flasher::setMessage('Gagal', 'dihapus', 'danger');
            header('location: ' . base_url . '/fasilitaspaud');
            exit;
        }
    }

    public function cariGuru()
    {
        $data['title'] = 'Halaman Data Guru';
        $data['dataguru'] = $this->model('FasilitasModel')->cariGuru();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('guru/index', $data);
        $this->view('templates/footer', $data);
    }
}
