<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryIssueResource\Pages;
use App\Filament\Resources\InventoryIssueResource\RelationManagers;
use App\Models\Inventory;
use App\Models\InventoryIssue;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryIssueResource extends Resource
{
    protected static ?string $model = InventoryIssue::class;
    protected static ?string $navigationGroup = 'Manage Inventory';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('inventory_id')
                    ->relationship('inventory', 'item_name')
                    ->required(),
                Forms\Components\Select::make('employee_id')
                    ->required()
                    ->relationship('employee', 'name'),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\Toggle::make('returnable')
            ->inline(false)
                    ->label('Returnable Item')
                    ->live()
                    ->required(),
                Forms\Components\DatePicker::make('issue_date')
                    ->required(),
                Forms\Components\DatePicker::make('return_date')
            ->minDate(fn(Get $get) => Carbon::parse($get('issue_date'))->subDay(-1))
                    ->visible(fn(Get $get): bool =>  $get('returnable'))
                    ->required(),
                Forms\Components\Textarea::make('remarks')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('inventory_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('employee_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('returnable')
                    ->boolean(),
                Tables\Columns\TextColumn::make('issue_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('return_date')
                    ->date()
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListInventoryIssues::route('/'),
            'create' => Pages\CreateInventoryIssue::route('/create'),
            'view' => Pages\ViewInventoryIssue::route('/{record}'),
            'edit' => Pages\EditInventoryIssue::route('/{record}/edit'),
        ];
    }
}
