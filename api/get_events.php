<?php

include "../config.php";

$gedung = isset($_GET['gedung']) ? $_GET['gedung'] : '';

if($gedung == ""){
    $query = mysqli_query($conn,"SELECT * FROM booking");
}else{
    $query = mysqli_query($conn,"SELECT * FROM booking WHERE gedung_id='$gedung'");
}

$events = [];

while($row = mysqli_fetch_assoc($query)){

$events[] = [

"title" => "G".$row['gedung_id']." - ".$row['jenis_acara'],

"start" => $row['tanggal'],

"extendedProps" => [
    "waktu" => $row['info_sesi'],
    "durasi" => $row['durasi_jam']." Jam",
    "gedung" => "Gedung ".$row['gedung_id'],
    "acara" => $row['jenis_acara']
]

];

}

header('Content-Type: application/json');

echo json_encode($events);