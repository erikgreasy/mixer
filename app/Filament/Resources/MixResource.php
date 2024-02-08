<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MixResource\Pages;
use App\Filament\Resources\MixResource\RelationManagers;
use App\Models\Mix;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MixResource extends Resource
{
    protected static ?string $model = Mix::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),

                Forms\Components\DateTimePicker::make('published_at')
                    ->seconds(false)
                    ->visibleOn('edit'),

                SpatieMediaLibraryFileUpload::make('upload')
                    ->required()
                    ->previewable(false)
                    ->collection('upload')
                    ->maxSize(256000),

                SpatieMediaLibraryFileUpload::make('cover')
                    ->image()
                    ->collection('cover'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
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
            'index' => Pages\ListMixes::route('/'),
            'create' => Pages\CreateMix::route('/create'),
            'edit' => Pages\EditMix::route('/{record}/edit'),
        ];
    }
}
