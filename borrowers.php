<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'includes/db.php';
include 'includes/header.php';

$query = "SELECT * FROM peminjaman";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data - Peminjam</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Pastikan file CSS ada -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
 <!-- Sidebar -->
 <div class="sidebar">
    <div class="logo">
        <img src="images/logosman.jpg" alt="Logo" posix_getlogin>
    </div>
    <ul>
        <a href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="books.php"><i class="fas fa-book"></i> Master Data - Buku</a>
        <a href="borrowers.php"><i class="fas fa-users"></i> Master Data - Peminjam</a>
        <a href="add_book.php"><i class="fas fa-book"></i> Tambah Buku</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
    </ul>
</div>

<div class="container">
    <h1>Daftar Peminjam</h1>

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Buku</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['judul_buku']; ?></td>
                        <td><?php echo $row['peminjam']; ?></td>
                        <td><?php echo $row['tgl_pinjam']; ?></td>
                        <td><?php echo $row['tgl_kembali']; ?></td>
                        <td>
                            <a href="edit_book.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="delete_borrower.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Tidak ada data peminjaman.</p>
    <?php } ?>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
