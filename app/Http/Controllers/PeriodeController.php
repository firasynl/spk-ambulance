<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periode = Periode::paginate(10);;
        return view('periode.index', compact('periode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request,[
    		'nama_periode' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'status' => 'required',
    	]);
 
        Periode::create([
            'nama_periode' => $request->nama_periode,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
    	]);
 
    	return redirect()->route('periode.index')
                        ->with('success','Periode created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periode $periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $periode = Periode::find($id);
        return view('periode.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periode $periode): RedirectResponse
    {
        $request->validate([
            'nama_periode' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'status' => 'required',
        ]);

        $periode->update($request->all());
        return redirect()->route('periode.index')
                        ->with('success','Periode updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $periode): RedirectResponse
    {
        $periode->delete();
        return redirect()->route('periode.index')
                ->with('success','Periode deleted successfully');
    }
}
