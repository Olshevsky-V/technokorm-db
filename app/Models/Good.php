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
        'categories' => 'array',
        'tags' => 'array',
    ];
    
    /**
     * Переопределяем toArray для гарантии, что tags всегда массив
     */
    public function toArray()
    {
        $data = parent::toArray();
        
        // Преобразуем tags в массив, если это строка
        if (isset($data['tags'])) {
            if (is_string($data['tags'])) {
                $data['tags'] = json_decode($data['tags'], true) ?? [];
            } elseif (is_array($data['tags'])) {
                // Уже массив, оставляем как есть
                $data['tags'] = array_values($data['tags']);
            } else {
                $data['tags'] = [];
            }
        }
        
        // Для categories тоже добавим проверку (на всякий случай)
        if (isset($data['categories']) && is_string($data['categories'])) {
            $data['categories'] = json_decode($data['categories'], true) ?? [];
        }
        
        return $data;
    }
}