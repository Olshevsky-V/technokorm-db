<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;
    protected $table = "goods";

    protected $fillable = ['name', 'categories', 'tags', 'image', 'price'];

    protected $casts = [
        'categories' => 'array',  // Автоматически конвертирует JSON в массив
        'tags' => 'array',        // и обратно
    ];
}
