<?php

namespace App\Livewire\Patients;

use App\Filament\Resources\PatientResource;
use Livewire\Component;
use App\Models\Patient;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;

class Create extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static string $resource = PatientResource::class;
    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        /**
         * Build our form using reusable form components from the PatientResource.php file.
         */

        return $form
            ->schema([
                PatientResource::buildContactSection(),
                PatientResource::buildMedicalSection(),
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
