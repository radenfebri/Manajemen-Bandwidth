// Ambil referensi elemen input dan tabel
var input = document.getElementById("cari");
var tabel = document.getElementById("tables");

// Tambahkan event listener ke input
input.addEventListener("keyup", function () {
    var nilaiCari = input.value.toLowerCase();
    
    // Loop melalui baris-baris tabel
    for (var i = 0; i < tabel.rows.length; i++) {
        var baris = tabel.rows[i];
        var ditemukan = false;
        
        // Loop melalui sel-sel dalam baris
        for (var j = 0; j < baris.cells.length; j++) {
            var sel = baris.cells[j];
            var nilaiSel = sel.textContent.toLowerCase();
            
            // Periksa apakah nilai sel cocok dengan nilai pencarian
            if (nilaiSel.indexOf(nilaiCari) > -1) {
                ditemukan = true;
                break;
            }
        }
        
        // Tampilkan atau sembunyikan baris berdasarkan hasil pencarian
        if (ditemukan) {
            baris.style.display = "";
        } else {
            baris.style.display = "none";
        }
    }
});