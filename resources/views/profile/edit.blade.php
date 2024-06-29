<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('GitHub Connection') }}</h3>
                    <div class="mt-4">
                        @if (Auth::user()->github_id)
                            <form method="POST" action="{{ route('profile.disconnect-github') }}">
                                @csrf
                                @method('DELETE')
                                <x-primary-button class="flex items-center bg-red-500 hover:bg-red-700">
                                    <i class="fa-brands fa-github me-2"></i> {{ __('Disconnect from GitHub') }}
                                </x-primary-button>
                            </form>
                        @else
                            <a href="{{ route('auth.github') }}">
                                <x-primary-button class="flex items-center bg-blue-500 hover:bg-blue-700">
                                    <i class="fa-brands fa-github me-2"></i> {{ __('Connect to GitHub') }}
                                </x-primary-button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    setTimeout(function() {
        let flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(function(flashMessage) {
            flashMessage.style.transition = 'opacity 1s';
            flashMessage.style.opacity = '0';
            setTimeout(function() {
                flashMessage.style.display = 'none';
            }, 1000);
        });
    }, 2000);
</script>
