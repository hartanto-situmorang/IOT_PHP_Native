<?php
require_once('../controller/controllerBarang.php');
require_once('../controller/controllerbarangmasuk.php');
require_once('../controller/controllerbarangkeluar.php');

$barangController = new controllerBarang();
$barangkeluarcontaoller = new controllerbarangkeluar();
$barangmasukcontaoller = new controllerbarangmasuk();
$code_barang = $_GET['code'];
$barangmasuk = $barangmasukcontaoller->getdatabycode($code_barang);
$barangkeluar = $barangkeluarcontaoller->getdatabycode($code_barang);
include 'header.php';
?>
<div class="mt-5">
    <h5>Daftar Barang Masuk</h5>
    <table class="table table-striped">
        <thead>
            <tr class="table-primary">
                <th>Code Barang</th>
                <th>Nama Barang</th>
                <th>Type</th>
                <th>Tanggal Keluar</th>
                <th>Jumlah Barang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barangmasuk as $row) { ?>
                <tr>
                    <td><?php echo $row['code_barang']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td>
                        <a href="http://localhost/timbangan/Barangkeluar.php/delete/' . $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="mt-5">
    <h5>Daftar Barang Keluar</h5>
    <table class="table table-striped">
        <thead>
            <tr class="table-warning">
                <th>Code Barang</th>
                <th>Nama Barang</th>
                <th>Type</th>
                <th>Tanggal Keluar</th>
                <th>Jumlah Barang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barangkeluar as $row) { ?>
                <tr>
                    <td><?php echo $row['code_barang']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td>
                        <a href="http://localhost/timbangan/barangmasuk.php/delete?id='<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
include 'footer.php';
?>