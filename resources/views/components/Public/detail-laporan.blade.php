<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl w-[550px] max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0" id="detailModalContent">
        <!-- Modal Header -->
        <div class="p-6 pb-0 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-8" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);"></div>
                    <h3 class="text-xl font-semibold text-gray-800">
                        Detail Laporan
                    </h3>
                </div>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="text-sm text-gray-500 mt-2">
                Informasi lengkap laporan yang kamu buat
            </p>
        </div>

        <!-- Modal Body - Content Detail -->
        <div class="p-6">
            <!-- Gambar -->
            <div class="mb-4">
                <img id="detailGambar" src="" alt="Gambar Laporan" class="w-full h-64 object-cover rounded-lg border border-gray-200 hidden">
                <div id="detailNoGambar" class="w-full h-64 bg-gray-100 flex items-center justify-center rounded-lg border border-gray-200">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-gray-400 text-sm ml-2">Tidak ada gambar</span>
                </div>
            </div>

            <!-- Badge Sentimen & Tanggal -->
            <div class="flex items-center gap-2 mb-4">
                <span class="text-xs font-medium px-2 py-1 rounded" 
                    style="background-color: var(--primary-light); color: var(--white);">
                    Laporan Saya
                </span>
                <span id="detailSentimen" class="text-xs font-medium px-2 py-1 rounded badge-sentimen"></span>
                <span id="detailTanggal" class="text-xs text-gray-400"></span>
            </div>

            <!-- Judul -->
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Judul Laporan
                </label>
                <p id="detailJudul" class="text-gray-800 font-semibold text-base"></p>
            </div>

            <!-- Isi Laporan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Isi Laporan
                </label>
                <p id="detailKontent" class="text-gray-600 text-sm leading-relaxed whitespace-pre-wrap"></p>
            </div>
        </div>

        <!-- Modal Footer - Hanya Tombol Close -->
        <div class="p-6 pt-0 border-t border-gray-100">
            <div class="flex justify-end">
                <button onclick="closeDetailModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>