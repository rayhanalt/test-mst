@extends('app')
@section('content')
    <style>
        .right-align {
            text-align: right;
        }
    </style>
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Tambah Data
                <hr>
            </h3>
            <div class="card-body">
                <form action="/detail" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="overflow-x-auto">
                        <table id="resultTable" class="table-compact table w-full">
                            <thead class="table-header-group">
                                <tr class="text-center">

                                    <th rowspan="2">Barang</th>

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

                                    <td>
                                        <select id="multipleSelect" name="kode_barang">
                                            <option disabled selected>Pick one</option>
                                            @foreach ($hasBarang as $barang)
                                                @if (!in_array($barang->kode, $salesDet))
                                                    <option value="{{ $barang->kode }}"
                                                        {{ old('kode_barang') == $barang->kode ? 'selected' : '' }}>
                                                        {{ $barang->kode }} | {{ $barang->nama }}
                                                    </option>
                                                @endif
                                            @endforeach
                                            <input type="hidden" name="nama" id="nama" value="">
                                            <input type="hidden" name="kode_sales" value="{{ $kodeSales }}">
                                        </select>
                                    </td>

                                    <td>
                                        <input type="number" id="harga_banderol" name="harga_banderol" class="right-align"
                                            value="" readonly>
                                    </td>
                                    <td class="text-right">
                                        <input type="number" name="qty" id="qty" onchange="calculateSubtotal()"
                                            value="1" class="right-align">
                                    </td>
                                    <td class="text-right">
                                        <input type="number" name="diskon_persen" id="diskon_persen"
                                            onchange="calculateSubtotal()" value="0" class="right-align">
                                    </td>
                                    <td class="text-right">
                                        <input type="number" name="diskon_nilai" id="diskon_nilai"
                                            onchange="calculateSubtotal()" value="0" class="right-align">
                                    </td>
                                    <td class="text-right">
                                        <input type="number" id="harga_diskon" name="harga_diskon" readonly value="">
                                    </td>
                                    <td class="text-right">
                                        <input type="number" id="total" name="total" readonly value="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-actions mt-2 justify-end">
                        <button type="submit" class="btn btn-error">Reset</button>
                        <button type="submit"class="btn btn-success">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElement = document.getElementById('multipleSelect');
            const hargaBanderolInput = document.getElementById('harga_banderol');
            const qtyInput = document.getElementById('qty');
            const diskonPersenInput = document.getElementById('diskon_persen');
            const diskonNilaiInput = document.getElementById('diskon_nilai');
            const hargaDiskonInput = document.getElementById('harga_diskon');
            const namaInput = document.getElementById('nama');
            const totalInput = document.getElementById('total');
            const selectedOptions = []; // Variabel untuk menyimpan opsi terpilih

            // Fungsi untuk memperbarui input berdasarkan opsi terpilih
            function updateSelectedOptions() {
                qtyInput.addEventListener('change', calculateSubtotal);
                diskonPersenInput.addEventListener('change', calculateSubtotal);
                diskonNilaiInput.addEventListener('change', calculateSubtotal);

                // Reset nilai input sebelum menghitung kembali
                hargaBanderolInput.value = '';
                namaInput.value = '';
                qtyInput.value = '';
                diskonPersenInput.value = '';
                diskonNilaiInput.value = '';
                hargaDiskonInput.value = '';
                totalInput.value = '';

                // Loop melalui setiap opsi terpilih
                for (let i = 0; i < selectedOptions.length; i++) {
                    const optionValue = selectedOptions[i];

                    // Dapatkan data lengkap opsi terpilih dari sumber daya lain (misalnya, AJAX ke backend)

                    // Lakukan permintaan AJAX untuk mendapatkan data lengkap opsi terpilih
                    fetch('{{ url('get-option-details') }}/' + optionValue + '/{{ $hasBarang }}')
                        .then(response => response.json())
                        .then(data => {
                            // Perbarui input berdasarkan data opsi terpilih
                            hargaBanderolInput.value = data.harga;
                            namaInput.value = data.nama;
                            // Lakukan perhitungan subtotal dan total setelah memperbarui input yang relevan
                            calculateSubtotal();
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                        });
                }
            }

            // Event listener saat select berubah
            selectElement.addEventListener('change', () => {
                const selectedValues = Array.from(selectElement.selectedOptions, option => option.value);

                // Loop melalui setiap opsi yang baru dipilih
                for (let i = 0; i < selectedValues.length; i++) {
                    const optionValue = selectedValues[i];

                    // Periksa apakah opsi sudah ada dalam daftar opsi terpilih
                    if (!selectedOptions.includes(optionValue)) {
                        selectedOptions.push(optionValue); // Tambahkan opsi ke daftar opsi terpilih
                    }
                }

                updateSelectedOptions(); // Perbarui input berdasarkan opsi terpilih
            });

            // Fungsi untuk menghitung subtotal dan total
            function calculateSubtotal() {
                var hargaBanderol = parseFloat(hargaBanderolInput.value);
                var qty = parseFloat(qtyInput.value);
                var diskonPersen = parseFloat(diskonPersenInput.value);

                var diskonNilai = 0;
                var hargaDiskon = hargaBanderol;

                if (!isNaN(diskonPersen) && diskonPersen > 0) {
                    diskonNilai = hargaBanderol * (diskonPersen / 100);
                    hargaDiskon = hargaBanderol - diskonNilai;
                }

                var subtotal = hargaDiskon * qty;

                diskonNilaiInput.value = diskonNilai.toFixed(2);
                hargaDiskonInput.value = hargaDiskon.toFixed(2);
                totalInput.value = subtotal.toFixed(2);
            }

            function updateDiskonNilai() {
                var hargaBanderol = parseFloat(hargaBanderolInput.value);
                var diskonPersen = parseFloat(diskonPersenInput.value);

                if (!isNaN(diskonPersen) && diskonPersen > 0) {
                    var diskonNilai = hargaBanderol * (diskonPersen / 100);
                    diskonNilaiInput.value = diskonNilai.toFixed(2);
                } else {
                    diskonNilaiInput.value = 0;
                }

                calculateSubtotal();
            }
        });
    </script>
@endsection
