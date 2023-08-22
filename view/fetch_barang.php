<?php
require_once('../controller/controllerBarang.php');
$barangController = new controllerBarang();

// Fetch the data from the controller
$data = $barangController->getdata();

// Prepare the response data
$response = array(
    'jenisBaut' => '',
    'jenisMur' => ''
);

// Process the data for "jenis baut" table
if (isset($data['barang'])) {
    foreach ($data['barang'] as $row) {
        $bufferClass = '';
        if ($row['stok'] > $row['buffer'] + 10) {
            $bufferClass = 'table-success';
        } elseif ($row['stok'] < $row['buffer']) {
            $bufferClass = 'bg-danger';
        } else {
            $bufferClass = 'table-warning';
        }

        if ($row['jenis'] == 'Baut') {
            $response['jenisBaut'] .= '<tr class="' . $bufferClass . '">
                <td>' . $row['code_barang'] . '</td>
                <td>' . $row['nama'] . '</td>
                <td>' . $row['type'] . '</td>
                <td>' . $row['jenis'] . '</td>
                <td>' . $row['stok'] . '</td>
                <td>
                    <a href="http://localhost/timbangan/view/editbarang.php/?code=' . $row['code_barang'] . '" class="btn btn-primary btn">Edit</a>
                    <a href="http://localhost/timbangan/controller/deletebarang.php?code=' . $row['code_barang'] . '" class="btn btn-danger btn" onclick="return confirm(\'Are you sure you want to delete this item?\')">Delete</a>
                    <a href="http://localhost/timbangan/view/detail.php?code=' . $row['code_barang'] . '" class="btn btn-secondary btn">Details</a>
                </td>
            </tr>';
        }
    }
}

// Process the data for "jenis mur" table
if (isset($data['barang'])) {
    foreach ($data['barang'] as $row) {
        $bufferClass = '';
        if ($row['stok'] > $row['buffer'] + 10) {
            $bufferClass = 'table-success';
        } elseif ($row['stok'] < $row['buffer'] + 10) {
            $bufferClass = 'bg-danger';
        } else {
            $bufferClass = 'table-warning';
        }

        if ($row['jenis'] == 'Mur') {
            $response['jenisMur'] .= '<tr class="' . $bufferClass . '">
                <td>' . $row['code_barang'] . '</td>
                <td>' . $row['nama'] . '</td>
                <td>' . $row['type'] . '</td>
                <td>' . $row['jenis'] . '</td>
                <td>' . $row['stok'] . '</td>
                <td>
                    <a href="http://localhost/timbangan/view/editbarang.php?code=' . $row['code_barang'] . '" class="btn btn-primary btn">Edit</a>
                    <a href="http://localhost/timbangan/controller/deletebarang.php?code=' . $row['code_barang'] . '" class="btn btn-danger btn" onclick="return confirm(\'Are you sure you want to delete this item?\')">Delete</a>
                    <a href="http://localhost/timbangan/view/detail.php?code=' . $row['code_barang'] . '" class="btn btn-secondary btn">Details</a>
                </td>
            </tr>';
        }
    }
}
    

// Set the response headers
header('Content-Type: application/json');

echo json_encode($response);
