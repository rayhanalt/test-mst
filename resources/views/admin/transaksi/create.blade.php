@extends('app')
@section('content')
    <style>
        .right-align {
            text-align: right;
        }
    </style>

    <h3 class="top-0 z-50 bg-transparent text-lg font-bold lg:sticky">Tambah Data
        <hr>
    </h3>
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <div class="card-body p-2 pb-10 lg:pb-0">
                <form action="/transaksi" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-control sm:w-2/6">
                        <label class="label">
                            <span class="label-text">Tanggal Transaksi</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="tanggal_lahir" type="date" placeholder="Tanggal Transaksi"
                            value="{{ old('tanggal_lahir') }}" class="datepicker input-bordered input">
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('tanggal_lahir')
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
                        <select class="select-bordered select" name="kode_cust">
                            <option disabled selected>Pick one</option>
                            @foreach ($hasCust as $customer)
                                <option value="{{ $customer->kode }}"
                                    {{ old('kode') == $customer->kode ? 'selected' : '' }}>
                                    {{ $customer->nama }} | {{ $customer->telp }}</option>
                            @endforeach
                        </select>
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nip')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>

                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Barang</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <select id="multipleSelect" name="barang[]" class="select-bordered select">
                            <!-- Opsi-opsi select -->
                            <option disabled selected>Pick one</option>
                            @foreach ($hasBarang as $barang)
                                <option value="{{ $barang->kode }}" {{ old('kode') == $barang->kode ? 'selected' : '' }}>
                                    {{ $barang->nama }} | {{ 'Rp. ' . number_format($barang->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                            <!-- dan seterusnya -->
                        </select>
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nip')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
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
                            <tbody id="resultTableBody" class="border-2">
                                <!-- Tempatkan hasil select di sini -->
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-5">
                        <div>
                            Total Harga: <span id="totalHarga"></span>
                        </div>
                        <div>
                            Diskon: <input type="number" id="diskonUser" name="diskon_user" onchange="totalBayar()">
                        </div>
                        <div>
                            Ongkir: <input type="number" id="ongkirUser" name="ongkir_user" onchange="totalBayar()">
                        </div>
                        <div>
                            Total yang Harus Dibayar: <span id="totalBayar"></span>
                        </div>
                    </div>


                    <input type="hidden" name="kode[]" value="">
                    <input type="hidden" name="total" id="totalInput" value="">
                    <input type="hidden" name="total_bayar" id="totalBayarInput" value="">

                    <div class="card-actions mt-5 justify-end">
                        <button type="reset" class="btn-error btn">Reset</button>
                        <button type="submit"class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElement = document.getElementById('multipleSelect');
            const resultTableBody = document.getElementById('resultTableBody');
            const selectedOptions = []; // Variabel untuk menyimpan opsi terpilih
            let totalHarga = 0; // Variabel untuk menyimpan total harga
            const hiddenInput = document.getElementById('hiddenInput');

            // Fungsi untuk memperbarui tabel berdasarkan opsi terpilih
            function updateResultTable() {
                // Bersihkan isi tabel sebelum menambahkan data baru
                resultTableBody.innerHTML = '';

                // Reset total harga sebelum menghitung kembali
                totalHarga = 0;

                // Loop melalui setiap opsi terpilih
                for (let i = 0; i < selectedOptions.length; i++) {
                    const optionValue = selectedOptions[i];
                    const iterationNumber = i + 1; // Nomor iterasi

                    // Lakukan permintaan AJAX untuk mendapatkan data lengkap opsi terpilih
                    fetch('{{ url('get-option-details') }}/' + optionValue + '/{{ $hasBarang }}')
                        .then(response => response.json())
                        .then(data => {
                            // Buat baris dan sel baru untuk setiap opsi terpilih
                            const newRow = document.createElement('tr');

                            // Sel untuk menampilkan nilai opsi
                            const noCell = document.createElement('td');
                            noCell.textContent = iterationNumber;

                            // Sel untuk menampilkan nilai opsi
                            const kodeCell = document.createElement('td');
                            kodeCell.textContent = data.kode;

                            // Sel untuk menampilkan nilai opsi
                            const valueCell = document.createElement('td');
                            valueCell.textContent = data.nama;

                            // Sel untuk menampilkan harga
                            const priceCell = document.createElement('td');
                            priceCell.textContent = 'Rp.' + parseFloat(data.harga).toLocaleString('id-ID');

                            // Kolom Qty
                            const qtyCell = document.createElement('td');
                            const qtyInput = document.createElement('input');
                            qtyInput.type = 'number';
                            qtyInput.value = 1; // Default value
                            qtyInput.classList.add('right-align');
                            qtyInput.name = 'qty[]';
                            qtyInput.addEventListener('input', () => {
                                updateSubtotal(newRow, data.harga, qtyInput.value, diskonPercentInput
                                    .value, diskonAmountInput.value);
                            });
                            qtyCell.appendChild(qtyInput);

                            // Kolom Diskon (%) dan (Rp)
                            const diskonPercentCell = document.createElement('td');
                            const diskonPercentInput = document.createElement('input');
                            diskonPercentInput.type = 'number';
                            diskonPercentInput.value = 0; // Default value
                            diskonPercentInput.name = 'diskon_persen[]'; // Default value
                            diskonPercentInput.classList.add('right-align');
                            diskonPercentInput.addEventListener('input', () => {
                                // Mengupdate nilai diskon dalam bentuk uang
                                const diskonPercent = parseFloat(diskonPercentInput.value);
                                const diskonAmount = (parseFloat(data.harga) * diskonPercent) / 100;
                                diskonAmountInput.value = diskonAmount;
                                updateSubtotal(newRow, data.harga, qtyInput.value, diskonPercentInput
                                    .value, diskonAmount);
                            });
                            diskonPercentCell.appendChild(diskonPercentInput);

                            const diskonAmountCell = document.createElement('td');
                            const diskonAmountInput = document.createElement('input');
                            diskonAmountInput.type = 'number';
                            diskonAmountInput.value = 0; // Default value
                            diskonAmountInput.name = 'diskon_nilai[]'; // Default value
                            diskonAmountInput.classList.add('right-align');
                            diskonAmountInput.addEventListener('input', () => {
                                // Mengupdate nilai diskon dalam persentase
                                const diskonAmount = parseFloat(diskonAmountInput.value);
                                const diskonPercent = (diskonAmount / parseFloat(data.harga)) * 100;
                                diskonPercentInput.value = diskonPercent;
                                updateSubtotal(newRow, data.harga, qtyInput.value, diskonPercent,
                                    diskonAmountInput.value);
                            });
                            diskonAmountCell.appendChild(diskonAmountInput);

                            const hargaDiskonCell = document.createElement('td');
                            hargaDiskonCell.textContent = 'Rp.0';

                            // Kolom Subtotal
                            const subtotalCell = document.createElement('td');
                            subtotalCell.textContent = 'Rp.0';

                            // Tambahkan harga ke total harga
                            totalHarga += parseFloat(data.harga);

                            // Sel untuk tombol hapus
                            const deleteCell = document.createElement('td');
                            const deleteButton = document.createElement('button');
                            deleteButton.textContent = 'Hapus';
                            deleteButton.addEventListener('click', () => {
                                // Hapus opsi dari daftar opsi terpilih
                                selectedOptions.splice(i, 1);
                                updateResultTable(); // Perbarui tabel setelah menghapus opsi
                                // Periksa apakah daftar opsi terpilih kosong setelah menghapus
                                if (selectedOptions.length === 0) {
                                    selectElement.selectedIndex = 0;
                                    totalHarga = 0; // Set total harga menjadi 0
                                }
                            });

                            deleteCell.appendChild(deleteButton);
                            newRow.appendChild(noCell);
                            newRow.appendChild(kodeCell);
                            newRow.appendChild(valueCell);
                            newRow.appendChild(priceCell);
                            newRow.appendChild(qtyCell);
                            newRow.appendChild(diskonPercentCell);
                            newRow.appendChild(diskonAmountCell);
                            newRow.appendChild(hargaDiskonCell);
                            newRow.appendChild(subtotalCell);
                            newRow.appendChild(deleteCell);

                            resultTableBody.appendChild(newRow);

                            // Perbarui total harga pada elemen HTML yang menampilkannya
                            const totalHargaElement = document.getElementById('totalHarga');
                            totalHargaElement.textContent = 'Rp.' + parseFloat(totalHarga).toLocaleString(
                                'id-ID');

                            // Perbarui nilai input total
                            const totalInput = document.getElementById('totalInput');
                            totalInput.value = totalHarga;
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                        });
                }
                // Periksa apakah daftar opsi terpilih kosong
                if (selectedOptions.length === 0) {
                    totalHarga = 0; // Set total harga menjadi 0
                }

                // Perbarui total harga pada elemen HTML yang menampilkannya
                const totalHargaElement = document.getElementById('totalHarga');
                totalHargaElement.textContent = 'Rp.' + totalHarga;

                // Perbarui input type hidden setiap kali tabel diperbarui
                updateHiddenInputs();
            }


            function updateSubtotal(row, harga, qty, diskonPercent, diskonAmount) {
                const hargaDiskonCell = row.querySelector('td:nth-child(8)');
                const subtotalCell = row.querySelector('td:nth-child(9)');

                let subtotal = parseFloat(harga) * parseInt(qty);

                // Hapus elemen input type hidden dengan name="harga_diskon" jika ada
                const existingHargaDiskonInput = row.querySelector('input[name="harga_diskon[]"]');
                const existingSubtotalInput = row.querySelector('input[name="subtotal[]"]');

                if (existingHargaDiskonInput) {
                    existingHargaDiskonInput.remove();
                }

                if (existingSubtotalInput) {
                    existingSubtotalInput.remove();
                }

                if (diskonPercent > 0) {
                    const diskon = (subtotal * diskonPercent) / 100;
                    const hargaDiskon = harga - (harga * diskonPercent) / 100;

                    hargaDiskonCell.textContent = 'Rp.' + hargaDiskon.toLocaleString('id-ID');
                    subtotal -= diskon;

                    // Buat elemen input type hidden untuk harga_diskon
                    const hargaDiskonInput = document.createElement('input');
                    hargaDiskonInput.setAttribute('type', 'hidden');
                    hargaDiskonInput.setAttribute('name', 'harga_diskon[]');
                    hargaDiskonInput.setAttribute('value', hargaDiskon);
                    row.appendChild(hargaDiskonInput);

                    // Buat elemen input type hidden untuk subtotal
                    const subtotalInput = document.createElement('input');
                    subtotalInput.setAttribute('type', 'hidden');
                    subtotalInput.setAttribute('name', 'subtotal[]');
                    subtotalInput.setAttribute('value', subtotal);
                    row.appendChild(subtotalInput);


                } else if (diskonAmount > 0) {
                    const diskon = parseFloat(diskonAmount);
                    hargaDiskonCell.textContent = 'Rp.' + hargaDiskon.toLocaleString('id-ID');
                    subtotal -= diskon;
                } else {
                    hargaDiskonCell.textContent = 'Rp.0';
                }

                subtotalCell.textContent = 'Rp.' + subtotal.toLocaleString('id-ID');
                calculateTotalHarga();
            }


            function calculateTotalHarga() {
                totalHarga = 0;
                const subtotalCells = document.querySelectorAll('#resultTableBody td:nth-child(9)');
                subtotalCells.forEach(cell => {
                    totalHarga += parseFloat(cell.textContent.replace('Rp.', '').replace('.', '').replace(
                        ',', ''));
                });

                const totalHargaElement = document.getElementById('totalHarga');
                totalHargaElement.textContent = 'Rp.' + totalHarga.toLocaleString('id-ID');

                // Update input hidden dengan name 'total'
                const totalInput = document.getElementById('totalInput');
                totalInput.value = totalHarga;
            }

            // Fungsi untuk memperbarui input type hidden dengan data kode terpilih
            function updateHiddenInputs() {
                const form = document.getElementById('myForm');
                const existingInputs = document.querySelectorAll('input[name="kode[]"]');

                // Hapus input type hidden yang sudah ada
                existingInputs.forEach(input => {
                    input.remove();
                });

                // Buat input type hidden baru untuk setiap kode terpilih
                selectedOptions.forEach(kode => {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('name', 'kode[]');
                    input.setAttribute('value', kode);
                    form.appendChild(input);
                });

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

                updateResultTable(); // Perbarui tabel berdasarkan opsi terpilih
            });


        });
    </script>
    <script>
        function totalBayar() {
            const totalHargaElement = document.getElementById('totalInput');
            const diskonElement = document.getElementById('diskonUser');
            const ongkirUserElement = document.getElementById('ongkirUser');
            const totalBayarElement = document.getElementById('totalBayar');

            const totalHargaValue = parseFloat(totalHargaElement.value) || 0; // Menggunakan nilai totalHarga global
            const diskon = parseFloat(diskonElement.value) || 0;
            const ongkir = parseFloat(ongkirUserElement.value) || 0;

            const totalBayar = totalHargaValue - (diskon + ongkir);

            // Update input hidden dengan name 'total'
            const totalbayarInput = document.getElementById('totalBayarInput');
            totalbayarInput.value = totalBayar;

            totalBayarElement.textContent = 'Rp.' + totalBayar.toLocaleString('id-ID');
        }
    </script>
@endsection
