@extends('layouts.main')

@section('title', 'Daftar Berita')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Berita Terkini</h1>
            <p class="text-gray-600">Temukan informasi terbaru dan terpercaya</p>
        </div>

        <!-- News Grid -->
        <div class="grid gap-8 md:gap-6">
            @foreach ($beritas as $item)
                <article
                    class="group bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg hover:border-gray-200 transition-all duration-300 overflow-hidden">
                    <div class="md:flex">
                        <!-- Image Section -->
                        @if($item->foto)
                            <div class="md:w-1/3 lg:w-1/4">
                                <div class="relative h-48 md:h-full overflow-hidden">
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Content Section -->
                        <div class="flex-1 p-6 md:p-8">
                            <div class="flex flex-col h-full">
                                <!-- Meta Information -->
                                <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span>{{ $item->user->name ?? 'Redaksi' }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <time datetime="{{ $item->created_at->format('Y-m-d') }}">
                                            {{ $item->created_at->format('d M Y') }}
                                        </time>
                                    </div>
                                </div>

                                <!-- Title -->
                                <h2
                                    class="text-xl md:text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                                    {{ $item->judul }}
                                </h2>

                                <!-- Excerpt -->
                                <p class="text-gray-600 leading-relaxed mb-4 flex-1 line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit($item->isi, 180) }}
                                </p>

                                <!-- Action Buttons -->
                                <div class="flex items-center justify-between mt-auto">
                                    <a href="#"
                                        class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                                        <span>Baca Selengkapnya</span>
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>

                                    <!-- Action Buttons Group -->
                                    <div class="flex items-center gap-2">
                                        <!-- Edit Button -->
                                        @can('update', $item)
                                            <a href="{{ route('berita.edit', $item->id) }}"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 text-sm text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-md transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                                <span class="hidden sm:inline">Edit</span>
                                            </a>
                                        @endcan

                                        <!-- Delete Button -->
                                        @can('delete', $item)
                                            <form action="{{ route('berita.destroy', $item->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 rounded-md transition-all duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                    <span class="hidden sm:inline">Hapus</span>
                                                </button>
                                            </form>
                                        @endcan

                                        <!-- Share Button -->
                                        <button
                                            class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition-all duration-200"
                                            onclick="shareArticle('{{ $item->judul }}', '{{ url()->current() }}')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination or Load More (if needed) -->

     @if(auth()->check() && auth()->user()->role === 'admin')
<div class="mt-12 flex justify-center">
    <a href="{{ route('beritas.create') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
        Tambah Berita
    </a>
</div>
@endif
    </div>

    <!-- Additional Styles and JavaScript -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        // Share function
        function shareArticle(title, url) {
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link berhasil disalin ke clipboard!');
                });
            }
        }

        // Delete confirmation with better UX
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('form[onsubmit*="confirm"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    // Create custom confirmation modal (optional)
                    const confirmed = confirm('⚠️ Apakah Anda yakin ingin menghapus berita ini?\n\nTindakan ini tidak dapat dibatalkan.');

                    if (confirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>
@endsection