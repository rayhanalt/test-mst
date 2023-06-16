<?php

namespace App\Http\Controllers;

use App\Models\mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.mapel.index');
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
            return view('admin.mapel.create');
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, mapel $mapel)
    {
        if (Auth::user()->jabatan == 'admin') {
            $validate = $request->validate([
                'nama_mapel' => 'required'
            ]);
            $mapel->create($validate);

            return redirect('/mapel')->with('success', 'New Data has been added!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Denda $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Denda $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Denda $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(mapel $mapel)
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.mapel.edit', [
                'item' => $mapel
            ]);
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Denda $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mapel $mapel)
    {
        if (Auth::user()->jabatan == 'admin') {
            $validate = $request->validate([
                'nama_mapel' => 'required'
            ]);
            $mapel->update($validate);

            return redirect('/mapel')->with('success', 'Data has been updated!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Denda $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(mapel $mapel)
    {
        if (Auth::user()->jabatan == 'admin') {
            $mapel->delete();
            return redirect()->back()->with('success', 'Data has been deleted!');
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }
}
