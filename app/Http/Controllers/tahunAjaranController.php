<?php

namespace App\Http\Controllers;

use App\Models\tahunAjaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class tahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.tahun_ajaran.index');
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
            return view('admin.tahun_ajaran.create');
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->jabatan == 'admin') {

            $validate = $request->validate([
                'kode_tahun_ajaran' => 'required|unique:tahun_ajaran,kode_tahun_ajaran',
                'tahun_ajaran' => 'required',
            ]);
            tahunAjaran::create($validate);

            return redirect('/tahun_ajaran')->with('success', 'New Data has been added!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function show(tahunAjaran $tahunAjaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function edit(tahunAjaran $tahunAjaran)
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.tahun_ajaran.edit', [
                'item' => $tahunAjaran
            ]);
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tahunAjaran $tahunAjaran)
    {
        if (Auth::user()->jabatan == 'admin') {
            $validate = $request->validate([
                'kode_tahun_ajaran' => 'required|unique:tahun_ajaran,kode_tahun_ajaran',
                'tahun_ajaran' => 'required'
            ]);

            $tahunAjaran->update($validate);

            return redirect('/tahun_ajaran')->with('success', 'Data has been updated!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(tahunAjaran $tahunAjaran)
    {
        if (Auth::user()->jabatan == 'admin') {
            $tahunAjaran->delete();
            return redirect()->back()->with('success', 'Data has been deleted!');
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }
}
