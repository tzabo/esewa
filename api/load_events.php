<?php

include "../config/database.php";

$query = mysqli_query($conn,"SELECT * FROM booking");

$data = array();

while($row = mysqli_fetch_assoc($query)){

$data[] = array(

"title" => $row['nama_gedung']." - ".$row['keperluan'],

"start" => $row['tanggal'],

"extendedProps" => array(

"waktu" => $row['info_sesi'],
"gedung" => $row['nama_gedung'],
"kegiatan" => $row['keperluan']

)

);

}

echo json_encode($data);

?>