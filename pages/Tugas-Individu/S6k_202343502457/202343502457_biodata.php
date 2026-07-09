<?php include 'header.php'; ?>
<?php
    // Biodata Mahasiswa
    $biodata = [
        'Nama' => 'Simson Resky',
        'NPM' => '202343502457',
        'Kelas' => 'S6K',
        'Jurusan' => 'Teknik Informatika',
        'Fakultas' => 'Fakultas Teknik Ilmu Komputer',
        'Universitas' => 'Universitas Indraprasta PGRI',
        'Alamat' => 'Jl. jalanan No. 11, Jakarta',
        'Email' => 'simson.resky@student.uniskal.ac.id',
        'No. HP' => '08xxxxxxxxxx'
    ];
?>
<div class="biodata-container">
    <div class="profile-section">
        <img src="foto.jpeg" alt="Foto Profil" class="profile-photo">
        <h2>Biodata Mahasiswa</h2>
    </div>
    
    <table class="biodata-table">
        <?php foreach ($biodata as $key => $value): ?>
        <tr>
            <td class="label"><?= $key ?></td>
            <td class="value"><?= $value ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php include 'footer.php'; ?>