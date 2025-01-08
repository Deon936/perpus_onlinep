<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Menampilkan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Koneksi ke database
include 'includes/db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = intval($_GET['id']);

// Query untuk mendapatkan data peminjaman berdasarkan ID
$query = "SELECT * FROM peminjaman WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Data tidak ditemukan.");
}

$row = $result->fetch_assoc();

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul_buku = trim($_POST['judul_buku']);
    $peminjam = trim($_POST['peminjam']);
    $tgl_pinjam = trim($_POST['tgl_pinjam']);
    $tgl_kembali = trim($_POST['tgl_kembali']);

    // Validasi sederhana
    if (empty($judul_buku) || empty($peminjam) || empty($tgl_pinjam) || empty($tgl_kembali)) {
        $error_message = "Semua kolom harus diisi.";
    } else {
        // Query untuk mengupdate data peminjaman
        $update_query = "UPDATE peminjaman SET judul_buku = ?, peminjam = ?, tgl_pinjam = ?, tgl_kembali = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ssssi", $judul_buku, $peminjam, $tgl_pinjam, $tgl_kembali, $id);

        if ($update_stmt->execute()) {
            header("Location: borrowers.php"); // Redirect ke halaman daftar peminjam
            exit;
        } else {
            $error_message = "Gagal memperbarui data: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Borrower</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style.css"> 
    <link rel="stylesheet" href="css/edit.css"> 
</head>
<body>
    <div class="container">
        <h1>Edit Data Peminjam</h1>
        <?php if (isset($error_message)) { ?>
            <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
        <?php } ?>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
            
            <label for="judul_buku">Judul Buku:</label>
            <input type="text" id="judul_buku" name="judul_buku" value="<?php echo htmlspecialchars($row['judul_buku']); ?>" required>
            <br>
            
            <label for="peminjam">Nama Peminjam:</label>
            <input type="text" id="peminjam" name="peminjam" value="<?php echo htmlspecialchars($row['peminjam']); ?>" required>
            <br>
            
            <label for="tgl_pinjam">Tanggal Pinjam:</label>
            <input type="date" id="tgl_pinjam" name="tgl_pinjam" value="<?php echo htmlspecialchars($row['tgl_pinjam']); ?>" required>
            <br>
            
            <label for="tgl_kembali">Tanggal Kembali:</label>
            <input type="date" id="tgl_kembali" name="tgl_kembali" value="<?php echo htmlspecialchars($row['tgl_kembali']); ?>" required>
            <br>
            
            <button type="submit">Update</button>
            <button href="borrowers.php">Batal</button>
        </form>
    </div>
</body>
</html>
