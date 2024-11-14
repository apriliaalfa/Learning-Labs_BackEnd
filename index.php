<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kegiatan</title>
    <style> 
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc;
            justify-content: center;
        }

        table {
            margin: 20px 0;
            background-color: #e3d5b0;
        }

        th {
            background-color: #cfe0cc;
            color: #333;
            font-weight: bold;
        }

        </style> 
</head>
<body>
    <h2>Daftar Kegiatan</h2>

    <h2>Tambah Kgiatan Baru</h2>
    <form action="" method="POST">
        <label for="Nama_Kegiatan">Nama Kegiatan:</label><br>
        <input type="text" name="Nama_Kegiatan" required><br>

        <label for="Status_Kegiatan">Status_Kegiatan:</label><br>
        <input type="text" name="Status_Kegiatan" required><br>

        <label for="Deadline">Deadline:</label><br>
        <input type="datetime-local" name="Deadline"><br><br>

        <input type="submit" name="submit" value="Tambah Kegiatan">
    </form>

    <table>
        <tr>
            <th>Nomor</th>
            <th>Nama Kegiatan</th>
            <th>Waktu Dibuat</th>
            <th>Status Kegiatan</th>
            <th>Deadline</th>
            <th>Aksi</th>
        </tr>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "todolist";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal:(: " . $conn->connect_error);
        }

        
    if (isset($_POST['submit'])) {
        $Nama_Kegiatan = $_POST['Nama_Kegiatan'];
        $Status_Kegiatan = $_POST['Status_Kegiatan'];
        $Deadline = $_POST['Deadline'];

        $sql = "INSERT INTO task (Nama_Kegiatan, Status_Kegiatan, Deadline) VALUES ('$Nama_Kegiatan', '$Status_Kegiatan', '$Deadline')";

    if ($conn->query($sql) === TRUE) {
        echo "Kegiatan berhasil ditambahkan!";
        } else {
        echo "Ada kesalahan: " . $conn->error;
    }
}

        $sql = "SELECT * FROM task";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" . $row['Nomor'] . "</td>";
                echo "<td>" . $row['Nama_Kegiatan'] . "</td>";
                echo "<td>" . date("Y-m-d H:i:s", strtotime($row['Waktu_dan_Tanggal_dibuat'])). "</td>";
                echo "<td>" . $row['Status_Kegiatan'] . "</td>";
                echo "<td>" . $row['Deadline'] . "</td>";
                echo "<td><a href='edit-kegiatan.php?id=" . $row['Nomor'] . "'>Edit</a> | <a href='hapus_kegiatan.php?id=" . $row['Nomor'] . "' onclick=\"return confirm('hapus?');\">Hapus</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada kegiatan yang ditemukan.</td></tr>";
        }

        $conn->close();
        ?>
    </table>   
</body>
</html>