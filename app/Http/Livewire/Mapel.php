<?php

namespace App\Http\Livewire;

use App\Models\mapel as ModelsMapel;
use App\Models\PengadaanBarang;
use Livewire\Component;
use Livewire\WithPagination;

class Mapel extends Component
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
        return view('livewire.mapel', [
            'data' => $this->search === null ?
                ModelsMapel::orderBy('id', 'desc')->Paginate(3)->withQueryString() :
                ModelsMapel::orderBy('id', 'desc')->where('kode_mapel', 'like', '%' . $this->search . '%')
                ->orWhere('nama_mapel', 'like', '%' . $this->search . '%')
                ->paginate(3)->withQueryString()
        ]);
    }
}
