<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 01</title>
</head>
<body>
    <h2>Form  Ujian </h2>
    <form method="POST" action="">
        <label>Nama :</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Email :</label><br>
        <input type="email" name="email" required><br><br>

        <label>Nilai Ujian :</label><br>
        <input type="number" name="nilai" required><br><br>

        <input type="submit" value="Kirim">
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama  = htmlspecialchars($_POST['nama']);
        $email = htmlspecialchars($_POST['email']);
        $nilai = (int) $_POST['nilai'];

        echo "<h3>Hasil Penilaian</h3>";
        echo "Nama: $nama <br>";
        echo "Email: $email <br>";
        echo "Nilai Ujian: $nilai <br>";

        if ($nilai > 70) {
            echo "Selamat anda lulus";
        } else {
            echo "Anda harus remedial";
        }
    }
    ?>

</body>
</html>