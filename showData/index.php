<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data</title>
    <!-- link bootstraps -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- link datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <style>
        div.dataTables_wrapper div.dataTables_length label {
            font-weight: normal;
            text-align: left;
            white-space: nowrap;
            margin-left: 13%;
        }

        div.dataTables_wrapper div.dataTables_filter label {
            font-weight: normal;
            white-space: nowrap;
            text-align: left;
            margin-right: 8%;
        }

        div.dataTables_wrapper div.dataTables_info {
            padding-top: 0.85em;
            white-space: nowrap;
            margin-left: 15%;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin: 2px 0;
            white-space: nowrap;
            justify-content: flex-end;
            margin-right: 7%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-primary">
        <a class="navbar-brand text-white" href="#">Starbhak Soft</a>
    </nav>
    <div class="table-responsive">
        <h2 align="center">Menampilkan Data dari Database ke Tabel dengan Datatables PHP</h2>
        <br>
        <table id="data" class="table table-striped table-bordered" style="width:90%; margin-left: 6%">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Siswa</td>
                    <td>Alamat</td>
                    <td>Jurusan</td>
                    <td>Jenis Kelamin</td>
                    <td>Tanggal Masuk</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $no = 1;
                $query = "SELECT * FROM `tbl_siswa` ORDER BY id ASC";
                $coba = $db1->prepare($query);
                $coba->execute();
                $res1 = $coba->get_result();
                while ($baris = $res1->fetch_assoc()) {
                    $id = $baris['id'];
                    $nama = $baris['nama_siswa'];
                    $alamat = $baris['alamat'];
                    $jurusan = $baris['jurusan'];
                    $jkl = $baris['jenis_kelamin'];
                    $tgl = $baris['tgl_masuk'];
                ?>

                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $nama ?></td>
                        <td><?php echo $alamat ?></td>
                        <td><?php echo $jurusan ?></td>
                        <td><?php echo $jkl ?></td>
                        <td><?php echo $tgl ?></td>
                        <td><button style="font-size: 11px;" class="btn btn-primary" id="detail" name="detail" title="lihat detail"><i class="fa fa-search">Detail</i></button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div id="viewModal" class="modal fade mr-tp-100" role="dialog">
            <div class="modal-dialog modal-lg flipInX animated">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="detailData">View Data</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" class="form-control" id="id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" readonly>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" id="alamat" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" id="jurusan" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" id="jenis_kelamin" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="text" id="tgl_masuk" class="form-control" readonly="">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            let table = $('#data').DataTable();

            $('#data tbody').on('click', '#detail', function() {
                var current_row = $(this).parents('tr');
                if (current_row.hasClass('child')) {
                    current_row = current_row.prev();
                }
                var data = table.row(current_row).data();
                console.log(data);

                document.getElementById("id").value = data[0];
                document.getElementById("nama_siswa").value = data[1];
                document.getElementById("alamat").value = data[2];
                document.getElementById("jurusan").value = data[3];
                document.getElementById("jenis_kelamin").value = data[4];
                document.getElementById("tgl_masuk").value = data[5];


                $("#viewModal").modal("show");
            });
        });
    </script>
</body>

</html>