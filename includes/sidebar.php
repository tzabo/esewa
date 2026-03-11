<div class="col-md-2 bg-dark text-white vh-100">

<h4 class="p-3">E-Sewa</h4>

<ul class="nav flex-column">

<li class="nav-item">
<a class="nav-link text-white" href="../dashboard/dashboard.php">Dashboard</a>
</li>

<?php if($_SESSION['role']=='superadmin'){ ?>

<li>
<a class="nav-link text-white" href="../superadmin/user.php">User</a>
</li>

<li>
<a class="nav-link text-white" href="../superadmin/gedung.php">Gedung</a>
</li>

<?php } ?>

<?php if($_SESSION['role']=='validator'){ ?>

<li>
<a class="nav-link text-white" href="../validator/validasi_sewa.php">Validasi Sewa</a>
</li>

<?php } ?>

<?php if($_SESSION['role']=='kecamatan'){ ?>

<li>
<a class="nav-link text-white" href="../kecamatan/gedung.php">Gedung</a>
</li>

<li>
<a class="nav-link text-white" href="../kecamatan/sewa.php">Data Sewa</a>
</li>

<?php } ?>

<li>

<a class="nav-link text-danger" href="../auth/logout.php">

Logout

</a>

</li>

</ul>

</div>