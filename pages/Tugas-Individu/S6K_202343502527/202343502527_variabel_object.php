<?php include 'header.php'; ?>
<h2>Variabel Object</h2>
<?php
    class Mahasiswa {
        public $nama;
        public $kelas;

        function __construct($nama, $kelas) {
            $this->nama = $nama;
            $this->kelas = $kelas;
        }
    }

    $orang = new Mahasiswa("Yusma Maulana", "S6K");
    echo "Nama: " . $orang->nama . "<br/>";
    echo "Kelas: " . $orang->kelas . "<br/>";
?>
<?php include 'footer.php'; ?>
