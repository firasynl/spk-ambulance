<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

class IndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $jabatan = Jabatan::select('id', 'jabatan');
        $query = Indikator::query();

        if ($request->filled('search')) {
            $searchQuery = $request->input('search');
            $query->where(function ($query) use ($searchQuery) {
                $query->where('indikator', 'like', "%$searchQuery%")
                    ->orWhereHas('jabatan', function ($query) use ($searchQuery) {
                        $query->where('jabatan', 'like', "%$searchQuery%");
                    });
            });
        }
        $indikator = $query->paginate(10);
        if ($request->filled('search')) {
            $indikator->appends(['search' => $request->input('search')]);
        }

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        return view('indikator.index',compact('indikator', 'jabatan'))->with('pagination', $indikator);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatan = Jabatan::select('id', 'jabatan')->get();

        return view('indikator.create',compact('jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'indikator' => 'required',
            'kategori' => 'required',
            'jabatan_id' => 'required',
        ]);

        $indikator = $request->input('indikator');
        $kategori = $request->input('kategori');
        $jabatan_id = $request->input('jabatan_id');
    
        Indikator::create([
            'indikator' => $indikator,
            'kategori' => $kategori,
            'jabatan_id' => $jabatan_id,
        ]);

        Alert::success('Success', 'Data berhasil dibuat');

        return redirect()->route('indikator.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Indikator $indikator)
    {
        $jabatan = Jabatan::select('id', 'jabatan')->get();

        return view('indikator.edit',compact('indikator', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Indikator $indikator): RedirectResponse
    {
        $request->validate([
            'indikator' => 'required',
            'kategori' => 'required',
            'jabatan' => 'required',
        ]);

        $indikator->update($request->all());

        Alert::success('Success', 'Data berhasil diupdate');

        return redirect()->route('indikator.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Indikator $indikator): RedirectResponse
    {
        if ($indikator->delete()){ 
            Alert::success('Deleted', 'Data berhasil dihapus');
        }

        return redirect()->route('indikator.index');
    }
}
