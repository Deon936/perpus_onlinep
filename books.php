<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'includes/db.php';
include 'includes/header.php';

$query = "SELECT * FROM buku";
$result = mysqli_query($conn, $query);
?>

<link rel="stylesheet" href="css/br.css"> <!-- Link to the CSS file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<head>
    <title>Master Data - Buku</title>
</head>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <img src="images/logosman.jpg" alt="Logo">
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
    <h2>Daftar Buku</h2>

    <?php if ($result->num_rows > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($book = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $book['id']; ?></td>
                        <td><?php echo $book['judul_buku']; ?></td>
                        <td><?php echo $book['nama_pengarang']; ?></td>
                        <td><?php echo $book['status']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $book['id']; ?>">Edit</a>
                            <a href="delete_book.php?id=<?php echo $book['id']; ?>" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Tidak ada data buku.</p>
    <?php } ?>
</div>

<?php include 'includes/footer.php'; ?>
