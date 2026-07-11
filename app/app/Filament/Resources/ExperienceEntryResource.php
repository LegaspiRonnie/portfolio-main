<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceEntryResource\Pages;
use App\Filament\Resources\ExperienceEntryResource\RelationManagers;
use App\Models\ExperienceEntry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExperienceEntryResource extends Resource
{
    protected static ?string $model = ExperienceEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Portfolio Content';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options([
                        'work' => 'Work experience',
                        'education' => 'Education',
                        'note' => 'Note / strengths',
                    ])
                    ->required()
                    ->live(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('organization')
                    ->maxLength(255),
                Forms\Components\TextInput::make('period_label')
                    ->placeholder('02/2026 – 06/2026')
                    ->maxLength(255),
                Forms\Components\Repeater::make('bullets')
                    ->simple(
                        Forms\Components\TextInput::make('bullet')->required()
                    )
                    ->addActionLabel('Add bullet point')
                    ->helperText('Used for work entries with multiple points.')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->rows(3)
                    ->helperText('Used for education/notes as a single paragraph instead of bullets.')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'work' => 'success',
                        'education' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->description(fn (ExperienceEntry $record): ?string => $record->organization),
                Tables\Columns\TextColumn::make('period_label')
                    ->label('Period'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListExperienceEntries::route('/'),
            'create' => Pages\CreateExperienceEntry::route('/create'),
            'edit' => Pages\EditExperienceEntry::route('/{record}/edit'),
        ];
    }
}
