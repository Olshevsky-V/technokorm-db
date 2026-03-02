<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoodResource\Pages;
use App\Models\Good;
use App\Models\Category;
use App\Models\Animal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GoodResource extends Resource
{
    protected static ?string $model = Good::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                
                // КАТЕГОРИИ - числовые ID
                Forms\Components\Select::make('categories')
                    ->options(function () {
                        $categories = Category::query()
                            ->pluck('name', 'id')
                            ->mapWithKeys(function ($name, $id) {
                                return [(int) $id => $name];
                            })
                            ->toArray();
                        
                        return [0 => 'Без категории'] + $categories;
                    })
                    ->multiple()
                    ->required()
                    ->afterStateHydrated(function ($component, $state) {
                        if (is_string($state)) {
                            $state = json_decode($state, true);
                        }
                        if (is_array($state)) {
                            // Категории приводим к числам
                            $state = array_map('intval', $state);
                            $component->state($state);
                        }
                    }),
                
                // ТЕГИ - строковые значения
                
                Forms\Components\Select::make('tags')
                    ->options(function () {
        return Animal::query()
            ->pluck('name', 'data')  // data - строковый ключ ("pig" => "Свинья")
            ->toArray();
                    })
                    ->multiple()
                    ->required()
                    ->columnSpanFull()
                    // Убираем afterStateHydrated - он не нужен, т.к. у вас есть $casts
                    ->dehydrateStateUsing(function ($state) {
                        // Гарантируем, что сохраняем только строки
                        if (is_array($state)) {
                            return array_values(array_filter($state, 'is_string'));
                        }
                        return [];
                    }),
                
                Forms\Components\FileUpload::make('image')
                    ->image(),
                
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('Р'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categories')
                    ->formatStateUsing(function ($state) {
                        if (is_string($state)) {
                            $state = json_decode($state, true);
                        }
                        if (is_array($state)) {
                            // Показываем названия категорий вместо ID
                            $categoryNames = Category::whereIn('id', $state)
                                ->pluck('name', 'id')
                                ->toArray();
                            
                            $result = [];
                            foreach ($state as $id) {
                                if ($id == 0) {
                                    $result[] = 'Без категории';
                                } elseif (isset($categoryNames[$id])) {
                                    $result[] = $categoryNames[$id];
                                }
                            }
                            return implode(', ', $result);
                        }
                        return '';
                    }),
                Tables\Columns\TextColumn::make('tags')
                    ->formatStateUsing(function ($state) {
                        if (is_string($state)) {
                            $state = json_decode($state, true);
                        }
                        if (is_array($state)) {
                            return implode(', ', $state);
                        }
                        return '';
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGoods::route('/'),
            'create' => Pages\CreateGood::route('/create'),
            'edit' => Pages\EditGood::route('/{record}/edit'),
        ];
    }
}