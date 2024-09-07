function conDelMasuk(idArsip, noArsip) {
    swal({
        title: noArsip,
        text: "Arsip ini akan dihapus secara permanent! Apakah Anda yakin?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d9534f",
        cancelButtonColor: "#5cb85c",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.value) {
            window.location.href  = "hapussuratmasuk/"+idArsip;
        }
    })
}

function conDelKeluar(idArsip, noArsip) {
    swal({
        title: noArsip,
        text: "Arsip ini akan dihapus secara permanent! Apakah Anda yakin?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d9534f",
        cancelButtonColor: "#5cb85c",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.value) {
            window.location.href  = "hapussuratkeluar/"+idArsip;
        }
    })
}

function conDelSurat(idArsip, noUrut) {
    swal({
        title: "Pengajuan No "+noUrut,
        text: "Pengajuan pembuatan surat ini akan dihapus secara permanent! Apakah Anda yakin?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d9534f",
        cancelButtonColor: "#5cb85c",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.value) {
            window.location.href  = "http://[::1]/ciawigebang/pengajuan/penduduk/delete_surat/"+idArsip;
        }
    })
}