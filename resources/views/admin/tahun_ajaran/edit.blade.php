@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Ubah Data
                <hr>
            </h3>
            <div class="card-body">
                <form action="/tahun_ajaran/{{ $item->kode_tahun_ajaran }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Kode Tahun Ajaran</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="kode_tahun_ajaran" type="text" placeholder="Type here"
                            value="{{ old('kode_tahun_ajaran', $item->kode_tahun_ajaran) }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('kode_tahun_ajaran')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Tahun Ajaran</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="tahun_ajaran" type="text" placeholder="Type here"
                            value="{{ old('tahun_ajaran', $item->tahun_ajaran) }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('tahun_ajaran')
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
    <form id="yourForm">
        @csrf
        <select name="options[]" multiple>
            @foreach ($options as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </form>

    <table id="yourTable">
        <!-- Tabel untuk menampilkan data terpilih -->
    </table>

    <script>
        $(document).ready(function() {
            $('select[name="options[]"]').on('change', function() {
                var selectedOptions = $(this).val();
                $.ajax({
                    url: "{{ route('your.route.name') }}",
                    method: 'POST',
                    data: {
                        options: selectedOptions
                    },
                    success: function(response) {
                        // Update tabel dengan data terpilih
                        $('#yourTable').html(response.html);
                    }
                });
            });
        });
    </script>
@endsection
