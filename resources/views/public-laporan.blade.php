@extends('layouts.public')
@section('content')

<header class="bg-white shadow-sm" style="border-bottom: 1px solid var(--primary-light);">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-1 h-8" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);"></div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Laporan Saya
            </h2>
        </div>

        <button onclick="openModal()" class="btn-primary flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Laporan
        </button>
    </div>
</header>

<!-- FILTER SECTION -->
<section class="max-w-7xl mx-auto mt-4 px-4">
    <div class="flex flex-col sm:flex-row gap-3 items-center justify-between">
        <!-- Search Box -->
        <div class="relative w-full sm:w-96">
            <input type="text" 
                   id="searchInput"
                   placeholder="Cari laporan..." 
                   class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 transition-all"
                   style="focus:ring-color: var(--primary-light);">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <!-- Filter Sentimen -->
        <div class="flex gap-2">
            <button class="filter-btn px-3 py-1 rounded-full text-sm font-medium active" data-filter="semua">
                Semua
            </button>
            <button class="filter-btn px-3 py-1 rounded-full text-sm font-medium" data-filter="positif">
                Positif
            </button>
            <button class="filter-btn px-3 py-1 rounded-full text-sm font-medium" data-filter="netral">
                Netral
            </button>
            <button class="filter-btn px-3 py-1 rounded-full text-sm font-medium" data-filter="negatif">
                Negatif
            </button>
        </div>
    </div>
</section>

<!-- GRID CARDS -->
<section class="max-w-7xl mx-auto mt-4 px-4">
    <div class="grid md:grid-cols-3 gap-6" id="laporanGrid">
        @foreach($reports as $report)
        <div class="card-laporan bg-white rounded-xl overflow-hidden" 
            data-sentimen="{{ $report->sentimen }}"
            data-judul="{{ strtolower($report->judul) }}"
            data-kontent="{{ strtolower($report->kontent) }}">
        
            <div class="relative">
                @if($report->gambar)
                    <img src="{{ asset('storage/' . $report->gambar) }}" 
                        class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>
            
            <!-- Content -->
            <div class="p-3">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs font-medium px-2 py-1 rounded" 
                        style="background-color: var(--primary-light); color: var(--white);">
                        Laporan Saya
                    </span>

                    @if($report->sentimen == 'positif')
                        <span class="text-xs font-medium px-2 py-1 rounded badge-sentimen badge-positif">
                            Positif
                        </span>
                    @elseif($report->sentimen == 'negatif')
                        <span class="text-xs font-medium px-2 py-1 rounded badge-sentimen badge-negatif">
                            Negatif
                        </span>
                    @else
                        <span class="text-xs font-medium px-2 py-1 rounded badge-sentimen badge-netral">
                            Netral
                        </span>
                    @endif

                    <span class="text-xs text-gray-400">
                        {{ $report->created_at->format('d M Y') }}
                    </span>
                </div>
                
                <h4 class="font-semibold text-gray-800 mb-2 line-clamp-2">
                    {{ $report->judul }}
                </h4>
                
                <p class="text-gray-600 text-sm mb-3 line-clamp-2" title="{{ $report->kontent }}">
                    {{ Str::limit($report->kontent, 80) }}
                </p>

                <div class="flex items-center gap-2 mt-2">
                    <button onclick="openModalDetail({{ json_encode($report) }})" type="button" class="btn-primary flex-1 text-sm font-medium text-center no-underline" 
                       style="flex: 4;"> 
                        Detail Berita
                    </button>
                    
                    <div class="relative action-dropdown" style="flex: 1;">
                        <button onclick="toggleDropdown(this)" 
                                class="w-full bg-gray-50 hover:bg-gray-100 text-gray-700 py-2 px-2 rounded-lg transition-all duration-300 border border-gray-200 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 bottom-full mb-2 w-36 bg-white rounded-lg shadow-md py-1 z-10 hidden border">
                            <button onclick="openModalEdit({{ json_encode($report) }})"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#0096D6] hover:text-white flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>
                            <button onclick="confirmDelete('{{ $report->id }}')" 
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-500 hover:text-white flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                        </div>
                        
                        {{-- form delete --}}
                        <form id="delete-form-{{ $report->id }}" 
                            action="{{ route('reports.destroy', $report->id) }}" 
                            method="POST" 
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="hidden col-span-3">
        <div class="bg-gray-50 rounded-lg p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-gray-500 text-lg mb-2">Belum ada laporan yang kamu buat</p>
            <p class="text-gray-400 text-sm mb-4">Yuk buat laporan pertamamu sekarang!</p>
            <button onclick="openModal()" class="btn-primary flex items-center gap-2 mx-auto">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Laporan Baru
            </button>
        </div>
    </div>

    <!-- PAGINATION -->
    <div class="flex justify-center mt-10 mb-16">
        {{ $reports->links() }}
    </div>
