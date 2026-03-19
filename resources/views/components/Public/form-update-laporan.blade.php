<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl w-[550px] max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0" id="modalContentEdit">
        <!-- Modal Header -->
        <div class="p-6 pb-0 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-8" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);"></div>
                    <h3 class="text-xl font-semibold text-gray-800">
                        Edit Laporan
                    </h3>
                </div>
                <button onclick="closeModalEdit()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="text-sm text-gray-500 mt-2">
                Ada yang mau diperbaiki dari laporan anda? Yuk diedit!
            </p>
        </div>

        <!-- Modal Body -->
        <form id="formEdit" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Laporan
                </label>
                <input type="text" name="judul" id="editJudul" required
                       placeholder="Contoh: Jalan Berlubang di Jl. Sudirman"
                       class="w-full border border-gray-300 rounded-lg p-1 px-2 text-sm focus:outline-none focus:ring-2 transition-all"
                       style="focus:ring-color: var(--primary-light);">
            </div>

            <!-- Isi Laporan -->
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Isi Laporan
                </label>
                <textarea name="kontent" id="editKontent" required rows="4"
                          placeholder="Jelaskan secara detail kejadian atau kondisi yang ingin dilaporkan..."
                          class="w-full border border-gray-300 rounded-lg p-1 px-2 text-sm focus:outline-none focus:ring-2 transition-all"></textarea>
            </div>

            <!-- Sentimen -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Sentimen Laporan
                </label>
                <select name="sentimen" id="editSentimen" required
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
                    onclick="document.getElementById('editGambar').click()">
                    <svg class="w-5 h-5 mx-0 text-gray-400 mb-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span id="fileNameEdit" class="text-sm text-gray-500">
                        Klik untuk upload gambar
                    </span>
                    <input type="file" name="gambar" id="editGambar" class="hidden" accept="image/*">
                </div>

                <div id="editImg" class="hidden mt-3">
                    <img id="previewEditImg" class="w-full h-48 object-cover rounded-lg border">
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" id="resetFormBtn" onclick="closeModalEdit()"
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