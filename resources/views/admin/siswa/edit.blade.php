@extends('app')
@section('content')
    <h3 class="top-0 z-10 text-lg font-bold lg:sticky">Tambah Data
        <hr>
    </h3>
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <div class="card-body p-2 pb-14 lg:pb-2">
                <form action="/siswa/{{ $item->nis }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-control w-full max-w-full">
                        <label class="label rounded-lg bg-stone-300">
                            <span class="label-tex text-lg font-medium">Data Siswa</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <div class="overflow-x-auto">
                            <table class="table-compact table">
                                <tr>
                                    <td>
                                        <input name="nis" type="text" placeholder="NIS"
                                            value="{{ old('nis', $item->nis) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('nis')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="nisn" type="text" placeholder="NISN"
                                            value="{{ old('nisn', $item->nisn) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('nisn')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="nama_lengkap" type="text" placeholder="Nama Lengkap"
                                            value="{{ old('nama_lengkap', $item->nama_lengkap) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('nama_lengkap')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="nama_panggilan" type="text" placeholder="Nama Panggilan"
                                            value="{{ old('nama_panggilan', $item->nama_panggilan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('nama_panggilan')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="agama" type="text" placeholder="Agama"
                                            value="{{ old('agama', $item->agama) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('agama')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>

                                </tr>
                                <tr>

                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="tempat_lahir" type="text" placeholder="Tempat Lahir"
                                            value="{{ old('tempat_lahir', $item->tempat_lahir) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('tempat_lahir')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="tanggal_lahir" type="date" placeholder="Tanggal Lahir"
                                            value="{{ old('tanggal_lahir', $item->tanggal_lahir == null ? null : \Carbon\Carbon::createFromLocaleFormat('j F Y', 'id_ID', $item->tanggal_lahir)) }}"
                                            class="datepicker input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('tanggal_lahir')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="kewarganegaraan" type="text" placeholder="Kewarganegaraan"
                                            value="{{ old('kewarganegaraan', $item->kewarganegaraan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('kewarganegaraan')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>

                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="anak_ke" type="number" placeholder="Anak Ke"
                                            value="{{ old('anak_ke', $item->anak_ke) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('anak_ke')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="jumlah_saudara_kandung" type="number" placeholder="Saudara Kandung"
                                            value="{{ old('jumlah_saudara_kandung', $item->jumlah_saudara_kandung) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('jumlah_saudara_kandung')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="jumlah_saudara_angkat" type="number" placeholder="Saudara Angkat"
                                            value="{{ old('jumlah_saudara_angkat', $item->jumlah_saudara_angkat) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('jumlah_saudara_angkat')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="jumlah_saudara_tiri" type="number" placeholder="Saudara Tiri"
                                            value="{{ old('jumlah_saudara_tiri', $item->jumlah_saudara_tiri) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('jumlah_saudara_tiri')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="yatim_piatu" type="text" placeholder="Yatim / Piatu"
                                            value="{{ old('yatim_piatu', $item->yatim_piatu) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('yatim_piatu')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="bahasa" type="text" placeholder="Bahasa Sehari - hari"
                                            value="{{ old('bahasa', $item->bahasa) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('bahasa')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <select class="select-bordered select w-full" name="jenis_kelamin">
                                            <option disabled value="">Jenis Kelamin</option>
                                            <option value="L" @if ($item->jenis_kelamin == 'L') selected @endif>Pria
                                            </option>
                                            <option value="P" @if ($item->jenis_kelamin == 'P') selected @endif>Wanita
                                            </option>
                                        </select>
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('jenis_kelamin')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="form-control w-full max-w-full">
                        <label class="label rounded-lg bg-stone-300">
                            <span class="label-tex text-lg font-medium">Data Kesehatan Siswa</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <div class="overflow-x-auto">
                            <table class="table-compact table">
                                <tr>
                                    <td>
                                        <input name="golongan_darah" type="text" placeholder="Golongan Darah"
                                            value="{{ old('golongan_darah', $kesehatan->golongan_darah) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('golongan_darah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="penyakit_pernah_diderita" type="text"
                                            placeholder="Riwayat Penyakit"
                                            value="{{ old('penyakit_pernah_diderita', $kesehatan->penyakit_pernah_diderita) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('penyakit_pernah_diderita')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="kelainan_jasmani" type="text" placeholder="Kelainan Jasmani"
                                            value="{{ old('kelainan_jasmani', $kesehatan->kelainan_jasmani) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('kelainan_jasmani')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="tinggi_badan" type="text" placeholder="Tinggi Badan"
                                            value="{{ old('tinggi_badan', $kesehatan->tinggi_badan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('tinggi_badan')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="berat_badan" type="text" placeholder="Berat Badan"
                                            value="{{ old('berat_badan', $kesehatan->berat_badan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('berat_badan')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="form-control w-full max-w-full">
                        <label class="label rounded-lg bg-stone-300">
                            <span class="label-tex text-lg font-medium">Data Pendidikan Siswa</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <div class="overflow-x-auto">
                            <table class="table-compact table">
                                <tr>
                                    <td>
                                        <input name="sekolah_asal" type="text" placeholder="Sekolah Asal"
                                            value="{{ old('sekolah_asal', $pendidikan->sekolah_asal) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('sekolah_asal')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="tanggal_ijazah" type="date" placeholder="Tanggal Ijazah"
                                            value="{{ old('tanggal_ijazah', $pendidikan->tanggal_ijazah == null ? null : \Carbon\Carbon::createFromLocaleFormat('j F Y', 'id_ID', $pendidikan->tanggal_ijazah)) }}"
                                            class="datepicker input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('tanggal_ijazah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="nomor_ijazah" type="text" placeholder="Nomor Ijazah"
                                            value="{{ old('nomor_ijazah', $pendidikan->nomor_ijazah) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('nomor_ijazah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="lama_belajar" type="text" placeholder="Lama Belajar"
                                            value="{{ old('lama_belajar', $pendidikan->lama_belajar) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('lama_belajar')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="dari_sekolah" type="text" placeholder="Dari Sekolah"
                                            value="{{ old('dari_sekolah', $pendidikan->dari_sekolah) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('dari_sekolah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>

                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="alasan" type="text" placeholder="Alasan"
                                            value="{{ old('alasan', $pendidikan->alasan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('alasan')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="di_kelas" type="text" placeholder="Di Kelas"
                                            value="{{ old('di_kelas', $pendidikan->di_kelas) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('di_kelas')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="kelompok" type="text" placeholder="Kelompok"
                                            value="{{ old('kelompok', $pendidikan->kelompok) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('kelompok')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="jurusan" type="text" placeholder="Jurusan"
                                            value="{{ old('jurusan', $pendidikan->jurusan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('jurusan')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="tanggal" type="date" placeholder="Tanggal Diterima"
                                            value="{{ old('tanggal', $pendidikan->tanggal == null ? null : \Carbon\Carbon::createFromLocaleFormat('j F Y', 'id_ID', $pendidikan->tanggal)) }}"
                                            class="datepicker input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('tanggal')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-control">
                                            <label class="label cursor-pointer">
                                                <span class="label-text"></span>
                                                <span class="label-text-alt"></span>
                                                <select class="select-bordered select w-full" id="kode_tahun_ajaran"
                                                    name="kode_tahun_ajaran">
                                                    <option disabled selected>Tahun Ajaran</option>
                                                    @foreach ($getTahunAjaran as $TahunAjaran)
                                                        <option value="{{ $TahunAjaran->kode_tahun_ajaran }}"
                                                            {{ old('kode_tahun_ajaran') == $TahunAjaran->kode_tahun_ajaran ? 'selected' : '' }}>
                                                            {{ $TahunAjaran->tahun_ajaran }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="label-text"></span>
                                                <span class="label-text-alt text-red-600">
                                                    @error('kode_tahun_ajaran')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-control">
                                            <label class="label cursor-pointer">
                                                <span class="label-text">Ijazah</span>
                                                <input type="checkbox" name="kumpul_ijazah"
                                                    @if ($pendidikan->kumpul_ijazah == 1) checked="checked" @endif
                                                    value="1" class="checkbox-success checkbox" />
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-control">
                                            <label class="label cursor-pointer">
                                                <span class="label-text">Akte Kelahiran</span>
                                                <input type="checkbox" name="kumpul_akte"
                                                    @if ($pendidikan->kumpul_akte == 1) checked="checked" @endif
                                                    value="1" class="checkbox-success checkbox" />
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-control">
                                            <label class="label cursor-pointer">
                                                <span class="label-text">Kartu Keluarga</span>
                                                <input type="checkbox" name="kumpul_kk"
                                                    @if ($pendidikan->kumpul_kk == 1) checked="checked" @endif
                                                    value="1" class="checkbox-success checkbox" />
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>


                    <div class="form-control mt-10 w-full max-w-full lg:mt-0">
                        <label class="label rounded-lg bg-stone-300">
                            <span class="label-text text-lg font-medium">Alamat</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <div class="overflow-x-auto">
                            <table class="table-compact table">
                                <tr>
                                    <td>

                                        <input name="jalan" type="text" placeholder="Jalan"
                                            value="{{ old('jalan', $alamat->jalan) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('jalan')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="rt_rw" type="text" placeholder="RT/RW"
                                            value="{{ old('rt_rw', $alamat->rt_rw) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('rt_rw')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="desa" type="text" placeholder="Desa"
                                            value="{{ old('desa', $alamat->desa) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('desa')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="kecamatan" type="text" placeholder="Kecamatan"
                                            value="{{ old('kecamatan', $alamat->kecamatan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('kecamatan')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="kabupaten" type="text" placeholder="Kabupaten"
                                            value="{{ old('kabupaten', $alamat->kabupaten) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('kabupaten')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="provinsi" type="text" placeholder="Provinsi"
                                            value="{{ old('provinsi', $alamat->provinsi) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('provinsi')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="kode_pos" type="text" placeholder="Kode Pos"
                                            value="{{ old('kode_pos', $alamat->kode_pos) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('kode_pos')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="tinggal_bersama" type="text" placeholder="Tinggal Bersama"
                                            value="{{ old('tinggal_bersama', $alamat->tinggal_bersama) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('tinggal_bersama')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="jarak_ke_sekolah" type="text" placeholder="Jarak Ke Sekolah"
                                            value="{{ old('jarak_ke_sekolah', $alamat->jarak_ke_sekolah) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('jarak_ke_sekolah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="no_telp" type="text" placeholder="No Telp"
                                            value="{{ old('no_telp', $item->no_telp) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('no_telp')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="form-control mt-10 w-full max-w-full lg:mt-0">
                        <label class="label rounded-lg bg-stone-300">
                            <span class="label-text text-lg font-medium">Data Ayah</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <div class="overflow-x-auto">
                            <table class="table-compact table">
                                <tr>
                                    <td>

                                        <input name="nama_ayah" type="text" placeholder="Nama Ayah"
                                            value="{{ old('nama_ayah', $ayah->nama) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('nama_ayah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="agama_ayah" type="text" placeholder="Agama"
                                            value="{{ old('agama_ayah', $ayah->agama) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('agama_ayah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="kewarganegaraan_ayah" type="text" placeholder="Kewarganegaraan"
                                            value="{{ old('kewarganegaraan_ayah', $ayah->kewarganegaraan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('kewarganegaraan_ayah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="pendidikan_terakhir_ayah" type="text"
                                            placeholder="Pendidikan Terakhir"
                                            value="{{ old('pendidikan_terakhir_ayah', $ayah->pendidikan_terakhir) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('pendidikan_terakhir_ayah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="pekerjaan_ayah" type="text" placeholder="Pekerjaan"
                                            value="{{ old('pekerjaan_ayah', $ayah->pekerjaan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('pekerjaan_ayah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="penghasilan_ayah" type="text" placeholder="Penghasilan"
                                            value="{{ old('penghasilan_ayah', $ayah->penghasilan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('penghasilan_ayah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="no_telp_ayah" type="text" placeholder="No Telp"
                                            value="{{ old('no_telp_ayah', $ayah->no_telp) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('no_telp_ayah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="keadaan_ayah" type="text" placeholder="Keadaan"
                                            value="{{ old('keadaan_ayah', $ayah->keadaan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('keadaan_ayah')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="form-control mt-10 w-full max-w-full lg:mt-0">
                        <label class="label rounded-lg bg-stone-300">
                            <span class="label-text text-lg font-medium">Data Ibu</span>
                            <span class="label-text-alt"></span>
                        </label>

                        <div class="overflow-x-auto">
                            <table class="table-compact table">
                                <tr>
                                    <td>

                                        <input name="nama_ibu" type="text" placeholder="Nama Ibu"
                                            value="{{ old('nama_ibu', $ibu->nama) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('nama_ibu')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="agama_ibu" type="text" placeholder="Agama"
                                            value="{{ old('agama_ibu', $ibu->agama) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('agama_ibu')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="kewarganegaraan_ibu" type="text" placeholder="Kewarganegaraan"
                                            value="{{ old('kewarganegaraan_ibu', $ibu->kewarganegaraan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('kewarganegaraan_ibu')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="pendidikan_terakhir_ibu" type="text"
                                            placeholder="Pendidikan Terakhir"
                                            value="{{ old('pendidikan_terakhir_ibu', $ibu->pendidikan_terakhir) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('pendidikan_terakhir_ibu')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="pekerjaan_ibu" type="text" placeholder="Pekerjaan"
                                            value="{{ old('pekerjaan_ibu', $ibu->pekerjaan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('pekerjaan_ibu')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="penghasilan_ibu" type="text" placeholder="Penghasilan"
                                            value="{{ old('penghasilan_ibu', $ibu->penghasilan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('penghasilan_ibu')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="no_telp_ibu" type="text" placeholder="No Telp"
                                            value="{{ old('no_telp_ibu', $ibu->no_telp) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('no_telp_ibu')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="keadaan_ibu" type="text" placeholder="Keadaan"
                                            value="{{ old('keadaan_ibu', $ibu->keadaan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('keadaan_ibu')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="form-control mt-10 w-full max-w-full lg:mt-0">
                        <label class="label rounded-lg bg-stone-300">
                            <span class="label-text text-lg font-medium">Data Wali</span>
                            <span class="label-text-alt"></span>
                        </label>

                        <div class="overflow-x-auto">
                            <table class="table-compact table">
                                <tr>
                                    <td>

                                        <input name="nama_wali" type="text" placeholder="Nama Wali"
                                            value="{{ old('nama_wali', $wali->nama) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('nama_wali')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="agama_wali" type="text" placeholder="Agama"
                                            value="{{ old('agama_wali', $wali->agama) }}" class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('agama_wali')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="kewarganegaraan_wali" type="text" placeholder="Kewarganegaraan"
                                            value="{{ old('kewarganegaraan_wali', $wali->kewarganegaraan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('kewarganegaraan_wali')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>

                                        <input name="pendidikan_terakhir_wali" type="text"
                                            placeholder="Pendidikan Terakhir"
                                            value="{{ old('pendidikan_terakhir_wali', $wali->pendidikan_terakhir) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('pendidikan_terakhir_wali')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="pekerjaan_wali" type="text" placeholder="Pekerjaan"
                                            value="{{ old('pekerjaan_wali', $wali->pekerjaan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('pekerjaan_wali')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="penghasilan_wali" type="text" placeholder="Penghasilan"
                                            value="{{ old('penghasilan_wali', $wali->penghasilan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('penghasilan_wali')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="no_telp_wali" type="text" placeholder="No Telp"
                                            value="{{ old('no_telp_wali', $wali->no_telp) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('no_telp_wali')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label">
                                            <span class="label-text"></span>
                                            <span class="label-text-alt"></span>
                                        </label>
                                        <input name="keadaan_wali" type="text" placeholder="Keadaan"
                                            value="{{ old('keadaan_wali', $wali->keadaan) }}"
                                            class="input-bordered input">
                                        <label class="label">
                                            <span class="label-text-alt"></span>
                                            <span class="label-text-alt text-red-600">
                                                @error('keadaan_wali')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="form-control w-full max-w-full">
                        <label class="label rounded-lg bg-stone-300">
                            <span class="label-text text-lg font-medium">Password</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="password" type="password" placeholder="" value="{{ old('password') }}" readonly
                            class="input-bordered input mt-2 w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                biarkan kosong jika tidak ingin ganti password
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
