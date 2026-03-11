<?php

include "../config/auth.php";

if($_SESSION['role'] != 'kecamatan'){
echo "Akses ditolak";
exit;
}

?>