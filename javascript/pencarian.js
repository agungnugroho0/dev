var muncul = document.getElementById('muncul');
var cari = document.getElementById('cari');

cari.addEventListener('keyup',function(){
    //buat objek ajax
    var xhr = new XMLHttpRequest();

    // cek ajax
    xhr.onreadystatechange = function(){
        if (xhr.readyState === 4 && xhr.status === 200){
            muncul.innerHTML = xhr.responseText;
            // console.log(cari.value);
        }
    };

    // eksekusi ajax
    xhr.open('GET','./../model/ajax.php?cari='+cari.value,true);
    xhr.send();
});
