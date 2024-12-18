<?php

namespace App\Filament\Resources;

use App\Domain\Passenger\FlightCollisionDetector;
use App\Filament\Resources\PassengerResource\Pages;
use App\Filament\Resources\PassengerResource\RelationManagers;
use App\Models\Passenger;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PassengerResource extends Resource
{
    protected static ?string $model = Passenger::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
//                Tables\Columns\TextColumn::make('collision')->getStateUsing(
//                    function (Passenger $record) {
//                        return FlightCollisionDetector::run($record);
//                    }
//                ),

                Tables\Columns\TextColumn::make('flights.number')
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                  //$query->with('flights');
            })
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
            RelationManagers\FlightsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPassengers::route('/'),
            'create' => Pages\CreatePassenger::route('/create'),
            'edit' => Pages\EditPassenger::route('/{record}/edit'),
        ];
    }
}
