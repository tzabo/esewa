<?php
include "includes/header.php";
include "includes/navbar.php";
?>

<div class="container mt-4">

    <div class="row">
        <div class="col-md-6">
            <!-- FILTER GEDUNG -->
            <div class="row mb-3">
                
                <?php
                    include "config/database.php"; // koneksi database

                    // Ambil daftar gedung dari database
                    $gedungQuery = mysqli_query($conn, "SELECT id, nama_gedung, gambar FROM gedung ORDER BY id ASC");
                    $gedungs = [];
                    while($row = mysqli_fetch_assoc($gedungQuery)) {
                        $gedungs[] = $row;
                    }
                ?>

                <div class="col-md-5">
                    <select id="filterGedung" class="form-select">
                        <option value="">Jadwal Semua Gedung</option>
                        <?php foreach($gedungs as $g): ?>
                            <option value="<?= $g['id'] ?>">Jadwal <?= htmlspecialchars($g['nama_gedung']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- KOLOM KIRI : CAROUSEL -->
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach($gedungs as $index => $g): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" data-gedung="<?= $g['id'] ?>">
                            <img src="<?= htmlspecialchars($g['gambar']) ?>" class="d-block w-100" alt="<?= htmlspecialchars($g['nama_gedung']) ?>" loading="eager">
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

    <!-- KOLOM KANAN : FULLCALENDAR -->
        <div class="col-md-6">
            <div id="calendar"></div>
        </div>
    </div>

    <!-- MODAL EVENT (letakkan di sini) -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100 text-center"><b>Detail Acara</b></h5>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-borderless" id="modalBodyContent">
                    <!-- JS -->
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-3">
        <h4 style="margin:0; line-height:1.2;">Anda butuh tempat untuk pelaksanaan kegiatan Anda??</h4>
        <h1 style="color: red;">Yukk..ke <b>SIGAP</b> aja !</h1>
        <a href="pages/booking.php" class="btn btn-lg btn-primary px-5 mt-3"><b>PESAN SEKARANG</b></a>
    </div>
</div>

<?php
include "includes/footer.php";
?>