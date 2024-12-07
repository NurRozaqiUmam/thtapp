<!-- Begin Page Content -->
<div class="container-fluid">

<div class="profile-container">
    <!-- Foto Profil -->
    <div class="profile-picture">
        <img src="../assets/images/<?= $user['foto_profil']; ?>"/>
            <i class="fa fa-pencil"></i>
    </div>

    <!-- Username -->
    <h2 class="user-name"><?= $user['username']; ?></h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Nama Kandidat -->
        <div class="form-name-group">
            <label for="nameCandidat">Nama Kandidat</label>
            <input type="text" id="nameCandidat" class="form-control" value="<?= $user['nama_kandidat']; ?>" readonly />
        </div>

        <!-- Posisi Kandidat -->
        <div class="form-position-group">
            <label for="positionCandidate">Posisi Kandidat</label>
            <input type="text" id="positionCandidate" class="form-control" value="<?= $user['posisi_kandidat']; ?>" readonly />
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->