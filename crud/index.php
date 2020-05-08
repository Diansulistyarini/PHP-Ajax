<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <!-- link bootstraps -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- link datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <!--  -->
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

    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php" style="color:white">
            Starbhak Soft
        </a>
    </nav>

    <div class="container">
        <h2 align="center" style="margin:30px;">CRUD Ajax No Loading</h2>
    </div>

    <form method="POST" class="form-data" id="form-data">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group" style="margin-left: 13%;">
                    <label>Nama Siswa</label>
                    <input type="hidden" name="id" id="id">
                    <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required="true">
                    <p class="text-danger" id="err_nama_siswa"></p>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label>Jurusan</label>
                    <select name="jurusan" id="jurusan" class="form-control" required="true">
                        <option value=""></option>
                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                        <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                        <option value="Multimedia">Multimedia</option>
                        <option value="Broadcasting">Broadcasting</option>
                        <option value="Teknik Elektro Industri">Teknik Elektro Industri</option>
                    </select>
                    <p class="text-danger" id="err_jurusan"></p>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" required="true">
                    <p class="text-danger" id="err_tgl_masuk"></p>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="input" style="margin-top: 3%">
                        <input type="radio" name="jkl" id="jkl1" value="Laki-laki" required="true">Laki-laki
                        <input type="radio" name="jkl" id="jkl2" value="Perempuan" required="true" style="margin-left: 10px;">Perempuan
                    </div>
                </div>
                <p class="text-danger" id="err_jkl"></p>
            </div>
        </div>

        <div class="form-group" style="margin-left: 3%; width: 87%;">
            <label>Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" required= "true"></textarea>
            <p class="text-danger" id="err_alamat"></p>
        </div>

        <div class="form-group">
            <button type="button" name="simpan" id="simpan" class="btn btn-primary" style="margin-left: 3%;">
                <i class="fa fa-save">Simpan</i>
            </button>
        </div>
    </form>

    <hr>

    <div class="data" style="margin-left: 10%"></div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.data').load("data.php");
            $("#simpan").click(function() {
                var data = $('.form-data').serialize();
                var jkl1 = document.getElementById("jkl1").value;
                var jkl2 = document.getElementById("jkl2").value;
                var nama_siswa = document.getElementById("nama_siswa").value;
                var tgl_masuk = document.getElementById("tgl_masuk").value;
                var alamat = document.getElementById("alamat").value;
                var jurusan = document.getElementById("jurusan").value;

                if (nama_siswa == "") {
                    document.getElementById("err_nama_siswa").innerHTML = "Nama Siswa Harus Diisi";
                } else {
                    document.getElementById("err_nama_siswa").innerHTML = "";
                }
                if (alamat == "") {
                    document.getElementById("err_alamat").innerHTML = "Alamat Siswa Harus Diisi";
                } else {
                    document.getElementById("err_alamat").innerHTML = "";
                }
                if (jurusan == "") {
                    document.getElementById("err_jurusan").innerHTML = "Jurusan Siswa Harus Diisi";
                } else {
                    document.getElementById("err_alamat").innerHTML = "";
                }
                if (tgl_masuk == "") {
                    document.getElementById("err_tgl_masuk").innerHTML = "Tanggal Masuk Siswa Harus Diisi";
                } else {
                    document.getElementById("err_tgl_masuk").innerHTML = "";
                }
                if (document.getElementById("jkl1").checked == false &&
                    document.getElementById("jkl2").checked == false) {
                    document.getElementById("err_jkl").innerHTML = "Jenis Kelamin Harus Dipilih";
                } else {
                    document.getElementById("err_jkl").innerHTML = "";
                }

                if (nama_siswa != "" && alamat != "" && jurusan != "" && tgl_masuk != "" && (document.getElementById("jkl1").checked == true || document.getElementById("jkl2").checked == true)) {
                    $.ajax({
                        type: 'POST',
                        url: "form_action.php",
                        data: data,
                        success: function() {
                            $('.data').load("data.php");
                            document.getElementById("id").value = "";
                            document.getElementById("form-data").reset();
                        },
                        error: function(response) {
                            console.log(response.responseText);
                        }
                    });

                }
            });

        });
    </script>
</body>

</html>