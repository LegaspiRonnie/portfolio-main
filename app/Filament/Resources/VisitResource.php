<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitResource\Pages;
use App\Filament\Resources\VisitResource\RelationManagers;
use App\Models\Visit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye';

    protected static ?string $navigationLabel = 'Visitors';

    protected static ?string $navigationGroup = 'Inbox & Analytics';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'visit';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP address')
                    ->fontFamily('mono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('Location')
                    ->formatStateUsing(fn (Visit $record): string => collect([$record->city, $record->country])->filter()->join(', ') ?: '—')
                    ->searchable(['city', 'country']),
                Tables\Columns\TextColumn::make('isp')
                    ->label('ISP')
                    ->toggleable()
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('visitor_cookie')
                    ->label('Visitor')
                    ->fontFamily('mono')
                    ->formatStateUsing(fn (?string $state): string => $state ? substr($state, 0, 8).'…' : '—')
                    ->badge()
                    ->color(fn (Visit $record): string => Visit::where('visitor_cookie', $record->visitor_cookie)->count() > 1 ? 'info' : 'gray')
                    ->tooltip(fn (Visit $record): string => Visit::where('visitor_cookie', $record->visitor_cookie)->count() > 1 ? 'Returning visitor' : 'New visitor'),
                Tables\Columns\TextColumn::make('user_agent')
                    ->label('Browser / device')
                    ->limit(50)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Visited at')
                    ->dateTime()
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListVisits::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
