<?php

include "../config/database.php";
include "../includes/header.php";
include "../includes/navbar.php";

$query = mysqli_query($conn,"SELECT * FROM gedung");

?>

<div class="container mt-5">
    <h2>Daftar Gedung</h2>
    <div class="row">

        <?php while($g = mysqli_fetch_assoc($query)) { ?>

        <div class="col-md-4">
            <div class="card mb-4">
                <img src="../<?php echo $g['gambar'] ?>" class="card-img-top">
                <div class="card-body">
                    <table class="table table-striped table-borderless">
                        <tr>
                            <h4 class="text-center"><b><?php echo $g['nama_gedung'] ?></b></h4>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><b>
                                <?php 
                                    echo $g['alamat'];

                                    if(!empty($g['kelurahan'])){
                                        echo '<br>Kel. ' . $g['kelurahan'];
                                    }

                                    if(!empty($g['kecamatan'])){
                                        echo '<br>Kec. ' . $g['kecamatan'];
                                    }
                                ?>
                                </b> 
                            </td>
                        </tr>
                        <tr>
                            <td>Luas Bangunan</td>
                            <td>:</td>
                            <td>
                                <b><?php echo $g['luas'] ?> m<sup>2</sup></b>
                            </td>
                        </tr>
                        <tr>
                            <td>Kapasitas</td>
                            <td>:</td>
                            <td>
                                <b>± <?php echo $g['kapasitas'] ?> orang</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Fasilitas</td>
                            <td>:</td>
                            <td>
                                <b><?php echo $g['fasilitas'] ?><br></b>
                            </td>
                        </tr>
                        <tr>
                            <td>Tarif Per Sesi</td>
                            <td>:</td>
                            <td>
                                <b>Rp. <?php echo number_format($g['harga_persesi'], 0, ',', '.');?></b></b>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    <?php } ?>

    </div>
</div>

<?php include "../includes/footer.php"; ?>