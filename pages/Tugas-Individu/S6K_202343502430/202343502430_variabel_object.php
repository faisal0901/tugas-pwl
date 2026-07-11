<?php include 'header.php'; ?>
<h2>Variabel Object</h2>
<?php
    class Desainer {
        public $nama;
        public $keahlian;

        function __construct($nama, $keahlian) {
            $this->nama = $nama;
            $this->keahlian = $keahlian;
        }
    }

    $orang = new Desainer("Nadilla Mulyani", "UI/UX Design");
    echo "Nama: " . $orang->nama . "<br/>";
    echo "Keahlian: " . $orang->keahlian . "<br/>";
?>
<?php include 'footer.php'; ?>
