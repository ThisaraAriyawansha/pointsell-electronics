@include('layouts.header')
<div class="flex flex-col min-h-screen bg-gray-100">
    <!-- Breadcrumbs -->
    <div class="px-4 py-4 bg-white shadow sm:px-6 lg:px-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ asset('/dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Main Panel
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ asset('/settings/settings')}}" class="text-sm font-medium text-gray-600 hover:text-blue-600">Settings</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Change Password</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Main Panel -->
    <div class="flex-grow p-4 sm:p-6 lg:p-8">
        @include('_message')
        <div class="max-w-md p-6 mx-auto bg-white shadow-lg rounded-xl md:p-8">
            <h2 class="mb-6 text-2xl font-bold text-gray-900">Change Password</h2>
            <form method="post" action="">
                {{ csrf_field() }}
                <div class="space-y-6">
                    <div class="relative">
                        <label for="c_psw" class="block mb-2 text-sm font-medium text-gray-900">Current Password</label>
                        <input type="password" id="c_psw" name="old_password" 
                               class="block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               placeholder="Enter current password" required />
                        <button type="button" class="absolute text-gray-500 right-3 top-10 toggle-password" data-target="c_psw">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>

                    <div class="relative">
                        <label for="n_psw" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
                        <input type="password" id="n_psw" name="new_password" 
                               class="block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               placeholder="Enter new password" required />
                        <button type="button" class="absolute text-gray-500 right-3 top-10 toggle-password" data-target="n_psw">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        @error('new_password')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="relative">
                        <label for="con_psw" class="block mb-2 text-sm font-medium text-gray-900">Confirm New Password</label>
                        <input type="password" id="con_psw" name="new_password_confirmation" 
                               class="block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               placeholder="Confirm new password" required />
                        <button type="button" class="absolute text-gray-500 right-3 top-10 toggle-password" data-target="con_psw">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        @error('new_password_confirmation')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-4">
                        <button type="button" id="cancel" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200"
                                onclick="window.location.href='{{ route('settings_page') }}'">Cancel</button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white transition-colors bg-[{{ $settings[7]->value }}] rounded-lg ">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.footer')
</div>

<script>
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', () => {
        const targetId = button.getAttribute('data-target');
        const input = document.getElementById(targetId);
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        button.querySelector('svg').classList.toggle('text-gray-500');
        button.querySelector('svg').classList.toggle('text-blue-500');
    });
});
</script>