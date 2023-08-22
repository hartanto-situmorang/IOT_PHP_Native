<?php
session_start();
require_once('../BarangModel.php');
require_once('../BarangmasukModel.php');
require_once('../BarangkeluarModel.php');

class controllerBarang
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

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            $action = $_POST['action'];

            switch ($action) {
                case 'update':
                    $this->update();
                    break;
                default:
                    break;
            }
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the data from the form
            $code_barang = $_POST['code_barang'];
            $nama = $_POST['nama'];
            $type = $_POST['type'];
            $jenis = $_POST['jenis'];
            $buffer = $_POST['buffer'];

            $result = $this->Barang->updateBarang($code_barang, $nama, $type, $jenis,$buffer);

            if ($result) {
                $_SESSION['message'] = '<div class="alert alert-dismissible fade show alert-primary" role="alert" data-mdb-color="primary" id="customxD"> <strong>Berhasil Update Barang!</strong>. <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button></div>';
            }
        }
        header("Location: http://localhost/timbangan/view/Barang");
        exit;
    }
}

$barangController = new controllerBarang();
$barangController->handleRequest();
