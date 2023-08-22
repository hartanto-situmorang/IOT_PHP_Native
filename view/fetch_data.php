<?php
require_once('../BarangkeluarModel.php');
$barangKeluar = new BarangKeluarModel();

foreach ($barangKeluar->getBarang() as $row) {
?>
    <tr>
        <td><?= $row['code_barang']; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['type']; ?></td>
        <td><?= $row['tanggal']; ?></td>
        <td><?= $row['jumlah']; ?></td>
        <td>
            <a href="http://localhost/timbangan/controller/deletebarangkeluar.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
        </td>
    </tr>
<?php
}
?>