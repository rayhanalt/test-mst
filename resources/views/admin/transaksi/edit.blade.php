@extends('app')
@section('content')
    <style>
        .right-align {
            text-align: right;
        }
    </style>
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="top-0 z-50 bg-transparent text-lg font-bold lg:sticky">Ubah Data
                <hr>
            </h3>
            <div class="card-body">
                <form action="/transaksi/{{ $item->kode }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-control sm:w-2/6">
                        <label class="label">
                            <span class="label-text">Tanggal Transaksi</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="tgl" type="date" placeholder="Tanggal Transaksi"
                            value="{{ old('tgl', $item->tgl) }}" class="datepicker input-bordered input">
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('tgl')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>

                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Customer</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <select class="select-bordered select" disabled name="kode_cust">
                            <option disabled selected>Pick one</option>
                            @foreach ($hasCust as $customer)
                                <option @if ($customer->kode == $item->kode_cust) selected @endif value="{{ $customer->kode }}"
                                    {{ old('kode_cust') == $customer->kode ? 'selected' : '' }}>
                                    {{ $customer->nama }} | {{ $customer->telp }}</option>
                            @endforeach
                        </select>
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('kode_cust')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>

                    <div>
                        <a href="/detail/create?kode={{ $item->kode }}"
                            class="btn-outline btn btn-success btn-sm mr-2 mb-1">➕ Data</a>
                    </div>

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
                                    <th rowspan="2">Aksi</th>
                                </tr>
                                <tr class="text-center">
                                    <th>(%)</th>
                                    <th>Rp.</th>
                                </tr>
                            </thead>
                            <tbody class="border-2">
                                @foreach ($salesDet as $sales)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sales->kode_barang }}</td>
                                        <td>{{ $sales->hasBarang->nama }}</td>
                                        <td>
                                            {{ $sales->harga_banderol }}

                                        </td>
                                        <td class="text-right">
                                            {{ $sales->qty }}
                                        </td>
                                        <td class="text-right">
                                            {{ $sales->diskon_pct }}
                                        </td>
                                        <td class="text-right">
                                            {{ $sales->diskon_nilai }}
                                        </td>
                                        <td class="text-right">{{ $sales->harga_diskon }}</td>
                                        <td class="text-right">{{ $sales->total }}</td>
                                        <td class="text-center">
                                            <a href="/detail/{{ $sales->id }}/edit"
                                                class="btn-outline btn btn-accent btn-sm mb-1">
                                                ✎
                                            </a>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">
                        Total Harga: {{ 'Rp. ' . number_format($subTotal, 0, ',', '.') }}
                        <input type="hidden" name="subtotal" id="totalInput" value="{{ $subTotal }}">
                    </div>
                    <div>
                        Diskon: <input type="number" id="diskonUser" name="diskon_user" value="{{ $item->diskon }}">
                    </div>
                    <div>
                        Ongkir: <input type="number" id="ongkirUser" name="ongkir_user" value="{{ $item->ongkir }}">
                    </div>
                    <div>
                        Total yang Harus Dibayar: <span id="totalBayar"></span>
                        <input type="hidden" name="total_bayar" id="totalBayarInput" value="{{ $item->total_bayar }}">
                    </div>

                    <div class="card-actions mt-3 mb-6 justify-end">
                        <button type="reset" class="btn btn-error">Reset</button>
                        <button type="submit"class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            totalBayar(); // Panggil fungsi totalBayar() saat halaman dimuat

            // Tambahkan event listener untuk perubahan nilai diskon dan ongkir
            const diskonElement = document.getElementById('diskonUser');
            const ongkirElement = document.getElementById('ongkirUser');

            diskonElement.addEventListener('change', totalBayar);
            ongkirElement.addEventListener('change', totalBayar);
        });

        function totalBayar() {
            const totalHargaElement = document.getElementById('totalInput');
            const diskonElement = document.getElementById('diskonUser');
            const ongkirElement = document.getElementById('ongkirUser');
            const totalBayarElement = document.getElementById('totalBayar');

            const totalHargaValue = parseFloat(totalHargaElement.value) || 0;
            const diskon = parseFloat(diskonElement.value) || 0;
            const ongkir = parseFloat(ongkirElement.value) || 0;

            const totalBayar = totalHargaValue - diskon + ongkir;

            const totalbayarInput = document.getElementById('totalBayarInput');
            totalbayarInput.value = totalBayar;

            totalBayarElement.textContent = 'Rp.' + totalBayar.toLocaleString('id-ID');
        }
    </script>
@endsection
