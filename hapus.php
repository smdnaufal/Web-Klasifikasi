<?php
    session_start();

    if(!isset($_SESSION['login_user'])){
        header("location:login.php");
        die();
    }
    include "database.php";

    $id = $_GET['id'];

    $sql = $conn->query("DELETE FROM tb_mahasiswa WHERE id_mahasiswa='$id'");

    if ($sql) {
        echo ("<script LANGUAGE='JavaScript'>
    window.alert('Data berhasil di hapus');
    window.location.href='klasifikasi.php';
    </script>");
    }