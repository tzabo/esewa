<?php

include "../config/auth.php";

if($_SESSION['role'] != 'superadmin'){
echo "Akses ditolak";
exit;
}

?>