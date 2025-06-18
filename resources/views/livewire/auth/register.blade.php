<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex-1 bg-white flex items-center justify-center p-8">
    <div class="w-full max-w-md">
        <div class="flex flex-col gap-6">
            <!-- Heading -->
            <div class="leading-none">
                <h1 class="text-4xl font-black text-black">Register</h1>
                <div class="h-2 rounded-full w-[40%]" style="background: linear-gradient(90deg, 
                    #346473 0%, 
                    #25A55F 40%, 
                    #9BDF46 100%)">
                </div>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <!-- Form -->
            <form wire:submit="register" class="flex flex-col gap-6">
                <!-- Name -->
                <flux:input
                    wire:model="name"
                    type="text"
                    :label="__('Nama')"
                    required
                    autofocus
                    autocomplete="name"
                    :placeholder="__('Nama')"
                />

                <!-- Email Address -->
                <flux:input
                    wire:model="email"
                    type="email"
                    :label="__('Alamat Email')"
                    required
                    autocomplete="email"
                    placeholder="Alamat Email"
                />

                <!-- Password -->
                <flux:input
                    wire:model="password"
                    type="password"
                    required
                    :label="__('Password')"
                    autocomplete="new-password"
                    placeholder="Password"
                    viewable
                />

                <!-- Confirm Password -->
                <flux:input
                    wire:model="password_confirmation"
                    type="password"
                    required
                    :label="__('Konfirmasi Password')"
                    autocomplete="new-password"
                    placeholder="Konfirmasi Password"
                    viewable
                />

                <div class="flex items-center justify-end">
                    <flux:button type="submit" variant="primary" class="w-full">
                        {{ __('Sign Up') }}
                    </flux:button>
                </div>
            </form>

            <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                {{ __('Telah mempunyai akun?') }}
                <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
            </div>
        </div>
    </div>
</div>
