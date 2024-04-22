<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Users;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        // dd($unit_kerja);
        $unit_kerja = UnitKerja::select('id', 'unit_kerja');
        $jabatan = Jabatan::select('id', 'jabatan');
        $usersQuery = Users::query();

        if ($searchQuery) {
            $usersQuery->where('nama', 'LIKE', "%$searchQuery%")
            ->orWhere('usertype', 'LIKE', "%$searchQuery%")
            ->orWhereHas('unit_kerja_pegawai', function ($query)use ($searchQuery) {
                $query->where('unit_kerja', 'LIKE', "%$searchQuery%");
        });}
        $users = $usersQuery->paginate(10);
        if ($request->filled('search')) {
            $users->appends(['search' => $request->input('search')]);
        }

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        return view('register_akun.index',compact('users'))->with('pagination', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = Users::join()->get();
        $usertype = Users::distinct()->pluck('usertype');
        $unit_kerja = UnitKerja::select('id', 'unit_kerja')->get();
        $jabatan = Jabatan::select('id', 'jabatan')->get();

        return view('register_akun.create',compact('users', 'usertype', 'unit_kerja', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'nullable',
            'pangkat' => 'nullable', 
            'jabatan_pegawai' => 'required',
            'unit_kerja' => 'required',
            'email' => 'required',
            'password' => 'required',
            'usertype' => 'required',
        ]);

        $name= $request->input('nama');
        $nip= $request->input('nip');
        $pangkat= $request->input('pangkat');
        $jabatan_pegawai = $request->input('jabatan_pegawai');
        $unit_kerja= $request->input('unit_kerja');
        $email= $request->input('email');
        $password= bcrypt($request->input('password'));
        $usertype= $request->input('usertype');
    
        Users::create([
            'nama' => $name,
            'nip' => $nip,
            'pangkat' => $pangkat,
            'jabatan_pegawai' => $jabatan_pegawai,
            'unit_kerja' => $unit_kerja,
            'email' => $email,
            'password' => $password,
            'usertype' => $usertype,
        ]);

        Alert::success('Success', 'Data berhasil dibuat');

        return redirect()->route('register_akun.index');
    }

    public function show($id)
    {
        $jabatan = Users::with('unit_kerja_pegawai', 'jabatan_user')->find($id);
        // $users = Users::all();
        return view('register_akun.show', compact('jabatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $register_akun)
    {
        $unit_kerja = UnitKerja::select('id', 'unit_kerja')->get();
        $jabatan = Jabatan::select('id', 'jabatan')->get();

        return view('register_akun.edit',compact('register_akun', 'unit_kerja', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Users $register_akun)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'nullable',
            'pangkat' => 'nullable', 
            'jabatan_pegawai' => 'required',
            'unit_kerja' => 'required',
            'email' => 'required',
            'usertype' => 'required',
        ]);
    
        // Ambil data dari request
        $data = $request->only(['nama','nip', 'pangkat', 'jabatan_pegawai', 'unit_kerja', 'email', 'usertype']);
    
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

        Alert::success('Success', 'Data berhasil diupdate');

        return redirect()->route('register_akun.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $register_akun)
    {
        if ($register_akun->delete()){ 
            Alert::success('Deleted', 'Data berhasil dihapus');
        }

        return redirect()->route('register_akun.index');
    }
}
