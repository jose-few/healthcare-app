<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Tables\Columns\TextColumn;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Make all text columns searchable, sortable, and toggleable by default.
         */

        TextColumn::configureUsing(function (TextColumn $column): void {
            $column
                ->toggleable()
                ->sortable()
                ->searchable();
        });
    }
}
