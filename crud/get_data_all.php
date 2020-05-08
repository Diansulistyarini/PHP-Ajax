<?php

    session_start();
    include 'koneksi.php';

    $id = $_POST['id'];
    $query = "SELECT * FROM `tbl_siswa` WHERE `tbl_siswa`.`id` = ?";
    $prepare1 = $db1->prepare($query);
    $prepare1->bind_param("i", $id);
    $prepare1->execute();
    $result = $prepare1->get_result();
    while ($baris = $result->fetch_assoc()) {
        $h['id'] = $baris["id"];
        $h['nama_siswa'] = $baris["nama_siswa"];
        $h['alamat'] = $baris["alamat"];
        $h['jurusan'] = $baris["jurusan"];
        $h['jenis_kelamin'] = $baris["jenis_kelamin"];
        $h['tgl_masuk'] = $baris["tgl_masuk"];
    }

    echo json_encode($h);
    $db1->close();

?>