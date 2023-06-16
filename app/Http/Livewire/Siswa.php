<?php

namespace App\Http\Livewire;

use App\Models\Siswa as ModelsSiswa;
use App\Models\TahunAjaran;
use Livewire\Component;
use Livewire\WithPagination;

class Siswa extends Component
{
    use WithPagination;

    public $searchInput; // Properti untuk input pencarian
    public $searchSelect; // Properti untuk select pencarian
    public $tahunAjaran;
    public $page = 1;

    protected $updatesQueryString = [
        ['page' => ['except' => 1]],
        ['searchInput' => ['except' => '']],
        ['searchSelect' => ['except' => '']],
        ['tahunAjaran' => ['except' => null]],
    ];

    public function render()
    {
        return view('livewire.siswa', [
            'getTahunAjaran' => TahunAjaran::orderBy('kode_tahun_ajaran', 'asc')->get(),
            'data' => ModelsSiswa::with('haveAlamat', 'haveOrangtuaWali', 'havePendidikanSebelum', 'getTahunAjaran')
                ->orderBy('nama_lengkap', 'asc')
                ->when($this->searchInput, function ($query) {
                    $query->where(function ($innerQuery) {
                        $innerQuery->where('nama_lengkap', 'like', '%' . $this->searchInput . '%')
                            ->orWhere('nama_panggilan', 'like', '%' . $this->searchInput . '%')
                            ->orWhere('nis', 'like', '%' . $this->searchInput . '%')
                            ->orWhere('nisn', 'like', '%' . $this->searchInput . '%')
                            ->orWhere('tempat_lahir', 'like', '%' . $this->searchInput . '%')
                            ->orWhere('tanggal_lahir', 'like', '%' . $this->searchInput . '%')
                            ->orWhere('jenis_kelamin', 'like', '%' . $this->searchInput . '%')
                            ->orWhere('no_telp', 'like', '%' . $this->searchInput . '%')
                            ->orWhereHas('haveAlamat', function ($query) {
                                $query->where('jalan', 'like', '%' . $this->searchInput . '%')
                                    ->orWhere('rt_rw', 'like', '%' . $this->searchInput . '%')
                                    ->orWhere('desa', 'like', '%' . $this->searchInput . '%')
                                    ->orWhere('kecamatan', 'like', '%' . $this->searchInput . '%')
                                    ->orWhere('kabupaten', 'like', '%' . $this->searchInput . '%')
                                    ->orWhere('provinsi', 'like', '%' . $this->searchInput . '%')
                                    ->orWhere('kode_pos', 'like', '%' . $this->searchInput . '%');
                            })
                            ->orWhereHas('haveOrangtuaWali', function ($query) {
                                $query->where('nama', 'like', '%' . $this->searchInput . '%')
                                    ->orWhere('pekerjaan', 'like', '%' . $this->searchInput . '%');
                            });
                    });
                })
                ->when($this->searchSelect, function ($query) {
                    $query->whereHas('getTahunAjaran', function ($query) {
                        $query->where('kode_tahun_ajaran', $this->searchSelect);
                    });
                })
                ->when($this->tahunAjaran, function ($query) {
                    $query->whereHas('getTahunAjaran', function ($query) {
                        $query->where('kode_tahun_ajaran', $this->tahunAjaran);
                    });
                })
                ->paginate(3)
                ->withQueryString(),
        ]);
    }

    public function resetPage()
    {
        $this->reset('page');
    }
}