</section>

<!-- MODAL INPUT -->
<div id="reportModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl w-[550px] max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <!-- Modal Header -->
        <div class="p-6 pb-0 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-8" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);"></div>
                    <h3 class="text-xl font-semibold text-gray-800">
                        Buat Laporan Baru
                    </h3>
                </div>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="text-sm text-gray-500 mt-2">
                Bagikan informasi atau keluhan Anda kepada warga sekitar
            </p>
        </div>

        <!-- Modal Body -->
        <form action="{{ route('reports.store') }}" id="formReport" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <!-- Judul -->
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Laporan
                </label>
                <input type="text" name="judul" required
                       placeholder="Contoh: Jalan Berlubang di Jl. Sudirman"
                       class="w-full border border-gray-300 rounded-lg p-1 px-2 text-sm focus:outline-none focus:ring-2 transition-all"
                       style="focus:ring-color: var(--primary-light);">
            </div>

            <!-- Isi Laporan -->
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Isi Laporan
                </label>
                <textarea name="kontent" required rows="4"
                          placeholder="Jelaskan secara detail kejadian atau kondisi yang ingin dilaporkan..."
                          class="w-full border border-gray-300 rounded-lg p-1 px-2 text-sm focus:outline-none focus:ring-2 transition-all"></textarea>
            </div>

            <!-- Sentimen -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Sentimen Laporan
                </label>
                <select name="sentimen" required
                        class="w-full border border-gray-300 rounded-lg text-sm p-1 px-2 focus:outline-none focus:ring-2 transition-all">
                    <option value="" disabled selected>Pilih sentimen laporan</option>
                    <option value="positif" class="text-green-600">Positif</option>
                    <option value="netral" class="text-gray-600">Netral</option>
                    <option value="negatif" class="text-red-600">Negatif</option>
                </select>
            </div>

            <!-- Upload Gambar -->
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Upload Gambar (Opsional)
                </label>

                <div class="border-2 border-dashed border-gray-300 rounded-lg p-1 px-2 gap-2 flex items-center cursor-pointer hover:border-blue-400"
                    onclick="document.getElementById('gambar').click()">
                    <svg class="w-5 h-5 mx-0 text-gray-400 mb-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span id="fileName" class="text-sm text-gray-500">
                        Klik untuk upload gambar
                    </span>
                    <input type="file" name="gambar" id="gambar" class="hidden" accept="image/*">
                </div>

                <div id="imagePreview" class="hidden mt-3">
                    <img id="previewImg" class="w-full h-48 object-cover rounded-lg border">
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" id="resetFormBtn" onclick="closeModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit"
                        class="px-6 py-2 text-white rounded-lg transition-all duration-300 hover:shadow-lg"
                        style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal edit & detail -->
@include('components.public.form-update-laporan')
@include('components.public.detail-laporan')

