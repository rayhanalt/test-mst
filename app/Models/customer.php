<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table = 'm_customer';
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

                $model->kode = 'C-' . rand(100000, 999999);
            }
        );
    }


    //  ? untuk relasi
    public function getSales()
    {
        return $this->hasMany(sales::class, 'kode', 'kode_cust');
    }
}
