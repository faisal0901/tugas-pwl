<?php include 'header.php'; ?>

<style>
    .biodata-container { padding: 4px 0; }
    .profile-section { text-align: center; margin-bottom: 16px; }
    .profile-photo {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: #3a5a8a;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6em;
        font-weight: bold;
        margin: 0 auto 8px;
    }
    .biodata-table { width: 100%; border-collapse: collapse; }
    .biodata-table td { padding: 6px 10px; border-bottom: 1px solid #eee; }
    .biodata-table .label { width: 140px; font-weight: bold; }
</style>

<?php
    $biodata = [
        'Nama' => 'Muchammad Faisal',
        'NPM' => '202343502487',
        'Kelas' => 'S6K',
        'Jurusan' => 'Teknik Informatika',
        'Fakultas' => 'Fakultas Teknik Ilmu Komputer',
        'Universitas' => 'Universitas Indraprasta PGRI',
        'Email' => 'muhfaisalll150402@gmail.com',
    ];
?>
<div class="biodata-container">
    <div class="profile-section">
        <div class="profile-photo">MF</div>
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
