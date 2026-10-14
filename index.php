<?php 
include "koneksi.php";

$nama = "";
$fasilitas = "";
$lokasi = "";
$id_kategori = 0;
$deskripsi = "";
$prioritas = "";

if (isset($_POST['submit'])) {
    if (isset($_POST['nama_pelapor']) && isset($_POST['nama_fasilitas']) && isset($_POST['lokasi']) && isset($_POST['id_kategori']) && isset($_POST['deskripsi']) && isset($_POST['prioritas'])) {
    $nama = $_POST['nama_pelapor'];
    $fasilitas = $_POST['nama_fasilitas'];
    $lokasi = $_POST['lokasi'];
    $id_kategori = $_POST['id_kategori'];
    $deskripsi = $_POST['deskripsi'];
    $prioritas = $_POST['prioritas'];

    mysqli_query($conn, "INSERT INTO laporan_kerusakan (nama_pelapor, nama_fasilitas, lokasi, id_kategori, deskripsi, prioritas)
    VALUES ('$nama', '$fasilitas', '$lokasi', $id_kategori, '$deskripsi', '$prioritas');");
}
}


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan Kerusakan Fasilitas Sekolah</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- TANTANGAN UI/UX: Tambahkan styling CSS, Bootstrap, atau Tailwind sendiri. -->
</head>
<body>
    <!-- Bagian ini merupakan starter HTML. Belum ada koneksi database ataupun query. -->
    <header class="flex flex-row justify-between p-6 items-center text-white">
        <div id="awalan" aria-label="Judul dan Subjudul" class="flex flex-col">
            <h1 class="text-2xl font-bold">Sistem Pelaporan Kerusakan Fasilitas Sekolah</h1>
            <p class="text-xl">Catat dan pantau laporan kerusakan fasilitas sekolah.</p>
        </div>
        <nav aria-label="Navigasi utama" class="flex flex-row gap-10">
            <a href="#form-laporan">Buat Laporan</a>
            <a href="#daftar-laporan">Daftar Laporan</a>
        </nav>
    </header>

    <main class="p-6 bg-white rounded-xl">
        <section id="form-laporan" aria-labelledby="judul-form">
            <h2 id="judul-form" class="text-3xl font-semibold">Form Pelaporan Kerusakan</h2>
            <p class="mb-12">Lengkapi data berikut untuk melaporkan fasilitas yang rusak.</p>

            <!-- TANTANGAN BONUS CREATE: Buat proses PHP agar POST menyimpan data. -->
            <form action="index.php" method="post">
                <fieldset>
                    <legend class="font-semibold">Data Pelaporan</legend>

                    <p>
                        <label for="nama_pelapor">Nama pelapor :</label>
                        <br>
                        <input type="text" id="nama_pelapor" name="nama_pelapor" maxlength="100" required class="border rounded p-1">
                    </p>

                    <p>
                        <label for="nama_fasilitas">Nama fasilitas :</label>
                        <br>
                        <input type="text" id="nama_fasilitas" name="nama_fasilitas" maxlength="100" required class="border rounded p-1">
                    </p>

                    <p>
                        <label for="lokasi">Lokasi kerusakan :</label>
                        <br>
                        <input type="text" id="lokasi" name="lokasi" maxlength="100" required class="border rounded p-1">
                    </p>

                    <p>
                        <label for="id_kategori">Kategori fasilitas :</label>
                        <br>
                        <select id="id_kategori" name="id_kategori" required class="border rounded p-1">
                            <option value="" selected disabled>-- Pilih kategori --</option>
                            <!-- Nilai berikut sesuai dengan data awal kategori_fasilitas. -->
                            <option value="1">Elektronik</option>
                            <option value="2">Furnitur</option>
                            <option value="3">Jaringan</option>
                            <option value="4">Peralatan Kelas</option>
                        </select>
                    </p>

                    <p>
                        <label for="deskripsi">Deskripsi kerusakan : </label>
                        <br>
                        <textarea id="deskripsi" name="deskripsi" rows="4" required class="border rounded p-1"></textarea>
                    </p>

                    <p>
                        <label for="prioritas" >Prioritas</label>
                        <br>
                        <select id="prioritas" name="prioritas" required class="border rounded p-1">
                            <option value="" selected disabled>-- Pilih prioritas --</option>
                            <option value="Rendah">Rendah</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </p>

                    <p><button type="submit" class="rounded-xl p-3 mt-5 bg-green-600 font-semibold text-white" name="submit">Kirim Laporan</button></p>
                </fieldset>
            </form>
            <p><small>Catatan: tombol Kirim Laporan belum menyimpan apa pun. Fitur Create merupakan tantangan bonus.</small></p>
        </section>

        <section id="daftar-laporan" aria-labelledby="judul-daftar" class="mt-24">
            <h2 id="judul-daftar" class="font-semibold text-3xl">Daftar Laporan Kerusakan</h2>
            <p>Seluruh laporan yang tercatat pada database ditampilkan di bagian ini.</p>

            <!-- TANTANGAN WAJIB:
                 1. Buat sendiri koneksi PHP ke MySQL.
                 2. Jalankan query SELECT untuk mengambil data dari laporan_kerusakan.
                 3. Ganti baris placeholder pada tbody dengan perulangan hasil query.
                 4. Jangan mengetik data database secara manual di HTML.
            -->
                 <?php 
                 $laporan = mysqli_query($conn, "SELECT * FROM laporan_kerusakan");
                 ?>
            <table class="border-collapse border-spacing-5 border border-black">
                <thead>
                    <tr>
                        <th scope="col" class="border border-black">No.</th>
                        <th scope="col" class="border border-black">Fasilitas</th>
                        <th scope="col" class="border border-black">Lokasi</th>
                        <th scope="col" class="border border-black">Pelapor</th>
                        <th scope="col" class="border border-black">Prioritas</th>
                        <th scope="col" class="border border-black">Status</th>
                        <th scope="col" class="border border-black">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($data = mysqli_fetch_assoc($laporan)) {
                    ?>
                    <tr>
                        <td class="border border-black"><?= $data['id_laporan'] ?></td>
                        <td class="border border-black"><?= $data['nama_fasilitas'] ?></td>
                        <td class="border border-black"><?= $data['lokasi'] ?></td>
                        <td class="border border-black"><?= $data['nama_pelapor'] ?></td>
                        <td class="border border-black"><?= $data['prioritas'] ?></td>
                        <td class="border border-black"><?= $data['status'] ?></td>
                        <td class="border border-black"><?= $data['tanggal_laporan'] ?></td>
                    </tr>
                    <?php 
                    };
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer class="mt-6 text-white p-6">
        <p>&copy; 2024 Sistem Pelaporan Kerusakan Fasilitas Sekolah.</p>
    </footer>
</body>
</html>
