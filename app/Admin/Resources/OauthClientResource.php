<?php

namespace App\Admin\Resources;

use App\Admin\Resources\OauthClientResource\Pages;
use App\Admin\Resources\OauthClientResource\RelationManagers;
use App\Models\OauthClient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Actions\Action;

class OauthClientResource extends Resource
{
    protected static ?string $model = OauthClient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TagsInput::make('redirect')
                    ->required()
                    ->separator(',')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('secret')
                    ->disabled()
                    ->formatStateUsing(fn($record) => $record?->secret)
                    ->hiddenOn(['create'])
                    ->suffixAction(
                        Action::make('copy')
                            ->icon('heroicon-s-clipboard-document-check')
                            ->action(function ($livewire, $state) {
                                $livewire->js(
                                    'window.navigator.clipboard.writeText("' . $state . '");
                                        $tooltip("' . __('Copied to clipboard') . '", { timeout: 1500 });'
                                );
                            })
                    ),
                Forms\Components\TextInput::make('client_id')
                    ->disabled()
                    ->formatStateUsing(fn($record) => $record?->id)
                    ->hiddenOn(['create'])
                    ->suffixAction(
                        Action::make('copy')
                            ->icon('heroicon-s-clipboard-document-check')
                            ->action(function ($livewire, $state) {
                                $livewire->js(
                                    'window.navigator.clipboard.writeText("' . $state . '");
                                        $tooltip("' . __('Copied to clipboard') . '", { timeout: 1500 });'
                                );
                            })
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
            'index' => Pages\ListOauthClients::route('/'),
            'create' => Pages\CreateOauthClient::route('/create'),
            'edit' => Pages\EditOauthClient::route('/{record}/edit'),
        ];
    }
}
