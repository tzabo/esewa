<?php

include "../config/auth.php";
include "../config/database.php"; // koneksi database
include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

            <!-- ================= MAIN CONTENT ================= -->
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            
                        </div>
                    </div>
                    <section class="section">
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- FILTER GEDUNG -->
                                    <div class="row mb-3">
                                        
                                        <?php
                                            
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
                                                    <img src="../assets/custom/img/<?= htmlspecialchars($g['gambar']) ?>" class="d-block w-100" alt="<?= htmlspecialchars($g['nama_gedung']) ?>" loading="eager">
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
                            <div class="modal fade text-left" id="eventModal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">

                                        <!-- HEADER PRIMARY -->
                                        <div class="modal-header bg-primary justify-content-center">
                                            <h5 class="modal-title text-white text-center w-100">
                                                <b>Detail Acara</b> <span id="eventCounter"></span>
                                            </h5>
                                        </div>

                                        <!-- BODY -->
                                        <div class="modal-body">
                                            <div id="eventCarousel" class="carousel slide">
                                                <div class="carousel-inner" id="modalBodyContent">
                                                    <!-- event dari JS -->
                                                </div>

                                                <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"></span>
                                                </button>

                                                <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"></span>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- FOOTER -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

<?php
include "../template/footer.php";
?>
        