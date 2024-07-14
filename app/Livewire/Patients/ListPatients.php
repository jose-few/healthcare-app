<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Filament\Actions\ForceDeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;

class ListPatients extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Patient::query())
            ->striped()
            ->selectable()
            ->columns([
                TextColumn::make('id')
                    ->weight(FontWeight::Bold)
                    ->label('ID'),
                TextColumn::make('last_name')
                    ->label('Last Name'),
                TextColumn::make('first_name')
                    ->label('First Name'),
                TextColumn::make('email')
                    ->label('Email'),
                TextColumn::make('phone')
                    ->label('Mobile No.'),
                TextColumn::make('nhs_no')
                    ->label('NHS No.'),
            ])
            ->defaultSort('last_name')
            ->persistSortInSession()
            ->actions([
                Action::make('edit')
                    ->url(fn (Patient $record): string => route('patients.edit', $record))
                    ->openUrlInNewTab(),

                Action::make('delete')
                    ->requiresConfirmation()
                    ->color('danger')
                    ->action(fn (Patient $record) => $record->delete()),
            ])
            ->headerActions([
                Action::make('create')
                    ->label('New')
                    ->extraAttributes([
                        'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150'
                    ])
                    ->url(fn (): string => route('patients.create')),
                BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->delete())
                ])
                    ->label('Bulk actions'),
            ])
            ->bulkActions([

            ]);
    }

    public function render(): View
    {
        return view('livewire.patients.list-patients');
    }
}
