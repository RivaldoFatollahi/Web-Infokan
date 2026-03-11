<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold fs-4 mb-0">
                Penduduk
            </h2>

            <a href="" class="btn btn-primary btn-sm">
                + Tambah User
            </a>
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
                                <a href="" class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <a href="" class="btn btn-sm btn-danger">
                                    Hapus
                                </a>
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
</x-app-layout>
