<?php

include "../config/database.php";

if(isset($_POST['submit'])){

$nama = $_POST['nama'];
$gedung = $_POST['gedung'];
$tanggal = $_POST['tanggal'];
$keperluan = $_POST['keperluan'];

$sesi = $_POST['sesi']; // array sesi

// jumlah sesi
$jumlah_sesi = count($sesi);

// info sesi (digabung)
$info_sesi = implode("\n", $sesi);

// durasi jam
$durasi_jam = $jumlah_sesi * 2;

mysqli_query($conn,"INSERT INTO booking
VALUES(
NULL,
'$nama',
'$gedung',
'$tanggal',
'$jumlah_sesi',
'$info_sesi',
'$durasi_jam',
'$keperluan',
'Proses'
)");

echo "<script>alert('Booking berhasil');</script>";

}

?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="container mt-5">
    <div class="row">

        <!-- Kolom Kiri -->
        <div class="col-md-4">
            <div class="card-body">
                <div class="alert alert-danger">
                    <h5><b>PETUNJUK PEMESANAN</b></h5>
                    <ol style="padding-left: inherit;" align="justify">
                        <li>Penyewa mengajukan pemesanan dengan cara datang langsung ke Kecamatan pada jam kerja (07.30 - 16.00) untuk <b>mengisi formulir pernyataan dan melampirkan fotokopi KTP paling lambat 14 (empat belas) hari sebelum pelaksanaan acara</b>.</li>
                        <li>Apabila permohonan benar dan sesuai, maka <b>akan diploting jadwal penggunaan GSG dan dilanjut dengan mencetak Surat Keterangan Retribusi Daerah (SKRD)</b>.</li>
                        <li>Penyewa wajib melakukan pembayaran retribusi GSG berdasarkan cetak SKRD dan <b>konfirmasi ke petugas di Kecamatan dengan menyertakan foto bukti pembayaran paling lambat 7 (tujuh) hari sebelum waktu pelaksanaan</b>.</li>
                        <li>Apabila <b>dalam jangka 7 (tujuh) hari setelah cetak SKRD tidak segera melakukan pembayaran</b>, maka pemesanan akan langsung dibatalkan.</li>
                        <li>Kecamatan akan <b>menerbitkan surat pemakaian GSG dan menyerahkan Surat Setoran Retribusi Daerah (SSRD) kepada penyewa paling lambat 1 (satu) hari sebelum pelaksanaan acara</b>.</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-8">
            <form method="POST">
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title text-center">Formulir Pemesanan</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <label><b>NIK <span class="text-danger">*</span></b></label>
                                    <input type="text" name="nik" class="form-control" pattern="\d{16}" maxlength="16" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <label><b>Nama Pemesan <span class="text-danger">*</span></b></label>
                                    <input type="text" name="nama_pemesan" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <label><b>Alamat <span class="text-danger">*</span></b></label>
                                    <input type="text" name="alamat" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label><b>No. Telepon <span class="text-danger">*</span></b></label>
                                <input type="tel" name="no_tlp" class="form-control" pattern="\d{10,13}" maxlength="13" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <label><b>Pilih Gedung</b> <span class="text-danger">*</span></label>
                                    <select name="gedung" class="form-control">
                                        <option value="">-- Pilih Gedung --</option> <!-- pilihan default -->
                                        <?php
                                        $g = mysqli_query($conn,"SELECT * FROM gedung");
                                        while($d = mysqli_fetch_assoc($g)){
                                        ?>
                                        <option value="<?php echo $d['id'] ?>">
                                            <?php echo $d['nama_gedung'] ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label><b>Tanggal</b> <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label><b>Sesi</b> <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column">
                                            <div class="form-check form-check-primary mb-1">
                                                <input class="form-check-input" type="checkbox" name="sesi[]" value="Sesi 1 (08.00 - 10.00)" id="sesi1">
                                                <label class="form-check-label" for="sesi1">Sesi 1 (08.00 - 10.00)</label>
                                            </div>
                                            <div class="form-check form-check-primary mb-1">
                                                <input class="form-check-input" type="checkbox" name="sesi[]" value="Sesi 2 (10.00 - 12.00)" id="sesi2">
                                                <label class="form-check-label" for="sesi2">Sesi 2 (10.00 - 12.00)</label>
                                            </div>
                                            <div class="form-check form-check-primary mb-1">
                                                <input class="form-check-input" type="checkbox" name="sesi[]" value="Sesi 3 (12.00 - 14.00)" id="sesi3">
                                                <label class="form-check-label" for="sesi3">Sesi 3 (12.00 - 14.00)</label>
                                            </div>
                                            <div class="form-check form-check-primary mb-1">
                                                <input class="form-check-input" type="checkbox" name="sesi[]" value="Sesi 4 (14.00 - 16.00)" id="sesi4">
                                                <label class="form-check-label" for="sesi4">Sesi 4 (14.00 - 16.00)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column">
                                            <div class="form-check form-check-primary mb-1">
                                                <input class="form-check-input" type="checkbox" name="sesi[]" value="Sesi 5 (16.00 - 18.00)" id="sesi5">
                                                <label class="form-check-label" for="sesi5">Sesi 5 (16.00 - 18.00)</label>
                                            </div>
                                            <div class="form-check form-check-primary mb-1">
                                                <input class="form-check-input" type="checkbox" name="sesi[]" value="Sesi 6 (18.00 - 20.00)" id="sesi6">
                                                <label class="form-check-label" for="sesi6">Sesi 6 (18.00 - 20.00)</label>
                                            </div>
                                            <div class="form-check form-check-primary mb-1">
                                                <input class="form-check-input" type="checkbox" name="sesi[]" value="Sesi 7 (20.00 - 22.00)" id="sesi7">
                                                <label class="form-check-label" for="sesi7">Sesi 7 (20.00 - 22.00)</label>
                                            </div>
                                            <div class="form-check form-check-primary mb-1">
                                                <input class="form-check-input" type="checkbox" name="sesi[]" value="Sesi 7 (20.00 - 22.00)" id="sesi7">
                                                <label class="form-check-label" for="sesi8">1 (Satu) hari</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-danger fw-bold" style="font-size:10px;">Centang sesi yang diinginkan (Bisa lebih dari 1 sesi)</small>
                            </div>
                            <div class="col-sm-6">
                                <label><b>Jenis Acara</b> <span class="text-danger">*</span></label>
                                <select name="jenis_acara" id="acara" class="form-control" onchange="document.getElementById ('lainnya').style.display = this.value === 'Lainnya' ? 'block' : 'none'; if(this.value !== 'Lainnya') { document.getElementById('lainnya').value=''; }">
                                    <option value="">-- Pilih Acara --</option>
                                    <option value="Seminar">Seminar</option>
                                    <option value="Pernikahan">Pernikahan</option>
                                    <option value="Latihan Olahraga">Latihan Olahraga</option>
                                    <option value="Pentas Seni">Pentas Seni</option>
                                    <option value="Pertemuan">Pertemuan</option>
                                    <option value="Pendidikan / Budaya">Pendidikan / Budaya</option>
                                    <option value="Lomba / Kompetisi">Lomba / Kompetisi</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <!-- Input text untuk Lainnya -->
                                <input type="text" id="lainnya" name="acara_lain" class="form-control mt-3" style="display:none;">
                                <div class="mt-3">
                                    <label><b>Estimasi Orang <span class="text-danger">*</span></b></label>
                                    <input type="text" name="peserta" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <label><b>Upload Formulir <span class="text-danger">*</span></b></label>
                                    <input type="file" name="upload1" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <label><b>Upload KTP <span class="text-danger">*</span></b></label>
                                    <input type="file" name="upload2" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center"><button class="btn btn-success btn-lg" style="width:200px;" name="submit"><b>PESAN</b></button></div>
            </div>
            </form>  
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>