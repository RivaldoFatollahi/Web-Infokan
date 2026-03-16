@extends('layouts.public')

@section('content')

<header class="bg-white shadow-sm" style="border-bottom: 1px solid var(--primary-light);">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-1 h-8" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);"></div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Home') }}
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

<!-- HERO / PENGUMUMAN - Improved Slider -->
<section class="max-w-7xl mx-auto mt-8 px-4">
    <div class="relative overflow-hidden rounded-2xl shadow-xl" style="box-shadow: 0 10px 15px -3px rgba(0, 150, 214, 0.2);">
        <!-- Slider container -->
        <div id="slider" class="flex transition-all duration-700 ease-in-out">
            
            @forelse ($announcement as $announ )   
            <div class="relative min-w-full">
                @if ($announ->gambar)
                    <img src="{{ asset('storage/' . $announ->gambar) }}" class="w-full h-[400px] object-cover">
                @else
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif

                <div class="absolute inset-0 bg-gradient-to-r from-[#1A4F73] to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 text-white">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold mb-3 inline-block" style="background-color: var(--primary);">
                        {{ $announ->jenis != null ? $announ->jenis : 'Pengumuman' }}
                    </span>
                    <h3 class="text-3xl font-bold mb-2">{{ $announ->judul }}</h3>
                    <p class="text-lg opacity-90 mb-0">{{ $announ->kontent }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-3">
                <div class="bg-gray-50 rounded-lg p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg mb-2">Belum ada pengumuman</p>
                    <p class="text-gray-400 text-sm">Pengumuman akan muncul di sini</p>
                </div>
            </div>
            @endforelse

            <div class="relative min-w-full">
                <img src="{{ asset('images/trotoarPalembang.jpg') }}" class="w-full h-[400px] object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-[#1A4F73] to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 text-white">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold mb-3 inline-block" style="background-color: var(--primary);">
                        Info Terkini
                    </span>
                    <h3 class="text-3xl font-bold mb-2">Laporkan Masalah di Sekitarmu</h3>
                    <p class="text-lg opacity-90 mb-0">Setiap laporan akan segera ditindaklanjuti</p>
                </div>
            </div>
            
            <div class="relative min-w-full">
                <img src="{{ asset('images/trotoarPalembang.jpg') }}" class="w-full h-[400px] object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-[#1A4F73] to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 text-white">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold mb-3 inline-block" style="background-color: var(--primary);">
                        Kolaborasi
                    </span>
                    <h3 class="text-3xl font-bold mb-2">Bersama Membangun Kota</h3>
                    <p class="text-lg opacity-90 mb-0">Partisipasi aktif warga untuk perubahan</p>
                </div>
            </div>
        </div>

        <!-- Slider dots -->
        <div class="absolute bottom-4 right-0 left-0 flex justify-center gap-2 z-10">
            <button class="slider-dot active" onclick="currentSlide(0)"></button>
            <button class="slider-dot" onclick="currentSlide(1)"></button>
            <button class="slider-dot" onclick="currentSlide(2)"></button>
        </div>

        <!-- Navigation buttons -->
        <button onclick="prevSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/30 hover:bg-white/50 rounded-full p-2 backdrop-blur-sm transition-all duration-300">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/30 hover:bg-white/50 rounded-full p-2 backdrop-blur-sm transition-all duration-300">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>
</section>

<!-- LAPORAN WARGA - Improved Cards -->
<section class="max-w-7xl mx-auto mt-12 px-4">
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-3">
            <div class="w-1 h-6" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);"></div>
            <h3 class="text-lg font-semibold text-gray-800">
                Laporan Warga Terbaru
            </h3>
        </div>
        
        <!-- Filter buttons -->
        <div class="flex gap-2">
            <button class="filter-btn px-3 py-1 rounded-full text-sm font-medium active" data-filter="semua">
                Semua
            </button>

            <button class="filter-btn px-3 py-1 rounded-full text-sm font-medium" data-filter="positif">
                Positif
            </button>

            <button class="filter-btn px-3 py-1 rounded-full text-sm font-medium" data-filter="negatif">
                Negatif
            </button>

            <button class="filter-btn px-3 py-1 rounded-full text-sm font-medium" data-filter="netral">
                Netral
            </button>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        {{-- apus forloopnya kalo datanya udah banyak, ini buat liat btn Load All --}}
        @for ($i = 1; $i <= 9; $i++)
            @forelse($reports as $report)
            <div class="card-laporan bg-white rounded-xl overflow-hidden" data-sentimen="{{ $report->sentimen }}">
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
                            Laporan Warga
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
                    
                    <!-- Judul -->
                    <h4 class="font-semibold text-gray-800 mb-2 line-clamp-2">
                        {{ $report->judul }}
                    </h4>
                    
                    <!-- Konten -->
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2" title="{{ $report->kontent }}">
                        {{ Str::limit($report->kontent, 80) }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-3">
                <div class="bg-gray-50 rounded-lg p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg mb-2">Belum ada laporan warga</p>
                    <p class="text-gray-400 text-sm">Jadilah yang pertama membuat laporan</p>
                </div>
            </div>
            @endforelse
        @endfor
    </div>

    <!-- EMPTY STATE UNTUK FILTER -->
    <div id="emptyState" class="hidden col-span-3">
        <div class="bg-gray-50 rounded-lg p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-gray-500 text-lg mb-2">Belum ada laporan warga</p>
            <p class="text-gray-400 text-sm">Jadilah yang pertama membuat laporan</p>
        </div>
    </div>
    
    <!-- Load more button -->
    @if($reports->count() > 0)
    <div class="text-center mt-8 mb-20">
        <button class="btn-outline-primary" id="loadAllBtn">
            Muat Lebih Banyak
        </button>
    </div>
    @endif

</section>

<!-- MODAL INPUT LAPORAN - Improved Design -->
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

<!-- SCRIPT - Improved -->
<script>
    // Modal functions
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
    }

    // Slider variables
    let currentIndex = 0;
    const slides = document.querySelectorAll('#slider > div');
    const dots = document.querySelectorAll('.slider-dot');
    const slider = document.getElementById('slider');
    let slideInterval;

    // Fungsi untuk pindah slide
    function goToSlide(index) {
        if (index < 0) index = slides.length - 1;
        if (index >= slides.length) index = 0;
        
        currentIndex = index;
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        
        // Update dots
        dots.forEach((dot, i) => {
            if (i === currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    function nextSlide() {
        goToSlide(currentIndex + 1);
    }

    function prevSlide() {
        goToSlide(currentIndex - 1);
    }

    function currentSlide(index) {
        goToSlide(index);
    }

    // Auto play
    function startAutoPlay() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    function stopAutoPlay() {
        clearInterval(slideInterval);
    }

    // Filter Buttons
    const filterButtons = document.querySelectorAll('.filter-btn');
    const laporanCards = document.querySelectorAll('.card-laporan');
    const emptyState = document.getElementById('emptyState');
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.dataset.filter;
            let visibleCount = 0;

            laporanCards.forEach(card => {
                const sentimen = card.dataset.sentimen;

                if(filter === 'semua' || sentimen === filter){
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // cek apakah ada card yang tampil  
            if(visibleCount === 0){
                emptyState.classList.remove('hidden');
            }else{
                emptyState.classList.add('hidden');
            }
        });
    });

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {

            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

        });
    });

    // Initialize slider
    document.addEventListener('DOMContentLoaded', function() {
        goToSlide(0);
        startAutoPlay();

        // Hentikan auto play saat hover di slider
        const sliderContainer = document.querySelector('.relative.overflow-hidden');
        sliderContainer.addEventListener('mouseenter', stopAutoPlay);
        sliderContainer.addEventListener('mouseleave', startAutoPlay);
    });

    // Preview image before upload
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

    // See All Reports Button
    const loadBtn = document.getElementById('loadAllBtn');
    const cards = document.querySelectorAll('.card-laporan');
    const gridReport = document.querySelector('.grid');
    const visible = 3;
    let expand = false;   

    function updateCards() {
        cards.forEach((card, index) => {
            if(!expand){
                card.style.display = index < visible ? "block" : "none";
            }else{
                card.style.display = "block";
            }
        });
    }

    updateCards();
    loadBtn.addEventListener('click', () => {
        expand = !expand;

        if(expand){
            loadBtn.textContent = "Muat Lebih Sedikit";
        }else{
            loadBtn.textContent = "Muat Lebih Banyak";
            window.scrollTo({
                top: gridReport.offsetTop - 120,
                behavior: "smooth"
            });
        }
        updateCards();
    });


    // Close modal when clicking outside
    document.getElementById('reportModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Prevent modal close when clicking inside modal content
    document.getElementById('modalContent').addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>
@endsection