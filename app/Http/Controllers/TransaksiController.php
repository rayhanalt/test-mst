<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\customer;
use App\Models\sales;
use App\Models\sales_det;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.transaksi.index');
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
            return view('admin.transaksi.create', [
                'hasBarang' => barang::get(),
                'hasCust' => customer::get(),
                'kodeCustTerpakai' => sales::pluck('kode_cust')->toArray(),
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
    public function store(Request $request, sales $sales)
    {
        // $selectedOptions = $request->input('selectedOptions');
        // dd(json_encode($request->subtotal));
        if (Auth::user()->jabatan == 'admin') {
            $request->validate([
                'tgl' => 'required',
                'kode_cust' => 'required',
                'diskon_user' => 'required',
                'ongkir_user' => 'required',
                'qty' => 'required',
                'diskon_persen' => 'required',
            ]);

            $sales = $sales->create([
                'tgl' => $request->tgl,
                'kode_cust' => $request->kode_cust,
                'subtotal' => $request->total,
                'diskon' => $request->diskon_user,
                'ongkir' => $request->ongkir_user,
                'total_bayar' => $request->total_bayar,
            ]);

            $kodeSales = $sales->kode;

            // Ambil data dari request
            $kodeArray = $request->kode;
            $qtyArray = $request->qty;
            $hargaDiskonArray = $request->harga_diskon;
            $DiskonPersenArray = $request->diskon_persen;
            $DiskonNilaiArray = $request->diskon_nilai;
            $subtotalArray = $request->subtotal;

            // Loop melalui setiap elemen dalam array kode
            foreach ($kodeArray as $index => $kode) {
                $qty = $qtyArray[$index];
                $hargaDiskon = $hargaDiskonArray[$index] ?? 0;
                $diskonPersen = $DiskonPersenArray[$index];
                $diskonNilai = $DiskonNilaiArray[$index];
                $subtotal = $subtotalArray[$index];

                // Lakukan operasi yang diperlukan untuk menyimpan data
                // Contoh:
                $data = new sales_det();
                $data->kode_barang = $kode;
                $data->kode_sales = $kodeSales;
                $data->qty = $qty;
                $data->harga_banderol = barang::where('kode', $kode)->value('harga');
                $data->diskon_pct = $diskonPersen;
                $data->diskon_nilai = $diskonNilai;
                $data->harga_diskon = $hargaDiskon;
                $data->total = $subtotal;
                $data->save();
            }

            return redirect('/transaksi')->with('success', 'New Data has been added!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Denda $sales
     * @return \Illuminate\Http\Response
     */
    public function show(sales $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Denda $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(sales $transaksi)
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.transaksi.edit', [
                'item' => $transaksi,
                'hasCust' => customer::get(),
                'subTotal' => sales_det::where('kode_sales', $transaksi->kode)->sum('total'),
                'salesDet' => sales_det::where('kode_sales', $transaksi->kode)->get()
            ]);
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Denda $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sales $transaksi)
    {

        if (Auth::user()->jabatan == 'admin') {

            $request->validate([
                'tgl' => 'required',
                'diskon_user' => 'required',
                'ongkir_user' => 'required',
            ]);
            $transaksi->update([
                'tgl' => $request->tgl,
                'diskon' => $request->diskon_user,
                'ongkir' => $request->ongkir_user,
                'subtotal' => $request->subtotal,
                'total_bayar' => $request->total_bayar,
            ]);
            return redirect('/transaksi')->with('success', 'Data has been updated!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Denda $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(sales $transaksi)
    {
        if (Auth::user()->jabatan == 'admin') {
            sales_det::where('kode_sales', $transaksi->kode)->delete();
            $transaksi->delete();
            return redirect()->back()->with('success', 'Data has been deleted!');
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    public function getOptionDetails($option, $hasBarang)
    {
        $barang = barang::where('kode', $option)->first();

        // Jika data barang ditemukan, kembalikan data dalam format JSON
        if ($barang) {
            return response()->json([
                'kode' => $barang->kode,
                'nama' => $barang->nama,
                'harga' => $barang->harga,
                // Tambahkan kolom data lainnya yang ingin Anda tampilkan
            ]);
        }

        // Jika data barang tidak ditemukan, kembalikan respon kosong atau pesan kesalahan
        return response()->json([
            'error' => 'Data barang tidak ditemukan.',
        ], 404);
    }
}
