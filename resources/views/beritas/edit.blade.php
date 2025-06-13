@extends('layouts.main')

@section('title', 'Edit Berita')

@section('content')
<div class="max-w-4xl mx-auto my-10 bg-white shadow-xl rounded-xl border border-gray-100">
    <!-- Header -->
    <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-t-xl">
        <h1 class="text-2xl font-bold text-gray-900">Edit Berita</h1>
        <p class="text-sm text-gray-600">Perbarui informasi berita di bawah ini.</p>
    </div>

    <!-- Form -->
    <div class="p-8">
        <form action="{{ route('beritas.update', $beritas->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label for="judul" class="block mb-1 font-semibold text-gray-800">Judul Berita</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $beritas->judul) }}" required
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
                @error('judul')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konten -->
            <div>
                <label for="isi" class="block mb-1 font-semibold text-gray-800">Konten Berita</label>
                <textarea id="isi" name="isi" rows="6" required
                          class="w-full border border-gray-300 px-4 py-3 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">{{ old('isi', $beritas->isi) }}</textarea>
                @error('isi')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Foto -->
            <div>
                <label for="foto" class="block mb-1 font-semibold text-gray-800">Foto Berita</label>

                @if($beritas->foto)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $beritas->foto) }}" alt="Foto berita" class="w-40 h-28 object-cover rounded border">
                        <p class="text-xs text-gray-500 mt-1">Upload foto baru untuk mengganti.</p>
                    </div>
                @endif

                <input type="file" id="foto" name="foto" accept="image/*"
                       class="w-full border border-gray-300 px-4 py-2 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500">
                @error('foto')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Penulis -->
            <div>
                <label for="user_id" class="block mb-1 font-semibold text-gray-800">Penulis</label>
                <select id="user_id" name="user_id" required
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Pilih Penulis --</option>
                    @if(isset($users) && $users->count() > 0)
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $beritas->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    @else
                        <option value="{{ $beritas->user_id }}" selected>{{ $beritas->user->name ?? 'User tidak ditemukan' }}</option>
                    @endif
                </select>
                @error('user_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                <a href="{{ route('beritas.index') }}"
                   class="px-5 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    ← Kembali
                </a>
                <button type="submit"
                        class="px-6 py-3 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
