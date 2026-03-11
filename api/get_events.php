<?php

include "../config/database.php";

$gedung = isset($_GET['gedung']) ? (int)$_GET['gedung'] : 0;

if($gedung == 0){
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
            "nama"   => $row['nama_pemesan'],
            "waktu"  => $row['info_sesi'],
            "durasi" => $row['durasi_jam']." Jam",
            "gedung" => "Gedung ".$row['gedung_id'],
            "acara"  => $row['jenis_acara']
        ]

    ];

}

header('Content-Type: application/json');
echo json_encode($events);