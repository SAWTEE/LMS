<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Tables\Actions\Action;

use Filament\Tables\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static ?string $navigationGroup = 'Manage Library';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->disabled(),
                Forms\Components\TextInput::make('book_call_number')
                    ->label('Book Call Number')
                    ->required(),
                Forms\Components\TextInput::make('title')
            ->label('Book Title')
                    ->required(),
            Forms\Components\TextInput::make('author'),
                Forms\Components\TextInput::make('isbn')
            ->label('ISBN Number')
                ->mask('999-9-99-999999-9')
                ->placeholder('999-9-99-999999-9')
            // ->stripCharacters('-')
            ,
                Forms\Components\Select::make('book_category_id')
            ->relationship('category', 'name')
            ->searchable()
            ->preload()
            ->required()
            ->createOptionForm([
                Forms\Components\TextInput::make('name')
                    ->required(),
            ])
                ->editOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required(),
            ])
                    ->native(false),
                Forms\Components\Select::make('shelf_id')
                    ->relationship('shelf', 'name')
            ->searchable()
            ->required()
            ->preload()
            ->createOptionForm([
                Forms\Components\TextInput::make('name')
                    ->required(),
            ])
                ->editOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required(),
            ])
                    ->native(false),
            Forms\Components\TextInput::make('publisher'),
                Forms\Components\TextInput::make('published_year')
            ->numeric(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')
                    ->searchable(),
                Tables\Columns\TextColumn::make('isbn')
            ->searchable()->sortable(),
            Tables\Columns\IconColumn::make('is_issued')->boolean()->columnSpan(1),
            Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('shelf.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('publisher')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Action::make('delete')->action(fn(Book $record) => $record->delete())->button()->color('danger')->requiresConfirmation(),
                Action::make('Issue')->action(function (Book $record) {
                    return redirect(BookIssueResource::getUrl('create', ['book_id' => $record->id]));
            })->button()->color('primary'),
            ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

            ])->iconButton(),

        ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make()->requiresConfirmation(),
                ]),
            ]);

    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CategoryRelationManager::class,
            RelationManagers\ShelfRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'view' => Pages\ViewBook::route('/{record}'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
