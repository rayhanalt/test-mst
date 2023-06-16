<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
     use HasFactory;
     protected $table = 'm_barang';
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

                    $model->kode = 'B-' . rand(100000, 999999);
               }
          );
     }

     //  ? untuk relasi
     public function getSalesDet()
     {
          return $this->belongsTo(sales_det::class, 'kode_barang', 'kode');
     }
}
