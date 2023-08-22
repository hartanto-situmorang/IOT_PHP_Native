<?php
require_once('../BarangModel.php');
require_once('../BarangmasukModel.php');
require_once('../BarangkeluarModel.php');
class controllerbarangmasuk
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
        $data['barang'] = $this->Barang->getBarang();
        include 'view/header.php';
        include 'view/Barang_view.php';
        include 'view/footer.php';
    }
    public function getdatabycode($code_barang)
    {
        $data = $this->barangMasuk->getBarangByCode($code_barang);
        return $data;
    }

    public function detail($code_barang)
    {
        $data['barangkeluar'] = $this->barangKeluarModel->getBarangByIdbarang($code_barang);
        $data['barangmasuk'] = $this->barangMasukModel->getBarangByIdbarang($code_barang);
        $this->loadView('header');
        $this->loadView('detail', $data);
        $this->loadView('footer');
    }

    public function edit($code_barang)
    {
        $data['barang'] = $this->barangModel->getBarangByCode($code_barang);
        $this->loadView('header');
        $this->loadView('edit_barang_view', $data);
        $this->loadView('footer');
    }

    public function update()
    {
        $code_barang = $_POST['code_barang'];
        $nama = $_POST['nama'];
        $type_baut = $_POST['type'];
        $jenis = $_POST['jenis'];
        $buffer = $_POST['buffer'];

        $this->barangModel->updateBarang($code_barang, $nama, $type_baut, $jenis,$buffer);
        $this->redirect('barang');
    }

    public function delete($code_barang)
    {
        if ($this->barangModel->deleteBarang($code_barang)) {
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
        $this->redirect('barang');
    }

    public function insert()
    {
        $this->loadView('header');
        $this->loadView('insert_barang_view');
        $this->loadView('footer');
    }

    public function save()
    {
        $data = array(
            'code_barang' => $_POST['code_barang'],
            'nama' => $_POST['nama'],
            'type' => $_POST['type'],
            'jenis' => $_POST['jenis'],
            'buffer' => $_POST['buffer']
        );

        if ($this->barangModel->saveBarang($data)) {
            $this->setSessionFlashdata('message', '<div class="alert alert-dismissible fade show alert-primary" role="alert" data.
            mdb-color="primary" id="customxD">
            <strong>Berhasil Menambahkan Barang!</strong>.
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
          </div>');
        } else {
            $this->setSessionFlashdata('message', '<div class="alert alert-dismissible fade show alert-warning" role="alert" data-mdb-color="warning" id="customxD">
            <strong>Gagal Menambahkan Barang!</strong>.
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
          </div>');
        }
        $this->redirect('barang');
    }

    public function loadView($viewName, $data = [])
    {
        $viewPath = 'view/' . $viewName . '.php';

        if (file_exists($viewPath)) {
            extract($data);
            require($viewPath);
        } else {
            die("View not found: " . $viewName);
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
}
