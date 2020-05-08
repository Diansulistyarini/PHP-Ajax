    <style>
         div.dataTables_wrapper div.dataTables_length label {
            font-weight: normal;
            text-align: left;
            white-space: nowrap;
            margin-left: 0%;
        }

        div.dataTables_wrapper div.dataTables_filter label {
            font-weight: normal;
            white-space: nowrap;
            text-align: left;
            margin-right: 21%;
        }

        div.dataTables_wrapper div.dataTables_info {
            padding-top: 0.85em;
            white-space: nowrap;
            margin-left: 0%;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin: 2px 0;
            white-space: nowrap;
            justify-content: flex-end;
            margin-right: 120px;
        }
        
    </style>
    <table id="example" class="table table-striped table-bordered" style="width:90%;">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama Siswa</td>
                <td>Alamat</td>
                <td>Jurusan</td>
                <td>Jenis Kelamin</td>
                <td>Tanggal Masuk</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'koneksi.php';
            $no = 1;
            $query = "SELECT * FROM `tbl_siswa` ORDER BY `nama_siswa` ASC";
            $coba = $db1->prepare($query);
            $coba->execute();
            $res1 = $coba->get_result();

            if ($res1->num_rows > 0) {
                while ($baris = $res1->fetch_assoc()) {
                    $id = $baris['id'];
                    $nama = $baris['nama_siswa'];
                    $alamat = $baris['alamat'];
                    $jurusan = $baris['jurusan'];
                    $jkl = $baris['jenis_kelamin'];
                    $tgl_masuk = $baris['tgl_masuk'];
            ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $nama ?></td>
                        <td><?php echo $alamat ?></td>
                        <td><?php echo $jurusan ?></td>
                        <td><?php echo $jkl ?></td>
                        <td><?php echo $tgl_masuk ?></td>
                        <td>
                            <button id="<?php echo $id; ?>" class="btn btn-success btn-sm edit_data" title="edit data">
                                <i class="fa fa-edit"> Edit </i></button>
                            <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_data" title="hapus data">
                                <i class="fa fa-trash"> Hapus </i></button>
                        </td>
                    </tr>

                <?php }
            } else { ?>
                <tr>
                    <td colspan="7">Data Not Found</td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').dataTable();
        });

        function reset() {
            document.getElementById("err_nama_siswa").innerHTML = "";
            document.getElementById("err_alamat").innerHTML = "";
            document.getElementById("err_jurusan").innerHTML = "";
            document.getElementById("err_tgl_masuk").innerHTML = "";
            document.getElementById("err_jkl").innerHTML = "";
        }

        $(document).on('click', '.edit_data', function() {
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: "get_data_all.php",
                data: {id:id}, 
                dataType: 'json',
                success: function(response) {
                    reset();
                    document.getElementById("id").value = response.id;
                    document.getElementById("nama_siswa").value = response.nama_siswa
                    document.getElementById("alamat").value = response.alamat;
                    document.getElementById("jurusan").value = response.jurusan;
                    document.getElementById("tgl_masuk").value = response.tgl_masuk;
                    if (response.jenis_kelamin == "Laki-laki") {
                        document.getElementById("jkl1").checked = true;
                    } else {
                        document.getElementById("jkl2").checked = true;
                    }
                },
                error: function(response) {
                    console.log(response.responseText)
                }
            });
        });

        $(document).on('click', '.hapus_data', function() {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: 'POST',
                        url: "hapus_data.php",
                        data: {id:id},
                        success: function() {
                                $('.data').load("data.php")
                            },
                            error: function(response) {
                                console.log(response.responseText)
                            }
                        });
                    });
    </script>
