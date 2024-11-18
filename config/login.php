<?php
    session_start();
    include_once "koneksi.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login = mysqli_query($konek,"SELECT * FROM staff WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($login);

    if ($cek >0) {
        $data = mysqli_fetch_assoc($login);
        // percabangan admin dengan guru
        if ($data['level']=="admin"){
            $_SESSION['username']=$data['username'];
            $_SESSION['level']=$data['level'];
            header("location:../admin/index.php");
        } elseif ($data['level']=="guru"){
            $_SESSION['username']=$data['username'];
            $_SESSION['nama']=$data['nama'];
            $_SESSION['level']=$data['level'];
            $_SESSION['kelas']=$data['id_kelas'];
            header("location:../guru/index.php");

        } else {
            header("location:../index.php?pesan=gagal");
        }
    } else {
        header("location:../index.php?pesan=gagal");
    }
    
?>