<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa Magang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <style>
        .container {
            max-width: 800px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- CONTAINER -->
    <div class="container">
        <!-- CARD -->
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Data Mahasiswa Magang
            </div>
            <div class="card-body">
                <!-- LOKASI TEXT PENCARIAN -->
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="<?php echo $katakunci ?>" name="katakunci" placeholder="Masukkan Kata Kunci" aria-label="Masukkan Kata Kunci" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                    </div>
                </form>
                <!-- MODAL -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Tambah Data Mahasiswa Magang
                </button>
                <!-- Modal -->

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Biodata Magang</h5>
                                <button type="button" class="btn-close tombol-tutup" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- KALAU ERROR -->
                                <div class="alert alert-danger error" role="alert" style="display: none;">
                                </div>
                                <!-- KALAU SUKSES -->
                                <div class="alert alert-primary sukses" role="alert" style="display: none;">
                                </div>
                                <!-- FORM INPUT DATA -->
                                <form id="formMahasiswa" enctype="multipart/form-data">
                                    <input type="hidden" id="inputId">
                                    <div class="mb-3 row">
                                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input name="nama" type="input" class="form-control" id="inputNama">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input name="email" type="input" class="form-control" id="inputEmail">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputBidang" class="col-sm-2 col-form-label">Bidang</label>
                                        <div class="col-sm-10">
                                            <input name="bidang" type="input" class="form-control" id="inputBidang">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input name="alamat" type="input" class="form-control" id="inputAlamat">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputFoto" class="col-sm-2 col-form-label">Foto</label>
                                        <div class="col-sm-10">
                                            <input name="foto" type="file" class="form-control" id="inputFoto">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary" id="tombolSimpan">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tabel Data Mahasiswa Magang -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Bidang</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataPegawai as $k => $v) { ?>
                            <tr>
                                <td><?php echo $k + 1 ?></td>
                                <td><?php echo $v['nama'] ?></td>
                                <td><?php echo $v['email'] ?></td>
                                <td><?php echo $v['bidang'] ?></td>
                                <td><?php echo $v['alamat'] ?></td>
                                <td>
                                    <?php if (!empty($v['foto'])) { ?>
                                        <img src="<?php echo base_url('uploads/' . $v['foto']) ?>" alt="Foto Pegawai" width="100">
                                    <?php } else { ?>
                                        Foto Tidak Tersedia
                                    <?php } ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="edit(<?php echo $v['id'] ?>)">Ubah</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapus(<?php echo $v['id'] ?>)">Hapus</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php
                $linkPagination = $pager->links();
                $linkPagination = str_replace('<li class="active">', '<li class="page-item active">', $linkPagination);
                $linkPagination = str_replace('<li>', '<li class="page-item">', $linkPagination);
                $linkPagination = str_replace("<a", "<a class='page-link'", $linkPagination);
                echo $linkPagination;
                ?>
            </div>
        </div>
    </div>
    <!-- SCRIPT JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        function hapus($id) {
            var result = confirm('Yakin mau melakukan proses delete');
            if (result) {
                window.location = "<?php echo site_url("pegawai/hapus") ?>/" + $id;
            }
        }

        function edit($id) {
            $.ajax({
                url: "<?php echo site_url("pegawai/edit") ?>/" + $id,
                type: "get",
                success: function(hasil) {
                    var $obj = $.parseJSON(hasil);
                    if ($obj.id != '') {
                        $('#inputId').val($obj.id);
                        $('#inputNama').val($obj.nama);
                        $('#inputEmail').val($obj.email);
                        $('#inputBidang').val($obj.bidang);
                        $('#inputAlamat').val($obj.alamat);
                    }
                }
            });
        }

        function bersihkan() {
            $('#inputId').val('');
            $('#inputNama').val('');
            $('#inputEmail').val('');
            $('#inputBidang').val('');
            $('#inputAlamat').val('');
            $('#inputFoto').val(''); // Kosongkan input foto setelah submit
        }

        $('.tombol-tutup').on('click', function() {
            if ($('.sukses').is(":visible")) {
                window.location.href = "<?php echo current_url() . "?" . $_SERVER['QUERY_STRING'] ?>";
            }
            $('.alert').hide();
            bersihkan();
        });

        $('#tombolSimpan').on('click', function() {
            var $id = $('#inputId').val();
            var $nama = $('#inputNama').val();
            var $email = $('#inputEmail').val();
            var $bidang = $('#inputBidang').val();
            var $alamat = $('#inputAlamat').val();
            var $foto = $('#inputFoto')[0].files[0]; // Tangkap file foto yang diunggah

            var formData = new FormData();
            formData.append('id', $id);
            formData.append('nama', $nama);
            formData.append('email', $email);
            formData.append('bidang', $bidang);
            formData.append('alamat', $alamat);
            formData.append('foto', $foto); // Tambahkan foto ke FormData

            // Kirim formData menggunakan AJAX
            $.ajax({
                url: "<?php echo base_url("pegawai/simpan") ?>",
                type: "POST",
                data: formData, // Kirim formData sebagai data
                contentType: false,
                processData: false,
                success: function(hasil) {
                    var $obj = $.parseJSON(hasil);
                    if ($obj.sukses == false) {
                        $('.sukses').hide();
                        $('.error').show();
                        $('.error').html($obj.error);
                    } else {
                        $('.error').hide();
                        $('.sukses').show();
                        $('.sukses').html($obj.sukses);
                    }
                }
            });
            bersihkan();
        });
    </script>
</body>

</html>
