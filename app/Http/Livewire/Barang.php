<?php

namespace App\Http\Livewire;

use App\Models\barang as ModelsBarang;
use App\Models\guru as ModelsGuru;
use Livewire\Component;
use Livewire\WithPagination;

class Barang extends Component
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
        return view('livewire.barang', [
            "data" => $this->search === null ?
                ModelsBarang::paginate(4)->withQueryString() :
                ModelsBarang::orderBy('id', 'desc')->where('kode', 'like', '%' . $this->search . '%')
                ->orWhere('nama', 'like', '%' . $this->search . '%')
                ->orWhere('harga', 'like', '%' . $this->search . '%')
                ->paginate(4)->withQueryString()
        ]);
    }
}
