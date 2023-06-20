@extends('app')
@section('content')
    <style>
        .right-align {
            text-align: right;
        }
    </style>
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Ubah Data
                <hr>
            </h3>
            <div class="card-body">
                <form action="/detail/{{ $item->id }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="overflow-x-auto">
                        <table id="resultTable" class="table-compact table w-full">
                            <thead class="table-header-group">
                                <tr class="text-center">
                                    <th rowspan="2"></th>
                                    <th rowspan="2">kode</th>
                                    <th rowspan="2">Nama</th>
                                    <th rowspan="2">Harga</th>
                                    <th rowspan="2">Qty</th>
                                    <th colspan="2">Diskon</th>
                                    <th rowspan="2">Harga Diskon</th>
                                    <th rowspan="2">Subtotal</th>

                                </tr>
                                <tr class="text-center">
                                    <th>(%)</th>
                                    <th>Rp.</th>
                                </tr>
                            </thead>
                            <tbody class="border-2">
                                <tr>
                                    <td></td>
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->hasBarang->nama }}</td>
                                    <td>
                                        <input type="number" id="harga_banderol" class="right-align"
                                            value="{{ $item->harga_banderol }}" readonly>
                                    </td>
                                    <td class="text-right">
                                        <input type="number" name="qty" id="qty" onchange="calculateSubtotal()"
                                            value="{{ $item->qty }}" class="right-align">
                                    </td>
                                    <td class="text-right">
                                        <input type="number" name="diskon_persen" id="diskon_persen"
                                            onchange="calculateSubtotal()" value="{{ $item->diskon_pct }}"
                                            class="right-align">
                                    </td>
                                    <td class="text-right">
                                        <input type="number" name="diskon_nilai" id="diskon_nilai"
                                            onchange="calculateSubtotal()" value="{{ $item->diskon_nilai }}"
                                            class="right-align">
                                    </td>
                                    <td class="text-right">
                                        <input type="number" id="harga_diskon" name="harga_diskon" readonly
                                            value="{{ $item->harga_diskon }}">
                                    </td>
                                    <td class="text-right">
                                        <input type="number" id="total" name="total" readonly
                                            value="{{ $item->total }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-actions mt-3 justify-end">
                        <button type="reset" class="btn btn-error">Reset</button>
                        <button type="submit"class="btn btn-success">Simpan</button>
                    </div>
                </form>
                <form action="/detail/{{ $item->id }}?kode={{ $item->kode_sales }}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="btn-outline btn btn-error btn-sm"
                        onclick="return confirm('yakin hapus data {{ $item->hasBarang->nama }} ?')">
                        🗑
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function calculateSubtotal() {
            var hargaBanderol = parseFloat(document.getElementById('harga_banderol').value);
            var qty = parseFloat(document.getElementById('qty').value);
            var diskonPersen = parseFloat(document.getElementById('diskon_persen').value);

            var diskonNilai = 0;
            var hargaDiskon = hargaBanderol;

            if (!isNaN(diskonPersen) && diskonPersen > 0) {
                diskonNilai = hargaBanderol * (diskonPersen / 100);
                hargaDiskon = hargaBanderol - diskonNilai;
            }

            var subtotal = hargaDiskon * qty;

            document.getElementById('diskon_nilai').value = diskonNilai.toFixed(2);
            document.getElementById('harga_diskon').value = hargaDiskon.toFixed(2);
            document.getElementById('total').value = subtotal.toFixed(2);
        }

        function updateDiskonNilai() {
            var hargaBanderol = parseFloat(document.getElementById('harga_banderol').value);
            var diskonPersen = parseFloat(document.getElementById('diskon_persen').value);

            if (!isNaN(diskonPersen) && diskonPersen > 0) {
                var diskonNilai = hargaBanderol * (diskonPersen / 100);
                document.getElementById('diskon_nilai').value = diskonNilai.toFixed(2);
            } else {
                document.getElementById('diskon_nilai').value = 0;
            }

            calculateSubtotal();
        }
    </script>
@endsection
