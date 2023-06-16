@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Ubah Data
                <hr>
            </h3>
            <div class="card-body">
                <form action="/barang/{{ $item->kode }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Nama</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="nama" type="text" placeholder="Type here" value="{{ old('nama', $item->nama) }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nama')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>

                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Harga</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="harga" type="text" id="inputHarga" data-harga="{{ $item->harga }}"
                            placeholder="Type here" value="{{ old('harga', $item->harga) }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('harga')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="card-actions justify-end">
                        <button type="submit" class="btn btn-error">Reset</button>
                        <button type="submit"class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Mendapatkan nilai harga dari database
        var hargaDariDatabase = document.getElementById('inputHarga').dataset.harga; // Contoh nilai harga dari database

        // Menghilangkan .00 pada data decimal
        var hargaTanpaDecimal = parseFloat(hargaDariDatabase).toFixed(0);

        // Mengatur nilai input type text
        var inputHarga = document.getElementById('inputHarga');
        inputHarga.value = hargaTanpaDecimal;
    </script>
@endsection
