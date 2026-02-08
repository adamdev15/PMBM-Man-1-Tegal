<x-guest-layout>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

        <div class="bg-green-600 px-8 py-6 text-center flex flex-col items-center">

            <a href="{{ route('landing') }}">
                <img src="{{ asset('images/logo_kemenag.png') }}"
                    alt="Logo"
                    class="h-12 w-auto mx-auto mb-3">
            </a>

            <h1 class="text-white text-2xl font-bold">
                Login Admin
            </h1>

            <p class="text-green-100 text-sm mt-1">
                Masuk ke sistem manajemen PMBM
            </p>

        </div>

        <div class="p-8">

            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if($errors->any())
                <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4">
                    {{ $errors->first() }}
                </div>
                @endif

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="admin@email.com"
                        required autofocus>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Password
                    </label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="********"
                        required>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-green-600 focus:ring-green-500 mr-2">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-gray-500 hover:text-green-600">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-green-500/30 transition transform hover:-translate-y-0.5">
                    Login Sekarang
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('landing') }}"
                   class="text-sm text-gray-500 hover:text-green-600">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>

</x-guest-layout>
