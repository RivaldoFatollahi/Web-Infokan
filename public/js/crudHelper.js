// Ganti nama jadi CrudHelper
const CrudHelper = {
    showForm: function (config) {
        return Swal.fire({
            title: config.title,
            html: config.html,
            showCancelButton: true,
            confirmButtonText: config.confirmText || "Simpan",
            didOpen: config.didOpen || (() => {}), // Tambahkan ini agar didOpen jalan
            preConfirm: () => {
                const formData = {};
                const container = Swal.getHtmlContainer();

                // Ambil Input teks, select, dll
                const inputs = container.querySelectorAll(
                    "input, select, textarea",
                );
                inputs.forEach((input) => {
                    if (input.type === "file") {
                        formData[input.id] = input.files[0]; // Ambil filenya
                    } else {
                        formData[input.id] = input.value;
                    }
                });
                return formData;
            },
        }).then((result) => {
            if (result.isConfirmed) {
                this.submitAjax(
                    config.url,
                    config.method || "POST",
                    result.value,
                );
            }
        });
    },

    submitAjax: function (url, method, data) {
        Swal.showLoading();

        let fetchMethod = method.toUpperCase();
        let bodyData;

        // CEK: Apakah data mengandung file?
        const hasFile = Object.values(data).some((val) => val instanceof File);

        if (hasFile) {
            // Jika ada file, pake FormData
            bodyData = new FormData();
            for (const key in data) {
                bodyData.append(key, data[key]);
            }
            // Laravel Spoofing untuk FormData
            if (["PUT", "PATCH", "DELETE"].includes(fetchMethod)) {
                bodyData.append("_method", fetchMethod);
                fetchMethod = "POST";
            }
        } else {
            // Jika teks biasa, tetap gunakan JSON
            bodyData = JSON.stringify({
                ...data,
                _method: ["PUT", "PATCH", "DELETE"].includes(fetchMethod)
                    ? fetchMethod
                    : undefined,
            });
            if (["PUT", "PATCH", "DELETE"].includes(fetchMethod))
                fetchMethod = "POST";
        }

        const headers = {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            Accept: "application/json",
        };

        // Kalo BUKAN file, tambahin Content-Type JSON
        if (!hasFile) {
            headers["Content-Type"] = "application/json";
        }

        fetch(url, {
            method: fetchMethod,
            headers: headers,
            body: bodyData,
        }).then(async (response) => {
            if (response.ok) {
                location.reload();
            } else {
                const errorData = await response.json();
                Swal.fire(
                    "Gagal!",
                    errorData.message || "Terjadi kesalahan",
                    "error",
                );
            }
        });
    },

    confirmDelete: function (
        url,
        message = "Data yang dihapus tidak dapat dipulihkan!",
    ) {
        return Swal.fire({
            title: "Apakah anda yakin?",
            text: message,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545", // Warna merah buat delete
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // Panggil submitAjax dengan method DELETE
                this.submitAjax(url, "DELETE", {});
            }
        });
    },
};
