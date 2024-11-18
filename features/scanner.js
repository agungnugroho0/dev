const html5QrCode = new Html5Qrcode("reader");

function startScanner() {
    html5QrCode.start(
        { facingMode: "environment" }, 
        {
            fps: 10,    // Optional, frame per seconds for qr code scanning
            qrbox: { width: 250, height: 250 }  // Optional, if you want bounded box UI
        },
        (decodedText, decodedResult) => {
            // Hentikan scanner untuk sementara
            html5QrCode.stop().then(() => {
                // Lakukan AJAX untuk absen
                $.ajax({
                    type: 'POST',
                    url: '../model/absen_proses.php',
                    data: {
                        "nis": decodedText,
                        "type": "scan",
                        "metode":"otomatis",
                    },
                    success: function(data) {
                        // Tampilkan SweetAlert2 dan restart scanner setelah ditutup
                        Swal.fire({
                            title: 'Scan Berhasil!',
                            text: data,
                            icon: 'success',
                            timer : 1000
                        }).then(() => {
                            // Mulai ulang scanner setelah menutup notifikasi
                            startScanner();
                        });
                    },
                    error: function() {
                        
                    }
                });
            }).catch((err) => {
                console.error("Gagal menghentikan scanner:", err);
            });
        },
        (errorMessage) => {
            // parse error, ignore it.
        }
    ).catch((err) => {
        console.error("Gagal memulai scanner:", err);
    });
}

// Mulai scanner pertama kali
startScanner();
