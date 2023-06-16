<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use App\Imports\SiswaImport;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ExportController extends Controller
{

     public function import(Request $request)
     {
          $this->validate($request, [
               'select_file'  => 'required|mimes:xls,xlsx'
          ]);
          $path = $request->file('select_file')->getRealPath();
          // $data = Excel::load($path, function($reader) {})->get();
          Excel::import(new SiswaImport, $path);
          if (session()->has('failed')) {
               return redirect('/siswa/create');
          } else {
               return redirect('/siswa')->with('success', 'File Excel berhasil di import.');
          }
     }

     public function exportData(Request $request)
     {
          // dd(json_encode($request->input('tahunAjaran')));
          $query = DB::table('siswa')
               ->select(
                    // siswa
                    'siswa.nis',
                    'siswa.nisn',
                    'siswa.nama_lengkap',
                    'siswa.nama_panggilan',
                    'siswa.agama',
                    'siswa.tempat_lahir',
                    'siswa.tanggal_lahir',
                    'siswa.kewarganegaraan',
                    'siswa.anak_ke',
                    'siswa.jumlah_saudara_kandung',
                    'siswa.jumlah_saudara_angkat',
                    'siswa.jumlah_saudara_tiri',
                    'siswa.yatim_piatu',
                    'siswa.bahasa',
                    'siswa.jenis_kelamin',
                    'siswa.no_telp',
                    // alamat
                    'alamat.jalan',
                    'alamat.rt_rw',
                    'alamat.desa',
                    'alamat.kecamatan',
                    'alamat.kabupaten',
                    'alamat.provinsi',
                    'alamat.kode_pos',
                    'alamat.tinggal_bersama',
                    'alamat.jarak_ke_sekolah',
                    // kesehatan
                    'kesehatan.golongan_darah',
                    'kesehatan.penyakit_pernah_diderita',
                    'kesehatan.kelainan_jasmani',
                    'kesehatan.tinggi_badan',
                    'kesehatan.berat_badan',
                    //  pendidikan sebelum
                    'pendidikan_sebelum.sekolah_asal',
                    'pendidikan_sebelum.tanggal_ijazah',
                    'pendidikan_sebelum.nomor_ijazah',
                    'pendidikan_sebelum.lama_belajar',
                    'pendidikan_sebelum.dari_sekolah',
                    'pendidikan_sebelum.alasan',
                    'pendidikan_sebelum.di_kelas',
                    'pendidikan_sebelum.kelompok',
                    'pendidikan_sebelum.jurusan',
                    'pendidikan_sebelum.tanggal',
                    // ortu ayah
                    'ayah.nama AS nama_ayah',
                    'ayah.agama AS agama_ayah',
                    'ayah.kewarganegaraan AS kewarganegaraan_ayah',
                    'ayah.pendidikan_terakhir AS pendidikan_terakhir_ayah',
                    'ayah.pekerjaan AS pekerjaan_ayah',
                    'ayah.penghasilan AS penghasilan_ayah',
                    'ayah.no_telp AS no_telp_ayah',
                    'ayah.keadaan AS keadaan_ayah',
                    // ortu ibu
                    'ibu.nama AS nama_ibu',
                    'ibu.agama AS agama_ibu',
                    'ibu.kewarganegaraan AS kewarganegaraan_ibu',
                    'ibu.pendidikan_terakhir AS pendidikan_terakhir_ibu',
                    'ibu.pekerjaan AS pekerjaan_ibu',
                    'ibu.penghasilan AS penghasilan_ibu',
                    'ibu.no_telp AS no_telp_ibu',
                    'ibu.keadaan AS keadaan_ibu',
                    // ortu wali
                    'wali.nama AS nama_wali',
                    'wali.agama AS agama_wali',
                    'wali.kewarganegaraan AS kewarganegaraan_wali',
                    'wali.pendidikan_terakhir AS pendidikan_terakhir_wali',
                    'wali.pekerjaan AS pekerjaan_wali',
                    'wali.penghasilan AS penghasilan_wali',
                    'wali.no_telp AS no_telp_wali',
                    'wali.keadaan AS keadaan_wali',
                    'siswa.kode_tahun_ajaran',

               )
               ->join('orangtua_wali AS ayah', function ($join) {
                    $join->on('siswa.nis', '=', 'ayah.nis')
                         ->where('ayah.status', '=', 'ayah');
               })
               ->join('orangtua_wali AS ibu', function ($join) {
                    $join->on('siswa.nis', '=', 'ibu.nis')
                         ->where('ibu.status', '=', 'ibu');
               })
               ->join('orangtua_wali AS wali', function ($join) {
                    $join->on('siswa.nis', '=', 'wali.nis')
                         ->where('wali.status', '=', 'wali');
               })
               ->join('alamat', 'alamat.nis', '=', 'siswa.nis')
               ->join('kesehatan', 'kesehatan.nis', '=', 'siswa.nis')
               ->join('pendidikan_sebelum', 'pendidikan_sebelum.nis', '=', 'siswa.nis');
          if ($request->input('tahunAjaran') !== null) {
               $query->where('kode_tahun_ajaran', $request->input('tahunAjaran'));
          }

          $data = $query->get()->toArray();


          return Excel::download(new ExportSingleTable($data), 'DataSiswa.xlsx', \Maatwebsite\Excel\Excel::XLSX, ['format' => 'yyy-mm-dd']);
     }
}

