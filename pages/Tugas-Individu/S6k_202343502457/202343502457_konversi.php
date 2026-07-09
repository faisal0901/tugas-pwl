<html>
    <body>
        <form method="POST">
            input angka : <input type="text" name="angka"/>
            <input type="submit" name="konversi"/>
 </form>
        <?php include 'header.php'; ?>
            <?php
            if(isset($_POST['konversi'])) {
                $angka = is_numeric($_POST['angka']) ? intval($_POST['angka']) : -1;
                
                if($angka >=80 && $angka <=100) {
                    echo "Nilai A";
                } else if($angka >=60 && $angka <84) {
                    echo "Nilai B";
                } else if($angka >=30 && $angka <60) {
                    echo "Nilai C";
                } else if($angka >=20 && $angka <30) {
                    echo "Nilai D";
                } else if($angka >=0 && $angka <50) {
                    echo "Nilai E";
                } else {
                    echo "Angka tidak valid. Masukkan angka antara 0-100";
                }
            } else {
                echo "Silakan input angka untuk konversi nilai";
            }
        ?>
    <?php include 'footer.php'; ?>  
    </body>
</html>