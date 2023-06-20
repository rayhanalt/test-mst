<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;
    protected $table = 't_sales';
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'kode';
    }


    // ? untuk kode otomatis

    public static function boot()
    {
        parent::boot();
        static::creating(
            function ($model) {

                $model->kode = 'S-' . rand(100000, 999999);
            }
        );
    }

    // ? untuk relasi

    // HasMany
    public function hasCust()
    {
        return $this->belongsTo(customer::class, 'kode_cust', 'kode');
    }
    // ? untuk relasi

    // BelongsTo
    public function getSalesDet()
    {
        return $this->belongsTo(sales_det::class, 'kode', 'kode_sales');
    }
}
