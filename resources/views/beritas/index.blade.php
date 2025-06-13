@extends('layouts.main')

@section('title', 'Daftar Berita')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Berita Terkini</h1>
        <p class="text-gray-600">Temukan informasi terbaru dan terpercaya</p>
    </div>

    <div>
         @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="mt-6 flex justify-center py-5">
            <a href="{{ route('beritas.create') }}"
               class="px-6 py-3 bg-[#e91e63]  text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                Tambah Berita
            </a>
        </div>
    @endif
    </div>

    <!-- Tabel Berita -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
            <thead class="bg-gray-100 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 border">No</th>
                    <th class="px-4 py-3 border">Foto</th>
                    <th class="px-4 py-3 border">Judul</th>
                    <th class="px-4 py-3 border">Penulis</th>
                    <th class="px-4 py-3 border">Tanggal</th>
                    <th class="px-4 py-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($beritas as $index => $item)
                    <tr class="hover:bg-gray-50 border-t">
                        <td class="px-4 py-3 border">{{ $index + 1 }}</td>

                        <!-- Kolom Foto -->
                        <td class="px-4 py-3 border">
                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                     alt="{{ $item->judul }}"
                                     class="w-16 h-16 object-cover rounded">
                            @else
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 border">
                            <strong class="text-gray-800">{{ $item->judul }}</strong>
                            <div class="text-gray-500 text-sm">
                                {{ \Illuminate\Support\Str::limit($item->isi, 50) }}
                            </div>
                        </td>
                        <td class="px-4 py-3 border">{{ $item->user->name ?? 'Redaksi' }}</td>
                        <td class="px-4 py-3 border">{{ $item->created_at->format('d M Y') }}</td>

                        <!-- Kolom Aksi -->
                        <td class="px-4 py-3 border space-y-1 space-x-1">
                            

                            @can('update', $item)
                                <a href="{{ route('berita.edit', $item->id) }}"
                                   class="text-amber-600 hover:underline text-sm">Edit</a>
                            @endcan

                            @can('delete', $item)
                                <form action="{{ route('berita.destroy', $item->id) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:underline text-sm">Hapus</button>
                                </form>
                            @endcan

                            <button onclick="shareArticle('{{ $item->judul }}', '{{ url()->current() }}')"
                                    class="text-gray-500 hover:text-gray-700 text-sm">Bagikan</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada berita tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tombol Tambah Berita -->
   
</div>

<!-- Script Bagikan -->
<script>
    function shareArticle(title, url) {
        if (navigator.share) {
            navigator.share({ title: title, url: url });
        } else {
            navigator.clipboard.writeText(url).then(() => {
                alert('Link berhasil disalin ke clipboard!');
            });
        }
    }
</script>
@endsection
