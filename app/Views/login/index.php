<body class="bg">

    <div class="container">
        <div class="row">
            <!-- Form Masuk Kiri -->
            <div class="form-login">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">SIMS Web App</h1>
                            <p class="text-gray-500">Masuk atau buat akun untuk memulai</p>
                        </div>
                        <!-- Tampilkan pesan flashdata atau session jika ada -->
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error'); ?>
                            </div>
                        <?php elseif (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success'); ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo base_url('/login'); ?>" method="POST" class="user">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="masukan email anda">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="masukan password anda">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
            <!-- Gambar Kanan -->
            <div class="col-md-6 d-none d-md-block">
                <img src="../assets/images/Frame 98699.png" alt="Illustration" class="w-100">
            </div>
        </div>
    </div>

</body>
