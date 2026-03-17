<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold fs-4 mb-0">
                Penduduk
            </h2>

            <button onclick="openModal()" class="btn btn-primary btn-sm">
                + Tambah User
            </button>
        </div>
    </x-slot>

    <div class="container py-4">

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Daftar User</span>
                <small class="text-muted">
                    Total User: {{ $totalUsers }}
                </small>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Rumah</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($Users ?? [] as $user)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $user->nama }}
                                </td>

                                <td>
                                    {{ $user->email }}
                                </td>

                                <td>
                                    {{ $user->rumah->no_rumah ?? '-' }}
                                </td>

                                <td>
                                    <button onclick='editModal(@json($user))'
                                        class="btn btn-sm btn-warning">Edit</button>

                                    <button onclick="deleteUser({{ $user->id }})" class="btn btn-sm btn-danger">
                                        Delete
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
                    title: 'Tambah Penduduk',
                    url: '/admin/users',
                    method: 'POST',
                    html: `
                <div class="text-start px-2">
                    <label class="small fw-bold">Nama</label>
                    <input id="nama" class="form-control mb-2">
                    <label class="small fw-bold">Email</label>
                    <input id="email" type="email" class="form-control mb-2">
                    <label class="small fw-bold">Password</label>
                    <input id="password" type="password" class="form-control mb-2">
                    <label class="small fw-bold">Role</label>
                    <select id="id_role" class="form-select mb-2">
                        <option value="" disabled selected hidden ></option>
                        @foreach ($Role as $r) <option value="{{ $r->id }}">{{ $r->role }}</option> @endforeach
                    </select>
                    <label class="form-label fw-bold small">No. Rumah</label>
                     <select id="id_rumah" class="form-select">
                         <option value="" disabled selected hidden ></option>
                         @foreach ($Rumah as $R)
                             <option value="{{ $R->id }}">{{ $R->no_rumah }}</option>
                        @endforeach
                     </select>
                </div>`
                });
            }

            function editModal(user) {
                CrudHelper.showForm({
                    title: 'Edit Penduduk',
                    url: `/admin/users/${user.id}`,
                    method: 'PUT',
                    html: `
                <div class="text-start px-2">
                    <label class="small fw-bold">Nama</label>
                    <input id="nama" class="form-control mb-2" value="${user.nama}">
                    <label class="small fw-bold">Email</label>
                    <input id="email" class="form-control mb-2" value="${user.email}">
                    <label class="small fw-bold">Role</label>
                    <select id="id_role" class="form-select mb-2">
                        @foreach ($Role as $r) <option value="{{ $r->id }}">{{ $r->role }}</option> @endforeach
                    </select>
                    <label class="small fw-bold">No Rumah</label>
                    <select id="id_rumah" class="form-select mb-2">
                        @foreach ($Rumah as $R) <option value="{{ $R->id }}">{{ $R->no_rumah }}</option> @endforeach
                    </select>
                </div>`,
                    didOpen: () => {
                        // Pastikan ID 'id_role' ada di dalam html di atas
                        document.getElementById('id_role').value = user.id_role;
                    }
                });
            }

            function deleteUser(id) {
                CrudHelper.confirmDelete(`/admin/users/${id}`);
            }
        </script>
    @endpush

</x-app-layout>
