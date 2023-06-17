@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Tambah Data
                <hr>
            </h3>
            <div class="card-body">
                <form action="/transaksi" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-control w-2/12">
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
                                    {{ $customer->nama }} | {{ $customer->kode }}</option>
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

                    <table id="resultTable" class="table-compact table w-full">
                        <thead class="table-header-group">
                            <th colspan="4" class="text-center">Hasil Select</th>
                        </thead>
                        <tbody id="resultTableBody">
                            <!-- Tempatkan hasil select di sini -->
                        </tbody>
                    </table>

                    <div class="mt-5">
                        Total Harga : <span id="totalHarga"></span>
                    </div>


                    <input type="hidden" name="kode[]" value="">
                    <input type="hidden" name="total" id="totalInput" value="">

                    <div class="card-actions mt-5 justify-end">
                        <button type="reset" class="btn btn-error">Reset</button>
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

                    // Lakukan permintaan AJAX untuk mendapatkan data lengkap opsi terpilih
                    fetch('{{ url('get-option-details') }}/' + optionValue + '/{{ $hasBarang }}')
                        .then(response => response.json())
                        .then(data => {
                            // Buat baris dan sel baru untuk setiap opsi terpilih
                            const newRow = document.createElement('tr');

                            // Sel untuk menampilkan nilai opsi
                            const kodeCell = document.createElement('td');
                            kodeCell.textContent = data.kode;

                            // Sel untuk menampilkan nilai opsi
                            const valueCell = document.createElement('td');
                            valueCell.textContent = data.nama;

                            // Sel untuk menampilkan harga
                            const priceCell = document.createElement('td');
                            priceCell.textContent = 'Rp.' + parseFloat(data.harga).toLocaleString('id-ID');

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
                            newRow.appendChild(kodeCell);
                            newRow.appendChild(valueCell);
                            newRow.appendChild(priceCell);
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
                totalHargaElement.textContent = totalHarga;




                // Perbarui input type hidden setiap kali tabel diperbarui
                updateHiddenInputs();

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
@endsection
