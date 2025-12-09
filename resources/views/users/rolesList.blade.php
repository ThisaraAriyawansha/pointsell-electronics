@include('layouts.header')
<div class="flex flex-col min-h-[90vh] max-lg:min-h-[92vh] bg-gray-50">
    <!-- Breadcrumbs -->
    <div class="px-8 py-4 max-sm:px-4">
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
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ asset('/users/users')}}" class="hover:text-gray-900">Users</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="font-medium text-gray-700">Role List</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Search and Controls -->
    <div class="px-8 py-3 max-sm:px-4">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center w-full gap-2 md:w-1/2">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="search_item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Search roles...">
                </div>
            </div>
            

        </div>
    </div>

    <!-- Table Section -->
    <div class="flex flex-col flex-grow px-8 py-4 max-sm:px-4">
        <div class="overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm">
            <div class="overflow-x-auto">
                <table id="RoleTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[{{ $settings[7]->value}}]">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase rounded-tl-lg">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase">
                                Permissions
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase rounded-tr-lg">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($roles as $index => $role)
                        <tr class="transition-all hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                                    </svg>
                                    {{ $role->role_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">
                                    {{ $role->permissions()->count() }} Permissions
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                @if(has_permission(37))
                                <button 
                                    onclick="editRole({{ $role->id }})"
                                    style="background-color: {{ $settings[7]->value }};"
                                    class="px-3 py-1.5 text-sm text-white rounded-md hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2"
                                >
                                    Edit
                                </button>

                                @endif
                                <button class="hidden px-3 py-1.5 ml-2 text-sm text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" onclick="deleteRole({{ $role->id }})">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</div>

<script>
function editRole(roleId) {
    window.location.href = `/users/updateRole/${roleId}`;
}

document.getElementById('search_item').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#RoleTable tbody tr');

    rows.forEach(row => {
        const roleName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        row.style.display = roleName.includes(filter) ? '' : 'none';
    });
});

function showEntries() {
    const rows = document.querySelectorAll('#RoleTable tbody tr');
    let entries = document.getElementById('col_num').value || 30;
    
    rows.forEach((row, index) => {
        row.style.display = index < entries ? '' : 'none';
    });
}

// Initialize with default entries
document.addEventListener('DOMContentLoaded', showEntries);
</script>