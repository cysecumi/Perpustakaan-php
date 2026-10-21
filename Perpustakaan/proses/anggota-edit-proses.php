<?php
include '../koneksi.php';
$id_anggota = $_POST['id_anggota'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$foto_awal = $_POST['foto_awal'];

if (isset($_POST['simpan'])){
    $nama_file = $_FILES['foto']['name'];
    
    // Cek apakah admin mengunggah foto baru saat mengedit
    if(!empty($nama_file)){
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
        $file_foto = $id_anggota.".".$tipe_file;
        
        $folder = "../images/".$file_foto;
        move_uploaded_file($lokasi_file, $folder);
    }
    else {
        // Jika tidak upload foto baru, gunakan foto yang lama
        $file_foto = $foto_awal;
    }
    
    // Perintah untuk membarui (update) data
    mysqli_query($db, "UPDATE tbanggota SET nama='$nama', jeniskelamin='$jenis_kelamin', alamat='$alamat', foto='$file_foto' WHERE idanggota='$id_anggota'");
    
    header("location:../index.php?p=anggota");
}
?>