<?php

include "../config/database.php";
include "../includes/header.php";
include "../includes/navbar.php";

if(!empty($_GET['bulan'])){
    $bulanAktif = $_GET['bulan'];
}else{
    $bulanAktif = date('Y-m');
}

$prev = date('Y-m', strtotime($bulanAktif.' -1 month'));
$next = date('Y-m', strtotime($bulanAktif.' +1 month'));

$bulanNum = date('n', strtotime($bulanAktif));
$tahunNum = date('Y', strtotime($bulanAktif));

$sql = "SELECT booking.*, gedung.nama_gedung
FROM booking
JOIN gedung ON booking.gedung_id = gedung.id
WHERE MONTH(booking.tanggal) = '$bulanNum'
AND YEAR(booking.tanggal) = '$tahunNum'";

$where = [];

if(!empty($_GET['gedung'])){
    $where[] = "booking.gedung_id='".$_GET['gedung']."'";
}

if(!empty($_GET['bulan'])){
    $bulan = date('m', strtotime($_GET['bulan']));
    $tahun = date('Y', strtotime($_GET['bulan']));

    $where[] = "MONTH(booking.tanggal)='$bulan' AND YEAR(booking.tanggal)='$tahun'";
}

// if(!empty($_GET['keperluan'])){
//     $where[] = "booking.keperluan LIKE '%".$_GET['keperluan']."%'";
// }

if(isset($_GET['status']) && $_GET['status'] != ""){
    $where[] = "booking.status='".$_GET['status']."'";
}else{
    $where[] = "booking.status='Disetujui'";
}

if(count($where) > 0){
    $sql .= " AND ".implode(" AND ", $where);
}

$query = mysqli_query($conn,$sql);

//BULAN

$bulan = [
1=>"Januari","Februari","Maret","April","Mei","Juni",
"Juli","Agustus","September","Oktober","November","Desember"
];

//TANGGAL INDONESIA

function tanggalIndonesia($tanggal){

    $bulan = [
        1=>"Januari","Februari","Maret","April","Mei","Juni",
        "Juli","Agustus","September","Oktober","November","Desember"
    ];

    $pecah = explode('-', $tanggal);

    return $pecah[2]." ".$bulan[(int)$pecah[1]]." ".$pecah[0];
}

?>

<div class="container mt-5">
    <form method="GET" class="row mb-4">
        
        <div class="col-md-3">
            <select id="filterType" class="form-control">
                <option value="">Pilih Filter</option>
                <option value="gedung">Gedung</option>
                <option value="tanggal">Bulan</option>
                <!-- <option value="keperluan">Keperluan</option>    -->
                <option value="status">Status</option>
            </select>
        </div>

        <div class="col-md-3 filter-box" id="filterGedung" style="display:none;">
            <select name="gedung" class="form-control">
                <option value="">Pilih Gedung</option>
                <option value="1">Gedung 1</option>
                <option value="2">Gedung 2</option>
                <option value="3">Gedung 3</option>
                <option value="4">Gedung 4</option>
            </select>
        </div>

        <div class="col-md-3 filter-box" id="filterTanggal" style="display:none;">
            <input type="month" name="bulan" class="form-control">
        </div>

        <!-- <div class="col-md-3 filter-box" id="filterKeperluan" style="display:none;">
            <input type="text" name="keperluan" class="form-control" placeholder="Keperluan">
        </div> -->

        <div class="col-md-3 filter-box" id="filterStatus" style="display:none;">
            <select name="status" class="form-control">
                <option value="">Semua Status</option>

                <option value="Proses"
                <?php if(($_GET['status'] ?? '')=='Proses') echo 'selected'; ?>>
                Proses
                </option>

                <option value="Disetujui"
                <?php if(($_GET['status'] ?? '')=='Disetujui') echo 'selected'; ?>>
                Disetujui
                </option>

                <option value="Ditolak"
                <?php if(($_GET['status'] ?? '')=='Ditolak') echo 'selected'; ?>>
                Ditolak
                </option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">Filter</button>
            <a href="jadwal.php" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <?php

    $prev = date('Y-m', strtotime($bulanAktif.' -1 month'));
    $next = date('Y-m', strtotime($bulanAktif.' +1 month'));

    ?>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <a href="jadwal.php?bulan=<?php echo $prev ?>&gedung=<?php echo $_GET['gedung'] ?? '' ?>" class="btn btn-outline-primary">
        ← Bulan Sebelumnya
        </a>

        <h3>
        Jadwal Bulan <?php echo $bulan[$bulanNum]." ".$tahunNum ?>
        </h3>

        <a href="jadwal.php?bulan=<?php echo $next ?>&gedung=<?php echo $_GET['gedung'] ?? '' ?>" class="btn btn-outline-primary">
        Bulan Berikutnya →
        </a>

    </div>

    <?php
    $total = mysqli_num_rows($query);
    ?>

    <div class="alert alert-info">
        Total Jadwal Bulan Ini : <b><?php echo $total ?></b>
    </div>

    <div class="alert alert-secondary">
        Hanya menampilkan jadwal yang telah <b>DISETUJUI</b>. Gunakan filter untuk dapat melihat perkembangan semua status.
    </div>

    <table class="table table-bordered table-hover">

        <thead>
            <tr>
                <th class="col-no">No</th>
                <th>Gedung</th>
                <th>Tanggal Penggunaan</th>
                <th>Jumlah Sesi (Jam)</th>
                <th>Jenis Acara</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            <?php 
                $no = 1;
                while($row = mysqli_fetch_assoc($query)) { 

                $status = $row['status'];

                if($status == "Proses"){
                    $badge = "warning";
                }elseif($status == "Disetujui"){
                    $badge = "success";
                }else{
                    $badge = "danger";
                }
            ?>

            <tr>
                <td class="col-no"><?php echo $no++; ?></td>
                <td><?php echo $row['nama_gedung'] ?></td>
                <td><?php echo tanggalIndonesia($row['tanggal']); ?></td>
                <td><?php echo $row['jumlah_sesi'] ?? '-' ?> Sesi (<?php echo $row['durasi_jam'] ?> Jam)</td>
                <td><?php echo $row['jenis_acara'] ?></td>
                <td><span class="badge rounded-pill bg-<?php echo $badge ?>"><?php echo $status ?></span></td>
            </tr>

            <?php } ?>

        </tbody>
    </table>
</div>

<?php include "../includes/footer.php"; ?>