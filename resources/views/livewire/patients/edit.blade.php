<div class="mx-auto py-5 px-6">
    <form wire:submit="save">
        {{ $this->form }}

        <x-button class="mt-4"> Submit </x-button>
    </form>

    <x-filament-actions::modals />
</div>
