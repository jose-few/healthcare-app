<?php

namespace App\Livewire\Patients;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use App\Models\Patient;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Http\RedirectResponse;
use Filament\Forms\Components\Hidden;

class Create extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
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
                            ->unique(column: 'nhs_no')
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
            ->model(Patient::class);
    }

    public function create()
    {
        Patient::create($this->form->getState());

        return redirect(route("patients.index"));
    }

    public function render(): View
    {
        return view('livewire.patients.create');
    }
}
