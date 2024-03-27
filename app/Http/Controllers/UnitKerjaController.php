<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitKerja = UnitKerja::paginate(10);
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
 
    	return redirect('/home/unit_kerja');
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
        return redirect('/home/unit_kerja');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unitKerja = UnitKerja::find($id);
        $unitKerja->delete();
        return redirect('/home/unit_kerja');
    }
}
