<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_colors';

    protected $fillable = [
        'product_id',
        'color_id',
        'quantity',
    ];

    // tambahkan ini ketika ingin menampilkan nama color ketika proses editing colr
    public function color(){
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
}
