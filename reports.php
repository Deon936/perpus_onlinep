<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'includes/db.php';
include 'includes/header.php';

$query = "SELECT b.title, br.name, br.date_borrowed FROM borrow_records br JOIN books b ON br.book_id = b.id";
$result = mysqli_query($conn, $query);
?>
<head>
    <title>Laporan</title>
</head>
<div class="container">
    <h1>Laporan Peminjaman</h1>
    <table>
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['date_borrowed']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include 'includes/footer.php'; ?>
