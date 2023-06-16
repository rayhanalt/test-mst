<?php

namespace App\Http\Livewire;

use App\Models\tahunAjaran as ModelsTahunAjaran;
use Livewire\Component;
use Livewire\WithPagination;

class TahunAjaran extends Component
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
        return view('livewire.tahun-ajaran', [
            'data' => $this->search === null ?
                ModelsTahunAjaran::orderBy('kode_tahun_ajaran', 'asc')->Paginate(3)->withQueryString() :
                ModelsTahunAjaran::orderBy('kode_tahun_ajaran', 'asc')
                ->where('kode_tahun_ajaran', 'like', '%' . $this->search . '%')
                ->where('tahun_ajaran', 'like', '%' . $this->search . '%')
                ->paginate(3)->withQueryString()
        ]);
    }
}
