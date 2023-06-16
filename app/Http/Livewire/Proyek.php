<?php

namespace App\Http\Livewire;

use App\Models\Proyek as ModelsProyek;
use Livewire\Component;
use Livewire\WithPagination;

class Proyek extends Component
{
    use WithPagination;

    public $search;
    public $page = 1;

    protected $updatesQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']],
    ];
    public function render()
    {
        return view('livewire.proyek', [
            'data' => $this->search === null ?
                ModelsProyek::with('getPegawai')->orderBy('id', 'desc')->Paginate(3)->withQueryString() :
                ModelsProyek::with('getPegawai')->orderBy('id', 'desc')
                ->where('kode_proyek', 'like', '%' . $this->search . '%')
                ->orWhere('nip', 'like', '%' . $this->search . '%')
                ->orWhere('tgl_mulai', 'like', '%' . $this->search . '%')
                ->orWhere('tgl_selesai', 'like', '%' . $this->search . '%')
                ->orWhere('tgl_dibuat', 'like', '%' . $this->search . '%')
                ->orWhere('nama_mitra', 'like', '%' . $this->search . '%')
                ->orWhereHas('getPegawai', function ($query) {
                    $query->where('nama', 'like', '%' . $this->search . '%');
                })
                ->paginate(3)->withQueryString()
        ]);
    }
}
