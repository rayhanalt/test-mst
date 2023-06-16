<?php

namespace App\Http\Livewire;

use App\Models\jenis_ujian;
use Livewire\Component;
use Livewire\WithPagination;

class JenisUjian extends Component
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
        return view('livewire.jenis-ujian', [
            'data' => $this->search === null ?
                jenis_ujian::with('haveNilai')->orderBy('id', 'desc')->Paginate(3)->withQueryString() :
                jenis_ujian::with('haveNilai')->orderBy('id', 'desc')
                ->where('kode_jenis_ujian', 'like', '%' . $this->search . '%')
                ->orWhere('jenis_ujian', 'like', '%' . $this->search . '%')
                ->paginate(3)->withQueryString()
        ]);
    }
}
