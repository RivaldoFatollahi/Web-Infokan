<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold fs-4 mb-0">
                Rumah - Rumah
            </h2>

            <button onclick="openModal()" class="btn btn-primary btn-sm">
                + Tambah Rumah
            </button>
        </div>
    </x-slot>

    <div class="container py-4">

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Daftar Rumah</span>
                <small class="text-muted">
                    Total: {{ $totalHouses }}
                </small>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nomor Rumah</th>
                            <th>Pemilik Rumah</th>
                            <th>Alamat</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($Houses ?? [] as $house)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $house->no_rumah }}
                                </td>

                                <td>
                                    {{ $house->pemilik_rumah }}
                                </td>

                                <td>
                                    {{ $house->alamat ?? '-' }}
                                </td>

                                <td>
                                    <button onclick="editModal({{ json_encode($house) }})"
                                        class="btn btn-sm btn-warning">
                                        Edit
                                    </button>

                                    <button onclick="deleteModal({{ $house->id }})" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    Belum ada data Rumah
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
                    title: 'Tambah Rumah',
                    url: '/admin/houses',
                    method: 'POST',
                    html: `
                <div class="text-start px-2">
                    <label class="small fw-bold">Nomor Rumah</label>
                    <input id="no_rumah" class="form-control mb-2">
                    <label class="small fw-bold">Pemilik Rumah</label>
                    <input id="pemilik_rumah" type="text" class="form-control mb-2">
                    <label class="small fw-bold">Alamat</label>
                    <input id="alamat" type="text" class="form-control mb-2">
                </div>`
                });
            }

            function editModal(house) {
                CrudHelper.showForm({
                    title: 'Edit Penduduk',
                    url: `/admin/houses/${house.id}`,
                    method: 'PUT',
                    html: `
                    <div class="text-start px-2">
                    <label class="small fw-bold">Nomor Rumah</label>
                    <input id="no_rumah" type="text" class="form-control mb-2" value="${house.no_rumah}">
                    <label class="small fw-bold">Pemilik Rumah</label>
                    <input id="pemilik_rumah" type="text" class="form-control mb-2" value="${house.pemilik_rumah}">
                    <label class="small fw-bold">Alamat</label>
                    <input id="alamat" type="text" class="form-control mb-2" value="${house.alamat}">
                </div>`
                });
            }

            function deleteModal(id) {
                CrudHelper.confirmDelete(`/admin/houses/${id}`);
            }
        </script>
    @endpush
</x-app-layout>
