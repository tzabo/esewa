<?php
session_start();
include "../includes/header.php";
?>

<body>
    <!-- <script src="../assets/custom/js/initTheme.js"></script> -->
    <div id="auth">
        <div class="row h-50">
            <div class="col-lg-7 col-12">
                <div id="auth-right" style="padding-top: 50px;">
                    
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div id="auth-left" style="padding-top: 50px;">
                    <div class="text-center">
                        <img src="../assets/custom/img/svg/PemkotSby.png" alt="Logo" style="width: 100px; height: auto;"></a>
                    </div>
                    <h1 class="text-center mt-3" style="font-size:5rem; margin-bottom:1rem;"><b>S I G A P</b></h1>
                    <p class="mb-4 fs-5 text-center">Sistem Informasi Gedung dan Prasarana</p>

                    <form method="POST" action="proses_login.php">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="username" class="form-control form-control-xl" placeholder="Nama Pengguna">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Kata Sandi">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Ingat Saya
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4"><b>MASUK</b></button>
                    </form>
                    <div class="text-center mt-4">
                        <p><a class="font-bold" href="auth-forgot-password.html">Lupa Kata Sandi ?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>