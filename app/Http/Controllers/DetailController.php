<?php

namespace App\Http\Controllers;

use App\Models\mapel;
use App\Models\sales;
use App\Models\barang;
use App\Models\sales_det;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd(json_encode($request->query('kode')));
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.detail.create', [
                'hasBarang' => barang::get(),
                'kodeSales' => $request->query('kode'),
                'salesDet' => sales_det::where('kode_sales', $request->query('kode'))->pluck('kode_barang')->toArray(),
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
    public function store(Request $request, sales_det $detail)
    {
        if (Auth::user()->jabatan == 'admin') {
            // dd(json_encode($request->harga_banderol));
            $request->validate([
                'kode_barang' => 'required',
                'harga_banderol' => 'required',
                'diskon_persen' => 'required',
                'harga_diskon' => 'required',
                'diskon_nilai' => 'required',
                'qty' => 'required',
                'total' => 'required',
            ]);

            $detail->create([
                'kode_sales' => $request->kode_sales,
                'kode_barang' => $request->kode_barang,
                'harga_banderol' => $request->harga_banderol,
                'qty' => $request->qty,
                'diskon_pct' => $request->diskon_persen,
                'diskon_nilai' => $request->diskon_nilai,
                'harga_diskon' => $request->harga_diskon,
                'total' => $request->total,
            ]);
            return redirect('/transaksi/' . $request->kode_sales . '/edit')->with('success', 'Data has been added!')->withInput();
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
    public function edit(sales_det $detail)
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.detail.edit', [
                'item' => $detail
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
    public function update(Request $request, sales_det $detail)
    {
        if (Auth::user()->jabatan == 'admin') {
            $validate = $request->validate([
                'qty' => 'required',
                'diskon_persen' => 'required',
                'diskon_nilai' => 'required',
                'harga_diskon' => 'required',
                'total' => 'required',
            ]);
            $detail->update([
                'qty' => $validate['qty'],
                'diskon_pct' => $validate['diskon_persen'],
                'diskon_nilai' => $validate['diskon_nilai'],
                'harga_diskon' => $validate['harga_diskon'],
                'total' => $validate['total'],
            ]);

            return redirect('/transaksi/' . $detail->kode_sales . '/edit')->with('success', 'Data has been updated!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Denda $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, sales_det $detail)
    {

        if (Auth::user()->jabatan == 'admin') {
            sales_det::where('id', $detail->id)->delete();
            return redirect('/transaksi/' . $request->query('kode') . '/edit')->with('success', 'Data has been updated!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }
}
