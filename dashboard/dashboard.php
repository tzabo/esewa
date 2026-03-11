<?php

include "../config/auth.php";
include "../config/database.php";

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-lg-3 col-6">

<div class="small-box bg-info">

<div class="inner">
<h3>10</h3>
<p>Total Gedung</p>
</div>

<div class="icon">
<i class="fas fa-building"></i>
</div>

</div>

</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-success">

<div class="inner">
<h3>25</h3>
<p>Total Sewa</p>
</div>

<div class="icon">
<i class="fas fa-file"></i>
</div>

</div>

</div>

</div>

<div class="card">

<div class="card-header">

<h3 class="card-title">
Statistik Sewa
</h3>

</div>

<div class="card-body">

<canvas id="chartSewa"></canvas>

</div>

</div>

</div>

</section>

</div>