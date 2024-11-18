<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa LPK Hikari</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class=" text-red-900 font-bold p-3">
        <center>
            <img src="./image/logo.png" alt="" srcset="" width="100">
            FORMULIR SISWA BARU<br>LPK HIKARI GAKKOU<br>
            <?php
            if (isset($_GET['nama'])) {
                echo "<script>alert('Siswa bernama " . htmlspecialchars($_GET['nama']) . " sudah terdaftar');</script>";
            } elseif (isset($_GET['sukses'])) {
                echo "<script>alert('Pendaftaran Berhasil, Selamat Belajar');</script>";
            } ?>
        </center>
    </div>

    <form action="./model/tambah.php" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto px-5">
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " required />
            <label for="nama_lengkap" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama Lengkap</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="nama_panggilan" id="nama_panggilan" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " required />
            <label for="nama_panggilan" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama Panggilan</label>
        </div>

        <div class="grid sm:grid-cols-2 gap-3 mb-5">

            <div class="flex items-center mb-4">
                <input id="gender-option-1" type="radio" name="gender" value="L" class="w-4 h-4 border-gray-300 focus:ring-3 focus:ring-red-500 " required />
                <label for="gender-option-1" class="block ms-2 text-sm font-medium text-gray-900">
                    Laki - laki
                </label>
            </div>
            <div class="flex items-center mb-4">
                <input id="gender-option-2" type="radio" name="gender" value="P" class="w-4 h-4 border-gray-300 focus:ring-3 focus:ring-red-500 " required />
                <label for="gender-option-2" class="block ms-2 text-sm font-medium text-gray-900">
                    Perempuan
                </label>
            </div>
        </div>

        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " required />
                <label for="tempat_lahir" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tempat Lahir</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="date" name="tgl_lahir" id="tgl_lahir" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " required />
                <label for="tgl_lahir" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tanggal Lahir</label>
            </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="number" name="wa" id="wa" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder="" required />
            <label for="wa" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">No Whatsapp</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="number" name="no_rumah" id="no_rumah" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder="" required />
            <label for="no_rumah" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">No Whatsapp Orang Tua</label>
        </div>
        <label for="agama" class="block mt-3 mb-3 text-sm font-medium text-gray-900 ">Pilih Agama Anda</label>
        <select id="agama" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 h-9 mb-5" name="agama">
            <option value="ISLAM">Islam</option>
            <option value="KRISTEN">Kristen</option>
            <option value="HINDU">Hindu</option>
            <option value="BUDHA">Budha</option>
            <option value="KATOLIK">Katolik</option>
            <option value="KONGHUCHU">Konghuchu</option>
        </select>

        <hr>
        <label for="" class="block mt-3 mb-5 text-sm font-medium text-gray-900 ">Masukan Alamat Lengkap Anda</label>

        <select name="provinsi" id="provinsi" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full mb-5 h-9">
        </select>
        <select name="kabupaten" id="kabupaten" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full mb-5 h-9">
        </select>
        <select name="kecamatan" id="kecamatan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full mb-5 h-9">
        </select>
        <select name="kelurahan" id="kelurahan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full mb-5 h-9">
        </select>

        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="rt" id="rt" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " />
                <label for="rt" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">RT</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="rw" id="rw" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder="" />
                <label for="rw" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">RW</label>
            </div>
        </div>
        <hr>

        <input type="file" name="file">
        <!--
    <input type="file" name="foto"><br>
        
    
    <label for="status" class="block mt-3 mb-3 text-sm font-medium text-gray-900 "></label>
    <select id="status" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 h-9 mb-5" name="status" required>
        <option value="">Pilih Status</option>
        <option value="SINGLE">Single</option>
        <option value="MENIKAH">Menikah</option>
        <option value="CERAI">Cerai</option>
    </select>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="number" name="bb" id="bb" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " required />
                    <label for="bb" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Berat Badan</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="number" name="tb" id="tb" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder="" required />
                    <label for="tb" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tinggi Badan</label>
                </div>
            </div>

    <div class="grid md:grid-cols-2 md:gap-6">
        <select id="gol" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 h-9 mb-5" name="darah" required>
            <option value="">Pilih Golongan Darah</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>
            <option value="O">O</option>
            <option value="TIDAK TAU">Tidak Tau</option>
        </select>
        <select id="tangan" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 h-9 mb-5" name="tangan" required>
            <option value="">Pilih Tangan Dominan</option>
            <option value="KANAN">KANAN</option>
            <option value="KIDAL">KIDAL / KIRI</option>
        </select>
    </div>

    <div class="grid md:grid-cols-2 md:gap-6">
        <select id="merokok" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 h-9 mb-5" name="merokok" required>
            <option value="">Merokok atau Tidak Merokok</option>
            <option value="YA">YA</option>
            <option value="TIDAK">TIDAK</option>
        </select>
        <select id="alkohol" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 h-9 mb-5" name="alkohol" required>
            <option value="">Minum  Alkohol atau Tidak</option>
            <option value="YA">YA</option>
            <option value="TIDAK">TIDAK</option>
        </select>
    </div>

    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="hobi" id="hobi" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " required />
        <label for="hobi" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">HOBI</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="tujuan" id="tujuan" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " required />
        <label for="tujuan" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tujuan Ke Jepang</label>
    </div>
    <hr>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="kelebihan1" id="kelebihan1" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " required />
        <label for="kelebihan1" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kelebihan 1</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="kelebihan2" id="kelebihan2" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " required />
        <label for="kelebihan2" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kelebihan 2</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="kelebihan3" id="kelebihan3" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " required />
        <label for="kelebihan3" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kelebihan 3</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="kekurangan1" id="kekurangan1" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-700 peer" placeholder=" " required />
        <label for="kekurangan1" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-slate-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kekurangan</label>
    </div> -->
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mt-5" name="submit">Submit</button>
    </form>

