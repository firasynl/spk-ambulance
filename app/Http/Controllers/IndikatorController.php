<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class IndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::select('id', 'jabatan')->get();
        $indikator = Indikator::join()->get();
        
        return view('indikator.index',compact('indikator', 'jabatan'));
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
            'jabatan' => 'required',
        ]);

        $indikator = $request->input('indikator');
        $jabatan = $request->input('jabatan');
    
        Indikator::create([
            'indikator' => $indikator,
            'jabatan' => $jabatan,
        ]);

        return redirect()->route('indikator.index')
                        ->with('success','Indikator created successfully.');
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
            'jabatan' => 'required',
        ]);

        $indikator->update($request->all());

        return redirect()->route('indikator.index')
                        ->with('success','Indikator updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Indikator $indikator): RedirectResponse
    {
        $indikator->delete();

        return redirect()->route('indikator.index')
                        ->with('success','Indikator deleted successfully');
    }
}