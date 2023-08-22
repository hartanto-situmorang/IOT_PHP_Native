<?php
session_start();
require_once('../BarangModel.php');
require_once('../BarangmasukModel.php');
require_once('../BarangkeluarModel.php');

class Deletebarang
{

    private $Barang;
    private $barangKeluar;
    private $barangMasuk;

    public function __construct()
    {
        $this->Barang = new BarangModel();
        $this->barangKeluar = new BarangKeluarModel();
        $this->barangMasuk = new BarangmasukModel();
    }
    public function index()
    {
        $code_barang = $_GET['code'];
        $result = $this->Barang->deleteBarang($code_barang);
        if ($result) {
            $this->setSessionFlashdata('message', '<div class="alert alert-dismissible fade show alert-primary" role="alert" data-mdb-color="primary" id="customxD">
            <strong>Berhasil Menghapus Barang!</strong>.
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
          </div>');
        } else {
            $this->setSessionFlashdata('message', '<div class="alert alert-dismissible fade show alert-warning" role="alert" data-mdb-color="warning" id="customxD">
            <strong>Gagal Menghapus Barang!</strong>.
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
          </div>');
        }
        $this->redirect('http://localhost/timbangan/view/Barang');
    }
    private function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }

    private function setSessionFlashdata($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}
$delete = new Deletebarang();
$delete->index();
