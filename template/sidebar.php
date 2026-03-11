<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="#" class="brand-link">

<span class="brand-text font-weight-light">
E-Sewa
</span>

</a>

<div class="sidebar">

<nav>

<ul class="nav nav-pills nav-sidebar flex-column">

<li class="nav-item">
<a href="../dashboard/dashboard.php" class="nav-link">
<i class="nav-icon fas fa-chart-bar"></i>
<p>Dashboard</p>
</a>
</li>

<?php if($_SESSION['role']=='superadmin'){ ?>

<li class="nav-item">
<a href="../superadmin/user.php" class="nav-link">
<i class="nav-icon fas fa-users"></i>
<p>User</p>
</a>
</li>

<li class="nav-item">
<a href="../superadmin/gedung.php" class="nav-link">
<i class="nav-icon fas fa-building"></i>
<p>Gedung</p>
</a>
</li>

<?php } ?>

<?php if($_SESSION['role']=='validator'){ ?>

<li class="nav-item">
<a href="../validator/validasi_sewa.php" class="nav-link">
<i class="nav-icon fas fa-check"></i>
<p>Validasi Sewa</p>
</a>
</li>

<?php } ?>

<?php if($_SESSION['role']=='kecamatan'){ ?>

<li class="nav-item">
<a href="../kecamatan/gedung.php" class="nav-link">
<i class="nav-icon fas fa-building"></i>
<p>Gedung</p>
</a>
</li>

<li class="nav-item">
<a href="../kecamatan/sewa.php" class="nav-link">
<i class="nav-icon fas fa-file"></i>
<p>Data Sewa</p>
</a>
</li>

<?php } ?>

</ul>

</nav>

</div>

</aside>