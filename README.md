<p align="center"><svg width="256px" height="256px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 12H7L9 19L12 5L15 17L17 12H21" stroke="#005EB8" stroke-width="1.44" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></p>

## Healthcare Manager

This application allows users to create, edit, delete, and otherwise manage patient records. There is also an admin panel, where user profiles can be created and managed.

This app uses the following to function:
- [Laravel](https://laravel.com/) for the base application.
- [Filament v3](https://filamentphp.com/) for tables, forms, and panels.
- [Laravel Jetstream](https://jetstream.laravel.com/introduction.html) for user authentication.
- [Livewire](https://livewire.laravel.com/docs/components) for dynamic components.
- [Tailwind](https://tailwindcss.com/) for styling.

The requirements can be installed via `composer install` and `npm install`
## Installation

Clone the project down from GitHub to your directory of choice.

`cd` to the project directory.

Run `composer install`

Create a copy of the included `.env.example` file, called `.env`: `cp .env.example .env`

The database settings in `.env` will already be configured, but please ensure the `DB_USERNAME` and `DB_PASSWORD` are set as required access.

Run `php artisan key:generate`

Run `php artisan migrate`

Run `php artisan db:seed`

Run `npm install`

Run `php artisan serve`

Run `npm run build`

## Usage

Go to https://localhost:8000/ to launch the application.

You can sign in as `admin@healthcare.com`, using `admin123` as your password. Alternatively, you can register
as a new user, - but note by default you will not have access to the admin panel doing this.

Once logged in, you will be redirected to the main dashboard. From here there are shortcuts to the main Patients view,
as well as the form for creating new patients.

From the navigation bar, you can access the Dashboard, Patient List, as well as update your profile, and access Admin
controls if permissions are set appropriately.

## Patient List

This (`/patients`) is the main index list of all patients in the system. By default, 50 example patients will be generated
when the database is seeded during set-up.

This view is powered by a Filament Table, which allows the sorting and searching of patients via all of the default
columns.

Each patient row has an edit button, and a delete button. These do what they say on the tin, and provide quick access to
their respective functions. The edit button will open a new page described below.

Patients can be deleted individually, or can be selected and then deleted in bulk. Doing either of these
will require confirmation to be given by way of a Modal that pops up upon clicking delete.

Finally, there is a button on the table for loading the Create Patient form.

## Create Patient

This is a simple form that allows you to fill out the relevant information about the patient and then insert them
into the database. Certain fields are required, with some conditionally required:
- Phone numbers and emails are required *only* if the other is not filled out on submission.
- The preferred sex description field, is *only* required if the sex dropdown is set to 'Prefers to self describe'.

The doctors dropdown loads users from the `Users` table where the `is_doctor` column is set to `true`.

The sex dropdown loads its options from the `patients_sexes` table. The chosen value is stored in the `sex` column on
the patient's model.

## Edit Patient

This view is a modified version of the `Create Patient` view, with the patient's information automatically loaded into
the form.

There are no significant changes, with the exception that the `NHS_no` will not be checked if it has not been changed,
as it is registered as a unique key.

## Admin Panel

This panel is made with `Filament`, and can be accessed at `/admin`, and will automatically appear on your navigation
bar if the current user has `is_admin` set as `true` in the database.

From here you can manage the user profiles on the system. You are able to create new users and modify existing
ones. You can also modify whether users have `is_admin`, and `is_doctor`.

By default, the `admin@healthcare.com` user has full access to this panel.
