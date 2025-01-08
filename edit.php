<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'includes/db.php';

// Periksa apakah ID buku telah diberikan
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil data buku berdasarkan ID
    $query = "SELECT * FROM buku WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Data buku tidak ditemukan!";
        exit;
    }
} else {
    echo "ID buku tidak diberikan!";
    exit;
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul_buku = $_POST['judul_buku'];
    $nama_pengarang = $_POST['nama_pengarang'];
    $status = $_POST['status'];

    // Update data buku
    $update_query = "UPDATE buku SET judul_buku = ?, nama_pengarang = ?, status = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssi", $judul_buku, $nama_pengarang, $status, $id);

    if ($update_stmt->execute()) {
        header("Location: books.php?message=success");
        exit;
    } else {
        echo "Gagal memperbarui data buku!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"> 
    <link rel="stylesheet" href="css/edit.css"> 
    <title>Edit Buku</title>
</head>
<body>


    <form action="" method="POST">
        <label for="judul_buku">Judul Buku:</label><br>
        <input type="text" name="judul_buku" id="judul_buku" value="<?php echo htmlspecialchars($book['judul_buku']); ?>" required><br><br>

        <label for="nama_pengarang">Nama Pengarang:</label><br>
        <input type="text" name="nama_pengarang" id="nama_pengarang" value="<?php echo htmlspecialchars($book['nama_pengarang']); ?>" required><br><br>

        <label for="status">Status:</label><br>
        <select name="status" id="status" required>
            <option value="Tersedia" <?php echo $book['status'] === 'Tersedia' ? 'selected' : ''; ?>>Tersedia</option>
            <option value="Dipinjam" <?php echo $book['status'] === 'Dipinjam' ? 'selected' : ''; ?>>Dipinjam</option>
            <option value="Dipesan" <?php echo $book['status'] === 'Dipesan' ? 'selected' : ''; ?>>Dipesan</option>
        </select><br><br>

        <button type="submit">Simpan Perubahan</button>
        <button href="books.php">Batal</button>
    </form>
    </div>
</body>
</html>

<?Php include 'includes/db.php'; ?>