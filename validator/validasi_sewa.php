<?php
include "../config/database.php";
include "../config/auth.php";

if($_SESSION['role'] != 'validator'){
echo "Akses ditolak";
exit;
}

$data = mysqli_query($conn,"SELECT * FROM sewa");
?>

<h3>Validasi Sewa</h3>

<table class="table">

<tr>

<th>No</th>
<th>Penyewa</th>
<th>Status</th>
<th>Aksi</th>

</tr>

<?php
$no=1;
while($d=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $no++ ?></td>
<td><?= $d['nama_penyewa'] ?></td>
<td><?= $d['status'] ?></td>

<td>

<a class="btn btn-success btn-sm">Setujui</a>

<a class="btn btn-danger btn-sm">Tolak</a>

</td>

</tr>

<?php } ?>

</table>