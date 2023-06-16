<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        @page {
            size: Legal;
            margin: 1cm 1.5cm 2cm 1.5cm;
        }

        /* CSS untuk tampilan layar */
        @media screen {
            .pas-foto {
                width: 3cm;
                position: absolute;
                top: 6.7cm;
                right: 0;
                background: white;
            }
        }

        /* CSS untuk cetak */
        @media print {
            .pas-foto {
                display: block;
            }
        }
    </style>
</head>

<body>
    <center>
        <b>
            {{-- IV. LEMBAR BUKU INDUK REGISTER   --}}
            <img src="{{ public_path('img/banner.JPG') }}" width="700px" height="120px" />
        </b>
    </center>
    <br>
    <table style="border: 1px solid black; border-collapse: collapse;" align="right">
        <tr>
            <td style="border: 1px solid black;" align="center">
                <b>
                    No. Urut
                </b>
            </td>
        </tr>
        <tr>
            <td style="font-size: 20px;" align="center">
                <b>
                    {{ $iteration }}
                </b>
            </td>
        </tr>
    </table>
    <table class="pas-foto">
        <tr style="">
            <td style="border: 1px solid black; height: 4cm;" align="center">
                pas foto <br> 3 x 4
            </td>
        </tr>
    </table>
    <table align="center" style="page-break-after: always;" width="100%" border="0">
        <tr>
            <td align="right" width="50%" style="width: 200px">NIS</td>
            <td width="1px">:</td>
            <td style="border-bottom: 1px solid #000; width: 180px;">
                {{ $siswa->nis }}
            </td>
            <td width="5%"></td>
            <td width="1px">NISN</td>
            <td width="1px">:</td>
            <td style="border-bottom: 1px solid #000;  width: 180px;">{{ $siswa->nisn }}</td>
            <td style="padding:0px 20px;"></td>
        </tr>
        <tr align="left">
            <td colspan="8">

            </td>
        </tr>
        <tr align="left">
            <td colspan="8">
                <b>
                    A. KETERANGAN PESERTA DIDIK
                </b>
            </td>
        </tr>
        <tr align="left">
            <td colspan="8">

            </td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->nama_lengkap }}
            </td>
        </tr>
        <tr>
            <td>Nama Panggilan</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->nama_panggilan }}
            </td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                @if ($siswa->jenis_kelamin == 'L')
                    Laki - Laki
                @else
                    Perempuan
                @endif
            </td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}
            </td>
        </tr>
        <tr>
            <td>Agama</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->agama }}
            </td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->kewarganegaraan }}
            </td>
        </tr>
        <tr>
            <td>Anak Ke</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->anak_ke }}
            </td>
        </tr>
        <tr>
            <td>Jumlah Saudara Kandung</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->jumlah_saudara_kandung }}
            </td>
        </tr>
        <tr>
            <td>Jumlah Saudara Tiri</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->jumlah_saudara_tiri }}
            </td>
        </tr>
        <tr>
            <td>Jumlah Saudara Angkat</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->jumlah_saudara_angkat }}
            </td>
        </tr>
        <tr>
            <td>Yatim / Piatu</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->yatim_piatu }}
            </td>
        </tr>
        <tr>
            <td>Bahasa Sehari - hari</td>
            <td width="1px">:</td>
            <td colspan="6" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->bahasa }}
            </td>
        </tr>
        <tr align="left">
            <td colspan="8">

            </td>
        </tr>
        <tr align="left">
            <td colspan="8"><b>
                    B. KETERANGAN TEMPAT TINGGAL
                </b>
            </td>
        </tr>
        <tr align="left">
            <td colspan="8">

            </td>
        </tr>
        <tr>
            <td>Jalan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveAlamat->jalan }}
            </td>
        </tr>
        <tr>
            <td>RT/RW</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveAlamat->rt_rw }}
            </td>
        </tr>
        <tr>
            <td>Desa</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveAlamat->desa }}
            </td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveAlamat->kecamatan }}
            </td>
        </tr>
        <tr>
            <td>Kabupaten</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveAlamat->kabupaten }}
            </td>
        </tr>
        <tr>
            <td>Provinsi</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveAlamat->provinsi }}
            </td>
        </tr>
        <tr>
            <td>Kode Pos</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveAlamat->kode_pos }}
            </td>
        </tr>
        <tr>
            <td>Nomor Telepon / HP</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->no_telp }}
            </td>
        </tr>
        <tr>
            <td>Tinggal Bersama</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveAlamat->tinggal_bersama }}
            </td>
        </tr>
        <tr>
            <td>Jarak Ke Sekolah</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveAlamat->jarak_ke_sekolah }}
            </td>
        </tr>
        <tr align="left">
            <td colspan="8">

            </td>
        </tr>
        <tr align="left">
            <td colspan="8"><b>
                    C. KETERANGAN KESEHATAN
                </b>
            </td>
        </tr>
        <tr align="left">
            <td colspan="8">

            </td>
        </tr>
        <tr>
            <td>Golongan Darah</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveKesehatan->golongan_darah }}
            </td>
        </tr>
        <tr>
            <td>Penyakit yang pernah diderita</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveKesehatan->penyakit_pernah_diderita }}
            </td>
        </tr>
        <tr>
            <td>Kelainan Jasmani</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveKesehatan->kelainan_jasmani }}
            </td>
        </tr>
        <tr>
            <td>Tinggi Badan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveKesehatan->tinggi_badan }}
            </td>
        </tr>
        <tr>
            <td>Berat Badan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->haveKesehatan->berat_badan }}
            </td>
        </tr>

        <tr align="left">
            <td colspan="8"><b>
                    D. KETERANGAN PENDIDIKAN
                </b>
            </td>
        </tr>
        <tr align="left">
            <td colspan="8">

            </td>
        </tr>
        <tr>
            <td>Sekolah Asal</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; ">
                {{ $siswa->havePendidikanSebelum->sekolah_asal }}
            </td>
        </tr>
        <tr>
            <td>Tanggan dan Nomor Ijazah</td>
            <td width="1px">:</td>
            <td colspan="2" align="center" style="border-bottom: 1px solid #000;" width="1px">
                @if ($siswa->havePendidikanSebelum->nomor_ijazah == !null)
                    {{ $siswa->havePendidikanSebelum->tanggal_ijazah }}
                @endif
            </td>
            <td width="1px" align="center">
                dan
            </td>
            <td align="center" colspan="4" style="border-bottom: 1px solid #000;" width="1px">
                {{ $siswa->havePendidikanSebelum->nomor_ijazah }}
            </td>


        </tr>
        <tr>
            <td>Lama Belajar</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->havePendidikanSebelum->lama_belajar }}
            </td>
        </tr>
        <tr align="left">
            <td>
                Pindahan
            </td>
            <td width="1px">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Dari Sekolah</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->havePendidikanSebelum->dari_sekolah }}
            </td>
        </tr>
        <tr>
            <td>Alasan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->havePendidikanSebelum->alasan }}
            </td>
        </tr>
    </table>

    <table align="center" width="100%" border="0">
        <tr align="left">
            <td>
                Diterima Disekolah ini
            </td>
            <td width="1px">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Di kelas</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->havePendidikanSebelum->di_kelas }}
            </td>
        </tr>
        <tr>
            <td>Kelompok</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->havePendidikanSebelum->kelompok }}
            </td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $siswa->havePendidikanSebelum->jurusan }}
            </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{-- @if ($siswa->havePendidikanSebelum->dari_sekolah == !null) --}}
                {{ $siswa->havePendidikanSebelum->tanggal }}
                {{-- @endif --}}
            </td>
        </tr>

        <tr align="left">
            <td colspan="8">

            </td>
        </tr>
        <tr align="left">
            <td colspan="8"><b>
                    E. KETERANGAN ORANG TUA KANDUNG
                </b>
            </td>
        </tr>
        <tr align="left">
            <td colspan="8">

            </td>
        </tr>
        <tr align="left">
            <td>
                Ayah Kandung
            </td>
            <td width="1px">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ayah->nama }}
            </td>
        </tr>
        <tr>
            <td>Agama</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ayah->agama }}
            </td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ayah->kewarganegaraan }}
            </td>
        </tr>
        <tr>
            <td>Pendidikan terakhir</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ayah->pendidikan_terakhir }}
            </td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ayah->pekerjaan }}
            </td>
        </tr>
        <tr>
            <td>Penghasilan Perbulan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ayah->penghasilan }}
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                @if ($ayah->nama == !null)
                    {{ $siswa->haveAlamat->jalan }}, {{ $siswa->haveAlamat->rt_rw }},
                    {{ $siswa->haveAlamat->desa }},
                    {{ $siswa->haveAlamat->kecamatan }},
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td>&nbsp;</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                @if ($ayah->nama == !null)
                    {{ $siswa->haveAlamat->kabupaten }}, {{ $siswa->haveAlamat->provinsi }},
                    {{ $siswa->haveAlamat->kode_pos }}.
                @endif
            </td>
        </tr>
        <tr>
            <td>Nomor Telepon / HP</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ayah->no_telp }}
            </td>
        </tr>
        <tr>
            <td>Keadaan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ayah->keadaan }}
            </td>
        </tr>
        <tr>
            <td colspan="7" width="1px" height="1mm">

            </td>
        </tr>
        <tr align="left">
            <td>
                Ibu Kandung
            </td>
            <td width="1px">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ibu->nama }}
            </td>
        </tr>
        <tr>
            <td>Agama</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ibu->agama }}
            </td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ibu->kewarganegaraan }}
            </td>
        </tr>
        <tr>
            <td>Pendidikan terakhir</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ibu->pendidikan_terakhir }}
            </td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ibu->pekerjaan }}
            </td>
        </tr>
        <tr>
            <td>Penghasilan Perbulan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ibu->penghasilan }}
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                @if ($ibu->nama == !null)
                    {{ $siswa->haveAlamat->jalan }}, {{ $siswa->haveAlamat->rt_rw }},
                    {{ $siswa->haveAlamat->desa }},
                    {{ $siswa->haveAlamat->kecamatan }},
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td>&nbsp;</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                @if ($ibu->nama == !null)
                    {{ $siswa->haveAlamat->kabupaten }}, {{ $siswa->haveAlamat->provinsi }},
                    {{ $siswa->haveAlamat->kode_pos }}.
                @endif
            </td>
        </tr>
        <tr>
            <td>Nomor Telepon / HP</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ibu->no_telp }}
            </td>
        </tr>
        <tr>
            <td>Keadaan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $ibu->keadaan }}
            </td>
        </tr>
        <tr align="left">
            <td colspan="8">

            </td>
        </tr>
        <tr align="left">
            <td colspan="8"><b>
                    F. KETERANGAN TENTANG WALI
                </b>
            </td>
        </tr>
        <tr align="left">
            <td colspan="8">

            </td>
        </tr>
        <tr align="left">
            <td>
                Wali
            </td>
            <td width="1px">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $wali->nama }}
            </td>
        </tr>
        <tr>
            <td>Agama</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $wali->agama }}
            </td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $wali->kewarganegaraan }}
            </td>
        </tr>
        <tr>
            <td>Pendidikan terakhir</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $wali->pendidikan_terakhir }}
            </td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $wali->pekerjaan }}
            </td>
        </tr>
        <tr>
            <td>Penghasilan Perbulan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $wali->penghasilan }}
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                @if ($wali->nama == null)
                @else
                    {{ $siswa->haveAlamat->jalan }}, {{ $siswa->haveAlamat->rt_rw }},
                    {{ $siswa->haveAlamat->desa }},
                    {{ $siswa->haveAlamat->kecamatan }},
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td width="1px">&nbsp;</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                @if ($wali->nama == null)
                @else
                    {{ $siswa->haveAlamat->kabupaten }}, {{ $siswa->haveAlamat->provinsi }},
                    {{ $siswa->haveAlamat->kode_pos }}.
                @endif
            </td>
        </tr>
        <tr>
            <td>Nomor Telepon / HP</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $wali->no_telp }}
            </td>
        </tr>
        <tr>
            <td>Keadaan</td>
            <td width="1px">:</td>
            <td colspan="7" style="border-bottom: 1px solid #000; width: 300px;">
                {{ $wali->keadaan }}
            </td>
        </tr>
    </table>

</body>

</html>