<!-- SCRIPT UNTUK INTERAKSI -->
<script>
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;

        document.querySelectorAll('.action-dropdown > div').forEach(el => {
            if (el !== dropdown) {
                el.classList.add('hidden');
            }
        });
        dropdown.classList.toggle('hidden');
    }

    // Confirm delete
    function confirmDelete(id) {
        console.log("KONTOOOLLLL ini btn di klik jiinggg");
        Swal.fire({
            title: 'Yakin mau hapus?',
            text: "Data yang dihapus nggak bisa balik lagi lho!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn-danger',
                cancelButton: 'btn-primary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Filter buttons
    const filterButtons = document.querySelectorAll('.filter-btn');
    const laporanCards = document.querySelectorAll('.card-laporan');
    const emptyState = document.getElementById('emptyState');
    const searchInput = document.getElementById('searchInput');
    function filterCards() {
        const activeFilter = document.querySelector('.filter-btn.active').dataset.filter;
        const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
        let visibleCount = 0;

        laporanCards.forEach(card => {
            const sentimen = card.dataset.sentimen;
            const judul = card.dataset.judul;
            const kontent = card.dataset.kontent;
            
            // Filter sentimen
            const matchSentimen = activeFilter === 'semua' || sentimen === activeFilter;
            
            // Filter search
            const matchSearch = searchTerm === '' || 
                               judul.includes(searchTerm) || 
                               kontent.includes(searchTerm);
            
            if (matchSentimen && matchSearch) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide empty state
        if (visibleCount === 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }

    // Filter button click
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            filterCards();
        });
    });
    if (searchInput) {
        searchInput.addEventListener('input', filterCards);
    }
    filterCards();

    // Add Modal
    function openModal(){
        const modal = document.getElementById('reportModal');
        const modalContent = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Animasi muncul
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    // Close Add Modal
    function closeModal(){
        const modal = document.getElementById('reportModal');
        const form = document.getElementById('formReport');
        const modalContent = document.getElementById('modalContent');
        const previewImg = document.getElementById('previewImg');
        const imagePreview = document.getElementById('imagePreview');
        const fileName = document.getElementById('fileName');
        
        // Animasi tutup
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        if(form) form.reset();
        if(previewImg) previewImg.src = '';
        if(imagePreview) imagePreview.classList.add('hidden');
        if(fileName) fileName.textContent = 'Klik untuk upload gambar';
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    };

    // Preview image Add Modal
    const gambarInput = document.getElementById('gambar');
    const previewImg = document.getElementById('previewImg');
    const imagePreview = document.getElementById('imagePreview');
    const fileName = document.getElementById('fileName');
    if(gambarInput){
        gambarInput.addEventListener('change', function(){
            const file = this.files[0];

            if(file){
                // tampilkan nama file
                fileName.textContent = file.name;
                const reader = new FileReader();

                reader.onload = function(e){
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Edit Modal
    function openModalEdit(report) {
        const modal = document.getElementById('modalEdit');
        const content = document.getElementById('modalContentEdit');
        const form = document.getElementById('formEdit');

        // set action form
        form.action = `/reports/${report.id}`;

        // isi input
        document.getElementById('editJudul').value = report.judul ?? '';
        document.getElementById('editKontent').value = report.kontent ?? '';
        document.getElementById('editSentimen').value = report.sentimen ?? '';

        // handle gambar lama
        if (report.gambar) {
            const imageUrl = `/storage/${report.gambar}`;

            document.getElementById('previewEditImg').src = imageUrl;
            document.getElementById('editImg').classList.remove('hidden');
            document.getElementById('fileNameEdit').innerText = 'Gambar saat ini: ' + imageUrl.split('/').pop();
        } else {
            document.getElementById('editImg').classList.add('hidden');
            document.getElementById('previewEditImg').src = '';
            document.getElementById('fileNameEdit').innerText = 'Klik untuk upload gambar';
        }

        // reset input file (penting biar ga nyangkut)
        document.getElementById('editGambar').value = '';

        // tampilkan modal + animasi
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    // Close Edit Modal
    function closeModalEdit() {
        const modal = document.getElementById('modalEdit');
        const content = document.getElementById('modalContentEdit');

        // animasi keluar
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');

            // reset gambar preview
            document.getElementById('editGambar').value = '';
            document.getElementById('previewEditImg').src = '';
            document.getElementById('editImg').classList.add('hidden');
            document.getElementById('fileNameEdit').innerText = 'Klik untuk upload gambar';
        }, 200);
    }

    // Preview image Edit Modal
    document.getElementById('editGambar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // update nama file
            document.getElementById('fileNameEdit').innerText = file.name;

            // preview gambar
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewEditImg').src = e.target.result;
                document.getElementById('editImg').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Detail Modal
    function openModalDetail(report) {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('detailModalContent');
        
        // Set data ke modal
        document.getElementById('detailJudul').textContent = report.judul ?? '';
        document.getElementById('detailKontent').textContent = report.kontent ?? '';
        document.getElementById('detailTanggal').textContent = new Date(report.created_at).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
        
        // Set badge sentimen
        const sentimenBadge = document.getElementById('detailSentimen');
        if (report.sentimen === 'positif') {
            sentimenBadge.textContent = 'Positif';
            sentimenBadge.className = 'text-xs font-medium px-2 py-1 rounded badge-sentimen badge-positif';
        } else if (report.sentimen === 'negatif') {
            sentimenBadge.textContent = 'Negatif';
            sentimenBadge.className = 'text-xs font-medium px-2 py-1 rounded badge-sentimen badge-negatif';
        } else {
            sentimenBadge.textContent = 'Netral';
            sentimenBadge.className = 'text-xs font-medium px-2 py-1 rounded badge-sentimen badge-netral';
        }
        
        // Set gambar
        const gambarElement = document.getElementById('detailGambar');
        const noGambarElement = document.getElementById('detailNoGambar');

       if (report.gambar) {
            let gambarUrl = `/storage/${report.gambar}`;

            gambarElement.src = gambarUrl;
            gambarElement.classList.remove('hidden');
            noGambarElement.classList.add('hidden');
        } else {
            gambarElement.classList.add('hidden');
            noGambarElement.classList.remove('hidden');
        }
        
        // Tampilkan modal dengan animasi
        modal.classList.remove('hidden');
        modal.classList.add('flex');        
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    // Close Detail Modal
    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('detailModalContent');
        
        // Animasi tutup
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.action-dropdown')) {
            document.querySelectorAll('.action-dropdown > div').forEach(el => {
                el.classList.add('hidden');
            });
        }
    });

    window.addEventListener('click', function(e) {
        const modal = document.getElementById('modalEdit');
        if (e.target === modal) {
            closeModalEdit();
        }
    });

     document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetailModal();
        }
    });
</script>
@endsection