<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{   
    protected $fillable = [
        'title',
        'header',
        'description',
        'image',
        'header-color',
        'text-color',
        'background-color',
        'link',
        'is-active'
    ];
    use HasFactory;
}
