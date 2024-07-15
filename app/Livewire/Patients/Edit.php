<?php

namespace App\Livewire\Patients;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use App\Models\Patient;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use App\Filament\Resources\PatientResource;

class Edit extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Patient $patient;

    protected static string $resource = PatientResource::class;

    public function mount(Patient $patient): void
    {
        $this->form->fill($patient->toArray());
    }

    public function form(Form $form): Form
    {
        /**
         * Build an edit form using components built in PatientResource.php.
         */
        return $form
            ->schema([
                PatientResource::buildContactSection(),
                PatientResource::buildMedicalSection(false, $this->patient),
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
