<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationGroup = 'Manage Address Book';
    protected static ?string $navigationIcon = 'heroicon-s-user-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([Forms\Components\Select::make('title')
                ->options(['Mr' => 'Mr', 'Mrs' => 'Mrs', 'Miss' => 'Miss', 'Dr' => 'Dr', 'Prof.' => 'Prof.', 'Other' => 'Other'])->default('Other')->required(),
                Forms\Components\TextInput::make('name')
                ->required()->placeholder('John Doe'),
            Forms\Components\Select::make('gender')
                ->options(['male' => 'Male', 'female' => 'Female', 'lgbqt' => 'LGBQT', 'prefer not to say' => 'Prefer not to say', 'other' => 'Other'])->default('other')->required(),
            Forms\Components\TextInput::make('designation')
                ->placeholder('CEO, Manager, Teacher'),
            Forms\Components\Select::make('language')
                ->options(['english' => 'English', 'nepali' => 'Nepali', 'both' => 'Both', 'other' => 'Other'])->default('other'),
                Forms\Components\TextInput::make('email')
                ->email()->placeholder('john.doe@me.com'),
                Forms\Components\TextInput::make('fax')
            ->tel()
                ->integer()
                ->mask('+999-999-999-9999')
                ->placeholder('+999-999-999-9999')
                ->stripCharacters('-', '+')
                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                ->integer()
                ->mask('+999-999-999-9999')
                ->placeholder('+999-999-999-9999')
                ->stripCharacters('-', '+')
                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                Forms\Components\TextInput::make('mobile_number')
            ->tel()
            ->integer()
            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
            ->mask('+999-999-999-9999')
            ->placeholder('+999-999-999-9999')
                ->stripCharacters('-', '+'),
                Forms\Components\TextInput::make('extension_number')
            ->length(3)
            ->mask('999')
            ->placeholder('999')
            ->stripCharacters('-', '+')
                    ->numeric(),
            Forms\Components\TextInput::make('organisation_name')->placeholder('Area 51'),
            Forms\Components\TextInput::make('organisation_department')->placeholder('IT Department'),
            Forms\Components\TextInput::make('organisation_address')->placeholder('Area 51, Nevada, United States'),
            Forms\Components\TextInput::make('personal_address_one')->placeholder('Area 51, Nevada, United States'),
            Forms\Components\TextInput::make('personal_address_two')->placeholder('Area 51, Nevada, United States'),
            Forms\Components\TextInput::make('city')->placeholder('Nevada'),
            Forms\Components\TextInput::make('state')->placeholder('Nevada'),
            Forms\Components\TextInput::make('country')->placeholder('United States'),
            Forms\Components\TextInput::make('region')->placeholder('Nevada'),
            Forms\Components\TextInput::make('zip_code')->placeholder('00000'),
            Forms\Components\TextInput::make('postal_code')->placeholder('00000'),
                Forms\Components\Select::make('contact_category_id')
                    ->relationship('contactCategory', 'name')
                ->required()->default('3'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('name')
            ->searchable()
            ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('designation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('language')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
            Tables\Columns\TextColumn::make('fax'),
            Tables\Columns\TextColumn::make('phone_number')
            ->searchable(),
                Tables\Columns\TextColumn::make('mobile_number')
            ->searchable(),
                Tables\Columns\TextColumn::make('extension_number')
            ->numeric(),
                Tables\Columns\TextColumn::make('organisation_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('organisation_department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('organisation_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('personal_address_one')
                    ->searchable(),
                Tables\Columns\TextColumn::make('personal_address_two')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('postal_code')
                    ->searchable(),

                Tables\Columns\TextColumn::make('contactCategory.name')
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
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListContacts::route('/'),
            'grid' => Pages\GridViewContacts::route('/grid'),
            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

}
