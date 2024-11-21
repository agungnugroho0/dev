<?php
require_once '../config/koneksi.php';
require '../config/admin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>

<body>
    <?php include 'menu.html'; ?>
    <div class="tabs flex *:h-8 *:mx-2 *:px-3 text-sm">
        <button id="tab1" class="tab-button font-medium border-b-2 border-red-800" data-target="content1">Siswa</button>
        <button id="tab2" class="tab-button" data-target="content2">Lolos</button>
        <button id="tab3" class="tab-button" data-target="content3">Pembayaran</button>
        <button id="tab4" class="tab-button" data-target="content4">Coming Soon</button>
    </div>

<div class="tab-contents">
    <div id="content1" class="tab-content active"><?php include './view/aktif.php'?></div>
    <div id="content2" class="tab-content "><?php include './view/lolos.php'?></div>
    <div id="content3" class="tab-content">Content 3</div>
    <div id="content4" class="tab-content">Content 4</div>
</div>

</body>

</html>

<script>
    let cari = document.getElementById('cari');
    let muncul = document.getElementById('muncul');

    cari.addEventListener('keyup',()=>{
        var xhr = new XMLHttpRequest();
        // cek ajax
        xhr.onreadystatechange = function(){
            if (xhr.readyState === 4 && xhr.status === 200){
                muncul.innerHTML = xhr.responseText;
                // console.log(cari.value);
            }
        };
        xhr.open('GET','./../model/cari_admin.php?cari='+cari.value,true);
        xhr.send();
    });

    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
    button.addEventListener('click', () => {
        const target = button.getAttribute('data-target'); // Ambil target dari atribut data-target

        // Menghapus kelas 'active' dari semua tab konten
        tabContents.forEach(content => content.classList.remove('active'));

        // Menambahkan kelas 'active' ke konten yang sesuai
        document.getElementById(target).classList.add('active');

        // Mengubah style pada tombol tab
        tabButtons.forEach(btn => {
            btn.classList.remove('font-medium');
            btn.classList.remove('border-b-2');
            btn.classList.remove('border-red-800');
        });
        button.classList.add('font-medium');
        button.classList.add('border-b-2');
        button.classList.add('border-red-800');
    });
});

</script>