class ExportSingleTable implements FromCollection, WithHeadings, WithEvents
{
     protected $data;

     public function __construct(array $data)
     {
          $this->data = $data;
     }

     public function headings(): array
     {
          return [
               'NIS',
               'NISN',
               'Nama Lengkap',
               'Nama Panggilan',
               'Agama',
               'Tempat Lahir',
               'Tanggal Lahir',
               'Kewarganegaraan',
               'Anak Ke',
               'Jumlah Saudara Kandung',
               'Jumlah Saudara Angkat',
               'Jumlah Saudara Tiri',
               'Yatim Piatu',
               'Bahasa',
               'Jenis Kelamin',
               'No Telp',
               // alamat
               'Jalan',
               'RT/RW',
               'Desa',
               'Kecamatan',
               'Kabupaten',
               'Provinsi',
               'Kode Pos',
               'Tinggal Bersama',
               'Jarak ke Sekolah',
               // kesehatan
               'Golongan Darah',
               'Penyakit yang Pernah Diderita',
               'Kelainan Jasmani',
               'Tinggi Badan',
               'Berat Badan',
               // Pendidikan sebelum
               'Sekolah Asal',
               'Tanggal Ijazah',
               'Nomor Ijazah',
               'Lama Belajar',
               'Dari Sekolah',
               'Alasan',
               'Di Kelas',
               'Kelompok',
               'Jurusan',
               'Tanggal Diterima',
               // ayah
               'Nama Ayah',
               'Agama Ayah',
               'Kewarganegaraan Ayah',
               'Pendidikan Terakhir Ayah',
               'Pekerjaan Ayah',
               'Penghasilan Ayah',
               'No Telp Ayah',
               'Keadaan Ayah',
               // ibu
               'Nama Ibu',
               'Agama Ibu',
               'Kewarganegaraan Ibu',
               'Pendidikan Terakhir Ibu',
               'Pekerjaan Ibu',
               'Penghasilan Ibu',
               'No Telp Ibu',
               'Keadaan Ibu',
               // wali
               'Nama Wali',
               'Agama Wali',
               'Kewarganegaraan Wali',
               'Pendidikan Terakhir Wali',
               'Pekerjaan Wali',
               'Penghasilan Wali',
               'No Telp Wali',
               'Keadaan Wali',
               'Kode Tahun Ajaran',
          ];
     }
     public function registerEvents(): array
     {
          return [
               AfterSheet::class => function (AfterSheet $event) {
                    $event->sheet->getStyle('A1:BM1')->applyFromArray([
                         'font' => [
                              'bold' => true,
                         ],
                    ]);

                    $event->sheet->autoSize();
               },
          ];
     }

     public function collection()
     {
          return collect($this->data);
     }
}
