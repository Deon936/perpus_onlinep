<?php
include 'includes/db.php';
include 'includes/header.php';

// Query to fetch books from the database
$sql = "SELECT * FROM buku";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPMN 1 Plered - Online Library</title>
    <link rel="stylesheet" href="css/style.css"> 
    <link rel="stylesheet" href="css/br.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"><!-- Link to the CSS file -->
</head>
<body>
    <div class="container">
        <!-- Sidebar for navigation -->
         <!-- Sidebar -->
         <div class="sidebar">
    <!-- Logo -->
    <div class="logo">
        <img src="images/logosman.jpg" alt="Logo">
    </div>
    <!-- Sidebar Links -->
    <a href="about.php">
        <i class="fas fa-home"></i> home
    </a>
    <a href="index.php">
        <i class="fas fa-book"></i> Pinjam Buku
    </a>
    <a href="login.php">
        <i class="fas fa-user-shield"></i> Admin
    </a>

    <!-- Optional Footer or extra info -->
    <div class="bottom">
        <p>Admin Panel</p>
    </div>
</div>
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
                            <a href="index.php">pinjam</a>
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
</body>
</html>
