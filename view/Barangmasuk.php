<?php
session_start();
require_once('../BarangmasukModel.php');
include 'header.php';
$barangmasuk = new BarangmasukModel();
$data['barangmasuk'] = $barangmasuk->getBarang();
?>

<div class="mt-5">
    <h2>Daftar Barang Masuk</h2>
    <table class="table table-striped">
        <thead>
            <tr class="table-success">
                <th>Code Barang</th>
                <th>Nama Barang</th>
                <th>Type</th>
                <th>Tanggal Keluar</th>
                <th>Jumlah Barang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="dynamic-content">
            <?php foreach ($data['barangmasuk'] as $row) { ?>
                <tr>
                    <td><?= $row['code_barang']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['type']; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['jumlah']; ?></td>
                    <td>
                        <a href="http://localhost/timbangan/controller/deletebarangmasuk.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchData() {
        $.ajax({
            url: 'fetch_data_masuk.php',
            success: function(data) {
                $('#dynamic-content').html(data);
            }
        });
    }

    $(document).ready(function() {
        fetchData();
        setInterval(fetchData, 3000);
    });
</script>

<?php
include 'footer.php';
?>