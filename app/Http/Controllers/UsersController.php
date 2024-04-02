<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $unit_kerjaPegawai = UnitKerja::select('id', 'unit_kerja');
        $usersQuery = Users::query();

        if ($searchQuery) {
            $usersQuery->where('nama', 'LIKE', "%$searchQuery%")
            ->orWhere('usertype', 'LIKE', "%$searchQuery%");
        }
        $users = $usersQuery->paginate(10);

        // $unit_kerja = UnitKerja::select('id', 'unit_kerja')->paginate(10);
        // $users = Users::join()->paginate(10);
        
        return view('register_akun.index',compact('users', 'unit_kerjaPegawai'))->with('pagination', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = Users::join()->get();
        $usertype = Users::distinct()->pluck('usertype');
        $unit_kerja = UnitKerja::select('id', 'unit_kerja')->get();

        return view('register_akun.create',compact('users', 'usertype', 'unit_kerja'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required', 
            'unit_kerja' => 'required',
            'email' => 'required',
            'password' => 'required',
            'usertype' => 'required',
        ]);

        $name= $request->input('nama');
        $nip= $request->input('nip');
        $unit_kerja= $request->input('unit_kerja');
        $email= $request->input('email');
        $password= bcrypt($request->input('password'));
        $usertype= $request->input('usertype');
    
        Users::create([
            'nama' => $name,
            'nip' => $nip,
            'unit_kerja' => $unit_kerja,
            'email' => $email,
            'password' => $password,
            'usertype' => $usertype,
        ]);

        return redirect()->route('register_akun.index')
                        ->with('success','Account created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $register_akun)
    {
        $unit_kerja = UnitKerja::select('id', 'unit_kerja')->get();

        return view('register_akun.edit',compact('register_akun', 'unit_kerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Users $register_akun)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'unit_kerja' => 'required',
            'email' => 'required',
            'usertype' => 'required',
        ]);
    
        // Ambil data dari request
        $data = $request->only(['nama','nip','unit_kerja', 'email', 'usertype']);
    
        // Cek apakah password diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required',
            ]);
            // Jika password diisi, bcrypt password tersebut
            $data['password'] = bcrypt($request->password);
        }
    
        // Update data pengguna
        $register_akun->update($data);

        return redirect()->route('register_akun.index')
                        ->with('success','Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $register_akun)
    {
        $register_akun->delete();

        return redirect()->route('register_akun.index')
                        ->with('success','Account deleted successfully');
    }
}
