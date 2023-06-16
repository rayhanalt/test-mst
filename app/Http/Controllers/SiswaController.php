<?php

namespace App\Http\Controllers;

use App\Models\alamat;
use PDF;
use App\Models\kesehatan;
use Illuminate\Http\Request;
use App\Models\orangtua_wali;
use App\Models\pendidikan_sebelum;
use Illuminate\Support\Facades\DB;
use App\Models\siswa as ModelsSiswa;
use App\Models\tahunAjaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\App;


class SiswaController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.siswa.index');
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.siswa.create', [
                'getTahunAjaran' => tahunAjaran::orderBy('kode_tahun_ajaran', 'asc')->get()
            ]);
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->jabatan == 'admin') {

            // validasi Data siswa
            $validasiSiswa = $request->validate([
                'nis' => 'required|numeric|unique:siswa,nis|unique:users,username',
                'nisn' => 'required|numeric|unique:siswa,nisn',
                'nama_lengkap' => 'required',
                'nama_panggilan' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'kewarganegaraan' => 'required',
                'anak_ke' => '',
                'jumlah_saudara_kandung' => '',
                'jumlah_saudara_angkat' => '',
                'jumlah_saudara_tiri' => '',
                'bahasa' => 'required',
                'yatim_piatu' => '',
                'agama' => 'required',
                'jenis_kelamin' => 'required',
                'no_telp' => 'required',
                'kode_tahun_ajaran' => 'required',
            ]);

            // validasi data kesehatan siswa
            $validasikesehatan = $request->validate([
                'nis' => 'required',
                'golongan_darah' => '',
                'penyakit_pernah_diderita' => '',
                'kelainan_jasmani' => '',
                'tinggi_badan' => '',
                'berat_badan' => '',
            ]);

            // validasi data pendidikan sebelum siswa
            $validasiPendidikanSebelum = $request->validate([
                'nis' => 'required',
                'sekolah_asal' => '',
                'tanggal_ijazah' => '',
                'nomor_ijazah' => '',
                'lama_belajar' => '',
                'dari_sekolah' => '',
                'alasan' => '',
                'di_kelas' => '',
                'kelompok' => '',
                'jurusan' => '',
                'tanggal' => '',
                'kumpul_ijazah' => 'nullable|boolean',
                'kumpul_akte' => 'nullable|boolean',
                'kumpul_kk' => 'nullable|boolean',
            ]);

            // validasi alamat siswa
            $validasialamat = $request->validate([
                'nis' => 'required',
                'jalan' => 'required',
                'rt_rw' => 'required',
                'desa' => 'required',
                'kecamatan' => 'required',
                'kabupaten' => 'required',
                'provinsi' => 'required',
                'kode_pos' => 'required',
                'tinggal_bersama' => 'required',
                'jarak_ke_sekolah' => '',

            ]);

            // ubah format tanggal ke text tanggal '20 maret 2019'
            $validasiSiswa['tanggal_lahir'] = \Carbon\Carbon::parse($request->tanggal_lahir)->isoFormat('D MMMM Y');
            $validasiPendidikanSebelum['tanggal_ijazah'] = \Carbon\Carbon::parse($request->tanggal_ijazah)->isoFormat('D MMMM Y');
            $validasiPendidikanSebelum['tanggal'] = \Carbon\Carbon::parse($request->tanggal)->isoFormat('D MMMM Y');

            // boolean default
            $validasiPendidikanSebelum['kumpul_ijazah'] = $validasiPendidikanSebelum['kumpul_ijazah'] ?? 0;
            $validasiPendidikanSebelum['kumpul_akte'] = $validasiPendidikanSebelum['kumpul_akte'] ?? 0;
            $validasiPendidikanSebelum['kumpul_kk'] = $validasiPendidikanSebelum['kumpul_kk'] ?? 0;

            // create validasi2 sebelumnya
            ModelsSiswa::create($validasiSiswa);
            kesehatan::create($validasikesehatan);
            pendidikan_sebelum::create($validasiPendidikanSebelum);
            alamat::create($validasialamat);

            // create ayah
            orangtua_wali::create([
                'nis' => $request->nis,
                'nama' => $request->nama_ayah,
                'agama' => $request->agama_ayah,
                'kewarganegaraan' => $request->kewarganegaraan_ayah,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_ayah,
                'pekerjaan' => $request->pekerjaan_ayah,
                'penghasilan' => $request->penghasilan_ayah,
                'no_telp' => $request->no_telp_ayah,
                'keadaan' => $request->keadaan_ayah,
                'status' => 'ayah'
            ]);

            // create ibu
            orangtua_wali::create([
                'nis' => $request->nis,
                'nama' => $request->nama_ibu,
                'agama' => $request->agama_ibu,
                'kewarganegaraan' => $request->kewarganegaraan_ibu,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_ibu,
                'pekerjaan' => $request->pekerjaan_ibu,
                'penghasilan' => $request->penghasilan_ibu,
                'no_telp' => $request->no_telp_ibu,
                'keadaan' => $request->keadaan_ibu,
                'status' => 'ibu'
            ]);

            // create wali
            orangtua_wali::create([
                'nis' => $request->nis,
                'nama' => $request->nama_wali,
                'agama' => $request->agama_wali,
                'kewarganegaraan' => $request->kewarganegaraan_wali,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_wali,
                'pekerjaan' => $request->pekerjaan_wali,
                'penghasilan' => $request->penghasilan_wali,
                'no_telp' => $request->no_telp_wali,
                'keadaan' => $request->keadaan_wali,
                'status' => 'wali'
            ]);

            DB::table('users')->insert([
                'username' => $validasiSiswa['nis'],
                'password' => bcrypt('12345'),
                'jabatan' => 'siswa',
            ]);

            return redirect('/siswa')->with('success', 'New Data has been added!')->withInput();
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsSiswa $siswa, Request $request)
    {
        // dd(json_encode($request->query('iteration')));
        $users = ModelsSiswa::with('haveAlamat', 'haveKesehatan', 'havePendidikanSebelum')->where('nis', $siswa->nis)->first();
        $ayah = orangtua_wali::where('nis', $siswa->nis)->where('status', 'ayah')->first();
        $ibu = orangtua_wali::where('nis', $siswa->nis)->where('status', 'ibu')->first();
        $wali = orangtua_wali::where('nis', $siswa->nis)->where('status', 'wali')->first();

        // $tanggal_lahir = Carbon::parse($users->tanggal_lahir);
        // $tgl_format = $tanggal_lahir->format("j F Y");

        $data = [
            'iteration' => $request->query('iteration'),
            'title' => 'Laporan Data Siswa',
            'date' => date('m/d/Y'),
            'siswa' => $users,
            'ayah' => $ayah,
            'ibu' => $ibu,
            'wali' => $wali,
            // 'tanggal_lahir' => $tgl_format
        ];
        // return view('admin.siswa.pdf', $data);

        $pdf = PDF::loadView('admin.siswa.pdf', $data);
        $set = $pdf->setPaper('Legal', 'portrait');
        return $set->stream("Data-$siswa->nis-$siswa->nama_lengkap.pdf");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelsSiswa $siswa)
    {
        // set timezone menjadi Asia/Jakarta
        // $date = Carbon::createFromLocaleFormat('j F Y', 'id_ID', $siswa->havePendidikanSebelum()->first()->tanggal_ijazah);
        // $date->setTimezone('Asia/Jakarta');
        // dd(json_encode($date));

        // dd(json_encode($date));
        if (Auth::user()->jabatan == 'admin') {
            return view('admin.siswa.edit', [
                'item' => $siswa,
                'alamat' => $siswa->haveAlamat()->first(),
                'kesehatan' => $siswa->haveKesehatan()->first(),
                'pendidikan' => $siswa->havePendidikanSebelum()->first(),
                'ayah' => $siswa->haveOrangtuaWali()->where('status', 'ayah')->first(),
                'ibu' => $siswa->haveOrangtuaWali()->where('status', 'ibu')->first(),
                'wali' => $siswa->haveOrangtuaWali()->where('status', 'wali')->first(),
                'getTahunAjaran' => $siswa->getTahunAjaran()->orderBy('kode_tahun_ajaran', 'asc')->get()
            ]);
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk halaman Edit Pegawai Lain.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelsSiswa $siswa)
    {
        $request->validate([
            'nis' => 'required|numeric',
            'nisn' => 'required|numeric',
            'nama_lengkap' => 'required',
            'nama_panggilan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kewarganegaraan' => 'required',
            'anak_ke' => '',
            'jumlah_saudara_kandung' => '',
            'jumlah_saudara_angkat' => '',
            'jumlah_saudara_tiri' => '',
            'bahasa' => 'required',
            'yatim_piatu' => '',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'kode_tahun_ajaran' => 'required',
        ]);
        // validasi kesehatan
        $request->validate([
            'nis' => 'required',
            'golongan_darah' => '',
            'penyakit_pernah_diderita' => '',
            'kelainan_jasmani' => '',
            'tinggi_badan' => '',
            'berat_badan' => '',
        ]);
        // validasi pendidikan sebelum
        $request->validate([
            'nis' => 'required',
            'sekolah_asal' => '',
            'tanggal_ijazah' => '',
            'nomor_ijazah' => '',
            'lama_belajar' => '',
            'dari_sekolah' => '',
            'alasan' => '',
            'di_kelas' => '',
            'kelompok' => '',
            'jurusan' => '',
            'tanggal' => '',
            'kumpul_ijazah' => 'nullable|boolean',
            'kumpul_akte' => 'nullable|boolean',
            'kumpul_kk' => 'nullable|boolean',
        ]);
        // validasi alamat
        $request->validate([
            'nis' => 'required',
            'jalan' => 'required',
            'rt_rw' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'kode_pos' => 'required',
            'tinggal_bersama' => 'required',
            'jarak_ke_sekolah' => '',

        ]);

        if ($siswa->nis != $request->nis) {
            $request->validate([
                'nis' => 'unique:siswa,nis|unique:users,username',
            ]);
        }
        if ($siswa->nisn != $request->nisn) {
            $request->validate([
                'nisn' => 'unique:siswa,nisn',
            ]);
        }
        $tgl_lahir = \Carbon\Carbon::parse($request->tanggal_lahir)->isoFormat('D MMMM Y');
        $tgl_ijazah = \Carbon\Carbon::parse($request->tanggal_ijazah)->isoFormat('D MMMM Y');
        $tgl_diterima = \Carbon\Carbon::parse($request->tanggal)->isoFormat('D MMMM Y');
        // dd(json_encode($tgl_ijazah));

        if ($request->password != null) {
            // update user
            DB::table('users')->where('username', '=', "$siswa->nis")->update([
                'username' => $request->nis,
                'password' => bcrypt($request->password),
            ]);
            // update kesehatan
            DB::table('kesehatan')->where('nis', '=', $siswa->nis)->update([
                'nis' => $request->nis,
                'golongan_darah' => $request->golongan_darah,
                'penyakit_pernah_diderita' => $request->penyakit_pernah_diderita,
                'kelainan_jasmani' => $request->kelainan_jasmani,
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
            ]);
            // update pendidikan sebeum
            DB::table('pendidikan_sebelum')->where('nis', '=', $siswa->nis)->update([
                'nis' => $request->nis,
                'sekolah_asal' => $request->sekolah_asal,
                'tanggal_ijazah' => $tgl_ijazah,
                'nomor_ijazah' => $request->nomor_ijazah,
                'lama_belajar' => $request->lama_belajar,
                'dari_sekolah' => $request->dari_sekolah,
                'alasan' => $request->alasan,
                'di_kelas' => $request->di_kelas,
                'kelompok' => $request->kelompok,
                'jurusan' => $request->jurusan,
                'tanggal' => $tgl_diterima,
                'kumpul_ijazah' => $request->kumpul_ijazah ?? 0,
                'kumpul_akte' => $request->kumpul_akte ?? 0,
                'kumpul_kk' => $request->kumpul_kk ?? 0,
            ]);
            // update alamat
            DB::table('alamat')->where('nis', '=', $siswa->nis)->update([
                'nis' => $request->nis,
                'jalan' => $request->jalan,
                'rt_rw' => $request->rt_rw,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
                'tinggal_bersama' => $request->tinggal_bersama,
                'jarak_ke_sekolah' => $request->jarak_ke_sekolah,
            ]);
            // update ibu
            DB::table('orangtua_wali')->where('nis', '=', $siswa->nis)->where('status', '=', 'ibu')->update([
                'nis' => $request->nis,
                'nama' => $request->nama_ibu,
                'agama' => $request->agama_ibu,
                'kewarganegaraan' => $request->kewarganegaraan_ibu,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_ibu,
                'pekerjaan' => $request->pekerjaan_ibu,
                'penghasilan' => $request->penghasilan_ibu,
                'no_telp' => $request->no_telp_ibu,
                'keadaan' => $request->keadaan_ibu,
                'status' => 'ibu'
            ]);
            // update ayah
            DB::table('orangtua_wali')->where('nis', '=', $siswa->nis)->where('status', '=', 'ayah')->update([
                'nis' => $request->nis,
                'nama' => $request->nama_ayah,
                'agama' => $request->agama_ayah,
                'kewarganegaraan' => $request->kewarganegaraan_ayah,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_ayah,
                'pekerjaan' => $request->pekerjaan_ayah,
                'penghasilan' => $request->penghasilan_ayah,
                'no_telp' => $request->no_telp_ayah,
                'keadaan' => $request->keadaan_ayah,
                'status' => 'ayah'
            ]);
            // update wali
            DB::table('orangtua_wali')->where('nis', '=', $siswa->nis)->where('status', '=', 'wali')->update([
                'nis' => $request->nis,
                'nama' => $request->nama_wali,
                'agama' => $request->agama_wali,
                'kewarganegaraan' => $request->kewarganegaraan_wali,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_wali,
                'pekerjaan' => $request->pekerjaan_wali,
                'penghasilan' => $request->penghasilan_wali,
                'no_telp' => $request->no_telp_wali,
                'keadaan' => $request->keadaan_wali,
                'status' => 'wali'
            ]);
            // update siswa
            ModelsSiswa::where('nis', $siswa->nis)->update([
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggilan' => $request->nama_panggilan,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tgl_lahir,
                'kewarganegaraan' => $request->kewarganegaraan,
                'anak_ke' => $request->anak_ke,
                'jumlah_saudara_kandung' => $request->jumlah_saudara_kandung,
                'jumlah_saudara_angkat' => $request->jumlah_saudara_angkat,
                'jumlah_saudara_tiri' => $request->jumlah_saudara_tiri,
                'bahasa' => $request->bahasa,
                'agama' => $request->agama,
                'yatim_piatu' => $request->yatim_piatu,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
                'kode_tahun_ajaran' => $request->kode_tahun_ajaran,
            ]);
        }

        if ($request->password == null) {
            // update user
            // dd($request->nis);
            DB::table('users')->where('username', '=', "$siswa->nis")->update([
                'username' => $request->nis,
            ]);
            // update kesehatan
            DB::table('kesehatan')->where('nis', '=', $siswa->nis)->update([
                'nis' => $request->nis,
                'golongan_darah' => $request->golongan_darah,
                'penyakit_pernah_diderita' => $request->penyakit_pernah_diderita,
                'kelainan_jasmani' => $request->kelainan_jasmani,
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
            ]);
            // update pendidikan sebeum
            DB::table('pendidikan_sebelum')->where('nis', '=', $siswa->nis)->update([
                'nis' => $request->nis,
                'sekolah_asal' => $request->sekolah_asal,
                'tanggal_ijazah' => $tgl_ijazah,
                'nomor_ijazah' => $request->nomor_ijazah,
                'lama_belajar' => $request->lama_belajar,
                'dari_sekolah' => $request->dari_sekolah,
                'alasan' => $request->alasan,
                'di_kelas' => $request->di_kelas,
                'kelompok' => $request->kelompok,
                'jurusan' => $request->jurusan,
                'tanggal' => $tgl_diterima,
                'kumpul_ijazah' => $request->kumpul_ijazah ?? 0,
                'kumpul_akte' => $request->kumpul_akte ?? 0,
                'kumpul_kk' => $request->kumpul_kk ?? 0,
            ]);
            // update alamat
            DB::table('alamat')->where('nis', '=', $siswa->nis)->update([
                'nis' => $request->nis,
                'jalan' => $request->jalan,
                'rt_rw' => $request->rt_rw,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
                'tinggal_bersama' => $request->tinggal_bersama,
                'jarak_ke_sekolah' => $request->jarak_ke_sekolah,
            ]);
            // update ibu
            DB::table('orangtua_wali')->where('nis', '=', $siswa->nis)->where('status', '=', 'ibu')->update([
                'nis' => $request->nis,
                'nama' => $request->nama_ibu,
                'agama' => $request->agama_ibu,
                'kewarganegaraan' => $request->kewarganegaraan_ibu,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_ibu,
                'pekerjaan' => $request->pekerjaan_ibu,
                'penghasilan' => $request->penghasilan_ibu,
                'no_telp' => $request->no_telp_ibu,
                'keadaan' => $request->keadaan_ibu,
                'status' => 'ibu'
            ]);
            // update ayah
            DB::table('orangtua_wali')->where('nis', '=', $siswa->nis)->where('status', '=', 'ayah')->update([
                'nis' => $request->nis,
                'nama' => $request->nama_ayah,
                'agama' => $request->agama_ayah,
                'kewarganegaraan' => $request->kewarganegaraan_ayah,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_ayah,
                'pekerjaan' => $request->pekerjaan_ayah,
                'penghasilan' => $request->penghasilan_ayah,
                'no_telp' => $request->no_telp_ayah,
                'keadaan' => $request->keadaan_ayah,
                'status' => 'ayah'
            ]);
            // update wali
            DB::table('orangtua_wali')->where('nis', '=', $siswa->nis)->where('status', '=', 'wali')->update([
                'nis' => $request->nis,
                'nama' => $request->nama_wali,
                'agama' => $request->agama_wali,
                'kewarganegaraan' => $request->kewarganegaraan_wali,
                'pendidikan_terakhir' => $request->pendidikan_terakhir_wali,
                'pekerjaan' => $request->pekerjaan_wali,
                'penghasilan' => $request->penghasilan_wali,
                'no_telp' => $request->no_telp_wali,
                'keadaan' => $request->keadaan_wali,
                'status' => 'wali'
            ]);
            // update siswa
            ModelsSiswa::where('nis', $siswa->nis)->update([
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggilan' => $request->nama_panggilan,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tgl_lahir,
                'kewarganegaraan' => $request->kewarganegaraan,
                'anak_ke' => $request->anak_ke,
                'jumlah_saudara_kandung' => $request->jumlah_saudara_kandung,
                'jumlah_saudara_angkat' => $request->jumlah_saudara_angkat,
                'jumlah_saudara_tiri' => $request->jumlah_saudara_tiri,
                'bahasa' => $request->bahasa,
                'agama' => $request->agama,
                'yatim_piatu' => $request->yatim_piatu,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
                'kode_tahun_ajaran' => $request->kode_tahun_ajaran,
            ]);
        }
        return redirect('/siswa')->with('success', 'Data has been updated!')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsSiswa $siswa)
    {
        if (Auth::user()->jabatan == 'admin') {
            AuthUser::where('username', $siswa->nis)->delete();
            kesehatan::where('nis', $siswa->nis)->delete();
            pendidikan_sebelum::where('nis', $siswa->nis)->delete();
            alamat::where('nis', $siswa->nis)->delete();
            orangtua_wali::where('nis', $siswa->nis)->delete();
            $siswa->delete();
            return redirect()->back()->with('success', 'Data has been deleted!');
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }
}
