<?php include 'header.php'; ?>

<form action="" method="POST">
    Masukkan Nilai : <input type="number" name="nilai" />
    <input type="submit" name="ok" value="Submit" />
</form>

<?php
    if(isset($_POST["ok"]))
    {
        $nilai = $_POST["nilai"];

        if($nilai >= 85 && $nilai <= 100)
            echo "Nilai $nilai = <b>A</b>";
        elseif($nilai >= 70 && $nilai <= 84)
            echo "Nilai $nilai = <b>B</b>";
        elseif($nilai >= 60 && $nilai < 70)
            echo "Nilai $nilai = <b>C</b>";
        elseif($nilai >= 50 && $nilai < 60)
            echo "Nilai $nilai = <b>D</b>";
        elseif($nilai < 50 && $nilai >= 0)
            echo "Nilai $nilai = <b>E</b>";
        else
            echo "INPUT TIDAK VALID";
    }
?>

<?php include 'footer.php'; ?>
