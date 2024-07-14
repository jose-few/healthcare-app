<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Welcome to your Healthcare Manager!
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        This app allows you to manage the various patients in the system. You can add new patients in, adjust exisiting patients, and remove patients as needed.
    </p>

    <p class="mt-6 text-gray-500 leading-relaxed">
        This is your dashboard - feel free to access the shortcuts below.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        <div class="flex items-center">
            <h2 class="text-xl font-semibold text-gray-900">
                <a href="{{ url(route('patients.index')) }}">Patients List</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Use this shortcut to quickly visit the expansive list of all active patients. On this index you will be able to sort the table by various columns of information, search for specific patients, and edit/delete patients.
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ url(route('patients.index')) }}" class="inline-flex items-center font-semibold text-indigo-700">
                View all patients

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

    <div>
        <div class="flex items-center">
            <h2 class="text-xl font-semibold text-gray-900">
                <a href="{{ url(route('patients.create')) }}">Insert a new patient</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Here you can quickly go to the form used for inserting new patients into the system. You will be able to add the patients contact information, D.o.B, NHS no., and assign the patient to an active User (Doctor) on the system.
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ url(route('patients.create')) }}" class="inline-flex items-center font-semibold text-indigo-700">
                Insert record

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>
</div>
