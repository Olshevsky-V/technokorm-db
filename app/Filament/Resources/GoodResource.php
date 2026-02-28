<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoodResource\Pages;
use App\Filament\Resources\GoodResource\RelationManagers;
use App\Models\Good;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function Laravel\Prompts\multiselect;

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
                Forms\Components\Select::make('categories')
                    ->options(
                array_merge(
                 //[0 => 'Без категории'],
                        \App\Models\Category::query()->pluck('name', 'id')->toArray()
                        )
                    )
                    ->multiple()
                    ->required(),
                    
                    
                Forms\Components\Textarea::make('tags')
                    ->required()
                    ->columnSpanFull(),
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

protected function mutateFormData(&$data): void
{
    // Предполагая, что categories, tags, image могут быть массивами
    if (isset($data['categories']) && is_array($data['categories'])) {
        $data['categories'] = json_encode($data['categories']);
    }

    if (isset($data['tags']) && is_array($data['tags'])) {
        $data['tags'] = json_encode($data['tags']);
    }

    if (isset($data['image']) && is_array($data['image'])) {
        $data['image'] = json_encode($data['image']);
    }

    // Остальной код...
    if (!in_array(0, $data['categories'] ?? [], true)) {
        $data['categories'][] = 0;
    }
}
}
