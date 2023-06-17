<?php

namespace App\Http\Livewire;

use App\Models\kelas as ModelsKelas;
use App\Models\sales;
use App\Models\sales_det;
use Livewire\Component;
use Livewire\WithPagination;

class Transaksi extends Component
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
        return view('livewire.transaksi', [
            'data' => $this->search === null ?
                sales::with('getSalesDet', 'hasCust')->orderBy('id', 'desc')->Paginate(3)->withQueryString() :
                sales::with('getSalesDet', 'hasCust')->orderBy('id', 'desc')
                ->where('kode', 'like', '%' . $this->search . '%')
                ->orWhere('tgl', 'like', '%' . $this->search . '%')
                ->orWhere('kode_cust', 'like', '%' . $this->search . '%')
                ->orWhere('subtotal', 'like', '%' . $this->search . '%')
                ->orWhere('diskon', 'like', '%' . $this->search . '%')
                ->orWhere('ongkir', 'like', '%' . $this->search . '%')
                ->orWhere('total_bayar', 'like', '%' . $this->search . '%')
                ->orWhereHas('getSalesDet', function ($query) {
                    $query->where('qty', 'like', '%' . $this->search . '%')
                        ->orWhere('diskon_nilai', 'like', '%' . $this->search . '%')
                        ->orWhere('harga_diskon', 'like', '%' . $this->search . '%')
                        ->orWhere('total', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('hasCust', function ($query) {
                    $query->where('nama', 'like', '%' . $this->search . '%');
                })
                ->paginate(3)->withQueryString()
        ]);
    }
}
