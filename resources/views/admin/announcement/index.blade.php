<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold fs-4 mb-0">
                Pengumuman
            </h2>

            <button onclick="openModal()" class="btn btn-primary btn-sm">
                Buat Pengumuman
            </button>
        </div>
    </x-slot>

    <div class="container py-4">

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Daftar User</span>
                <small class="text-muted">
                    Total Pengumuman: {{ $totalPengumuman }}
                </small>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Judul Pengumuman</th>
                            <th>Pengumuman</th>
                            <th>Gambar</th>
                            <th>Tanggal</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($Pengumuman ?? [] as $P)
                            <tr>
                                <td>{{ $P->judul }}</td>
                                <td>{{ $P->kontent }}</td>
                                <td><img src="{{ asset('storage/' . $P->gambar) }}" width="100"></td>
                                <td>{{ $P->created_at->format('d M Y') }}</td>

                                <td>
                                    <button onclick="editModal({{ json_encode($P) }})" class="btn btn-sm btn-warning">
                                        Edit
                                    </button>

                                    <button onclick="deleteModal({{ $P->id }})" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    Belum ada data user
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/crudHelper.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function openModal() {
                CrudHelper.showForm({
                    title: 'Tambah Pengumuman',
                    url: '/admin/announcements',
                    method: 'POST',
                    html: `
                <div class="text-start px-2">
                    <label class="small fw-bold">Judul</label>
                    <input id="judul" type="text" class="form-control mb-2">
                    <label class="small fw-bold">Kontent</label>
                    <input id="kontent" type="text" class="form-control mb-2">
                    <label class="small fw-bold">Gambar / Foto</label>
                    <input id="gambar" type="file" class="form-control mb-2" accept="image/*">
                </div>`
                });
            }

            function editModal(P) {
                CrudHelper.showForm({
                    title: 'Edit Penduduk',
                    url: `/admin/announcements/${P.id}`,
                    method: 'PUT',
                    html: `
                    <div class="text-start px-2">
                    <label class="small fw-bold">Nomor Rumah</label>
                    <input id="no_rumah" type="text" class="form-control mb-2" value="${P.no_rumah}">
                    <label class="small fw-bold">Pemilik Rumah</label>
                    <input id="pemilik_rumah" type="text" class="form-control mb-2" value="${p.pemilik_rumah}">
                    <label class="small fw-bold">Alamat</label>
                    <input id="alamat" type="text" class="form-control mb-2" value="${p.alamat}">
                </div>`
                });
            }

            function deleteModal(id) {
                CrudHelper.confirmDelete(`/admin/announcements/${id}`);
            }
        </script>
    @endpush

</x-app-layout>
