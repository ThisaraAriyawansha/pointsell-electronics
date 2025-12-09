<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function users()
    {
        return view('users.users');
    }
    public function permissionList()
    {
        $permission = Permission::all();
        // Pass the suppliers data to the view
        return view('users.permissionList', compact('permission'));
    }
    public function rolesList() {
        // Fetch all roles from the database
        $roles = Role::all(); // This retrieves all role records
    
        // Pass the roles to the view
        return view('users.rolesList', compact('roles'));
    }
    
    public function usersList()
    {
        $user = User::with(['status', 'role'])->get(); // Eager load status and role relationships
        return view('users.usersList', compact('user'));
    }
    
    

    public function addPermission()
    {
        return view('users.addPermission');
    }
    public function addRole()
    {
        return view('users.addRole');
    }
    public function addUsers()
    {
        $role = Role::all(); // This retrieves all role records
        // Pass the roles to the view
        return view('users.addUsers', compact('role'));
    }

    public function editPermission($id)
    {
        // Retrieve the permission data based on the id
        $permission = Permission::findOrFail($id);
    
        // Pass the permission data to the view
        return view('users.updatePermission', compact('permission'));
    }
    
    public function editRole($id)
    {
        $user = Role::find($id); // Fetch user by ID
        $permissions = Permission::all(); // Retrieve all permissions
        return view('users.updateRole', compact('user', 'permissions'));
    }
    
    public function editUsers($id)
    {
        $role = Role::all(); // Retrieve all roles
        $user = User::findOrFail($id); // Retrieve the user by ID
        return view('users.updateUsers', compact('role', 'user'));
    }
    

        // Save the permission to the database
        public function store(Request $request)
        {
            // Validate the incoming data
            $request->validate([
                'permission' => 'required|string|max:255|unique:permissions,permissions_name',
            ]);

            try {
                // Save the permission to the database
                Permission::create([
                    'permissions_name' => $request->permission,
                ]);

                // Redirect with a success message
                return redirect()->back()->with('success', 'Permission added successfully!');
            } catch (\Exception $e) {
                // In case of an error, return with an error message
                return redirect()->back()->with('error', 'Something went wrong. Please try again.');
            }
        }


               
        // Update the permission in the database
        public function updatePermission(Request $request, $id)
        {
            try {
                // Validate the request data
                $validated = $request->validate([
                    'permission' => 'required|string|max:255|unique:permissions,permissions_name,' . $id,
                ]);

                // Find the permission by ID
                $permission = Permission::findOrFail($id);

                // Update the permission data
                $permission->permissions_name = $validated['permission'];
                $permission->save();

                // Redirect the user to the permission list with a success message
                return redirect()->back()->with('success', 'Permission updated successfully!');
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                // Handle the case where the permission is not found
                return redirect()->back()->with('error', 'Permission not found.');
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Handle validation errors (Laravel does this automatically, but it's here for clarity)
                return redirect()->back()->withErrors($e->errors());
            } catch (\Exception $e) {
                // Handle any other errors
                return redirect()->back()->with('error', 'Something went wrong. Please try again.');
            }
        }



            // Save the Role to the database
            public function storeRole(Request $request)
            {
                // Validate the incoming data
                $request->validate([
                    'role' => 'required|string|max:255|unique:roles,role_name',
                ]);
            
                try {
                    // Save the role to the database
                    Role::create([
                        'role_name' => $request->role,
                    ]);
            
                    // Redirect with a success message
                    return redirect()->back()->with('success', 'Role added successfully!');
                } catch (\Exception $e) {
                    // Log the error for debugging
                    \Log::error('Error adding role: ' . $e->getMessage());
            
                    // Redirect with an error message
                    return redirect()->back()->with('error', 'Something went wrong. Please try again.');
                }
            }
            


            public function updateRole(Request $request, $id)
                {
                    // Validate incoming request
                    $request->validate([
                        'permissions' => 'array',
                        'permissions.*' => 'exists:permissions,id', // Ensure each permission exists
                    ]);

                    // Find user by ID
                    $user = Role::findOrFail($id);

                    // Sync permissions with the user
                    if ($request->has('permissions')) {
                        // Sync permissions, this will attach new ones and detach old ones not in the array
                        $user->permissions()->sync($request->permissions);
                    } else {
                        // If no permissions are selected, detach all permissions
                        $user->permissions()->detach();
                    }

                    // Redirect back with success message
                    return redirect()->back()->with('success', 'Role Update successfully!');
                }
                

                //Add user
                public function userstore(Request $request)
                {
                    $validatedData = $request->validate([
                        'name' => 'required|string|max:255',
                        'Mobile_Number' => 'required|regex:/^[0-9]{10}$/|unique:users,number',
                        'email' => 'required|email|unique:users,email',
                        'password' => 'required|min:6|confirmed',
                        'gender' => 'required',
                        'role' => 'required|exists:roles,id',
                    ]);
                
                    $user = new User();
                    $user->name = $validatedData['name'];
                    $user->number = $validatedData['Mobile_Number'];
                    $user->email = $validatedData['email'];
                    $user->password = bcrypt($validatedData['password']);
                    $user->gender = $validatedData['gender'];
                    $user->roles_id = $validatedData['role'];
                    $user->status_id = 1; // Assuming 1 is the default active status
                
                    if ($user->save()) {
                        return redirect()->back()->with('success', 'User added successfully.');
                    } else {
                        return redirect()->back()->with('error', 'Failed to add user.');
                    }
                }
                

                //Update user
                public function update(Request $request, $id)
                {
                    $validatedData = $request->validate([
                        'name' => 'required|string|max:255',
                        'Mobile_Number' => 'required|regex:/^[0-9]{10}$/|unique:users,number,' . $id,
                        'email' => 'required|email|unique:users,email,' . $id,
                        'password' => 'nullable|min:6|confirmed',
                        'gender' => 'required',
                        'role' => 'exists:roles,id',
                    ]);

                    $user = User::findOrFail($id);

                    $user->name = $validatedData['name'];
                    $user->number = $validatedData['Mobile_Number'];
                    $user->email = $validatedData['email'];
                    $user->gender = $validatedData['gender'];
                    $user->roles_id = $validatedData['role'];

                    // Update password only if provided
                    if (!empty($validatedData['password'])) {
                        $user->password = bcrypt($validatedData['password']);
                    }

                    if ($user->save()) {
                        return redirect()->back()->with('success', 'User Update successfully.');
                    } else {
                        return redirect()->back()->with('error', 'Failed to update user.');
                    }
                }


                public function toggleUserStatus($id)
                {
                    try {
                        // Find the user by ID
                        $user = User::findOrFail($id);
                        
                        // Toggle the status_id between 1 (Active) and 2 (Inactive)
                        $user->status_id = $user->status_id === 1 ? 2 : 1;
                        
                        // Save the updated user
                        $user->save();
                
                        // Return a JSON response with the updated status_id
                        return response()->json(['status_id' => $user->status_id]);
                
                    } catch (\Exception $e) {
                        // Log the exception for debugging
                        \Log::error('Error toggling user status: ' . $e->getMessage());
                        \Log::error($e->getTraceAsString());
                
                        // Return a JSON response with error information
                        return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
                    }
                }
                
                

                
                

}
