@extends('layouts.main')

@section('title', 'Tambah Berita')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-6 bg-white shadow-2xl rounded-3xl border border-gray-100">
    <!-- Heading -->
    <div class="mb-10 text-center">
        <h1 class="text-3xl font-extrabold text-indigo-700">📰 Tambah Berita Baru</h1>
        <p class="text-gray-600 text-sm mt-2">Silakan lengkapi form di bawah untuk menambahkan konten berita.</p>
    </div>

    <!-- Form -->
    <form action="{{ route('beritas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Judul -->
        <div>
            <label for="judul" class="block mb-1 font-semibold text-gray-800">Judul Berita</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                   placeholder="Contoh: Pemerintah Resmi Mengumumkan..."
                   class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500">
            @error('judul')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Isi Berita -->
        <div>
            <label for="isi" class="block mb-1 font-semibold text-gray-800">Konten Berita</label>
            <textarea name="isi" id="isi" rows="6"
                      class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 resize-none"
                      placeholder="Tuliskan isi lengkap dari berita...">{{ old('isi') }}</textarea>
            @error('isi')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Upload Foto -->
        <div>
            <label for="foto" class="block mb-2 font-semibold text-gray-800">Foto Berita</label>
            <div class="flex items-center gap-4">
                <div class="w-24 h-24 border border-gray-300 bg-gray-50 rounded-lg flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 15a4 4 0 001 7h16a4 4 0 000-8h-1l-2-3.5a2 2 0 00-3.4-.5L11 11l-1-1.5a2 2 0 00-3.4.5L3 15z"/>
                    </svg>
                </div>
                <input type="file" name="foto" id="foto" accept=".jpg,.jpeg,.png"
                       class="block w-full text-sm text-gray-600 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
            @error('foto')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pilih Penulis -->
        <div>
            <label for="user_id" class="block mb-1 font-semibold text-gray-800">Penulis</label>
            <select name="user_id" id="user_id" required
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500">
                <option value="">-- Pilih Penulis --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <a href="{{ url()->previous() }}"
               class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                ← Kembali
            </a>
            <button type="submit"
                    class="px-6 py-3 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition">
                Simpan Berita
            </button>
        </div>
    </form>
</div>
@endsection
