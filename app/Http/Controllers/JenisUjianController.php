<?php

namespace App\Http\Controllers;


use App\Models\jenis_ujian;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.jenis_ujian.index');
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
            return view('admin.jenis_ujian.create');
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, jenis_ujian $jenis_ujian)
    {
        if (Auth::user()->jabatan == 'admin') {
            $validate = $request->validate([
                'jenis_ujian' => 'required'
            ]);
            $jenis_ujian->create($validate);

            return redirect('/jenis_ujian')->with('success', 'New Data has been added!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Denda $jenis_ujian
     * @return \Illuminate\Http\Response
     */
    public function show(Denda $jenis_ujian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Denda $jenis_ujian
     * @return \Illuminate\Http\Response
     */
    public function edit(jenis_ujian $jenis_ujian)
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.jenis_ujian.edit', [
                'item' => $jenis_ujian
            ]);
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Denda $jenis_ujian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jenis_ujian $jenis_ujian)
    {
        if (Auth::user()->jabatan == 'admin') {
            $validate = $request->validate([
                'jenis_ujian' => 'required'
            ]);
            $jenis_ujian->update($validate);

            return redirect('/jenis_ujian')->with('success', 'Data has been updated!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Denda $jenis_ujian
     * @return \Illuminate\Http\Response
     */
    public function destroy(jenis_ujian $jenis_ujian)
    {
        if (Auth::user()->jabatan == 'admin') {
            $jenis_ujian->delete();
            return redirect()->back()->with('success', 'Data has been deleted!');
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }
}
