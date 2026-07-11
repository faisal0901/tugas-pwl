<?php include 'header.php'; ?>
<h2>Biodata Mahasiswa</h2>
<?php
    $biodata = [
        'Nama' => 'Nadilla Mulyani',
        'NPM' => '202343502430',
        'Kelas' => 'S6K',
        'Jurusan' => 'Teknik Informatika',
        'Fakultas' => 'Fakultas Teknik Ilmu Komputer',
        'Universitas' => 'Universitas Indraprasta PGRI',
    ];
?>
<table>
    <?php foreach ($biodata as $key => $value): ?>
    <tr>
        <td style="font-weight:700; width:160px; padding:6px 0;"><?= $key ?></td>
        <td style="padding:6px 0;">: <?= $value ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'footer.php'; ?>
