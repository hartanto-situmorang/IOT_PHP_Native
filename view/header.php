<?php
$base_url = 'http://localhost/timbangan/';
// Example in header.php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Barang</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
</head>
<style>
    .edt {
        font-size: 16px;
        font-weight: bold;
        color: #483f81;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('assest\img\bground.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        opacity: 0.5;
        z-index: -1;
    }

    .nav-item a.active {
        color: #ff353a;
    }
</style>
</style>

<body>
    <div class="container mb-4 handr">
        <header class="pt-4 shadow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarExample01">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="btn btn-link edt" href="http://localhost/timbangan/view/Barang">Barang</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-link edt" href="http://localhost/timbangan/view/Barangkeluar">Barang Keluar</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-link edt" href="http://localhost/timbangan/view/Barangmasuk">Barang Masuk</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Navbar -->
            <!-- Background image -->
        </header>
        <main>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>