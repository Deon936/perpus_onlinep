<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'includes/db.php';
include 'includes/header.php';
?>

<style>
    /* Main content styling */
.main-content {
    text-align: center; /* Centering text */
    padding: 30px;
    margin-top: 50px;
}

/* Styling the heading */
.main-content h2 {
    font-size: 40px; /* Larger font size */
    color: #333;
    margin-bottom: 30px;
}

/* Logo styling */
.logo img {
    max-width: 80%; /* Larger image */
    height: auto;
    margin: 30px 0;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

/* Additional paragraph styling */
.main-content p {
    font-size: 24px; /* Larger font size */
    color: #555;
    margin-top: 20px;
}

</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to the CSS file -->
    <!-- Font Awesome CDN for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<div class="container">
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
    <div class="main-content">
        <h2>Welcome, Admin</h2>
        <div class="logo">
            <img src="images/logosman.jpg" alt="Logo">
        </div>
        <p>Here you can manage books, borrowers, and generate reports.</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
