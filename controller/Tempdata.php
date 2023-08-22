<?php
session_start();
require_once('../BarangModel.php');
require_once('../BarangmasukModel.php');
require_once('../BarangkeluarModel.php');

class TempData
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

    public function Getdata()
    {
        $mutasi = $_GET['mutasi'];
        $dataget = [
            'code_barang' => $_GET['code'],
            'jumlah' => $_GET['total'],
            'tanggal' => date('Y-m-d')
        ];

        if ($mutasi == '1') {
            // masuk ke model
            $this->barangMasuk->saveBarang($dataget);
            $messageContent = 'Barang Masuk Berhasil';
            $this->saveMessage($messageContent);
            $this->setSessionFlashdata('message', '<div class="alert alert-dismissible fade show alert-primary" role="alert" data-mdb-color="primary" id="customxD">
                <strong>Berhasil Menambahkan Barang Masuk!</strong>.
                <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
              </div>');
            $this->redirect('http://localhost/timbangan/view/Barangmasuk');
        } elseif ($mutasi == '2') {
            $this->barangKeluar->saveBarang($dataget);
            $messageContent = 'Barang Keluar Berhasil';
            $this->saveMessage($messageContent);
            $this->setSessionFlashdata('message', '<div class="alert alert-dismissible fade show alert-warning" role="alert" data-mdb-color="warning" id="customxD">
            <strong>Barang Keluar Berhasil!</strong>.
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
            </div>');
            $this->redirect('http://localhost/timbangan/view/Barangkeluar');
        }
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
    private function saveMessage($content)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=project', 'root', '');
        $statement = $pdo->prepare("INSERT INTO messages (content) VALUES (:content)");
        $statement->bindValue(':content', $content);
        $statement->execute();
    }
}
$TempData = new TempData();
$TempData->Getdata();//memanggil function