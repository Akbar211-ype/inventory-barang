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
        <title>Edit Data Transaksi</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <?php include "../menu.php"; ?>
                </div>
            </div>
            <div class="card border-success mb-3">
                <div class="card-header">Edit Data Transaksi</div>
                <div class="card-body text-success">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="update_transaksi.php">
                                <?php
                                include "../config/koneksi.php";
                                $no_trx_danur = $_GET['no_trx_danur'];
                                $tampil = mysqli_query($koneksi, "SELECT * FROM tb_rental_danur WHERE no_trx_danur='$no_trx_danur'");
                                $data = mysqli_fetch_array($tampil);
                                ?>
                                <div class="mb-3 mt-3">
                                    <label for="no_trx_danur" class="form-label">No Transaksi :</label>
                                    <input type="hidden" name="no_trx_danur_tmp" value="<?= $data['no_trx_danur'] ?>"
                                        class="form-control" required>
                                    <input type="text" name="no_trx_danur" value="<?= $data['no_trx_danur'] ?>"
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nik_ktp_danur" class="form-label">Pelanggan:</label>
                                    <select name="nik_ktp_danur" class="form-control" required>
                                        <option value="">-- Pilih Pelanggan --</option>
                                        <?php
                                        $tampil_pelanggan = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan_danur");
                                        while ($pelanggan = mysqli_fetch_array($tampil_pelanggan)) {
                                            $selected = ($pelanggan['nik_ktp_danur'] == $data['nik_ktp_danur']) ? 'selected' : '';
                                            echo "<option value='{$pelanggan['nik_ktp_danur']} - {$pelanggan['nama_pelanggan_danur']}' $selected>{$pelanggan['nik_ktp_danur']} - {$pelanggan['nama_pelanggan_danur']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="no_plat_danur" class="form-label">Mobil:</label>
                                    <select name="no_plat_danur" class="form-control" required>
                                        <option value="">-- Pilih Mobil --</option>
                                        <?php
                                        $tampil_mobil = mysqli_query($koneksi, "SELECT * FROM tb_mobil_danur");
                                        while ($mobil = mysqli_fetch_array($tampil_mobil)) {
                                            $selected = ($mobil['no_plat_danur'] == $data['no_plat_danur']) ? 'selected' : '';
                                            echo "<option value='{$mobil['no_plat_danur']}' $selected>{$mobil['no_plat_danur']} - {$mobil['nama_mobil_danur']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_rental_danur" class="form-label">Tanggal Ambil:</label>
                                <input type="date" name="tgl_rental_danur" class="form-control"
                                    value="<?= $data['tgl_rental_danur'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="jam_rental_danur" class="form-label">Jam Ambil:</label>
                                <input type="time" name="jam_rental_danur" class="form-control"
                                    value="<?= $data['jam_rental_danur'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga_danur" class="form-label">Harga Rental (per hari):</label>
                                <input type="number" name="harga_danur" id="harga_danur" class="form-control"
                                    value="<?= $data['harga_danur'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="lama_danur" class="form-label">Lama rental (hari):</label>
                                <<input type="number" name="lama_danur" id="lama_danur" class="form-control"
                                    value="<?= $data['lama_danur'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="total_bayar_danur" class="form-label">Total Bayar:</label>
                                <input type="text" name="total_bayar_danur" class="form-control" id="total_bayar_danur"
                                    readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <a href="tampil_transaksi.php" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-primary">Perbaharui</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const lamaRental = document.getElementById('lama_danur');
            const hargaRental = document.getElementById('harga_danur');
            const totalBayar = document.getElementById('total_bayar_danur');

            // Fungsi untuk menghitung total bayar
            function hitungTotal() {
                const lama = parseInt(lamaRental.value) || 0; 
                const harga = parseInt(hargaRental.value) || 0;
                totalBayar.value = lama * harga;  \
            }

            // Menambahkan event listener untuk memanggil fungsi hitungTotal ketika ada input
            lamaRental.addEventListener('input', hitungTotal);
            hargaRental.addEventListener('input', hitungTotal);


        </script>

    </body>

    </html>
    <?php
}
?>