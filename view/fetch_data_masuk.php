<?php
require_once('../BarangmasukModel.php');
$barangmasuk = new BarangmasukModel();

foreach ($barangmasuk->getBarang() as $row) {
?>
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
<?php
}
?>