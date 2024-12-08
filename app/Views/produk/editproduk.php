<!-- Begin Page Content -->
<div class="container-fluid">
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php elseif (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
    <!-- Page Heading -->
    <h1 class="h5 mb-4 text-gray-800">Edit Produk</h1>

    <!-- Formulir Tambah Produk -->
    <form action="<?= base_url('/produk/update/' . $produk['id']); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan nama produk" value="<?= $produk['nama_produk']; ?>" required>
        </div>

        <div class="form-group">
            <label for="kategori_produk">Kategori Produk</label>
            <select class="form-control" id="kategori_produk" name="kategori_produk" required>
                <option value="" disabled selected>Pilih kategori</option>
                <option value="Alat Olahraga">Alat Olahraga</option>
                <option value="Alat Musik">Alat Musik</option>
                <!-- Tambahkan opsi lain sesuai kebutuhan -->
            </select>
        </div>

        <div class="form-group">
            <label for="harga_beli">Harga Beli (Rp)</label>
            <input type="number" class="form-control" id="harga_beli" name="harga_beli" placeholder="Masukkan harga beli" value="<?= $produk['nama_produk']; ?> required>
        </div>

        <div class="form-group">
            <label for="harga_jual">Harga Jual (Rp)</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukkan harga jual" required>
        </div>

        <div class="form-group">
            <label for="stok_produk">Stok Produk</label>
            <input type="number" class="form-control" id="stok_produk" name="stok_produk" placeholder="Masukkan jumlah stok" required>
        </div>

        <div class="form-group">
            <label for="image">Gambar Produk</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-success">Tambah Produk</button>
    </form>
</div>
<!-- End of Main Content -->
