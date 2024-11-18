const bulan = document.getElementById("bulan");
bulan.addEventListener('change',function(){
    $.ajax({
        type: 'POST',
        url: '../model/l_absen.php', // nama file PHP yang akan dipanggil
        data: { 
            "bulan":  bulan.value,

        }, // mengirimkan nilai input tanggal ke server
        success: function(data) {
            tampil.innerHTML = data;

            // kode untuk menampilkan data yang dikembalikan oleh server akan ditulis disini
            
        }
    });

});