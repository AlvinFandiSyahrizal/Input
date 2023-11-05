<?php
namespace App\Http\Controllers;

use App\Models\Input;
use Carbon\Carbon;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function index(): View
    {
        $inputs = Input::orderBy('Tanggal', 'asc')->paginate(50);

        return view('input.input', compact('inputs'));
    }

    public function create(): View
    {
        return view('input.create');
    }
    // public function create(): View
    // {
    //     $tambahs = Tambah::pluck('PartNumber', 'PartNumber');
    //     return view('input.input', compact('tambahs'));
    // }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request,[
            'Tanggal' => 'required|date',
            'PartNumber' => 'required',
            'Operations' => 'required',
            'Quantity' => 'numeric',
        ]);

        Input::create([
            'Tanggal' => Carbon::parse($request->input('Tanggal')),
            'PartNumber' => $request->input('PartNumber'),
            'Operations' => $request->input('Operations'),
            'Quantity' => $request->input('Quantity'),
        ]);

        return redirect()->route('inputs.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $input = Input::findOrFail($id);
        return view('input.edit', compact('input'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Tanggal' => 'required|date',
            'PartNumber' => 'required',
            'Operations' => 'required',
            'Quantity' => 'numeric',
        ]);

        $input = Input::findOrFail($id);

        $input->update([
            'Tanggal' => Carbon::parse($request->input('Tanggal')),
            'PartNumber' => $request->input('PartNumber'),
            'Operations' => $request->input('Operations'),
            'Quantity' => $request->input('Quantity'),
        ]);

        return redirect()->route('inputs.index')->with(['success' => 'Data berhasil diperbarui']);
    }



    public function destroy($id): RedirectResponse
    {
        $input = Input::findOrFail($id);
        $input->delete();
        return redirect()->route('inputs.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
