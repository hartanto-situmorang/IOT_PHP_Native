<?php
session_start();
require_once('../BarangModel.php');
require_once('../BarangmasukModel.php');
require_once('../BarangkeluarModel.php');

class Deletebarangmasuk
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
        $id = $_GET['id'];
        $jumlah = $this->barangKeluar->getJumlahById($id);
        print_r($jumlah);
        $code_barang = $this->barangKeluar->getcodebyId($id);

        if ($jumlah !== false) {
            $this->Barang->updateStokkeluar($code_barang, $jumlah);
            $this->barangKeluar->deleteRecord($id);

            echo '<div class="alert alert-dismissible fade show alert-primary" role="alert" data-mdb-color="primary" id="customxD">
                    <strong>Berhasil Menghapus Barang Keluar!</strong>.
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                  </div>';
            // Redirect to the list page or show a success message
        } else {
            echo '<div class="alert alert-dismissible fade show alert-warning" role="alert" data-mdb-color="warning" id="customxD">
                    <strong>Gagal Menghapus Barang Keluar!</strong>.
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        $this->redirect('http://localhost/timbangan/view/Barangkeluar');
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
$delete = new Deletebarangmasuk();
$delete->index();
