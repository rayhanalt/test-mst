@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Tambah Data
                <hr>
            </h3>
            <div class="card-body">
                <form action="/kelas" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Nama Kelas</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="nama_kelas" type="text" placeholder="Type here" value="{{ old('nama_kelas') }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nama_kelas')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>

                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">
                                Kapasitas
                            </span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="kapasitas" type="number" placeholder="Type here" value="{{ old('kapasitas') }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('kapasitas')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>

                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Wali Kelas</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <select class="select-bordered select" id="nip" name="nip">
                            <option disabled selected>Pick one</option>
                            @foreach ($getWaliKelas as $waliKelas)
                                <option value="{{ $waliKelas->nip }}" {{ old('nip') == $waliKelas->nip ? 'selected' : '' }}>
                                    {{ $waliKelas->nama_guru }} | {{ $waliKelas->nip }}</option>
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
                    <div class="card-actions justify-end">
                        <button type="submit" class="btn-error btn">Reset</button>
                        <button type="submit"class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
