<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
{
    $this->validate([
        'email' => ['required', 'string', 'email'],
    ]);

    $status = Password::sendResetLink($this->only('email'));

    if ($status === Password::RESET_LINK_SENT) {
        session()->flash('status', __('Link berhasil dikirim.'));
    } else {
        session()->flash('status', __('Gagal mengirim reset link.'));
    }
}

}; ?>
<div class="flex flex-col items-center justify-center gap-8 max-w-md w-full mx-auto p-6 rounded-xl shadow-lg bg-white dark:bg-zinc-900">
    <x-auth-header 
        :title="__('Lupa Password')" 
        :description="__('Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi.')" 
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center text-sm text-green-500" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6 w-full">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Alamat Email')"
            type="email"
            required
            autofocus
            placeholder="email@example.com"
            viewable
        />

        <flux:button variant="primary" type="submit" class="w-full">
            {{ __('Kirim Link Reset Password') }}
        </flux:button>
    </form>

    <div class="text-sm text-zinc-500 text-center">
        {{ __('Sudah ingat kata sandi?') }}
        <flux:link :href="route('login')" class="text-primary font-medium hover:underline" wire:navigate>
            {{ __('Masuk di sini') }}
        </flux:link>
    </div>
</div>
