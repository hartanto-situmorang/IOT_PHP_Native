<?php
require_once('../controller/controllerBarang.php');

$barangController = new controllerBarang();
$code_barang = $_GET['code'];
$barang = $data = $barangController->edit($code_barang);
include 'header.php';
?>
<div class="container-lg">
    <div class="container mt-4 shadow-4 p-4 mt-5" style="max-width: 600px;">
        <?php foreach ($barang as $row) { ?>
            <h2>Edit Barang <?php echo $row['nama']; ?></h2>
            <form method="POST" action="http://localhost/timbangan/controller/controllerUpdateBarang.php">
                <input type="hidden" name="action" value="update">
                <div class="form-group mt-2 mb-4">
                    <label for="code_barang">Code Barang</label>
                    <input type="hidden" name="code_barang" class="form-control" value="<?php echo $row['code_barang']; ?>" readonly>
                    <input disable type="text" name="code_barang" class="form-control" value="<?php echo $row['code_barang']; ?>" readonly>
                </div>
                <div class="form-group mt-2 mb-4">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">
                </div>
                <div class="form-group mt-2 mb-4">
                    <label for="type_baut">Type Baut</label>
                    <input type="text" name="type" class="form-control" value="<?php echo $row['type']; ?>">
                </div>
                <div class="form-group mt-2 mb-4">
                    <label for="jenis">jenis</label>
                    <input type="text" name="jenis" class="form-control" value="<?php echo $row['jenis']; ?>">
                </div>
                <div class="form-group mt-2 mb-4">
                    <label for="buffer">buffer</label>
                    <input type="text" name="buffer" class="form-control" value="<?php echo $row['buffer']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            <?php } ?>
            </form>
    </div>
</div>

<?php
include 'footer.php';
?>