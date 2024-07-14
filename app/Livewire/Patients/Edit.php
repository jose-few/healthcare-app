<?php

namespace App\Livewire\Patients;

use Livewire\Component;
use App\Models\Patient;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

class Edit extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Patient $patient;

    public function mount(Patient $patient): void
    {
        $this->form->fill($patient->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Contact Information')
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
                    ]),
                Section::make('Medical Information')
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                    ])
                    ->description('The patients medical details:')
                    ->schema([
                        Select::make('sex')
                            ->options([
                                1 => 'Male',
                                2 => 'Female',
                                3 => 'Non-binary',
                                4 => 'Prefer to self describe',
                                5 => 'Prefer not to say',
                            ])
                            ->native(false)
                            ->columnSpan(1)
                            ->required(),
                        TextInput::make('sex_preferred')
                            ->columnSpan(1)
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
                            ->unique(column: 'nhs_no', ignorable: $this->patient)
                            ->label('NHS No.')
                            ->required(),
                        TextInput::make('doctor_id')
                            ->hidden()
                            ->numeric()
                            ->default(1),
                        Select::make('doctor_id')
                            ->label('Doctor')
                            ->relationship(name: 'doctor', titleAttribute: 'name')
                            ->native(false)
                            ->columnSpan(2)
                            ->required(),
                    ]),
            ])
            ->statePath('data')
            ->model($this->patient);
    }

    public function save()
    {
        $patient = $this->patient;
        $patient->fill($this->form->getState());
        $patient->save();

        return redirect(route("patients.index"));
    }

    public function render()
    {
        return view('livewire.patients.edit');
    }
}
