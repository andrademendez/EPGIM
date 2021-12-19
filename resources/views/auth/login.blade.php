<x-guest-layout>
    <div class="bg-cover bg-center" style="background-image: url('../images/wall.jpg')">
        <div class="flex flex-col md:flex-row items-center justify-center">
            <div class="min-h-screen flex flex-col items-center justify-center">
                <div class="min-w-full md:mx-auto w-96">
                    <div class="bg-gray-800 bg-opacity-95 rounded-2xl shadow-md px-6 pt-6 pb-8 mx-4">
                        <div class="flex flex-col items-center justify-center">
                            <img src="{{ asset('images/logo_light.png') }}" class="h-14" />
                        </div>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4 text-xs" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="my-4 text-center" :errors="$errors" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mt-5">
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="example@grupogim.com.mx" />

                            </div>

                            <!-- Password -->
                            <div class="mt-5">
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="*************" required autocomplete="current-password" />
                            </div>

                            <div class=" mt-5 pt-4 flex items-center justify-center">
                                <button type="submit" class="inline-block px-10 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-600 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-700 focus:outline-none">
                                    INICIAR SESION
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
