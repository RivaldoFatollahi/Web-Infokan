<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold fs-4 mb-0 text-dark">Detail Laporan #{{ $report->id }}</h2>
            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge bg-soft-warning text-warning mb-2 px-3 py-2">
                                    {{ strtoupper($report->sentimen ?? 'Laporan') }}
                                </span>
                                <h3 class="fw-bold mb-1">{{ $report->judul }}</h3>
                                <p class="text-muted small">
                                    Dilaporkan oleh <strong>{{ $report->user->nama }}</strong> • {{ $report->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <hr class="text-muted opacity-25">
                        <div class="report-content py-2" style="line-height: 1.6; font-size: 1.1rem;">
                            {{ $report->kontent }}
                        </div>

                        @if($report->gambar)
                        <div class="mt-3">
                            <img src="{{ asset('storage/'.$report->gambar) }}" class="img-fluid rounded-3 shadow-sm" style="max-height: 400px;">
                        </div>
                        @endif
                    </div>
                    <div class="card-footer bg-light border-0 p-3 d-flex justify-content-between">
                        <button onclick="replyComment({{ $report->id }})" class="btn btn-primary">
                            <i class="bi bi-reply"></i> Balas Laporan
                        </button>
                    </div>
                </div>

                <h5 class="fw-bold mb-3 mt-5">Diskusi & Balasan</h5>
                <div class="replies-container">
                    @forelse($report->replies->where('parent_id', null) as $reply)
                        @include('admin.reports.partials.reply', ['reply' => $reply, 'level' => 0])
                    @empty
                        <div class="text-center py-5 bg-white rounded-3 shadow-sm">
                            <p class="text-muted mb-0">Belum ada balasan untuk laporan ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                    <div class="card-header bg-white fw-bold border-0 pt-3">Informasi Pelapor</div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                {{ substr($report->user->nama, 0, 1) }}
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $report->user->nama }}</h6>
                                <small class="text-muted">Warga / User</small>
                            </div>
                        </div>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-muted">Email:</span>
                                <span>{{ $report->user->email }}</span>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-muted">Terdaftar:</span>
                                <span>{{ $report->user->created_at->format('M Y') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function replyComment(idLaporan, parentId = null) {
            Swal.fire({
                title: 'Tulis Balasan',
                input: 'textarea',
                inputAttributes: { 'rows': 4 },
                inputPlaceholder: 'Ketik pesan balasan di sini...',
                showCancelButton: true,
                confirmButtonText: 'Kirim Balasan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#0d6efd'
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    fetch('/admin/reports/reply', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            report_id: idLaporan,
                            parent_id: parentId,
                            message: result.value
                        })
                    }).then(res => res.json())
                    .then(data => {
                        if(data.success) location.reload();
                    });
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
