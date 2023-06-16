<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.kelas.index');
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.kelas.create', [
                'getWaliKelas' => guru::get()
            ]);
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, kelas $kelas)
    {
        if (Auth::user()->jabatan == 'admin') {
            $guru = guru::where('nip', $request->nip)->first();
            $validate = $request->validate([
                'nama_kelas' => 'required',
                'kapasitas' => 'required',
                'nip' => 'required|unique:kelas,nip',
            ], [
                'nip.unique' => 'Bapak/Ibu ' . $guru->nama_guru . ' sudah menjadi wali kelas lain.'
            ]);
            $kelas->create($validate);

            return redirect('/kelas')->with('success', 'New Data has been added!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Denda $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Denda $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(kelas $kelas)
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.kelas.edit', [
                'item' => $kelas,
                'getWaliKelas' => guru::get()
            ]);
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Denda $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kelas $kelas)
    {
        if (Auth::user()->jabatan == 'admin') {

            $guru = guru::where('nip', $request->nip)->first();
            $validate = $request->validate([
                'nama_kelas' => 'required',
                'kapasitas' => 'required',
            ]);
            if ($request->nip != $kelas->nip) {
                $validate = $request->validate([
                    'nama_kelas' => 'required',
                    'kapasitas' => 'required',
                    'nip' => 'required|unique:kelas,nip',
                ], [
                    'nip.unique' => 'Bapak/Ibu ' . $guru->nama_guru . ' sudah menjadi wali kelas lain.'
                ]);
            }
            $kelas->update($validate);

            return redirect('/kelas')->with('success', 'Data has been updated!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Denda $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(kelas $kelas)
    {
        if (Auth::user()->jabatan == 'admin') {
            $kelas->delete();
            return redirect()->back()->with('success', 'Data has been deleted!');
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }
}
