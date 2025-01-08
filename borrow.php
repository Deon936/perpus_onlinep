<?php
include 'includes/db.php';
include 'includes/header.php';

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']); // Menghindari injeksi SQL dengan casting
    $sql = "SELECT * FROM buku WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if (!$book) {
        echo "Buku tidak ditemukan!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validasi input pengguna
        $peminjam = htmlspecialchars(trim($_POST['peminjam']));
        $tgl_kembali = $_POST['tgl_kembali'];
        $lama_pinjam = intval($_POST['lama_pinjam']);
        $keterangan = htmlspecialchars(trim($_POST['keterangan']));
        $tgl_pinjam = date('Y-m-d');

        // Validasi tanggal kembali
        if (strtotime($tgl_kembali) < strtotime($tgl_pinjam)) {
            echo "Tanggal kembali tidak boleh sebelum tanggal pinjam!";
        } else {
            // Query untuk menyimpan data peminjaman
            $insert_sql = "INSERT INTO peminjaman (judul_buku, peminjam, tgl_pinjam, tgl_kembali, lama_pinjam, keterangan) 
                           VALUES (?, ?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param(
                "ssssss",
                $book['judul_buku'],
                $peminjam,
                $tgl_pinjam,
                $tgl_kembali,
                $lama_pinjam,
                $keterangan
            );

            if ($insert_stmt->execute()) {
                echo "Buku berhasil dipinjam!";
                // Update status buku menjadi 'Dipinjam'
                $update_sql = "UPDATE buku SET status = 'Dipinjam' WHERE id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("i", $book_id);
                $update_stmt->execute();
            } else {
                echo "Terjadi kesalahan: " . $conn->error;
            }
        }
    }
} else {
    echo "Buku tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
    <link rel="stylesheet" href="css/br.css"> <!-- Link to the CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="images/logosman.jpg" alt="Logo">
            </div>
            <a href="index.php"><i class="fas fa-home"></i> Rumah</a>
            <a href="borrow.php"><i class="fas fa-book"></i> Pinjam Buku</a>
            <a href="login.php"><i class="fas fa-user-shield"></i> Admin</a>
            <div class="bottom">
                <p>Admin Panel</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h2>Pinjam Buku</h2>
            <h3><?php echo htmlspecialchars($book['judul_buku']); ?></h3>
            <form method="POST">
                <label for="peminjam">Nama Peminjam:</label>
                <input type="text" id="peminjam" name="peminjam" required><br>

                <label for="tgl_kembali">Tanggal Kembali:</label>
                <input type="date" id="tgl_kembali" name="tgl_kembali" required><br>

                <label for="lama_pinjam">Lama Pinjam (hari):</label>
                <input type="number" id="lama_pinjam" name="lama_pinjam" required><br>

                <label for="keterangan">Keterangan:</label>
                <input type="text" id="keterangan" name="keterangan"><br>

                <input type="submit" value="Pinjam Buku">
            </form>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
