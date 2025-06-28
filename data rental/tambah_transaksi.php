<?php session_start();
if (
    empty($_SESSION['username_danur']) and
    empty($_SESSION['password_danur'])
) {
    echo "<script>alert('Anda tidakmemiliki akses'); window.location = ../'login.php'</script>";
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Data Rental</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <div class="container mt-4">
            <div class="card border-success">
                <div class="card-header text-white bg-success">Tambah Data Rental</div>
                <div class="col-md-12 mb-4">
                    <?php include "../menu.php"; ?>
                </div>
                <div class="card-body">
                    <form method="POST" action="insert_transaksi.php">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_trx_danur" class="form-label">No TRX:</label>
                                    <input type="text" name="no_trx_danur" class="form-control" id="no_trx_danur"
                                        value="<?php echo 'TRX_' . date('YmdHis'); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nik_ktp_danur" class="form-label">Pelanggan:</label>
                                    <select name="nik_ktp_danur" class="form-control" id="nik_ktp_danur" required>
                                        <option value="">-- Pilih Pelanggan --</option>
                                        <?php
                                        include "../config/koneksi.php";
                                        $tampil_pelanggan = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan_danur");
                                        while ($data = mysqli_fetch_array($tampil_pelanggan)) {
                                            $value = $data['nik_ktp_danur'] . ' - ' . $data['nama_pelanggan_danur'];
                                            echo "<option value='$value'>$value</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="no_plat_danur" class="form-label">Mobil:</label>
                                    <select name="no_plat_danur" class="form-control" id="no_plat_danur" required>
                                        <option value="">-- Pilih Mobil --</option>
                                        <?php
                                        $tampil_mobil = mysqli_query($koneksi, "SELECT * FROM tb_mobil_danur");
                                        while ($data = mysqli_fetch_array($tampil_mobil)) {
                                            echo "<option value='$data[no_plat_danur]'>$data[no_plat_danur] - $data[nama_mobil_danur]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tgl_rental_danur" class="form-label">Tanggal Ambil:</label>
                                    <input type="date" name="tgl_rental_danur" class="form-control" id="tgl_rental_danur"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_rental_danur" class="form-label">Jam Ambil:</label>
                                    <input type="time" name="jam_rental_danur" class="form-control" id="jam_rental_danur"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga_danur" class="form-label">Harga Rental (per hari):</label>
                                    <input type="number" name="harga_danur" class="form-control" id="harga_danur"
                                        placeholder="Masukkan Harga Rental" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lama_danur" class="form-label">Lama Rental (hari):</label>
                                    <input type="number" name="lama_danur" class="form-control" id="lama_danur"
                                        placeholder="Masukkan Lama Rental" required>
                                </div>
                                <div class="mb-3">
                                    <label for="total_bayar_danur" class="form-label">Total Bayar:</label>
                                    <input type="text" name="total_bayar_danur" class="form-control" id="total_bayar_danur"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="tampil_transaksi.php" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const lamaRental = document.getElementById('lama_danur');
            const hargaRental = document.getElementById('harga_danur');
            const totalBayar = document.getElementById('total_bayar_danur');

            lamaRental.addEventListener('input', hitungTotal);
            hargaRental.addEventListener('input', hitungTotal);

            function hitungTotal() {
                const lama = parseInt(lamaRental.value) || 0;
                const harga = parseInt(hargaRental.value) || 0;
                totalBayar.value = lama * harga;
            }
        </script>
    </body>

    </html>
    <?php
}
?>