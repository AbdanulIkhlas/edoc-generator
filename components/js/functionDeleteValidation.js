delRow: function (i) {
    Swal.fire({
        title: "Apa anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "grey",
        confirmButtonText: "Ya, hapus!"
    }).then((result) => {
        if (result.isConfirmed || result.value) {
            if (i > -1) {
                this.status_umum.splice(i, 1);
            }
            Swal.fire({
                icon: "success",
                title: "Berhasil menghapus data",
                showConfirmButton: false,
                timer: 1000
            });
        }
    });
}