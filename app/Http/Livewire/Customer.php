<?php

namespace App\Http\Livewire;

use App\Models\customer as ModelsCustomer;
use Livewire\Component;
use Livewire\WithPagination;

class Customer extends Component
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
        return view('livewire.customer', [
            'data' => $this->search === null ?
                ModelsCustomer::orderBy('kode', 'asc')->Paginate(3)->withQueryString() :
                ModelsCustomer::orderBy('kode', 'asc')
                ->where('kode', 'like', '%' . $this->search . '%')
                ->orWhere('nama', 'like', '%' . $this->search . '%')
                ->orWhere('telp', 'like', '%' . $this->search . '%')
                ->paginate(3)->withQueryString()
        ]);
    }
}
