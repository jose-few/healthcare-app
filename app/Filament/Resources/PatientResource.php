<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('doctor_id')
                    ->relationship('doctor', 'name')
                    ->required(),
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('nhs_no')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('address1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address2')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('county')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('postcode')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('dob')
                    ->required(),
                Forms\Components\TextInput::make('sex')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sex_preferred')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('doctor.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nhs_no')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sex')
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }

    public static function buildContactSection(): Section
    {
        return Section::make('Contact Information')
            ->columns([
                'sm' => 1,
                'xl' => 2,
            ])
            ->description('The patients contact details:')
            ->schema([
                TextInput::make('first_name')
                    ->required()
                    ->columnSpan(1)
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->required()
                    ->columnSpan(1)
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->columnSpan(1)
                    ->requiredWithout('phone'),
                TextInput::make('phone')
                    ->tel()
                    ->columnSpan(1)
                    ->requiredWithout('email'),
                TextInput::make('address1')
                    ->required()
                    ->columnSpan(2)
                    ->label('Address 1')
                    ->maxLength(255),
                TextInput::make('address2')
                    ->columnSpan(2)
                    ->label('Address 2')
                    ->maxLength(255),
                TextInput::make('city')
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(255),
                TextInput::make('county')
                    ->columnSpan(1)
                    ->maxLength(255),
                TextInput::make('postcode')
                    ->required()
                    ->columnSpan(1)
                    ->maxLength(255),
            ]);
    }

    public static function buildMedicalSection(bool $new = true, ?Patient $patient = null): Section
    {
        $ignore = null;

        if (!$new)
        {
            $ignore = $patient;
        }

        return Section::make('Medical Information')
            ->columns([
                'sm' => 1,
                'xl' => 2,
            ])
            ->description('The patients medical details:')
            ->schema([
                Select::make('doctor_id')
                    ->label('Doctor')
                    ->relationship(
                        name: 'doctor',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query) => $query->where('is_doctor', 1)
                    )
                    ->native(false)
                    ->columnSpan(1)
                    ->required()
                    ->selectablePlaceholder(false),
                Select::make('sex')
                    ->relationship(
                        name: 'sex',
                        titleAttribute: 'name'
                    )
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => ucwords($record->name))
                    ->selectablePlaceholder(false)
                    ->native(false)
                    ->columnSpan(1)
                    ->required(),
                TextInput::make('sex_preferred')
                    ->columnSpan(2)
                    ->requiredIf('sex', 4)
                    ->label('(If applicable) self description'),
                DatePicker::make('dob')
                    ->required()
                    ->columnSpan(1)
                    ->label('Date of Birth'),
                TextInput::make('nhs_no')
                    ->numeric()
                    ->minLength(10)
                    ->maxLength(10)
                    ->columnSpan(1)
                    ->unique(column: 'nhs_no', ignorable: $ignore)
                    ->label('NHS No.')
                    ->required(),
                TextInput::make('doctor_id')
                    ->hidden()
                    ->numeric()
                    ->default(1),
            ]);
    }
}
