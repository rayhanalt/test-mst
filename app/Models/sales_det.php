<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales_det extends Model
{
    use HasFactory;
    protected $table = 't_sales_det';
    protected $guarded = ['id'];


    // ? untuk relasi

    // has
    public function hasBarang()
    {
        return $this->hasOne(barang::class, 'kode', 'kode_barang');
    }
    public function hasSales()
    {
        return $this->hasOne(sales::class, 'kode', 'kode_sales');
    }
}
