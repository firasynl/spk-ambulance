<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UnitKerja::query();
        
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('unit_kerja', 'like', $searchTerm);
        }
        $unitKerja = $query->paginate(10);
        if ($request->filled('search')) {
            $unitKerja->appends(['search' => $request->input('search')]);
        }

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('unit_kerja.index', compact('unitKerja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unit_kerja.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
    		'unit_kerja' => 'required',
    	]);
 
        UnitKerja::create([
    		'unit_kerja' => $request->unit_kerja,
    	]);

        Alert::success('Success', 'Data berhasil dibuat');
 
    	return redirect()->route('unit_kerja.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitKerja $unitKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unitKerja = UnitKerja::find($id);
        return view('unit_kerja.edit', compact('unitKerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'unit_kerja' => 'required',
        ]);

        $unitKerja = UnitKerja::find($id);
        $unitKerja->unit_kerja = $request->unit_kerja;
        $unitKerja->update();

        Alert::success('Success', 'Data berhasil diupdate');
        return redirect()->route('unit_kerja.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (UnitKerja::find($id)->delete()){ 
            Alert::success('Deleted', 'Data berhasil dihapus');
        }
        return redirect()->route('unit_kerja.index');
    }
}
