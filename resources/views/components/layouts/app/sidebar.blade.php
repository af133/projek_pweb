<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen {{ request()->is('settings/*') ? 'bg-[#EAEFC4] dark:bg-zinc-800' : 'bg-white dark:bg-zinc-800' }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-[#225E00] dark:border-zinc-700 dark:bg-zinc-900 w-16">
        <flux:sidebar.toggle class="lg:hidden text-white" icon="x-mark" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Logo di atas -->
        <div class="flex flex-col items-center mt-4 mb-2">
            <a href="/" class="mb-2">
                <img src="icon/LogoTaniXpress.png" alt="Logo" class="h-8 w-full rounded-full p-1" />
            </a>
        </div>

        <!-- Menu ikon di tengah (tanpa flux:navlist) -->
        <div class="flex-1 flex flex-col justify-center items-center">
            <div class="flex flex-col items-center space-y-14">
                <a href="{{ route('dashboard') }}" class="text-white hover:bg-green-700 transition-colors p-2 rounded-lg text-xl @if(request()->routeIs('dashboard')) border-2 border-white @endif">
                    <i class="fa-solid fa-house"></i>
                </a>
                <a href="{{ route('cashier') }}" class="text-white hover:bg-green-700 transition-colors p-2 rounded-lg text-xl @if(request()->routeIs('cashier')) border-2 border-white @endif">
                    <i class="fa-solid fa-shopping-cart"></i>
                </a>
                <a href="{{ route('order_history') }}" class="text-white hover:bg-green-700 transition-colors p-2 rounded-lg text-xl @if(request()->routeIs('order_history')) border-2 border-white @endif">
                    <i class="fa-solid fa-shopping-bag"></i>
                </a>
                <a href="{{ route('stock_management') }}" class="text-white hover:bg-green-700 transition-colors p-2 rounded-lg text-xl @if(request()->routeIs('stock_management')) border-2 border-white @endif">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </a>
                <a href="{{ route('report') }}" class="text-white hover:bg-green-700 transition-colors p-2 rounded-lg text-xl @if(request()->routeIs('cashier_report')) border-2 border-white @endif">
                    <i class="fa-solid fa-chart-column"></i>
                </a>
            </div>
        </div>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    @auth
    <flux:header class="{{ request()->is('settings/*') ? 'bg-[#EAEFC4] dark:bg-zinc-800' : 'bg-white dark:bg-zinc-800' }}"
>
        <flux:sidebar.toggle class="lg:hidden text-gray-800 dark:text-white" icon="bars-2" inset="left" />
        <flux:spacer />
        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />
            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>
                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>
    @endauth
   
    
    {{ $slot }}

   

    @fluxScripts
</body>
</html>
