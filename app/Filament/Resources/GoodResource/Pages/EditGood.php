<?php

namespace App\Filament\Resources\GoodResource\Pages;

use App\Filament\Resources\GoodResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGood extends EditRecord
{
    protected static string $resource = GoodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // При загрузке данных для редактирования
        if (isset($data['categories']) && is_string($data['categories'])) {
            $data['categories'] = json_decode($data['categories'], true) ?? [];
            // Категории приводим к числам
            $data['categories'] = array_map('intval', $data['categories']);
        }
        
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = json_decode($data['tags'], true) ?? [];
            // Теги оставляем как строки
            $data['tags'] = array_filter($data['tags'], 'is_string');
        }
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Та же логика что и в CreateGood
        if (isset($data['categories'])) {
            $categories = is_string($data['categories']) 
                ? json_decode($data['categories'], true) 
                : $data['categories'];
            
            $categories = is_array($categories) ? $categories : [];
            $categories = array_map('intval', $categories);
            
            if (!in_array(0, $categories, true)) {
                $categories[] = 0;
            }
            
            $categories = array_unique($categories);
            sort($categories);
            
            $data['categories'] = json_encode(array_values($categories), JSON_NUMERIC_CHECK);
        }

        if (isset($data['tags'])) {
            $tags = is_string($data['tags']) 
                ? json_decode($data['tags'], true) 
                : $data['tags'];
            
            $tags = is_array($tags) ? $tags : [];
            $tags = array_filter($tags, 'is_string');
            $tags = array_unique($tags);
            $tags = array_values($tags);
            
            $data['tags'] = json_encode($tags);
        }

        return $data;
    }
}