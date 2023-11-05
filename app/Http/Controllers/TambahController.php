<?php

namespace App\Http\Controllers;

use App\Models\Tambah;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TambahController extends Controller
{
    public function index(): View
    {
        $tambahs = Tambah::latest()->paginate(50);

        return view('tambah.tambah', compact('tambahs'));
    }

    public function create(): View
    {
        return view('tambah.create');
    }


    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'PartNumber' => 'required',
        ]);

        Tambah::create([
            'PartNumber' => $request->input('PartNumber'),
        ]);

        return redirect()->route('tambahs.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $tambah = Tambah::findOrFail($id);
        return view('tambah.edit', compact('tambah'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'PartNumber' => 'required',
        ]);

        $tambah = Tambah::findOrFail($id);

        $tambah->update([
            'PartNumber' => $request->input('PartNumber'),
        ]);

        return redirect()->route('tambahs.index')->with(['success' => 'Data berhasil diperbarui']);
    }

    public function destroy(string $id): RedirectResponse
    {
        $tambah = Tambah::findOrFail($id);
        $tambah->delete();

        return redirect()->route('tambahs.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
