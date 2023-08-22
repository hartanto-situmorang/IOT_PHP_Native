<?php
session_start();
require_once('../controller/controllerBarang.php');

$barangController = new controllerBarang();
$data = $barangController->getdata();
include 'header.php';

// Connect database
$pdo = new PDO('mysql:host=localhost;dbname=project', 'root', '');

$statement = $pdo->query("SELECT * FROM messages ORDER BY timestamp DESC LIMIT 1");
$message = $statement->fetch(PDO::FETCH_ASSOC);

if ($message) {
    $_SESSION['flash_message'] = $message['content'];
    $deleteStatement = $pdo->prepare("DELETE FROM messages WHERE id = :id");
    $deleteStatement->bindValue(':id', $message['id']);
    $deleteStatement->execute();
}
?>
<style>
    .bg-danger {
        color: white;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function fetchBarang() {
        $.ajax({
            url: 'fetch_barang.php',
            success: function(data) {
                $('#jenis-baut-table tbody').html(data.jenisBaut);
                $('#jenis-mur-table tbody').html(data.jenisMur);
            }
        });
    }

    function checkForChanges() {
        $.ajax({
            url: 'check_changes.php',
            success: function(response) {
                if (response.changed) {
                    alert('Data has changed. Please refresh the page.');
                }
            }
        });
    }

    $(document).ready(function() {
        fetchBarang();
        setInterval(fetchBarang, 3000);
        setInterval(checkForChanges, 5000);
    });

    function fetchMessage() {
        $.ajax({
            url: 'check_messages.php',
            success: function(data) {
                if (data.message) {
                    document.getElementById('divalert').style.display = 'flex';
                    $('#flash-message').text(data.message).show();
                    $.ajax({
                        url: 'clear_message.php',
                        success: function(response) {}
                    });
                } else {
                    document.getElementById('divalert').style.display = 'none';
                    $('#flash-message').text(data.message).hidden();
                }
            }
        });
    }

    $(document).ready(function() {
        fetchMessage();
        setInterval(fetchMessage, 3000);
        var flashMessage = sessionStorage.getItem('flash_message');
        if (flashMessage) {
            $('.alert').text(flashMessage).show();
            sessionStorage.removeItem('flash_message');
        }
    });
</script>
<div class="mt-5">
    <h2>Daftar Barang</h2>
    <button type="button" class="btn btn-primary mb-4 mt-3" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
        Tambah Data Barang
    </button>
    <div id="divalert" style="display: none;" class="alert alert-dismissible fade show alert-warning" role="alert" data-mdb-color="warning">
        <strong id="flash-message"></strong>
        </button>
    </div>
    <?php
    // Display the flash message if it exists
    if (isset($_SESSION['flash_message'])) {
        echo '<div id="flash-message" style="display: none;" class="alert alert-dismissible fade show alert-warning" role="alert" data-mdb-color="warning" id="customxD"> WOEEEEEEEEEEEEEE' . $_SESSION['flash_message'] . '<button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close">
        </button>';
        // Remove the flash message from the session
        unset($_SESSION['flash_message']);
    }
    ?>
    <div class="datatable">
        <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
            <h5>Jenis Baut</h5>
            <table id="jenis-baut-table" class="table datatable-table">
                <thead class="datatable-header">
                    <tr class="table-primary">
                        <th>Code Barang</th>
                        <th>Nama</th>
                        <th>Type Baut</th>
                        <th>Jenis Barang</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <h5>Jenis Mur</h5>
            <table id="jenis-mur-table" class="table datatable-table">
                <thead class="datatable-header">
                    <tr class="table-success">
                        <th>Code Barang</th>
                        <th>Nama</th>
                        <th>Type Baut</th>
                        <th>Jenis Barang</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="http://localhost/timbangan/controller/savebarang.php">
                        <input type="hidden" name="action" value="update">
                        <div class="form-group mt-2 mb-4">
                            <label for="code_barang">Code Barang</label>
                            <input type="text" name="code_barang" class="form-control" value="">
                        </div>
                        <div class="form-group mt-2 mb-4">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" value="">
                        </div>
                        <div class="form-group mt-2 mb-4">
                            <label for="type_baut">Type Baut</label>
                            <input type="text" name="type" class="form-control" value="">
                        </div>
                        <div class="form-group mt-2 mb-4">
                            <label for="jenis">jenis</label>
                            <input type="text" name="jenis" class="form-control" value="">
                        </div>
                        <div class="form-group mt-2 mb-4">
                            <label for="jenis">Buffer Stok</label>
                            <input type="number" name="buffer" class="form-control" value="0">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>