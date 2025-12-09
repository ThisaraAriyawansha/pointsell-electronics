@include('layouts.header')
<div class="flex flex-col flex-grow min-h-screen bg-gray-50">
    <div class="px-8 py-5 max-sm:px-4">
        <!-- Breadcrumbs -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 text-sm text-gray-600">
                <li class="inline-flex items-center">
                    <a href="{{ asset('/dashboard')}}" class="inline-flex items-center hover:text-gray-900">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Main Panel
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="font-medium text-gray-700 ms-1">Update Role</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Flash Messages -->
    <div class="px-8 max-sm:px-4">
        @if (session('success'))
            <div class="flex items-center justify-between p-4 mb-4 text-sm text-green-800 border border-green-200 rounded-lg bg-green-50">
                <div class="flex items-center">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="text-green-500 hover:text-green-700" onclick="this.parentElement.style.display='none'">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @elseif (session('error'))
            <div class="flex items-center justify-between p-4 mb-4 text-sm text-red-800 border border-red-200 rounded-lg bg-red-50">
                <div class="flex items-center">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.style.display='none'">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <div class="px-8 py-4 max-sm:px-4">
        <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h2 class="mb-6 text-xl font-semibold text-gray-800">Update Role Permissions</h2>
            
            <form method="POST" action="{{ route('users.updateRole', $user->id) }}">
                @csrf
                
                <!-- Role Name -->
                <div class="mb-6">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-700">Role Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                            </svg>
                        </div>
                        <input 
                            id="role" 
                            name="role" 
                            type="text" 
                            value="{{ $user->role_name }}" 
                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full ps-10 p-2.5" 
                            readonly 
                            required
                        >
                    </div>
                </div>

                <!-- Permissions Section -->
                <div class="mb-8">
                    <h3 class="mb-4 text-lg font-medium text-gray-800">Permissions</h3>
                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($permissions as $permission)
                            <div class="flex items-center p-3 rounded-lg bg-gray-50 hover:bg-gray-100">
                                <input 
                                    id="permission-{{ $permission->id }}" 
                                    type="checkbox" 
                                    name="permissions[]" 
                                    value="{{ $permission->id }}" 
                                    class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500 focus:ring-2" 
                                    {{ $user->permissions->contains($permission) ? 'checked' : '' }}
                                >
                                <label for="permission-{{ $permission->id }}" class="text-sm font-medium text-gray-700 ms-2">
                                    {{ $permission->permissions_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="window.location.href='/users/rolesList'" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        Cancel
                    </button>
                    <button type="reset" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                        Reset
                    </button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-[{{ $settings[7]->value}}] rounded-lg hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Update Permissions
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
    // Auto-dismiss flash messages after 4 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const flashMessages = document.querySelectorAll('.bg-green-50, .bg-red-50');
        
        flashMessages.forEach(message => {
            setTimeout(() => {
                message.style.opacity = '0';
                setTimeout(() => {
                    message.style.display = 'none';
                }, 300);
            }, 4000);
        });
    });
</script>