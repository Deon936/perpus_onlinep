<?php
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPMN 1 Plered - Online Library</title>
    <link rel="stylesheet" href="css/style.css"> 
    <link rel="stylesheet" href="css/edit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"><!-- Link to the CSS file -->
</head>
<body>
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

    <!-- Main Content -->
    <div class="container">
        <h1>Tambah Buku</h1>
        <form action="upload_book.php" method="post" enctype="multipart/form-data">
            <label for="judul_buku">Judul Buku:</label>
            <input type="text" name="judul_buku" id="judul_buku" required>

            <label for="nama_pengarang">Nama Pengarang:</label>
            <input type="text" name="nama_pengarang" id="nama_pengarang" required>

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="Tersedia">Tersedia</option>
                <option value="Dipinjam">Dipinjam</option>
                <option value="Dipesan">Dipesan</option>
            </select>

            <button type="submit">Simpan</button>
        </form>
    </div>

</body>
</html>