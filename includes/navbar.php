<?php
include(__DIR__ . "/../config.php");
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= $base_url ?>index.php"><b>S I G A P</b></a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>pages/gedung.php">Gedung</a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>pages/jadwal.php">Jadwal</a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>pages/booking.php">Pesan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>