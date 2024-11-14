<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM task WHERE Nomor = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Data tidak ada";
        exit;
    }
}

if (isset($_POST['submit'])) {
    $Nama_Kegiatan = $_POST['Nama_Kegiatan'];
    $Status_Kegiatan = $_POST['Status_Kegiatan'];
    $Deadline = $_POST['Deadline'];

    $sql = "UPDATE task SET Nama_Kegiatan= '$Nama_Kegiatan', Status_Kegiatan='$Status_Kegiatan', Deadline= '$Deadline' WHERE Nomor=$id";

    if ($conn->query($sql)===TRUE){
        echo "Kegiatan berhasil di update!";
        header("Location: index.php");
        exit;
    } else {
        echo "Ada Kesalahan: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan</title>
</head>
<body>
    <h2>Edit Kegiatan</h2>

    <form action="" method="POST">
        <label for="Nama_Kegiatan">Nama Kegiatan:</label><br>
        <input type="text" name="Nama_Kegiatan" value="<?php echo $row['Nama_Kegiatan']; ?>"required><br>

        <label for="Status_Kegiatan">Status_Kegiatan:</label><br>
        <input type="text" name="Status_Kegiatan" value="<?php echo $row['Status_Kegiatan']; ?>" required><br>

        <label for="Deadline">Deadline:</label><br>
        <input type="datetime-local" name="Deadline" value="<?php echo date('Y-m-d\TH:i', strtotime($row['Deadline'])); ?>"><br><br>
        <input type="submit" name="submit" value="Update Kegiatan">
    </form>
</body>
</html>
