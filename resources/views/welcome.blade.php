<x-guest-layout>
    <div class="container mx-auto p-8 flex">
        <div class="max-w-md w-full mx-auto">
            <h1 class="text-4xl text-center mb-12 font-thin">Healthcare Manager</h1>
            <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                <div class="p-8">
                    @if (Route::has('login'))
                        @auth
                            <h1 class="text-2xl text-left mb-12 font-thin">Logged in?</h1>
                            <a
                                href="{{ url('/dashboard') }}"
                                class="w-full mx-auto p-3 mt-4 bg-indigo-600 text-white rounded shadow block text-center"                            >
                                Dashboard
                            </a>
                            @if(Auth::user()->is_admin)
                                <a
                                    href="{{ url('/admin') }}"
                                    class="w-full mx-auto p-3 mt-4 bg-indigo-600 text-white rounded shadow block text-center"                            >
                                    Admin Controls
                                </a>
                            @endif
                        @else
                            <h1 class="text-2xl text-left mb-12 font-thin">Welcome</h1>
                            <a
                                href="{{ route('login') }}"
                                class="w-full mx-auto p-3 mt-4 bg-indigo-600 text-white rounded shadow block text-center"                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="w-full mx-auto p-3 mt-4 bg-indigo-600 text-white rounded shadow block text-center"                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
