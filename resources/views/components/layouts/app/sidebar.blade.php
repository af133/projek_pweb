<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
    <body class="min-h-screen bg-[white] dark:bg-zinc-800 ">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <flux:sidebar sticky stashable class="w-16 border-e border-green-700/20 bg-green-800 flex flex-col">
            <flux:sidebar.toggle class="lg:hidden text-white" icon="x-mark" />
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-[#225E00] dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
            @vite('resources/js/app.js')

            <!-- Spacer atas untuk mendorong navigasi ke tengah -->
            <div class="flex-1"></div>

            <!-- Container navigasi yang terpusat -->
            <div class="flex flex-col items-center justify-center space-y-8">
                <flux:navlist class="flex-shrink-0" variant="outline">
                    <flux:navlist.group :heading="__('')" class="grid gap-8">
                        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                            class="flex items-center justify-center text-white hover:bg-green-700 transition-colors p-3 rounded-lg">
                            {{ __('') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="shopping-cart" :href="route('cashier')" :current="request()->routeIs('cashier')"
                            class="flex items-center justify-center text-white hover:bg-green-700 transition-colors p-3 rounded-lg">
                            {{ __('') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="shopping-bag" :href="route('order_history')" :current="request()->routeIs('order_history')"
                            class="flex items-center justify-center text-white hover:bg-green-700 transition-colors p-3 rounded-lg">
                            {{ __('') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="document-chart-bar" :href="route('stock_management')" :current="request()->routeIs('stock_management')"
                            class="flex items-center justify-center text-white hover:bg-green-700 transition-colors p-3 rounded-lg">
                            {{ __('') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="document-currency-dollar" :href="route('report')" :current="request()->routeIs('cashier_report')"
                            class="flex items-center justify-center text-white hover:bg-green-700 transition-colors p-3 rounded-lg">
                            {{ __('') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>
            </div>

            <!-- Spacer bawah untuk menjaga navigasi tetap di tengah -->
            <div class="flex-1"></div>
            
            <flux:spacer/>
            
            <flux:navlist class="" variant="outline">
                <flux:navlist.group :heading="__('')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" class="justify-center">{{ __('') }}</flux:navlist.item>
                    <flux:navlist.item icon="shopping-cart" :href="route('cashier')" :current="request()->routeIs('cashier')" class="justify-center">{{ __('') }}</flux:navlist.item>
                    <flux:navlist.item icon="shopping-bag" :href="route('order_history')" :current="request()->routeIs('order_history')" class="justify-center">{{ __('') }}</flux:navlist.item>
                    <flux:navlist.item icon="document-chart-bar" :href="route('stock_management')" :current="request()->routeIs('stock_management')" class="justify-center">{{ __('') }}</flux:navlist.item>
                    <flux:navlist.item icon="document-currency-dollar" :href="route('report')" :current="request()->routeIs('cashier_report')" class="justify-center">{{ __('') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist> 

            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
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
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="bg-white dark:bg-zinc-800">
            <flux:sidebar.toggle class="lg:hidden text-gray-800 dark:text-white" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
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

        {{ $slot }}

        @fluxScripts
    </body>
</html>
