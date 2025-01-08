<?php
// Include koneksi database
include 'includes/db.php';

// Periksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $judul_buku = $conn->real_escape_string(trim($_POST['judul_buku']));
    $nama_pengarang = $conn->real_escape_string(trim($_POST['nama_pengarang']));
    $status = $conn->real_escape_string(trim($_POST['status']));

    // Validasi data
    if (empty($judul_buku) || empty($nama_pengarang) || empty($status)) {
        echo "Semua kolom harus diisi!";
    } elseif (!in_array($status, ['Tersedia', 'Dipinjam', 'Dipesan'])) {
        echo "Status tidak valid!";
    } else {
        // Query untuk menyisipkan data ke tabel buku
        $sql = "INSERT INTO buku (judul_buku, nama_pengarang, status) 
                VALUES ('$judul_buku', '$nama_pengarang', '$status')";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            echo "Data buku berhasil ditambahkan.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Tutup koneksi
$conn->close();
?>
