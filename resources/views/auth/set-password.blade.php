<x-guest-layout>
    <form method="POST" action="{{ route('password.set') }}">
        @csrf

        <!-- Hidden Fields -->
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="github_id" value="{{ $github_id }}">
        <input type="hidden" name="github_name" value="{{ $github_name }}">
        <input type="hidden" name="github_username" value="{{ $github_username }}">
        <input type="hidden" name="username" value="{{ $username }}">
        <input type="hidden" name="github_token" value="{{ $github_token }}">
        <input type="hidden" name="github_refresh_token" value="{{ $github_refresh_token }}">

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autofocus />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Set Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
