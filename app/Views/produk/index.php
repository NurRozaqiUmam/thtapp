<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h5 mb-4 text-gray-800"><?= $title; ?></h1>

<!-- Section for Search and Filter -->
<div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Search Input -->
        <div class="form-group w-25">
            <!-- <button class="btn" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button> -->
            <input type="text" class="form-control" placeholder="Cari barang" id="searchInput">
        </div>

        <!-- Dropdown Filter -->
        <div class="filter-group">
            <select class="form-control w-30" placeholder="Semua" id="filterKategori">
                <option value="semua">Semua</option>
                <option value="kategori1">ALat Olahraga</option>
                <option value="kategori2">Alat Musik</option>
                <!-- Add other options as needed -->
            </select>
        </div>

        <!-- Buttons for Export and Add Product -->
        <div>
            <a href="#" class="btn btn-success btn-sm mr-2">Export Excel</a>
            <a href="/produk/create" class="btn btn-danger btn-sm">Tambah Produk</a>
        </div>
    </div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Nama Produk</th>
            <th>Kategori Produk</th>
            <th>Harga Beli (Rp)</th>
            <th>Harga Jual (Rp)</th>
            <th>Stok Produk</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($produk as $item): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><img src="../assets/images/<?= $item['image']; ?>" width="30"></td>
            <td><?= $item['nama_produk']; ?></td>
            <td><?= $item['kategori_produk']; ?></td>
            <td><?= number_format($item['harga_beli'], 0, ',', '.'); ?></td>
            <td><?= number_format($item['harga_jual'], 0, ',', '.'); ?></td>
            <td><?= $item['stok_produk']; ?></td>
            <td>
            <a href="/produk/edit/<?= $item['id']; ?>" class="btn">
                <img src="../assets/images/edit.png" alt="Edit">
            </a>
            <a href="/produk/delete/<?= $item['id']; ?>" class="btn" onclick="return confirm('Yakin hapus data ini?')">
                <img src="../assets/images/delete.png" alt="Hapus">
            </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Show Item Info -->
<div class="d-flex justify-content-between align-items-center">
    <div>
        <span>Show <?= $currentPage; ?> from <?= $totalItems; ?></span>
    </div>

    <!-- Pagination -->
 <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- End of Pagination -->

</div>


</div>
<!-- End of Main Content -->