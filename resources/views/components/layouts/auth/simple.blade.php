<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
     
        @if (Route::is('login')||Route::is('register'))
        <div class="min-h-screen flex w-full">
            <div class="hidden md:block flex-1 bg-[#346473] bg-cover bg-center relative" style="background-image: url('{{ asset('icon/rightBox.png') }}')">
                <div class="m-5 text-white">
                    <img src="{{ asset('icon/LogoTaniXpress.png') }}" alt="gak ada" class="mb-10 w-[4rem]">
                    <div class="ml-8">
                        <h1 class="text-5xl font-bold">Selamat Datang</h1>
                        <p class="text-3xl mt-2">Di TaniXpress</p>
                    </div>
                </div>
            </div>
        {{ $slot }}
        </div>
        @else
         <div class="relative min-h-svh flex flex-col items-center justify-center gap-6 p-6 md:p-10 {{ Route::is('forgot-password') || Route::is('password.reset') ? 'md:rounded-lg md:shadow-lg' : '' }}"
            @if (Route::is('password.request') || Route::is('password.reset'))
                style="background-image: url('{{ asset('/background-sawah.png') }}'); background-size: cover; background-position: center;"
            @endif
        >
            @if (Route::is('password.request') || Route::is('password.reset'))
                <div class="absolute inset-0 bg-[#00000021]  backdrop-blur-sm z-0"></div>
            @endif

            <div class="relative z-10 w-full max-w-md">
                {{ $slot }}
            </div>
        </div>

        @endif
        @fluxScripts
    </body>
</html>
