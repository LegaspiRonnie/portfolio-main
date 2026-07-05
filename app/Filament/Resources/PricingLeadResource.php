<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PricingLeadResource\Pages;
use App\Filament\Resources\PricingLeadResource\RelationManagers;
use App\Models\PricingLead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PricingLeadResource extends Resource
{
    protected static ?string $model = PricingLead::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Pricing Leads';

    protected static ?string $navigationGroup = 'Inbox & Analytics';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::whereNull('read_at')->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('email')
                    ->email(),
                Forms\Components\TextInput::make('plan'),
                Forms\Components\Textarea::make('message')
                    ->rows(4)
                    ->columnSpanFull(),
            ])
            ->disabled();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('plan')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->description(fn (PricingLead $record): string => $record->email),
                Tables\Columns\TextColumn::make('message')
                    ->limit(60)
                    ->searchable(),
                Tables\Columns\IconColumn::make('read_at')
                    ->label('Read')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('read_at')
                    ->label('Read status')
                    ->nullable()
                    ->placeholder('All leads')
                    ->trueLabel('Read only')
                    ->falseLabel('Unread only')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('read_at'),
                        false: fn (Builder $query) => $query->whereNull('read_at'),
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPricingLeads::route('/'),
            'view' => Pages\ViewPricingLead::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
