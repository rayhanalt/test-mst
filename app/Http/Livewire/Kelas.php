<?php

namespace App\Http\Livewire;

use App\Models\kelas as ModelsKelas;
use Livewire\Component;
use Livewire\WithPagination;

class Kelas extends Component
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
        return view('livewire.kelas', [
            'data' => $this->search === null ?
                ModelsKelas::with('getWaliKelas')->orderBy('id', 'desc')->Paginate(3)->withQueryString() :
                ModelsKelas::with('getWaliKelas')->orderBy('id', 'desc')
                ->where('kode_kelas', 'like', '%' . $this->search . '%')
                ->orWhere('nama_kelas', 'like', '%' . $this->search . '%')
                ->orWhere('kapasitas', 'like', '%' . $this->search . '%')
                ->orWhereHas('getWaliKelas', function ($query) {
                    $query->where('nama_guru', 'like', '%' . $this->search . '%');
                })
                ->paginate(3)->withQueryString()
        ]);
    }
}
