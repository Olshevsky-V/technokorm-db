<?php

namespace App\Filament\Resources\GoodResource\Pages;

use App\Filament\Resources\GoodResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGood extends CreateRecord
{
    protected static string $resource = GoodResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // ОБРАБОТКА КАТЕГОРИЙ (числовые ID)
        if (isset($data['categories'])) {
            // Декодируем если строка
            $categories = is_string($data['categories']) 
                ? json_decode($data['categories'], true) 
                : $data['categories'];
            
            // Приводим к массиву
            $categories = is_array($categories) ? $categories : [];
            
            // Приводим ВСЕ элементы к числам
            $categories = array_map('intval', $categories);
            
            // Добавляем 0
            if (!in_array(0, $categories, true)) {
                $categories[] = 0;
            }
            
            // Убираем дубликаты и сортируем
            $categories = array_unique($categories);
            sort($categories);
            
            // Кодируем с числовыми индексами
            $data['categories'] = json_encode(array_values($categories), JSON_NUMERIC_CHECK);
        } else {
            $data['categories'] = json_encode([0]);
        }

        // ОБРАБОТКА ТЕГОВ (строковые значения)
        if (isset($data['tags'])) {
            // Декодируем если строка
            $tags = is_string($data['tags']) 
                ? json_decode($data['tags'], true) 
                : $data['tags'];
            
            // Приводим к массиву
            $tags = is_array($tags) ? $tags : [];
            
            // Фильтруем только строки и убираем пустые
            $tags = array_filter($tags, function($tag) {
                return is_string($tag) && !empty($tag);
            });
            
            // Убираем дубликаты
            $tags = array_unique($tags);
            
            // Переиндексируем
            $tags = array_values($tags);
            
            // Кодируем как есть (строки останутся строками)
            $data['tags'] = json_encode($tags);
        } else {
            $data['tags'] = json_encode([]);
        }

        return $data;
    }
}