</body>

</html>

<script>
    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`)
        .then(response => response.json())
        .then(provinces => {
            var data = provinces;
            var tampung = '<option>Pilih Provinsi</option>'
            data.forEach(element => {
                tampung += `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`;
            })
            document.getElementById('provinsi').innerHTML = tampung;
        });

    const selectprovinsi = document.getElementById("provinsi");
    selectprovinsi.addEventListener('change', (e) => {
        var provinsi = e.target.options[e.target.selectedIndex].dataset.reg;
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
            .then(respons => respons.json())
            .then(regencies => {
                var data = regencies;
                var tampung = '<option>Pilih Kabupaten</option>'
                data.forEach(element => {
                    tampung += `<option data-dist="${element.id}" value="${element.name}">${element.name}</option>`;
                })
                document.getElementById('kabupaten').innerHTML = tampung;
            })
    });

    const selectkabupaten = document.getElementById("kabupaten");
    selectkabupaten.addEventListener('change', (e) => {
        var kabupaten = e.target.options[e.target.selectedIndex].dataset.dist;
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabupaten}.json`)
            .then(respons => respons.json())
            .then(districts => {
                var data = districts;
                var tampung = '<option>Pilih Kecamatan</option>'
                data.forEach(element => {
                    tampung += `<option data-vill="${element.id}" value="${element.name}">${element.name}</option>`;
                })
                document.getElementById('kecamatan').innerHTML = tampung;
            })
    });

    const selectkecamatan = document.getElementById("kecamatan");
    selectkecamatan.addEventListener('change', (e) => {
        var kecamatan = e.target.options[e.target.selectedIndex].dataset.vill;
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
            .then(respons => respons.json())
            .then(districts => {
                var data = districts;
                var tampung = '<option>Pilih Desa</option>'
                data.forEach(element => {
                    tampung += `<option value="${element.name}">${element.name}</option>`;
                })
                document.getElementById('kelurahan').innerHTML = tampung;
            })
    });
</script>