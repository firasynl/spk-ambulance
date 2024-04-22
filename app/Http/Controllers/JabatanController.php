<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Jabatan::query();
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('jabatan', 'like', $searchTerm);
        }
        $jabatan = $query->paginate(5);
        if ($request->filled('search')) {
            $jabatan->appends(['search' => $request->input('search')]);
        }

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        return view('jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
    		'jabatan' => 'required',
    	]);
 
        Jabatan::create([
    		'jabatan' => $request->jabatan,
    	]);

        Alert::success('Success', 'Data berhasil dibuat');
 
        return redirect()->route('jabatan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jabatan = Jabatan::find($id);
        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'jabatan' => 'required',
        ]);

        $jabatan = Jabatan::find($id);
        $jabatan->jabatan = $request->jabatan;
        $jabatan->update();

        Alert::success('Success', 'Data berhasil diupdate');
        return redirect()->route('jabatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $jabatan = Jabatan::find($id);
        // $jabatan->delete();
        if (Jabatan::find($id)->delete()){ 
            Alert::success('Deleted', 'Data berhasil dihapus');
        }

        return redirect()->route('jabatan.index');
    }
}
