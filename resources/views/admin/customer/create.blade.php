@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="top-0 z-50 bg-transparent text-lg font-bold lg:sticky">Tambah Data
                <hr>
            </h3>
            <div class="card-body p-2 pb-10 lg:pb-0">
                <form action="/customer" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Nama</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="nama" type="text" placeholder="Type here" value="{{ old('nama') }}"
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
                            <span class="label-text">Telp</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="telp" type="tel" placeholder="Type here" value="{{ old('telp') }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('telp')
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
@endsection
