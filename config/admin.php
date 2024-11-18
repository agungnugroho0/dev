<?php
session_start();
if ($_SESSION['level']== ""){
    header("location:../index.php?pesan=gagal");
    exit;
}elseif($_SESSION['level']!=="admin"){
    header("location:../index.php?pesan=salah");
    exit;
};