<?php
require_once('../BarangModel.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barang = new BarangModel();
    $data = array(
        'code_barang' => $_POST['code_barang'],
        'nama'=> $_POST['nama'],
        'type' => $_POST['type'],
        'jenis' => $_POST['jenis'],
        'buffer' => $_POST['buffer'],
    );
    $result = $barang->saveBarang($data);
    if ($result) {
        $_SESSION['message'] = ('<div class="alert alert-dismissible fade show alert-primary" role="alert" data. mdb-color="primary" id="customxD"> <strong>Berhasil Menambahkan Barang!</strong>. <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button> </div>');
        header('Location: http://localhost/timbangan/view/Barang');
        exit;
    } else {
        $_SESSION['message'] =  ('<div class="alert alert-dismissible fade show alert-danger" role="alert" data. mdb-color="danger" id="customxD"> <strong>Gagal Menambahkan Barang!</strong>. <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button> </div>');
        header('Location: http://localhost/timbangan/view/Barang');
        exit;
    }
}
$_SESSION['message'] =  ('<div class="alert alert-dismissible fade show alert-danger" role="alert" data. mdb-color="danger" id="customxD"> <strong>Form Error Menambahkan Barang!</strong>. <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button> </div>');
header('Location: http://localhost/timbangan/view/Barang');
