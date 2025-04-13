<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientesResource\Pages;
use App\Filament\Resources\ClientesResource\RelationManagers;
use App\Models\Clientes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientesResource extends Resource
{
    protected static ?string $model = Clientes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('tipo_persona')
                ->label('Tipo de Persona')
                ->options([
                    'N' => 'Persona Natural',
                    'J' => 'Persona Jurídica',
                ])
                ->required()
                ->reactive(),

            // Campos para Persona Natural
            Forms\Components\TextInput::make('nombre_1')
                ->label('Primer Nombre')
                ->required()
                ->maxLength(30)
                ->visible(fn ($get) => $get('tipo_persona') === 'N'),

            Forms\Components\TextInput::make('nombre_2')
                ->label('Segundo Nombre')
                ->maxLength(30)
                ->visible(fn ($get) => $get('tipo_persona') === 'N'),

            Forms\Components\TextInput::make('apellido_1')
                ->label('Primer Apellido')
                ->required()
                ->maxLength(30)
                ->visible(fn ($get) => $get('tipo_persona') === 'N'),

            Forms\Components\TextInput::make('apellido_2')
                ->label('Segundo Apellido')
                ->maxLength(30)
                ->visible(fn ($get) => $get('tipo_persona') === 'N'),

            // Campos para Persona Jurídica
            Forms\Components\TextInput::make('razon_social')
                ->label('Razón Social')
                ->required()
                ->maxLength(120)
                ->visible(fn ($get) => $get('tipo_persona') === 'J'),

            // Campos comunes
            Forms\Components\TextInput::make('email')
                ->label('Correo Electrónico')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\Select::make('tipo_documento')
                ->label('Tipo de Documento')
                ->options([
                    'CC' => 'Cédula de Ciudadanía',
                    'CE' => 'Cédula de Extranjería',
                    'NIT' => 'NIT',
                    'PAS' => 'Pasaporte',
                ])
                ->required(),

            Forms\Components\TextInput::make('numero_documento')
                ->label('Número de Documento')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\Select::make('tipo_cliente')
                ->label('Tipo de Cliente')
                ->options([
                    'REGULAR' => 'Regular',
                    'VIP' => 'VIP',
                    'MAYORISTA' => 'Mayorista',
                ])
                ->required(),

            Forms\Components\TextInput::make('telefono')
                ->label('Teléfono')
                ->tel()
                ->required(),

            Forms\Components\TextInput::make('direccion')
                ->label('Dirección')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('ciudad')
                ->label('Ciudad')
                ->required(),

            Forms\Components\TextInput::make('departamento')
                ->label('Departamento')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipo_persona')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'N' => 'success',
                        'J' => 'info',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'N' => 'Natural',
                        'J' => 'Jurídica',
                    }),
                Tables\Columns\TextColumn::make('nombre_completo')
                    ->label('Nombre')
                    ->searchable(['nombre_1', 'apellido_1', 'razon_social'])
                    ->getStateUsing(function ($record): string {
                        return $record->tipo_persona === 'N'
                            ? "{$record->nombre_1} {$record->apellido_1}"
                            : $record->razon_social;
                    }),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo_documento')
                    ->label('Tipo Doc.')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_documento')
                    ->label('Número Doc.')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ciudad')
                    ->label('Ciudad')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateClientes::route('/create'),
            'edit' => Pages\EditClientes::route('/{record}/edit'),
        ];
    }
}
