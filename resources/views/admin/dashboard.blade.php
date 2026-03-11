<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-4">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="container py-4">

        {{-- Statistik --}}
        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Warga</h6>
                        <h3 class="fw-bold">{{ $totalUsers ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Rumah</h6>
                        <h3 class="fw-bold">{{ $totalHouses ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Laporan</h6>
                        <h3 class="fw-bold">{{ $totalReports ?? 0 }}</h3>
                    </div>
                </div>
            </div>

        </div>


        {{-- Laporan Terbaru --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-semibold">
                Laporan Terbaru
            </div>

            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Pelapor</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($reports ?? [] as $report)
                        <tr>
                            <td>{{ $report->judul }}</td>
                            <td>{{ $report->user->nama ?? '-' }}</td>
                            <td>
                                <span class="badge bg-warning">
                                    {{ $report->sentimen }}
                                </span>
                            </td>
                            <td>{{ $report->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Belum ada laporan
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
