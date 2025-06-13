<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('beritas.index', compact('beritas'));
    }

    public function create()
    {
        $users = User::all(); // Ambil semua user untuk dropdown
    return view('beritas.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|min:10',
            'isi' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');
        }

        Berita::create([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'foto' => $path,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $beritas = Berita::findOrFail($id);
        return view('beritas.edit', compact('beritas'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul' => 'required|min:10',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $beritas = Berita::findOrFail($id);

        // Jika ada file baru diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($beritas->foto) {
                Storage::disk('public')->delete($beritas->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');
            $beritas->foto = $path;
        }

        $beritas->judul = $validated['judul'];
        $beritas->isi = $validated['isi'];
        $beritas->save();

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $beritas = Berita::findOrFail($id);

        // Hapus file foto jika ada
        if ($beritas->foto) {
            Storage::disk('public')->delete($beritas->foto);
        }

        $beritas->delete();

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil dihapus.');
    }
}
